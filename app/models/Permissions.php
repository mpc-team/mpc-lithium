<?php

namespace app\models;

class Permissions extends \lithium\data\Model  { 
	const _PUBLIC = 0;
	const _MEMBER = 1;
	const _MOD = 2;
	const _ADMIN = 3;

	public static function is_admin ($content) {
		return $content['permission'] >= self::_MOD;
	}
	
	public static function is_public ($content) {
		return $content['permission'] == self::_PUBLIC;
	}
	
	public static function is_members_only ($content) {
		return $content['permission'] >= self::_MEMBER;
	}
}
