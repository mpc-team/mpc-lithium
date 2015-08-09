<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Games;
use app\models\UserGames;
use app\models\Permissions;

class MembersController extends \lithium\action\Controller {
	/**
	 * findGameNameById
	 *
	 * @parameters:
	 *	• $userGames - array of games that the user plays.
	 *	• $allGames - array of all games currently registered.
	 *
	 */
	private static function findGameNameById ($userGame, $allGames) {
		foreach ($allGames as $game) {
			if ($userGame['gid'] == $game['id']) {
				return $game['name'];
			}
		}
		return null;
	}	
	/**
	 * index
	 *
	 * @returns: 
	 *	• $authorized - required for 'navbar' possibly used elsewhere as well, needs to be returned.
	 *	• $count - count of users in the Database. This kind of thing should be in a '$data' array.
	 *	• $members - actual json array of users with some data.
	 *	• $permission - permissions that are available to the current user notifies the client of
	 *			what information it will be able to process.
	 *	• $games - list of all games registered to the server.
	 *
	 * What we should do:
	 *	• Put everything that isn't 'authorized' into 'response' rather than having a really long list
	 * 			of parameters for every page. Each page should get roughly the same thing, with the 
	 *			variance being the data sent through "response".
	 */
	public function index() {		
		$authorized = Auth::check('default');
		$data = array();
		$breadcrumbs = array(
			'path' => array('MPC', 'Members'),
			'link' => array('/', '/members')
		);
		$data['count'] = Users::count();
		$data['games'] = Games::getList();
		$data['permissions'] = Permissions::is_admin($authorized) ? array('admin') : array('public');
		$members = Users::all()->to('array');
		$membersArray = array();
		foreach ($members as $user) { 
			$userGames = UserGames::getById($user['id']); 
			$playedGames = array();
			foreach ($userGames as $userGame) {
				if ($userGameName = self::findGameNameById($userGame, $data['games'])) {
					array_push($playedGames, $userGameName);
				}
			}
			$userInfo = array('alias' => $user['alias'], 'id' => $user['id'], 'played' => $playedGames);
			$userInfo['email'] = (Permissions::is_admin($authorized)) ? $user['email'] : null;
			array_push($membersArray, $userInfo);
		}
		$data['members'] = json_encode($membersArray);
		return compact('authorized', 'data', 'breadcrumbs');
	}
}
