<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace lithium\data\entity;

use lithium\util\Collection;
use UnexpectedValueException;

/**
 * `Document` is an alternative to the `entity\Record` class, which is optimized for
 * organizing collections of entities from document-oriented databases such as CouchDB or MongoDB.
 * A `Document` object's fields can represent a collection of both simple and complex data types,
 * as well as other `Document` objects. Given the following data (document) structure:
 *
 * {{{
 * {
 * 	_id: 12345.
 * 	name: 'Acme, Inc.',
 * 	employees: {
 * 		'Larry': { email: 'larry@acme.com' },
 * 		'Curly': { email: 'curly@acme.com' },
 * 		'Moe': { email: 'moe@acme.com' }
 * 	}
 * }
 * }}}
 *
 * You can query the object as follows:
 *
 * {{{$acme = Company::find(12345);}}}
 *
 * This returns a `Document` object, populated with the raw representation of the data.
 *
 * {{{print_r($acme->to('array'));
 *
 * // Yields:
 * //	array(
 * //	'_id' => 12345,
 * //	'name' => 'Acme, Inc.',
 * //	'employees' => array(
 * //		'Larry' => array('email' => 'larry@acme.com'),
 * //		'Curly' => array('email' => 'curly@acme.com'),
 * //		'Moe' => array('email' => 'moe@acme.com')
 * //	)
 * //)}}}
 *
 * As with other database objects, a `Document` exposes its fields as object properties, like so:
 *
 * {{{echo $acme->name; // echoes 'Acme, Inc.'}}}
 *
 * However, accessing a field containing a data set will return that data set wrapped in a
 * sub-`Document` object., i.e.:
 *
 * {{{$employees = $acme->employees;
 * // returns a Document object with the data in 'employees'}}}
 */
class Document extends \lithium\data\Entity implements \Iterator, \ArrayAccess {

	/**
	 * If this `Document` instance has a parent document (see `$_parent`), this value indicates
	 * the key name of the parent document that contains it.
	 *
	 * @see lithium\data\entity\Document::$_parent
	 * @var string
	 */
	protected $_pathKey = null;

	/**
	 * An array containing all related documents, keyed by relationship name, as defined in the
	 * bound model class.
	 *
	 * @var array
	 */
	protected $_relations = array();

	/**
	 * Contains an array of removed fields, where the field names are the keys, and the values are
	 * always `true`.
	 *
	 * @var array
	 */
	protected $_removed = array();

	/**
	 * Contains an array of backend-specific statistics generated by the query that produced this
	 * `Document` object. These stats are accessible via the `stats()` method.
	 *
	 * @see lithium\data\collection\DocumentSet::stats()
	 * @var array
	 */
	protected $_stats = array();

	/**
	 * Holds the current iteration state. Used by `Document::valid()` to terminate `foreach` loops
	 * when there are no more fields to iterate over.
	 *
	 * @var boolean
	 */
	protected $_valid = false;

	protected function _init() {
		parent::_init();
		$data = (array) $this->_data;
		$this->_data = array();
		$this->set($data);
		$exists = $this->_exists;

		$this->_data = $this->_updated;
		$this->_updated = array();
		$this->update();
		$this->_exists = $exists;
		unset($this->_autoConfig);
	}

	/**
	 * PHP magic method used when accessing fields as document properties, i.e. `$document->_id`.
	 *
	 * @param $name The field name, as specified with an object property.
	 * @return mixed Returns the value of the field specified in `$name`, and wraps complex data
	 *         types in sub-`Document` objects.
	 */
	public function &__get($name) {
		$data  = null;
		$null  = null;
		$model = $this->_model;
		$conn  = $model ? $model::connection() : null;

		if (isset($this->_relationships[$name])) {
			return $this->_relationships[$name];
		}
		if (strpos($name, '.')) {
			return $this->_getNested($name);
		}

		if (isset($this->_removed[$name])) {
			return $null;
		}
		if (isset($this->_updated[$name])) {
			return $this->_updated[$name];
		}

		if ($model && $conn) {
			foreach ($model::relations() as $relation => $config) {
				if ($config && (($linkKey = $config->data('fieldName')) === $name)) {
					$data = isset($this->_data[$name]) ? $this->_data[$name] : array();
					$this->_relationships[$name] = $this->_relationship($config);
					return $this->_relationships[$name];
				}
			}
			if (!isset($this->_data[$name]) && $schema = $model::schema($name)) {
				$schema = array($name => $schema);
				$pathKey = $this->_pathKey ? "{$this->_pathKey}.{$name}" : $name;
				$options = compact('pathKey', 'schema') + array('first' => true);
				$this->_data[$name] = $conn->cast($this, array($name => null), $options);
				return $this->_data[$name];
			}
		}
		if (isset($this->_data[$name])) {
			return $this->_data[$name];
		}
		return $null;
	}

