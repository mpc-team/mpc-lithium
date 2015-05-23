<?php

namespace app\models;

class Games extends \lithium\data\Model  {
	/**
	 * getList
	 *
	 * Returns entire list of available games that are on the database.
	 */
	public static function getList () {
		return Games::find('all')->to('array');
	}
}
