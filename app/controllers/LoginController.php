<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;

class LoginController extends \lithium\action\Controller {

	public function index() {
		$authorized = Auth::check('default');
	
		if (!$authorized) {
			if ($this->request->data) {
				Auth::clear('default');
				if (Auth::check('default', $this->request)) {
					return $this->redirect(
						'/profile'
					);
				}
			}
		}
		return compact ('authorized');
	}
}
