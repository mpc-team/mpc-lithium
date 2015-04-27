<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;

class SignupController extends \lithium\action\Controller {

	public function index() {
		$authorized = Auth::check('default');
		$data = $this->request->data;
		
		if (!$authorized) {
			if ($data) {
				$user = Users::create($data);
				$exists = Users::find('first', array(
					'conditions' => array('email' => $user->email)
				));
				if (!$exists) {
					if ($user->save()) {
						Auth::clear('default');
						Auth::check('default', $this->request);
						return $this->redirect('/profile');
					}
				}
			}
		}
		return compact('authorized');
	}
}
