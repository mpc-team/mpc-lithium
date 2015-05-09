<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;
use app\models\Timestamp;

class ProfileController extends \lithium\action\Controller {

	const RECENT_LIMIT = 6;

	public function index() {
	/**
	 * Profile index
	 *
	 *	Requires user authentication to access this content. This page will
	 *	access information that only the authenticated User should be able
	 *	to see. 
	 *
	 *	At this stage, the only thing considered "private" is a User's email 
	 *	and password hash. Password is never revealed to anybody (only from
	 *	Database access), and Email is typically only available to Administrators.
	 */
		$this->_render['layout'] = 'profile';
		$authorized = Auth::check('default');
		
		if ($authorized) {
			if ($recentfeed = Messages::find('all', array(
					'conditions' => array('uid' => $authorized['id']),
					'limit' => self::RECENT_LIMIT,
					'order' => array('tstamp' => 'DESC')
				))) {
				$recentfeed = $recentfeed->to('array');
				
				foreach ($recentfeed as $key => $recent) {
					$thread = Threads::find('first', array('conditions' => array('id' => $recent['tid'])));
					$forum = Forums::find('first', array('conditions' => array('id' => $thread->fid)));
					$recentfeed[$key]['author'] = $authorized['alias'];
					$recentfeed[$key]['thread'] = $thread->name;
					$recentfeed[$key]['forum']  = $forum->name;
					$recentfeed[$key]['tstamp']  = Timestamp::toDisplayFormat($recent['tstamp']);
				}
			} else {	$recentfeed = array(); }
			
			return compact('authorized', 'recentfeed');
		} 
		/* Redirect to the Login page if no User is authenticated */
		return $this->redirect('/login');
		
	}
	
	public function view() {
	/**
	 * Profile view
	 *
	 *	Does not require User authentication. Profile views are available (currently)
	 *	to the public permission group.
	 */
		if (isset($this->request->id)) {
			$this->_render['layout'] = 'profile';
			$id = $this->request->id;
			$authorized = Auth::check('default');
			
			if ($user = Users::find('first', array('conditions' => array('id' => $id)))) {
				if ($recentfeed = Messages::find('all', array(
						'conditions' => array('uid' => $user->id),
						'limit' => self::RECENT_LIMIT,
						'order' => array('tstamp' => 'DESC')
					))) {
					$recentfeed = $recentfeed->to('array');
					$user = $user->to('array');
					
					foreach ($recentfeed as $key => $recent) {
						$thread = Threads::find('first', array('conditions' => array('id' => $recent['tid'])));
						$forum = Forums::find('first', array('conditions' => array('id' => $thread->fid)));
						$recentfeed[$key]['author'] = $user['alias'];
						$recentfeed[$key]['thread'] = $thread->name;
						$recentfeed[$key]['forum']  = $forum->name;
						$recentfeed[$key]['tstamp']  = Timestamp::toDisplayFormat($recent['tstamp']);
					}
				} else { $recentfeed = array(); }
				
				return compact('authorized', 'user', 'recentfeed');
			}	
		}
		
		return $this->redirect('/profile');
		
	}
}
