<?php

namespace app\models;

class Games extends \lithium\data\Model  
{
	public static function getList () 
	{
		return Games::find('all')->to('array');
	}
}
