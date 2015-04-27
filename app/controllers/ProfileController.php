<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class ProfileController extends \lithium\action\Controller {

	public function index() {
		$authorized = Auth::check('default');
		
		if (!$authorized) {
			return $this->redirect('/login');
		}
		return compact('authorized');
	}
}
