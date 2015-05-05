<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;

class MembersController extends \lithium\action\Controller {

	public function index() {		
		$authorized = Auth::check('default');
		$is_admin = Permissions::is_admin($authorized);
		$users = Users::all()->to('array');
		$count = Users::count();
		$temp  = array();
		
		foreach ($users as $user) {
			if ($is_admin) {
				$info = array('alias' => $user['alias'], 'email' => $user['email']);
			} else {
				$info = array('alias' => $user['alias']);
			}
			array_push($temp, $info);
		}
		
		$users = $temp;
		if ($is_admin) {
			$permission = array("admin");
		} else {
			$permission = array("public");
		}
		
		return compact('users', 'count', 'authorized', 'permission');
	}
}
