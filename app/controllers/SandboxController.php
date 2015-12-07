<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class SandboxController extends \lithium\action\Controller 
{
	public function index() 
	{
		$authorized = Auth::check('default');	
		$breadcrumbs = array(
			'path' => array('MPC','sandbox'),
			'link' => array('/','/Sandbox')
		);
		
		$this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
		));	
	}
}
