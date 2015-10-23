<?php

namespace app\tests\cases\models;

use app\models\Users;

class UsersTest extends \lithium\test\Unit {
	
	public function setUp() { }
	public function tearDown() { }

	public function testGetUserAvatar( )
	{
		$avatarPath = Users::findAvatarImagePath('b0rg3r@gmail.com');
		print($avatarPath);
	}
}