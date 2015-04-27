<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;

class LogoutController extends \lithium\action\Controller {

	public function index() {
		$authorized = Auth::check('default');
		
		if ($authorized) {
			Auth::clear('default');
			return $this->redirect('/login');
		}
		return $this->redirect('/login');
	}
}
