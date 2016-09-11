<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class CounterStrikeController extends ContentController 
{
	public function index() 
	{
		$this->_render['layout'] = 'games';		
		
		$this->set(array(
			'authorized' => Auth::check('default'),
			'breadcrumbs' => array(
				'path' => array('MPC','Games','Counter Strike'),
				'link' => array('/','/games','/games/counter_strike')
			),
		));
	}
}