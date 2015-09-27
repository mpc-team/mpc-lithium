<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class GamesController extends ContentController {
	public function index() {
		$this->_render['layout'] = 'games';		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC','Games'),
			'link' => array('/','/games')
		);
		return compact('authorized', 'breadcrumbs'); 
	}
}