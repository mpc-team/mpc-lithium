<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;
use app\models\Confirms;

class SignupController extends \lithium\action\Controller {

	public function index() {
		if (!($authorized = Auth::check('default'))) {
			return compact('authorized');
		}
		return $this->redirect('/profile');
	}
	
	public function complete () {
		if (!($authorized = Auth::check('default'))) {
			$data = array('member' => null);
			if ($this->request->data) {
				$user = Users::create($this->request->data);
				$exists = Users::find('first', array('conditions' => array('email' => $user->email)));
				$pending = Confirms::find('first', array('conditions' => array('email' => $user->email)));
				
				if (!$exists && !$pending) {
					$confirm = Confirms::create(array(
						'email' => $user->email,
						'key' => md5($user->email . date('dmY')),
						'password' => $user->password,
						'alias' => $user->alias
					));
					$confirm->save();
					$data['member'] = $user->to('array');
					Confirms::sendConfirmation($data['member'], $confirm->key);
				} else {
					return $this->redirect('/signup');
				}
			}
			return compact('authorized', 'data');
		}
		return $this->redirect('/profile');
	}
}
