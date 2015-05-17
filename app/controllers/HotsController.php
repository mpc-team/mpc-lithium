<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class HotsController extends \lithium\action\Controller {

	public function index() {
		$this->_render['layout'] = 'games';
		$authorized = Auth::check('default');
		$page = array('title' => 'Heroes of the Storm');
		$sidebar = array(
			'Forum' => '/board/view/8'
		);
		
		return compact('authorized', 'page', 'sidebar');
	}
}
