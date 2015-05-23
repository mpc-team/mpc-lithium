<?php

namespace app\models;

class Threads extends \lithium\data\Model  { 
	
	public static function getById ($id) {
		if ($thread = self::find('first', array('conditions' => array('id' => $id)))) {
			return $thread->to('array');
		} else {
			return null;
		}
	}
	
	public static function getByForumId ($fid) {
		return self::find('all', array('conditions' => array('fid' => $fid)))->to('array');;
	}
	
	public static function deleteById ($id) {
		if ($thread = self::find('first', array('conditions' => array('id' => $id)))) {
			return $thread->delete();
		} else {
			return false;
		}
	}
}
