<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;
use app\models\Games;
use app\models\games\StarCraft2;

class StarCraft2Controller extends ContentController {

	public function index() 
	{
		$this->_render['layout'] = 'games';		
		
		$this->set(array(
			'dir' => scandir(getcwd() . "/starcraft2/builds"),
			'authorized' => Auth::check('default'),
			'breadcrumbs' => array(
				'path' => array('MPC','Games','Starcraft II'),
				'link' => array('/','/games','/games/star_craft2'),
			),
		));

	}
}