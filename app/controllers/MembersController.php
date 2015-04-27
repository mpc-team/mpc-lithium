<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;

class MembersController extends \lithium\action\Controller {

	public function index() {		
		$authorized = Auth::check('default');
		$users = Users::all()->to('array');
		$count = Users::count();
		$temp  = array();
		
		foreach ($users as $user) {
			$info = array($user['alias'], $user['email']);
			array_push($temp, $info);
		}
		$users = $temp;
		return compact('users', 'count', 'authorized');
	}
}
