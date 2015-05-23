<?php

namespace app\models;

class Posts extends \lithium\data\Model  { 

	public static function getById ($id) {
		if ($post = self::find('first', array('conditions' => array('id' => $id)))) {
			return $post->to('array');
		} else {
			return null;
		}
	}

	public static function getByThreadId ($tid) {
		return self::find('all', array(
			'conditions' => array('tid' => $tid),
			'order' => array('tstamp' => 'ASC')
		))->to('array');
	}
	
	public static function countByThreadId ($tid) {
		return self::count('all', array(
			'conditions' => array('tid' => $tid)
		));
	}
	
	public static function deleteById ($id) {
		if ($post = self::find('first', array('conditions' => array('id' => $id)))) {
			return $post->delete();
		} else {
			return false;
		}
	}
	
	public static function deleteByThreadId ($tid) {
		$posts = self::find('all', array('conditions' => array('tid' => $tid)));
		$result = true;
		foreach ($posts as $post) {
			if (!($post->delete())) {
				$result = false;
			}
		}
		return $result;
	}
}
