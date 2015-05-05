<?php

namespace app\models;

class Permissions extends \lithium\data\Model  { 

	const _PUBLIC = 0;
	const _MEMBER = 1;
	const _MOD = 2;
	const _ADMIN = 3;

	public static function is_admin($user) {
		return $user['permission'] >= self::_MOD;
	}
}
