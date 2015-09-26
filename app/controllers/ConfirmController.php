<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Confirms;

class ConfirmController extends \lithium\action\Controller {

	public function user () {
		$authorized = Auth::check('default');
		if (isset($this->request->query['confirm'])) {
			$key = $this->request->query['confirm'];
			$confirm = Confirms::find( 'first', array( 'conditions' => array( 'key' => $key ) ) );
			if ($confirm) {
				$user = Users::create(array(
					'email' => $confirm->email,
					'password' => $confirm->password,
					'alias' => $confirm->alias
				));
				$user->save();
				$confirm->delete();
				return $this->redirect('/user/profile');
			}
		}
		return $this->redirect('/signup');
	}
}