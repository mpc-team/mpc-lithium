<?php

namespace app\models;

class Categories extends \lithium\data\Model  
{
	public static function Get ($id) 
    {
        $category = self::find('first', array('conditions' => array('id' => $id)));
		if ($category) 
			return $category->to('array');
		else
			return null;
	}
}
