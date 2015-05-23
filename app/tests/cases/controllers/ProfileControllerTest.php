<?php

namespace app\tests\cases\controllers;

use app\controllers\ProfileController;

class ProfileControllerTest extends \lithium\test\Unit {
	
	public function setUp() { }
	public function tearDown() { }

	public function testGamePlayedCheck() {
		$played = array(
			array('gid' => 5),
			array('gid' => 6)
		);
		$this->assertTrue(ProfileController::isGamePlayed(5, $played));
		$this->assertTrue(ProfileController::isGamePlayed('5', $played));
		$this->assertTrue(ProfileController::isGamePlayed(6, $played));
		$this->assertTrue(ProfileController::isGamePlayed('6', $played));
	}
}