	public function export() {
		foreach ($this->_updated as $key => $val) {
			if (is_a($val, __CLASS__)) {
				$path = $this->_pathKey ? "{$this->_pathKey}." : '';
				$this->_updated[$key]->_pathKey = "{$path}{$key}";
				$this->_updated[$key]->_exists = false;
			}
		}
		return parent::export() + array('key' => $this->_pathKey, 'remove' => $this->_removed);
	}

	public function update($id = null, array $data = array()) {
		parent::update($id, $data);

		foreach ($this->_data as $key => $val) {
			if (is_object($val) && method_exists($val, 'update')) {
				$this->_data[$key]->update(null, isset($data[$key]) ? $data[$key] : array());
			}
		}
		$this->_removed = array();
	}

	/**
	 * Instantiates a new `Document` object as a descendant of the current object, and sets all
	 * default values and internal state.
	 *
	 * @param string $classType The type of class to create, either `'entity'` or `'set'`.
	 * @param string $key The key name to which the related object is assigned.
	 * @param array $data The internal data of the related object.
	 * @param array $options Any other options to pass when instantiating the related object.
	 * @return object Returns a new `Document` object instance.
	 */
	protected function _relation($classType, $key, $data, $options = array()) {
		$options['exists'] = false;
		return parent::_relation($classType, $key, $data, $options);
	}

	protected function _relationship($relationship) {
		$classType = ($relationship->type == 'hasMany') ? 'set' : 'entity';
		$config = array('model' => $relationship->to, 'parent' => $this, 'exists' => true);
		$class = $this->_classes[$classType];

		switch ($relationship->link) {
			case $relationship::LINK_EMBEDDED:
				$field = $relationship->fieldName;
				$config['data'] = isset($this->_data[$field]) ? $this->_data[$field] : array();
			break;
		}
		return new $class($config);
	}

	protected function &_getNested($name) {
		$current =& $this;
		$null = null;
		$path = explode('.', $name);
		$length = count($path) - 1;

		foreach ($path as $i => $key) {
			if (is_array($current)) {
				$current =& $current[$key];
			} elseif (isset($current->{$key})) {
				$current =& $current->{$key};
			} else {
				return $null;
			}

			if (is_scalar($current) && $i < $length) {
				return $null;
			}
		}
		return $current;
	}

	/**
	 * PHP magic method used when setting properties on the `Document` instance, i.e.
	 * `$document->title = 'Lorem Ipsum'`. If `$value` is a complex data type (i.e. associative
	 * array), it is wrapped in a sub-`Document` object before being appended.
	 *
	 * @param $name The name of the field/property to write to, i.e. `title` in the above example.
	 * @param $value The value to write, i.e. `'Lorem Ipsum'`.
	 * @return void
	 */
	public function __set($name, $value = null) {
		if (is_array($name)) {
			foreach ($name as $key => $val) {
				$this->__set($key, $val);
			}
			return;
		}
		if (is_string($name) && strpos($name, '.')) {
			return $this->_setNested($name, $value);
		}
		if ($model = $this->_model) {
			$pathKey = $this->_pathKey;
			$options = compact('pathKey') + array('first' => true);
			$value = $model::connection()->cast($this, array($name => $value), $options);
		}
		$this->_updated[$name] = $value;
		unset($this->_increment[$name], $this->_removed[$name]);
	}

	protected function _setNested($name, $value) {
		$current =& $this;
		$path = explode('.', $name);
		$length = count($path) - 1;

		for ($i = 0; $i < $length; $i++) {
			$key = $path[$i];

			if (is_array($current) && isset($current[$key])) {
				$next =& $current[$key];
			} elseif (isset($current->{$key})) {
				$next =& $current->{$key};
			} else {
				unset($next);
				$next = null;
			}

			if ($next === null && ($model = $this->_model)) {
				$current->__set($key, $model::connection()->item($model));
				$next =& $current->{$key};
			}
			$current =& $next;
		}

		if (is_object($current)) {
			$current->__set(end($path), $value);
		}
	}

	/**
	 * PHP magic method used to check the presence of a field as document properties, i.e.
	 * `$document->_id`.
	 *
	 * @param $name The field name, as specified with an object property.
	 * @return boolean True if the field specified in `$name` exists, false otherwise.
	 */
	public function __isset($name) {
		$exists = isset($this->_data[$name]) || isset($this->_updated[$name]);
		return ($exists && !isset($this->_removed[$name]));
	}

	/**
	 * PHP magic method used when unset() is called on a `Document` instance.
	 * Use case for this would be when you wish to edit a document and remove a field, ie.:
	 * {{{
	 * $doc = Post::find($id);
	 * unset($doc->fieldName);
	 * $doc->save();
	 * }}}
	 *
	 * @param string $name The name of the field to remove.
	 * @return void
	 */
	public function __unset($name) {
		$this->_removed[$name] = true;
		unset($this->_updated[$name]);
	}

	/**
	 * Allows several properties to be assigned at once.
	 *
	 * For example:
	 * {{{
	 * $doc->set(array('title' => 'Lorem Ipsum', 'value' => 42));
	 * }}}
	 *
	 * @param $values An associative array of fields and values to assign to the `Document`.
	 * @return void
	 */
	public function set($values) {
		$this->__set($values);
	}

