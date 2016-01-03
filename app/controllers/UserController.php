<?php

namespace app\controllers;

use Exception;

use lithium\security\Auth;
use app\models\utils\Notifications;
use app\models\UserNotifications;
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

class UserController extends \lithium\action\Controller 
{
	// The amount of Recent Threads to display.
	const RECENT_LIMIT = 9;
	
	// Accepted Image Types for Profile Avatars.
	static $s_imageTypes = array('IMG_JPG','IMG_JPEG','IMG_PNG','IMG_GIF');
	
	public static function getUserGameIds ($uid) 
	{
		$games = UserGames::GetPlayedGames($uid);
		$result = array();
		foreach ($games as $game) 
			array_push($result, $game['gid']);
			
		return $result;
	}
	
	/**
	 * <Needs To Be Filled In>
	 *	@params
	 *		$authorized:
	 *		$query:
	 *	@returns
	 *
	 */
	private function ViewProfile ($authorized, $query) 
	{
		$authorized['date'] = Timestamp::toDisplayFormat($authorized['tstamp']);
		$data = array(
			'games' => Games::All(),
			'played' => json_encode(self::getUserGameIds($authorized['id'])),
			'options' => array('post'),
			'recentfeed' => Posts::find('all', array(
				'conditions' => array('uid' => $authorized['id']),
				'order' => array('tstamp' => 'DESC')
			))
		);
		$breadcrumbs = array(
			'path' => array('MPC', 'Your Profile'),
			'link' => array('/', '/user/profile')
		);
		$notification = Notifications::parse($this->request->query);
			
		if ($data['recentfeed']) 
		{
			$data['recentfeed'] = $data['recentfeed']->to('array');
			$recentCount = 0;
			foreach ($data['recentfeed'] as $key => $recent) 
			{
				$thread = Threads::Get($recent['tid']);
				if ($recentCount < self::RECENT_LIMIT) 
				{
					$forum = Forums::Get($thread['fid']);
					$data['recentfeed'][$key]['content'] = stripslashes($data['recentfeed'][$key]['content']);
					$data['recentfeed'][$key]['author'] = stripslashes($authorized['alias']);
					$data['recentfeed'][$key]['thread'] = stripslashes($thread['name']);
					$data['recentfeed'][$key]['forum'] = stripslashes($forum['name']);
					$data['recentfeed'][$key]['date'] = Timestamp::toDisplayFormat($recent['tstamp']);
						
					$recentCount += 1;
				} 
				else 
				{
					unset($data['recentfeed'][$key]);
				}
			}
		} 
		else 
		{
			$data['recentfeed'] = array();
		}
		
		// Set View variables and declare render options.
		$this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
			'notification' => $notification,
			'data' => $data,
		));
		$options = array();
		$options['template'] = '../user/profile';
		
		$avatarPath = Users::FindAvatarFile($authorized['email']);
		$this->set(array('avatar' => $avatarPath));
		
		// Return and render the View specified above.
		return $this->render($options);
		
	}

	
	/**
	 * <Needs To Be Filled In>
	 *	@params
	 *		$authorized:
	 *		$query:
	 *	@returns
	 *
	 */
	private function EditProfile($authorized, $data)
	{
		// First perform the Edit and then load the standard Profile page.
		if (isset($data['avatarfile']) && $data['avatarfile']) 
		{			
			if ($data['avatarfile']['tmp_name'])
			{
				// Make sure that an image file was uploaded.
				$check = getimagesize($data['avatarfile']['tmp_name']);
				$image_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG);
				
				if ($check && in_array($check[2], $image_types))
				{
					$fileext = pathinfo($data['avatarfile']['name'], PATHINFO_EXTENSION);
					$cleaned = Users::CleanAvatarFiles($authorized['email']);
					
					$saveToPath = getcwd().'/users/avatars/'.$authorized['email'].'.'.$fileext;
					copy($data['avatarfile']['tmp_name'], $saveToPath);
					
					return $this->redirect('/user/profile?status=success&op=avch');
				}
			}
			return $this->redirect('/user/profile?status=nofile&op=avch');
		}
		return $this->redirect('/user/profile');
	}
	
	
	/**
	 * Routes traffic to /user/profile to more specific functions such as 
	 * /edit. By default routes to the primary Profile page.
	 *	@returns
	 *		Returns a redirect to the appropriate URI.	
	 */
	public function profile( ) 
	{
		$authorized = Auth::check('default');
		if (!$authorized) 
			return $this->redirect('/login');
	
		$redirect = false;
		$opedit = false;
		$argc = count($this->request->args);
		if ($argc == 1) 
		{
			if ($this->request->args[0] == 'edit')
				$opedit = true;
			else
				$redirect = true;
		} 
		elseif ($argc > 1) 
			$redirect = true;
		
		if ($redirect)
			return $this->redirect('/user/profile');
		
		if ($opedit) 
			// Redirect to the /user/profile/edit action.
			return self::EditProfile($authorized, $this->request->data);
		else
			// Redirect to the standard action /user/profile.
			return self::ViewProfile($authorized, $this->request->query);
	}
	
	
	/**
	 * Change a User's password.
	 *	@returns
	 * 		Returns a redirect to the /login page to allow the User to 
	 *		authenticate themselves with the new credentials.
	 */
	public function changepassword ( ) 
	{
		$authorized = Auth::check('default');
		
		if ($authorized) 
		{	
			/* If the User is signed in and requests to change their password, 
			 * authentication is based on whoever is signed in. */
		} 
		elseif (isset($this->request->query['confirm'])) 
		{
			/* If the User is not signed in and requests to change their password,
			 * authentication is based on the Reset Password key included in the email. */
			 
			$key = $this->request->query['confirm'];
			$reset = UserResetPasswords::getByKey( $key );
			
			if( isset( $this->request->data['password'] ) && $reset ) 
			{
				$password = $this->request->data['password'];
				
				/* We have authenticated now we can change the password
				 * and end the `password reset` process. */
				
				Users::setPassword( $reset['email'], $password );
				UserResetPasswords::deleteByEmail( $reset['email'] );
			}
		}
		return $this->redirect( '/login?status=success&op=pwc' );
	}
	
	
	
	static $s_resetPswrdStatus = array(
		'none' => 'NONE', 'confirmed' => 'CONFIRMED', 'pending' => 'PENDING',
		'no_user' => 'NO_USER', 'key_error' => 'KEY_ERROR' );
	
	/**
	 * <Needs To Be Filled In>
	 *	@returns
	 *
	 */
	public function resetpassword ( ) 
	{
		$authorized = Auth::check('default');
		if( $authorized ) 
		{
			/* If there is an authorized User signed in then there is no need
			 * to reset the password. Redirect to the User's profile page. */
			 
			return $this->redirect( '/user/profile' );
		}
		
		$breadcrumbs = array(
			'path' => array( 'MPC', 'Login', 'Reset Password' ),
			'link' => array( '/', '/login', '/user/resetpassword' )
		);
		$status = self::$s_resetPswrdStatus['none'];
		$user = null;
		
		if (isset($this->request->query['confirm'])) 
		{
			$key = $this->request->query['confirm'];			
			if ($reset = UserResetPasswords::getByKey($key)) 
			{
				$status = self::$s_resetPswrdStatus['confirmed'];
			} 
			else 
			{
				// If the 'confirm' key isn't in the Database then we either have
				// an out-of-date key being used or a key that doesn't exist.
				$status = self::$s_resetPswrdStatus['key_error'];
				throw new Exception(); // Page Not Found
			}
			return compact( 'authorized', 'breadcrumbs', 'user', 'status', 'key' );
			
		} 
		elseif ($this->request->data && isset($this->request->data['email'])) 
		{
			$email = $this->request->data[ 'email' ];
			if( ($user = Users::getByEmail( $email )) != null ) 
			{
				$exists = UserResetPasswords::getByEmail( $email );
				if( $exists ) 
				{
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
				$status = self::$s_resetPswrdStatus['pending'];
			} 
			else 
			{
				$status = self::$s_resetPswrdStatus['no_user'];
			}
		}
		return compact( 'authorized', 'breadcrumbs', 'user', 'status' );
	}

	
	public function view ( ) 
	{
		if( isset( $this->request->id ) ) 
		{
			$authorized = Auth::check('default');
			if ($member = Users::Get($this->request->id)) 
			{
				$member['date'] = Timestamp::toDisplayFormat($member['tstamp']);
				$data = array(
					'member' => $member,
					'games' => Games::All(), 
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
						'order' => array('tstamp' => 'DESC') ))) 
				{
					$data['recentfeed'] = $data['recentfeed']->to('array');
					$recentCount = 0;
					foreach ($data['recentfeed'] as $key => $recent) 
					{
						$thread = Threads::Get($recent['tid']);
						if ($recentCount < self::RECENT_LIMIT && Permissions::is_public($thread)) 
						{
							$forum = Forums::Get($thread['fid']);
							$data['recentfeed'][$key]['content'] = stripslashes($recent['content']);
							$data['recentfeed'][$key]['author'] = stripslashes($member['alias']);
							$data['recentfeed'][$key]['thread'] = stripslashes($thread['name']);
							$data['recentfeed'][$key]['forum'] = stripslashes($forum['name']);
							$data['recentfeed'][$key]['date'] = Timestamp::toDisplayFormat($recent['tstamp']);
							$recentCount += 1;
						} 
						else 
						{
							unset($data['recentfeed'][$key]);
						}
					}
				} 
				else 
				{
					$data['recentfeed'] = array();
				}
				
                $privateInformation = Users::Get($member['id'], Users::$FIELDS_PRIVATE);
				$avatar = Users::FindAvatarFile($privateInformation['email']);
				return compact('authorized', 'data', 'breadcrumbs', 'avatar');
			}
		}
		return $this->redirect('/profile');
	}

	
	

	public function edit ( ) 
	{
		if (isset($this->request->id)) 
		{
			$authorized = Auth::check('default');
			if (isset($this->request->data['game'])) 
			{
				$flag = ($this->request->data['flag'] == "true") ? true : false;
				if ($authorized && $authorized['id'] == $this->request->id) 
				{
					if (UserGames::Set($this->request->id, $this->request->data['game'], $flag)) 
					{
						return json_encode(array(
							'status' => true,
							'response' => self::getUserGameIds($this->request->id)
						));
					}
				}
			} 
			elseif (isset($this->request->data['wall'])) 
			{
				if ($authorized) 
				{
					$mid = Messages::Send('text', $authorized['id'], $this->request->id, $this->request->data['wall']);

                    if ($authorized['id'] != $this->request->id)
                        UserNotifications::NewNotification($this->request->id, $mid, UserNotifications::MESSAGE, $authorized['id']);

					return json_encode(array('status' => true, 'response' => $mid));
				}
			}
		}
		return json_encode(array('status' => false, 'response' => 'None'));
	}
}
