<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class BoardController extends \lithium\action\Controller {

	public function view() {
	
		if (isset($this->request->id)) {
			$this->_render['layout'] = 'forum';
			$id = $this->request->id;
			$authorized = Auth::check('default');
			
			if (!($forum = Forums::find('first', array('conditions' => array('id' => $id))))) { 
				return $this->redirect('/forum'); 
			}
			
			if ($forum->permission > 0 && $forum->permission > $authorized['permission']) {
				return $this->redirect("/forum"); 
			}
			
			$breadcrumbs = array(
				'path' => array("Forum", $forum->name),
				'link' => array("/forum", "/board/view/{$id}")
			);
			
			$page = array('title' => $forum->name, 'header' => $forum->name, 'subheader' => 'Forum');
			$threads = Threads::find('all', array('conditions' => array('fid' => $id)))->to('array');
			
			foreach ($threads as $key => $thread) {
				$user = Users::find('first', array(
					'conditions' => array('id' => $thread['uid'])
				))->to('array');
				
				$messages = Messages::find('all', array(
					'conditions' => array('tid' => $thread['id']),
					'order' => array('tstamp' => 'DESC')
				))->to('array');
				
				$threads[$key]['author'] = $user['alias'];
				$threads[$key]['count'] = count($messages);
				$threads[$key]['recent'] = reset($messages);
				
				if ($threads[$key]['recent']) {
					$user = Users::find('first', array(
						'conditions' => array('id' => $threads[$key]['recent']['uid'])
					))->to('array');
					$threads[$key]['recent']['author'] = $user['alias'];
				}
			}
			
			return compact('id', 'authorized', 'page', 'threads', 'breadcrumbs');
		}
		
		return $this->redirect('/forum');
	}
}