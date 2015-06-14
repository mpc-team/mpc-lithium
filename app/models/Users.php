<?php

namespace app\models;

class Users extends \lithium\data\Model  { 

	public static function getById ($id) {
		if ($user = self::find('first', array('conditions' => array('id' => $id)))) {
			return $user->to('array');
		} else {
			return null;
		}
	}
}