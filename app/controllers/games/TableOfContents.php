<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class TableOfContents extends ContentController {

	static $NameMap = array(
		'heroes_of_the_storm' => 'Heroes of the Storm',
		'starcraft2' => 'Starcraft II',
		'world_of_warcraft' => 'World of Warcraft'
	);
	
	public function index() {
		$this->_render['layout'] = 'games';		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC','Games'),
			'link' => array('/','/games')
		);
		$this->set(array(
			'authorized'=>$authorized,
			'breadcrumbs'=>$breadcrumbs
		));
		$dir = scandir(getcwd().'/../views/games');
		$games = array();
		foreach ($dir as $file) {
			$split = explode('.',$file);
			if (count($split) == 1) {
				array_push($games, self::$NameMap[$file]);
			}
		}
		$this->set(array('games'=>$games));
		$options=array();
		$options['template']='../games/index';
		return $this->render($options);
	}
}