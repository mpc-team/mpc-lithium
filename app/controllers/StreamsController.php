<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Games;
use app\models\UserGames;
use app\models\Permissions;
use app\models\TwitchUsers;

class StreamsController extends \lithium\action\Controller 
{
    public static function getUserGameIds ($uid) 
	{
		$games = UserGames::GetPlayedGames($uid);
		$result = array();
		foreach ($games as $game) 
			array_push($result, $game['gid']);
			
		return $result;
	}    

	public function index( ) 
	{
        //Check Authorization of the User.
		$authorized = Auth::check('default');	
        //Declare Breadcrumbs and Link
		$breadcrumbs = array(
			'path' => array('MPC','Streams'),
			'link' => array('/','/streams')
		);
        //Information from Twitch Users Table.
        $casters = TwitchUsers::All();
        $count = TwitchUsers::count();
        $data = array(
			'games' => Games::All(),
			'played' => json_encode(self::getUserGameIds($authorized['id'])),
		);
        //OutPut to the View/Connect Folder.
        $this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
			'casters' => $casters,
            'totalcasters' => $count,
            'data' => $data,
		));	
	}


}