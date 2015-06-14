<?php

namespace app\tests\cases\models;

use app\models\Communities;

class CommunitiesTest extends \lithium\test\Unit {
	
	const TEST_USER_ID = 136;
	
	public function setUp() { }
	public function tearDown() { }

	public function testMakeAndDisband () {
		$cid = Communities::make(self::TEST_USER_ID, "Clan MPC");
		$this->assertTrue($cid > -1);
		$this->assertTrue(Communities::disband($cid));
	}
	
	public function testMakeAndDisbandDuplicate () {
		$cid = Communities::make(self::TEST_USER_ID, "My Community");
		$this->assertTrue($cid > -1);
		$cid2 = Communities::make(self::TEST_USER_ID, "My Community");
		$this->assertTrue($cid2 == -1);
		$this->assertFalse(Communities::disband($cid2));
		$this->assertTrue(Communities::disband($cid));
	}
}