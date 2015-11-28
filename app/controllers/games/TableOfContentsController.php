<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class TableOfContentsController extends ContentController {

	static $NameMap = array(
		'heroes_of_the_storm' => 'Heroes of the Storm',
		'starcraft2' => 'Starcraft II',
		'world_of_warcraft' => 'World of Warcraft',
		'clash_of_clans' => 'Clash of Clans',
	);
	
	public function index() 
	{
		$authorized = Auth::check('default');	
		$breadcrumbs = array(
			'path' => array('MPC','Games'),
			'link' => array('/','/games')
		);
		
		$this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs
		));
		
		$games = array();
		$dir = scandir(getcwd().'/../views/games');
		foreach ($dir as $file) {
			$split = explode('.',$file);
			if (count($split) == 1) {
				array_push($games, self::$NameMap[$file]);
			}
		}
		
		return compact('games');
	}
}