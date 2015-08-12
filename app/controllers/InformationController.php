<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class InformationController extends \lithium\action\Controller {
	
	public function index() {		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC', 'Information'),
			'link' => array('/', '/information')
		);
		return compact('authorized', 'breadcrumbs');
	}
}