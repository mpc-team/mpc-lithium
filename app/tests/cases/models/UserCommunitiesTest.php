<?php

namespace app\tests\cases\models;

use app\models\UserCommunities;
use app\models\Communities;

class UserCommunitiesTest extends \lithium\test\Unit {
	
	const TEST_USER_ID = 136;
	
	public function setUp() { }
	public function tearDown() { }

	public function testIsUserIn () {
		$cid = Communities::make(self::TEST_USER_ID, 'Test Community');
		$this->assertFalse(UserCommunities::isUserIn(self::TEST_USER_ID, $cid));
		$this->assertTrue(Communities::disband($cid));
	}
	
	public function testAddUser () {
		$cid = Communities::make(self::TEST_USER_ID, 'Test Community');
		
		$this->assertTrue(Communities::disband($cid));
	}
}