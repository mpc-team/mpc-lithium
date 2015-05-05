<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

/**
 *
 *
 */
class ForumController extends \lithium\action\Controller {

	public function index() {		
		$this->_render['layout'] = 'forum';		
		$authorized = Auth::check('default');
		$forums = Forums::all()->to('array');

		$breadcrumbs = array('path' => array("Forum"), 'link' => array("/forum"));
		$page = array('title' => 'Home', 'header' => 'Forum', 'subheader' => 'Categories');
		$recentfeed = Messages::find('all', array(
			'limit' => 3,
			'order' => array('tstamp' => 'DESC')
		))->to('array');
		
		foreach ($recentfeed as $key => $recent) {
			$author = Users::find('first', array('conditions' => array('id' => $recent['uid'])));
			$recentfeed[$key]['author'] = $author->alias;
			
			$thread = Threads::find('first', array('conditions' => array('id' => $recent['tid'])));
			$recentfeed[$key]['thread'] = $thread->name;
			
			$forum = Forums::find('first', array('conditions' => array('id' => $thread->fid)));
			$recentfeed[$key]['forum'] = $forum->name;
		}		
		
		foreach ($forums as $key => $forum) {
			$threads = Threads::find('all', array(
				'conditions' => array('fid' => $forum['id'])
			))->to('array');
			$forums[$key]['count'] = count($threads);
		}
		
		return compact('authorized', 'page', 'forums', 'breadcrumbs', 'recentfeed');
	}
}