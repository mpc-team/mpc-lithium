<?php

namespace app\models;

class Posts extends \lithium\data\Model  { 

	public static function clean ($text) {
		$text = trim($text);
		$cleaned = '';
		$linefeeds = 0;
		$length = strlen($text);
		for ($i = 0; $i < $length; $i++) {
			if (ord($text[$i]) == 10) {
				if ($linefeeds < 2) {
					$cleaned .= $text[$i];
					$linefeeds++;
				}
			} elseif (ord($text[$i]) != 13) {
				$cleaned .= $text[$i];
				$linefeeds = 0;
			}
		}
		return strip_tags($cleaned);
	}
	
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
