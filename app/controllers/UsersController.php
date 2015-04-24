<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;

class UsersController extends \lithium\action\Controller {

	public function index() {		
		$users = Users::all()->to('array');
		$count = Users::count();
		$temp  = array();
		
		foreach ($users as $user) {
			$info = array($user['alias'], $user['email']);
			array_push($temp, $info);
		}
		$users = $temp;
		return compact('users', 'count');
	}
	
	public function profile() {
		$authorized = Auth::check('default');
		
		if (!$authorized) {
			return $this->redirect('/users/login');
		}
		return compact('authorized');
	}
	
	public function login() {
	
		if ($this->request->data) {
			Auth::clear('default');
			if (Auth::check('default', $this->request)) {
				return $this->redirect(
					'/users/profile'
				);
			}
		}
	}
	
	public function logout() {
		
		Auth::clear('default');
		return $this->redirect('/users/login');
	}
	
	public function signup() {
		$data = $this->request->data;
		
		if ($data) {
			$user = Users::create($this->request->data);
			$exists = Users::find('first', array(
				'conditions' => array('email' => $user->email)
			));
			if (!$exists) {
				if ($user->save()) {
					Auth::clear('default');
					Auth::check('default', $this->request);
					return $this->redirect(
						'/users/profile'
					);
				}
			}
		}
	}
}