	/**
	 * Allows document fields to be accessed as array keys, i.e. `$document['_id']`.
	 *
	 * @param mixed $offset String or integer indicating the offset or index of a document in a set,
	 *              or the name of a field in an individual document.
	 * @return mixed Returns either a sub-object in the document, or a scalar field value.
	 */
	public function offsetGet($offset) {
		return $this->__get($offset);
	}

	/**
	 * Allows document fields to be assigned as array keys, i.e. `$document['_id'] = $id`.
	 *
	 * @param mixed $offset String or integer indicating the offset or the name of a field in an
	 *              individual document.
	 * @param mixed $value The value to assign to the field.
	 * @return void
	 */
	public function offsetSet($offset, $value) {
		return $this->__set(array($offset => $value));
	}

	/**
	 * Allows document fields to be tested as array keys, i.e. `isset($document['_id'])`.
	 *
	 * @param mixed $offset String or integer indicating the offset or the name of a field in an
	 *              individual document.
	 * @param mixed $value The value to assign to the field.
	 * @return boolean Returns `true` if `$offset` is a field in the document, otherwise `false`.
	 */
	public function offsetExists($offset) {
		return $this->__isset($offset);
	}

	/**
	 * Allows document fields to be unset as array keys, i.e. `unset($document['_id'])`.
	 *
	 * @param mixed $offset String or integer indicating the offset or the name of a field in an
	 *              individual document.
	 * @return void
	 */
	public function offsetUnset($offset) {
		return $this->__unset($offset);
	}

	/**
	 * Rewinds to the first item.
	 *
	 * @return mixed The current item after rewinding.
	 */
	public function rewind() {
		reset($this->_data);
		$this->_valid = (count($this->_data) > 0);
		return current($this->_data);
	}

	/**
	 * Used by the `Iterator` interface to determine the current state of the iteration, and when
	 * to stop iterating.
	 *
	 * @return boolean
	 */
	public function valid() {
		return $this->_valid;
	}

	public function current() {
		return current($this->_data);
	}

	public function key() {
		return key($this->_data);
	}

	/**
	 * Adds conversions checks to ensure certain class types and embedded values are properly cast.
	 *
	 * @param string $format Currently only `array` is supported.
	 * @param array $options
	 * @return mixed
	 */
	public function to($format, array $options = array()) {
		$defaults = array('handlers' => array(
			'MongoId' => function($value) { return (string) $value; },
			'MongoDate' => function($value) { return $value->sec; }
		));

		if ($format == 'array') {
			$options += $defaults;
			$data = array_merge($this->_data, $this->_updated);
			return Collection::toArray(array_diff_key($data, $this->_removed), $options);
		}
		return parent::to($format, $options);
	}

	/**
	 * Returns the next `Document` in the set, and advances the object's internal pointer. If the
	 * end of the set is reached, a new document will be fetched from the data source connection
	 * handle (`$_handle`). If no more records can be fetched, returns `null`.
	 *
	 * @return object|null Returns the next record in the set, or `null`, if no more records are
	 *         available.
	 */
	public function next() {
		$prev = key($this->_data);
		$this->_valid = (next($this->_data) !== false);
		$cur = key($this->_data);

		if (!$this->_valid && $cur !== $prev && $cur !== null) {
			$this->_valid = true;
		}
		return $this->_valid ? $this->__get(key($this->_data)) : null;
	}

	/**
	 * Gets the raw data associated with this `Document`, or single item if `$field` is defined.
	 *
	 * @param string $name If included will only return the named item
	 * @return array Returns a raw array of `Document` data, or individual field value
	 */
	public function data($name = null) {
		if ($name) {
			return parent::data($name);
		}
		$map = function($rel) { return $rel->data(); };
		return $this->to('array') + array_map($map, $this->_relationships);
	}

	/**
	 * Safely (atomically) increments the value of the specified field by an arbitrary value.
	 * Defaults to `1` if no value is specified. Throws an exception if the specified field is
	 * non-numeric.
	 *
	 * @param string $field The name of the field to be incrememnted.
	 * @param string $value The value to increment the field by. Defaults to `1` if this parameter
	 *               is not specified.
	 * @return integer Returns the current value of `$field`, based on the value retrieved from the
	 *         data source when the entity was loaded, plus any increments applied. Note that it
	 *         may not reflect the most current value in the persistent backend data source.
	 * @throws UnexpectedValueException Throws an exception when `$field` is set to a non-numeric
	 *         type.
	 */
	public function increment($field, $value = 1) {
		if (!isset($this->_increment[$field])) {
			$this->_increment[$field] = 0;
		}
		$this->_increment[$field] += $value;

		if (!is_numeric($this->_data[$field])) {
			throw new UnexpectedValueException("Field `{$field}` cannot be incremented.");
		}
		$this->_data[$field] += $value;
	}
}

?>