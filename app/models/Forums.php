<?php

namespace app\models;

class Forums extends \lithium\data\Model  {

	/**
	 * getById
	 *
	 * Returns a Forum (or null if one cannot be found) that matches the specified ID.
	 */
	public static function Get ($id) {
		if ($forum = self::find('first', array('conditions' => array('id' => $id)))) {
			return $forum->to('array');
		} else {
			return null;
		}
	}

    /**
     * Returns a list of Names of the current Forums.
     */
    public static function GetList ()
    {
        return self::find('all', array('fields' => array('id', 'name')))->to('array');
    }
}