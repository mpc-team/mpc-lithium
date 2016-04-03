<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Games;
use app\models\UserGames;
use app\models\Permissions;

class CommunityController extends \lithium\action\Controller 
{
	public function index() 
    {		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC', 'Community'),
			'link' => array('/', '/community')
		);
		$data = array('count' => Users::count());

        if ($authorized)
            Users::UpdateLastLogged($authorized['id']);

        return compact('authorized', 'data', 'breadcrumbs');
    }
}
