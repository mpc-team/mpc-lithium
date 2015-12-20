<?php

namespace app\models;

class Categories extends \lithium\data\Model  
{
	public static function getById ($id) {
		if ($category = self::find('first', array('conditions' => array('id' => $id)))) {
			return $category->to('array');
		} else {
			return null;
		}
	}
}
