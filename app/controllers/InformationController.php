<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class InformationController extends \lithium\action\Controller 
{

	//Lists

	
	
	
	//Functions
	public function index() 
	{
		$authorized = Auth::check('default');	
		$breadcrumbs = array(
			'path' => array('MPC','Information'),
			'link' => array('/','/Information')
		);
		
		$this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
		));	
	}
}
