<?php

namespace app\tests\cases\controllers;

use app\controllers\BoardController;

class BoardControllerTest extends \lithium\test\Unit {
	
	public function setUp() { }
	public function tearDown() { }

	public function testSort() {
		$threads = array(
			'key1' => array('recent' => array('tstamp' => 10)),
			'key2' => array('recent' => array('tstamp' => 15)),
			'key3' => array('recent' => array('tstamp' => 5))
		);
		$sorted = usort($threads, "\app\controllers\BoardController::thread_sort");
		$sorted_expected = array(
			'key2' => array('recent' => array('tstamp' => 15)),
			'key1' => array('recent' => array('tstamp' => 10)),
			'key3' => array('recent' => array('tstamp' => 5))
		);
		/* Compare the number of exact matches with the size of the associative
			array to determine if the arrays are equivalent. */
		$intersects = array_intersect($threads, $sorted_expected);
		$matched = count($intersects);
		$this->assertEqual($matched, count($threads));
	}
}