<?php

namespace app\controllers;

use lithium\security\Auth;

class ContactController extends \lithium\action\Controller {
	
	public function index() { 
		$authorized = Auth::check('default');
		
		return compact('authorized');
	}
}
