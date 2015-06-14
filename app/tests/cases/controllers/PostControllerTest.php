<?php

namespace app\tests\cases\controllers;

use app\controllers\PostController;
use app\models\Posts;

class PostControllerTest extends \lithium\test\Unit {
	
	public function setUp() { }
	public function tearDown() { }
	
	public function testClean() {
		$case[0] = "Hello should become hello";
		$case_pass[0] = "Hello should become hello";
	
		$case[1] = "<h1>Hello</h1> should become\n hello\n";
		$case_pass[1] = "Hello should become\n hello";
		
		$case[2] = "Hello\n\n should become\n hello\n";
		$case_pass[2] = "Hello\n\n should become\n hello";
		
		$case[3] = "Hello\n\n\nthis is a test\n\n\n3\n\n";
		$case_pass[3] = "Hello\n\nthis is a test\n\n3";
		
		$case[4] = "What\n\n\n\nthe\n\n\n\nfuck";
		$case_pass[4] = "What\n\nthe\n\nfuck";
		
		$case[5] = "Carriage returns\r should be removed.\r\n\r\n\r\n\r\nCR followed by LF should result in a limited LF-only result.";
		$case_pass[5] = "Carriage returns should be removed.\n\nCR followed by LF should result in a limited LF-only result.";
		
		for ($i = 0; $i < count($case); $i++) {
			$this->assertEqual($case_pass[$i], Posts::clean($case[$i]));
		}
	}
}