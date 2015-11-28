<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class HeroesOfTheStormController extends ContentController 
{
	public function index() 
	{
		$this->_render['layout'] = 'games';		
		
		$this->set(array(
			'authorized' => Auth::check('default'),
			'breadcrumbs' => array(
				'path' => array('MPC','Games','Heroes of the Storm'),
				'link' => array('/','/games','/games/heroes_of_the_storm')
			),
		));
	}
}