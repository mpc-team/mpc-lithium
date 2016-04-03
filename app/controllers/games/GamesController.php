<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;
use app\models\Games;

class GamesController extends ContentController 
{
	public function index() 
	{
		$authorized = Auth::check('default');	
		$breadcrumbs = array(
			'path' => array('MPC','Games'),
			'link' => array('/','/games')
		);
		$games = Games::All();

        if ($authorized)
            Users::UpdateLastLogged($authorized['id']);
		
		$this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
			'games' => $games,
		));	
	}
}