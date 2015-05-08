<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;
use app\models\Timestamp;

class ProfileController extends \lithium\action\Controller {

	const RECENT_LIMIT = 5;

	public function index() {
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
			}
			return compact('authorized', 'recentfeed');
		} 
		
		return $this->redirect('/login');
		
	}
}
