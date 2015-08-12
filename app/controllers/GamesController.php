<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class GamesController extends ContentController {

	private static $s_GameNameMapping = array(
		'heroes' => 'Heroes of the Storm',
		'sc2' => 'StarCraft II'
	);

	public function index() {
		$authorized = Auth::check('default');
		$args = $this->request->args;
		$breadcrumbs = array('path' => array(), 'link' => array());
		if ($args) {
			$game = $args[0];
			if (array_key_exists($game, self::$s_GameNameMapping)) {
				$breadcrumbs = array(
					'path' => array('MPC', 'Games', self::$s_GameNameMapping[$game]),
					'link' => array('/', '/', '/games/' . $game)
				);
				return compact('authorized', 'breadcrumbs'); 
			}
		}
		return compact('authorized', 'breadcrumbs'); 
	}

}