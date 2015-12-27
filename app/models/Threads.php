<?php

namespace app\models;

class Threads extends \lithium\data\Model  
{
	public static function CleanTitle ($text) 
    {
		$text = strip_tags(trim($text));
		$text = str_replace('\r\n', '', $text);
		$text = str_replace('\n', '', $text);
		$text = str_replace('\r', '', $text);
		return $text;
	}

	public static function Get ($id) 
    {
		if ($thread = self::find('first', array('conditions' => array('id' => $id)))) 
			return $thread->to('array');
		else
			return null;
	}

    public static function UpdateThreadName ($id, $name)
    {
        $thread = self::find('first', array('conditions' => array('id' => $id)));
        if ($thread)
        {
            $thread->name = self::CleanTitle($name);
            $thread->save();
        }
    }

	public static function GetByForum ($fid) 
    {
		return self::find('all', array('conditions' => array('fid' => $fid)))->to('array');;
	}

	public static function DeleteThread ($id) 
    {
		if ($thread = self::find('first', array('conditions' => array('id' => $id))))
			return $thread->delete();
		else
			return false;
	}
}
