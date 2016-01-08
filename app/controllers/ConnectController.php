<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class ConnectController extends \lithium\action\Controller 
{

	public function index() 
	{
		$authorized = Auth::check('default');	
		$breadcrumbs = array(
			'path' => array('MPC','Connect'),
			'link' => array('/','/connect')
		);
		
		$this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
		));	
	}
}
