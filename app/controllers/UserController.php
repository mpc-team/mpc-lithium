<?php

namespace app\controllers;

use lithium\security\Auth;
use Exception;
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
use app\models\UserResetPasswords;

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
	
	///
	/// `changepassword`
	///
	public function changepassword ( ) {
		$authorized = Auth::check('default');
		if( $authorized ) {
			// If the User is signed in and requests to change their password,
			// authentication is standard.
		
		} elseif( isset( $this->request->query['confirm'] ) ) {
			// If the User is not signed in and requests to change their password,
			// authentication is based on the Reset Password key included in the email.
			$key = $this->request->query['confirm'];
			$reset = UserResetPasswords::getByKey( $key );
			
			if( isset( $this->request->data['password'] ) && $reset ) {
				$password = $this->request->data['password'];
				// We have authenticated now we can change the password and end the
				// `password reset` process.
				Users::setPassword( $reset['email'], $password );
				UserResetPasswords::deleteByEmail( $reset['email'] );
			}
		}
		return $this->redirect( '/login' );
	}
	
	const STATUS_NONE = "NONE";
	const STATUS_CONFIRMED = "CONFIRMED";
	const STATUS_PENDING = "PENDING";
	const STATUS_NO_USER = "NO_USER";
	const STATUS_KEY_ERROR = "KEY_ERROR";
	
	///
	///	`resetpassword`
	/// 
	/// Description:
	///
	/// There are multiple states for this action depending on what stage the
	/// reset process is in. The stages are as follows: 
	///
	///		1) No confirmation, no request data.
	///			- User must enter an e-mail address.
	///		2) Request data for e-mail.
	///			- The e-mail address is found.
	///				> Send confirmation e-mail.
	///			- The e-mail address is not found.
	///				> Show error.
	///		3) Confirmation.
	///			- Change password dialog.
	///
	public function resetpassword ( ) 
	{
		$authorized = Auth::check('default');
		if( $authorized ) {
			// If there is an authorized User signed in then there is no need
			// to reset the password. Redirect to the User's profile page.
			return $this->redirect( '/user/profile' );
		}
		$breadcrumbs = array(
			'path' => array( 'MPC', 'Login', 'Reset Password' ),
			'link' => array( '/', '/login', '/user/resetpassword' )
		);
		$user = null;
		$status = self::STATUS_NONE;
		
		if( isset( $this->request->query['confirm'] ) ) {
			$key = $this->request->query[ 'confirm' ];			
			if( $reset = UserResetPasswords::getByKey( $key ) ) {
				$status = self::STATUS_CONFIRMED;
			}	else {
				// If the 'confirm' key isn't in the Database then we either have
				// an out-of-date key being used or a key that doesn't exist.
				$status = self::STATUS_KEY_ERROR;
				throw new Exception(); // Page Not Found
			}
			return compact( 'authorized', 'breadcrumbs', 'user', 'status', 'key' );
			
		} elseif( $this->request->data && isset( $this->request->data['email'] ) ) {
			$email = $this->request->data[ 'email' ];
			if( ($user = Users::getByEmail( $email )) != null ) {
				$exists = UserResetPasswords::getByEmail( $email );
				if( $exists ) {
					// Delete the reset request if there is already one there so that the
					// most recent password reset request takes precedence.
					UserResetPasswords::deleteByEmail( $email );
				}
				$reset = UserResetPasswords::create( array(
					'email' => $user['email'],
					'key' => md5( $user['email'] . date( 'dmY' ) )
				) );
				$reset->save();
				UserResetPasswords::sendReset( $user, $reset->key );
				$status = self::STATUS_PENDING;
			} else {
				$status = self::STATUS_NO_USER;
			}
		}
		return compact( 'authorized', 'breadcrumbs', 'user', 'status' );
	}

	public function view ( ) 
	{
		if( isset( $this->request->id ) ) {
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
