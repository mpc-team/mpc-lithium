<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class BoardController extends ContentController {

	public function view() {
	
		if (isset($this->request->id)) {
			$this->_render['layout'] = 'forum';
			$id = $this->request->id;
			$authorized = Auth::check('default');
			
			if ($forum = self::verify_access($authorized, '\app\models\Forums', $id)) {
				$breadcrumbs = array(
					'path' => array("Forum", $forum->name),
					'link' => array("/forum", "/board/view/{$id}")
				);
				$page = array(
					'title' => $forum->name, 
					'header' => $forum->name, 
					'subheader' => 'Forum'
				);
				$threads = Threads::find('all', array('conditions' => array('fid' => $id)))->to('array');
				
				foreach ($threads as $key => $thread) {
					$author = Users::find('first', array(
						'conditions' => array('id' => $thread['uid'])
					))->to('array');
					$messages = Messages::find('all', array(
						'conditions' => array('tid' => $thread['id']),
						'order' => array('tstamp' => 'DESC')
					))->to('array');
					$threads[$key]['author'] = $author['alias'];
					$threads[$key]['count'] = count($messages);
					$threads[$key]['recent'] = reset($messages);
					$is_author = ($author['id'] == $authorized['id']);
					$is_admin = ($authorized['permission'] >= 2);
					$threads[$key]['editpanel'] = ($is_author || $is_admin);
					
					if ($threads[$key]['recent']) {
						$author = Users::find('first', array(
							'conditions' => array('id' => $threads[$key]['recent']['uid'])
						))->to('array');
						$threads[$key]['recent']['author'] = $author['alias'];
					}
				}
				
				return compact('id', 'authorized', 'page', 'threads', 'breadcrumbs');
			}
		}
		
		return $this->redirect('/forum');
	}
}