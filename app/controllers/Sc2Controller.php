<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class Sc2Controller extends \lithium\action\Controller {

	public function index() {
		$this->_render['layout'] = 'games';
		$authorized = Auth::check('default');
		$page = array('title' => 'StarCraft II');
		$sidebar = array(
			'Forum' => '/board/view/7'
		);
		
		return compact('authorized', 'page', 'sidebar');
	}
}
