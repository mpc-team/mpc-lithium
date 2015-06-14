<?php

namespace app\models;

use app\models\Communities;

class UserCommunities extends \lithium\data\Model  {

	const MAX_PER_USER = 3;
	
	public static function isUserIn ($userid, $communityid) {
		$result = self::find('first', array(
			'conditions' => array('cid' => $communityid, 'uid' => $userid)
		));
		return (boolean) $result;
	}
	
	public static function addUser ($communityid, $userid) {
		if (!self::isUserIn($userid, $communityid)) {
			
		}
	}
}