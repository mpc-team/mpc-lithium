<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class ForumController extends \lithium\action\Controller {

	public function index() {		
		$forums = Forums::all()->to('array');
		
		$this->_render['layout'] = 'forum';		
		$breadcrumbs = array(
			'path' => array("Forum"),
			'link' => array("/forum")
		);
		
		$recentfeed = Messages::find('all', array(
			'limit' => 3
		))->to('array');
		
		foreach ($recentfeed as $key => $recent) {
			$author = Users::find('first', array(
				'conditions' => array('id' => $recent['uid'])
			))->to('array');
			$recentfeed[$key]['author'] = $author['alias'];
			
			$thread = Threads::find('first', array(
				'conditions' => array('id' => $recent['tid'])
			))->to('array');
			$recentfeed[$key]['thread'] = $thread['name'];
			
			$forum = Forums::find('first', array(
				'conditions' => array('id' => $thread['fid'])
			))->to('array');
			$recentfeed[$key]['forum'] = $forum['name'];
		}
		
		$this->set(array(
			'title' => 'Home',
			'pageheader' => 'Forum', 
			'pagesub' => 'Categories'
		));
		
		foreach ($forums as $key => $forum) {
			$threads = Threads::find('all', array(
				'conditions' => array('fid' => $forum['id'])
			))->to('array');
			$forums[$key]['count'] = count($threads);
		}
		
		return compact('recentfeed', 'forums', 'breadcrumbs', 'recentfeed');
	}
}