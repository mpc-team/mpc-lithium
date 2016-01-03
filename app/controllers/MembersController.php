<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Games;
use app\models\UserGames;
use app\models\Permissions;

class MembersController extends \lithium\action\Controller 
{
	/**
	 * findGameNameById
	 *
	 * @parameters:
	 *	• $userGames - array of games that the user plays.
	 *	• $allGames - array of all games currently registered.
	 */
	private static function findGameNameById ($userGame, $allGames) 
    {
		foreach ($allGames as $game)
			if ($userGame['gid'] == $game['id'])
				return $game['name'];
		return null;
	}	

	public function index() 
    {		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC', 'Members'),
			'link' => array('/', '/members')
		);
		$data = array('count' => Users::count());
        return compact('authorized', 'data', 'breadcrumbs');
    }

        //$data['games'] = Games::All();
        //$data['permissions'] = Permissions::is_admin($authorized) ? array('admin') : array('public');
        //$members = Users::All();
    //    $membersArray = array();
    //    foreach ($members as $user) 
    //    { 
    //        $userGames = UserGames::GetPlayedGames($user['id']); 
    //        $playedGames = array();
    //        foreach ($userGames as $userGame)
    //            if ($userGameName = self::findGameNameById($userGame, $data['games']))
    //                array_push($playedGames, $userGameName);

    //        $userInfo = array('alias' => $user['alias'], 'id' => $user['id'], 'played' => $playedGames);
    //        $userInfo['email'] = (Permissions::is_admin($authorized)) ? $user['email'] : null;
    //        array_push($membersArray, $userInfo);
    //    }
    //    $data['members'] = json_encode($membersArray);
    //    return compact('authorized', 'data', 'breadcrumbs');
    //}
}
