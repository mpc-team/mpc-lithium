<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class WorldOfWarcraftController extends ContentController 
{
	public function index() 
	{
		$this->_render['layout'] = 'games';		
		
		$this->set(array(
			'authorized' => Auth::check('default'),
			'breadcrumbs' => array(
				'path' => array('MPC','Games','World of Warcraft'),
				'link' => array('/','/games','/games/world_of_warcraft')
			),
		));
	}
}