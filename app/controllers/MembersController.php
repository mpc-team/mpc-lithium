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
		$admin = Permissions::is_admin($authorized);
		
		foreach ($users as $user) {
			$info = array('alias' => $user['alias'], 'id' => $user['id']);
			if ($admin) {
				$info['email'] = $user['email'];
			}
			array_push($temp, $info);
		}
		
		$users = $temp;
		$permission = ($admin ? array("admin") : array("public"));
		
		return compact('users', 'count', 'authorized', 'permission');
	}
}
