<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Games;
use app\models\UserGames;
use app\models\Permissions;

class CommunityController extends \lithium\action\Controller 
{
    /**
     * Main Community Page
     */
	public function index() 
    {		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC', 'Community'),
			'link' => array('/', '/community')
		);
		$data = array('count' => Users::count());
        return compact('authorized', 'data', 'breadcrumbs');
    }
}
