<?php

namespace app\models;

class Users extends \lithium\data\Model  { 

	/**
	 * getById
	 *
	 * Returns a User (or null if one cannot be found) that matches the specified ID.
	 */
	public static function getById ($id) {
		if ($user = self::find('first', array('conditions' => array('id' => $id)))) {
			return $user->to('array');
		} else {
			return null;
		}
	}
}