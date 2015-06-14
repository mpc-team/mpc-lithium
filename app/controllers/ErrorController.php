<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class BoardController extends \lithium\action\Controller {

	public function index () {
		$authorized = Auth::check('default');
		return compact('authorized');
	}
}







