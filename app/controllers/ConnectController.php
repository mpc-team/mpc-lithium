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
			'path' => array('MPC','connect'),
			'link' => array('/','/Connect')
		);
		
		$this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
		));	
	}
}
