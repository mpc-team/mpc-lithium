<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class ForumController extends \lithium\action\Controller {
/**
 * Limit to the amount of recent messages that are sent to the Client.
 */
	const RECENT_LIMIT = 3;
	
	public function index() {		
	/**
	 * Forum Index
	 *	Shows all the available Forums that can be accessed. In addition, a 
	 *	panel that shows recent activity is displayed as a shortcut feature.
	 */
		$this->_render['layout'] = 'forum';		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array("Forum"), 
			'link' => array("/forum")
		);
		$page = array('title' => 'Forum');
		$forums = Forums::all()->to('array');
		$recentfeed = Messages::find('all', array(
			'limit' => self::RECENT_LIMIT,
			'order' => array('tstamp' => 'DESC')
		))->to('array');
	/**
	 * 	Reference external models for additional information about the recent
	 *	Thread or Post.
	 */
		foreach ($recentfeed as $key => $recent) {
			$author = Users::find('first', array('conditions' => array('id' => $recent['uid'])));
			$thread = Threads::find('first', array('conditions' => array('id' => $recent['tid'])));
			$forum = Forums::find('first', array('conditions' => array('id' => $thread->fid)));
			$recentfeed[$key]['author'] = $author->alias;
			$recentfeed[$key]['thread'] = $thread->name;
			$recentfeed[$key]['forum'] = $forum->name;
		}		
	/**
	 *	Additional Forum information such as the amount of Threads.
	 */
		foreach ($forums as $key => $forum) {
			$threads = Threads::find('all', array(
				'conditions' => array('fid' => $forum['id'])
			))->to('array');
			$forums[$key]['count'] = count($threads);
		}
	
		return compact('authorized', 'page', 'forums', 'breadcrumbs', 'recentfeed');
	}
}