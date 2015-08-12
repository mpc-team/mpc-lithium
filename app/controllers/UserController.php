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
use app\models\Permissions;

class UserController extends \lithium\action\Controller {

	const RECENT_LIMIT = 9;

	public function profile ( ) {
		$authorized = Auth::check('default');
		if ($authorized) {
			if ($authorized = Users::getById($authorized['id'])) {
				$authorized['date'] = Timestamp::toDisplayFormat($authorized['tstamp']);
				$data = array(
					'games' => Games::getList(),
					'played' => json_encode(self::getUserGameIds($authorized['id'])),
					'options' => array('post')
				);
				$breadcrumbs = array(
					'path' => array('MPC', 'Your Profile'),
					'link' => array('/', '/user/profile')
				);
				if ($data['recentfeed'] = Posts::find('all', array(
						'conditions' => array('uid' => $authorized['id']),
						// 'limit' => self::RECENT_LIMIT,
						'order' => array('tstamp' => 'DESC')
					))) {
					$data['recentfeed'] = $data['recentfeed']->to('array');
					$recentCount = 0;
					foreach ($data['recentfeed'] as $key => $recent) {
						$thread = Threads::getById($recent['tid']);
						if ($recentCount < self::RECENT_LIMIT) {
							$forum = Forums::getById($thread['fid']);
							$data['recentfeed'][$key]['content'] = stripslashes($data['recentfeed'][$key]['content']);
							$data['recentfeed'][$key]['author'] = stripslashes($authorized['alias']);
							$data['recentfeed'][$key]['thread'] = stripslashes($thread['name']);
							$data['recentfeed'][$key]['forum'] = stripslashes($forum['name']);
							$data['recentfeed'][$key]['date'] = Timestamp::toDisplayFormat($recent['tstamp']);
							$recentCount += 1;
						} else {
							unset($data['recentfeed'][$key]);
						}
					}
				} else {
					$data['recentfeed'] = array();
				}
				return compact('authorized', 'data', 'breadcrumbs');
			}
		}
		return $this->redirect('/login');
	}
	
	public function resetpassword ( ) {
		$authorized = Auth::check('default');
		if( !$authorized ) {
			$breadcrumbs = array(
				'path' => array('MPC', 'Login', 'Reset Password'),
				'link' => array('/', '/login', '/user/resetpassword')
			);
			if( $this->request->data ) {
				$email = $this->request->data['email'];
				if( ($user = Users::getByEmail($email)) != null ) {
					$data = 'This user exists (id = ' . $user['id'] . ').';
				} else {
					$data = 'This user does not exist.';
				}
			} 
			if( isset($data) ) {
				return compact('authorized', 'breadcrumbs', 'data');
			}
			return compact('authorized', 'breadcrumbs');
		}
		return $this->redirect('/user/profile');
	}

	public function view ( ) {
		if (isset($this->request->id)) {
			$authorized = Auth::check('default');
			if ($member = Users::getById($this->request->id)) {
				$member['date'] = Timestamp::toDisplayFormat($member['tstamp']);
				$data = array(
					'member' => $member,
					'games' => Games::getList(), 
					'played' => json_encode(self::getUserGameIds($this->request->id)),
					'options' => (($authorized) ? array('post') : array())
				);
				$breadcrumbs = array(
					'path' => array('MPC', 'Members', $member['alias']),
					'link' => array('/', '/members', '/user/view/' + $member['id'])
				);
				if ($data['recentfeed'] = Posts::find('all', array(
						'conditions' => array('uid' => $member['id']),
						// 'limit' => self::RECENT_LIMIT,
						'order' => array('tstamp' => 'DESC')
					))) {
					$data['recentfeed'] = $data['recentfeed']->to('array');
					$recentCount = 0;
					foreach ($data['recentfeed'] as $key => $recent) {
						$thread = Threads::getById($recent['tid']);
						if ($recentCount < self::RECENT_LIMIT && Permissions::is_public($thread)) {
							$forum = Forums::getById($thread['fid']);
							$data['recentfeed'][$key]['content'] = stripslashes($recent['content']);
							$data['recentfeed'][$key]['author'] = stripslashes($member['alias']);
							$data['recentfeed'][$key]['thread'] = stripslashes($thread['name']);
							$data['recentfeed'][$key]['forum'] = stripslashes($forum['name']);
							$data['recentfeed'][$key]['date'] = Timestamp::toDisplayFormat($recent['tstamp']);
							$recentCount += 1;
						} else {
							unset($data['recentfeed'][$key]);
						}
					}
				} else {
					$data['recentfeed'] = array();
				}
				return compact('authorized', 'data', 'breadcrumbs');
			}
		}
		return $this->redirect('/profile');
	}

	public static function getUserGameIds ($uid) {
		$games = UserGames::getById($uid);
		$result = array();
		foreach ($games as $game) {
			array_push($result, $game['gid']);
		}
		return $result;
	}

	public function edit ( ) {
		if (isset($this->request->id)) {
			$authorized = Auth::check('default');
			if (isset($this->request->data['game'])) {
				$flag = ($this->request->data['flag'] == "true") ? true : false;
				if ($authorized && $authorized['id'] == $this->request->id) {					
					if (UserGames::set($this->request->id, $this->request->data['game'], $flag)) {
						return json_encode(array(
							'status' => true,
							'response' => self::getUserGameIds($this->request->id)
						));
					}
				}
			} else	if (isset($this->request->data['wall'])) {
				if ($authorized) {
					$mid = Messages::send('text', $authorized['id'], $this->request->id, $this->request->data['wall']);
					return json_encode(array(
						'status' => true,
						'response' => $mid
					));
				}
			}
		}
		return json_encode(array('status' => false, 'response' => 'None'));
	}

	public function messages ( ) {
		if (isset($this->request->id)) {
			if ($user = Users::getById($this->request->id)) {
				$messages = Messages::getUserMessages($this->request->id);
				foreach ($messages as $key => $message) {
					$sender = Users::getById($message['uidsender']);
					$messages[$key]['sender'] = $sender['alias'];
					$messages[$key]['senderid'] = $sender['id'];
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

}
