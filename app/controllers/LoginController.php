<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;

class LoginController extends \lithium\action\Controller {

	public function index() {
		if (!($authorized = Auth::check('default'))) {
			$breadcrumbs = array(
				'path' => array('MPC', 'Login'),
				'link' => array('/', '/login')
			);
			if ($this->request->data) {
				Auth::clear('default');
				if (Auth::check('default', $this->request)) {
					return $this->redirect('/user/profile');
				}
			}
			return compact ('authorized', 'breadcrumbs');
		}
		return $this->redirect('/user/profile');
	}
}
