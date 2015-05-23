<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Posts;
use app\models\Messages;
use app\models\Timestamp;
use app\models\Games;
use app\models\UserGames;
use app\models\Confirms;

class UserController extends \lithium\action\Controller {

	/**
	 * Limit to the amount of recent posts that are displayed in certain templates. 
	 */
	const RECENT_LIMIT = 6;

	public function profile() {
		$authorized = Auth::check('default');
		if ($authorized) {
			if ($authorized = Users::getById($authorized['id'])) {
				$authorized['date'] = Timestamp::toDisplayFormat($authorized['tstamp']);
				$data = array(
					'games' => Games::getList(),
					'played' => json_encode(self::getUserGames($authorized['id'])),
					'options' => array('post')
				);
				if ($data['recentfeed'] = Posts::find('all', array(
						'conditions' => array('uid' => $authorized['id']),
						'limit' => self::RECENT_LIMIT,
						'order' => array('tstamp' => 'DESC')
					))) {
					$data['recentfeed'] = $data['recentfeed']->to('array');
					foreach ($data['recentfeed'] as $key => $recent) {
						$thread = Threads::getById($recent['tid']);
						$forum = Forums::getById($thread['fid']);
						$data['recentfeed'][$key]['content'] = stripslashes($data['recentfeed'][$key]['content']);
						$data['recentfeed'][$key]['author'] = stripslashes($authorized['alias']);
						$data['recentfeed'][$key]['thread'] = stripslashes($thread['name']);
						$data['recentfeed'][$key]['forum'] = stripslashes($forum['name']);
						$data['recentfeed'][$key]['date'] = Timestamp::toDisplayFormat($recent['tstamp']);
					}
				} else {
					$data['recentfeed'] = array();
				}
				return compact('authorized', 'data');
			}
		}
		return $this->redirect('/login');
	}

	public function view() {
		if (isset($this->request->id)) {
			$authorized = Auth::check('default');
			if ($member = Users::getById($this->request->id)) {
				$member['date'] = Timestamp::toDisplayFormat($member['tstamp']);
				$data = array(
					'member' => $member,
					'games' => Games::getList(), 
					'played' => json_encode(self::getUserGames($this->request->id)),
					'options' => (($authorized) ? array('post') : array())
				);
				if ($data['recentfeed'] = Posts::find('all', array(
						'conditions' => array('uid' => $member['id']),
						'limit' => self::RECENT_LIMIT,
						'order' => array('tstamp' => 'DESC')
					))) {
					$data['recentfeed'] = $data['recentfeed']->to('array');
					foreach ($data['recentfeed'] as $key => $recent) {
						$thread = Threads::getById($recent['tid']);
						$forum = Forums::getById($thread['fid']);
						$data['recentfeed'][$key]['content'] = stripslashes($recent['content']);
						$data['recentfeed'][$key]['author'] = stripslashes($member['alias']);
						$data['recentfeed'][$key]['thread'] = stripslashes($thread['name']);
						$data['recentfeed'][$key]['forum'] = stripslashes($forum['name']);
						$data['recentfeed'][$key]['date'] = Timestamp::toDisplayFormat($recent['tstamp']);
					}
				} else {
					$data['recentfeed'] = array();
				}
				return compact('authorized', 'data');
			}
		}
		return $this->redirect('/profile');
	}

	/**
	 * >> edit
	 *
	 * Action is meant for asynchronous communication between server-client and returns a JSON
	 * object with the properties 'status' and 'response'. 
	 *	status: (boolean) request processed successfully/unsuccessfully.
	 *	response: JSON data representing the content requested.
	 *
	 * Any features that edit the content of a user's profile are routed through /user/edit. 
	 * Determines function based on values that are sent with the /edit request.
	 */ 
	public function edit() {
		if (isset($this->request->id)) {
			$id = $this->request->id;
			$authorized = Auth::check('default');
			if (isset($this->request->data['game'])) {
				$flag = ($this->request->data['flag'] == "true") ? true : false;
				if ($authorized && $authorized['id'] == $id) {							
					if (UserGames::set($id, $this->request->data['game'], $flag)) {
						return json_encode(array(
							'status' => true,
							'response' => self::getUserGames($id)
						));
					}
				} 
			} else	if (isset($this->request->data['post'])) {
				if ($authorized) {
					$mid = Messages::send('text', $authorized['id'], $id, $this->request->data['post']);
					return json_encode(array(
						'status' => true,
						'response' => $mid
					));
				}
			}
		}
		return json_encode(array('status' => false));
	}

	/**
	 * messages
	 *
	 * Action is meant for asynchronous communication between server-client and returns a JSON
	 * object with the properties 'status' and 'response'.
	 *	status: (boolean) request processed successfully/unsuccessfully.
	 *	response: JSON data representing the content requested.
	 *
	 * A function of the server interface. Returns messages in JSON format that have been created for
	 * a specified user.
	 */
	public function messages () {
		if (isset($this->request->id)) {
			if ($user = Users::getById($this->request->id)) {
				$messages = Messages::getUserMessages($this->request->id);
				foreach ($messages as $key => $message) {
					$sender = Users::getById($message['uidsender']);
					$messages[$key]['sender'] = $sender['alias'];
					$messages[$key]['content'] = stripslashes($message['content']);
				}
				$messages = array_values($messages);
				return json_encode(array(
					'status' => true,
					'response' => $messages
				));
			}
		}
		return json_encode(array('status' => false));
	}

	public static function getUserGames($id) {
		$games = UserGames::getById($id);
		$result = array();
		foreach ($games as $game) {
			array_push($result, $game['gid']);
		}
		return $result;
	}
	
	public static function isGamePlayed($id, $played) {
		foreach ($played as $search) {
			if ($search['gid'] == $id) {
				return true;
			}
		}
		return false;
	}

}
