<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class StreamController extends \lithium\action\Controller 
{

	public function index() 
	{
		$authorized = Auth::check('default');	
		$breadcrumbs = array(
			'path' => array('MPC','Stream'),
			'link' => array('/','/stream')
		);
		
		$this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
		));	
	}
}
