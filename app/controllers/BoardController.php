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
			$id = $this->request->id;
			$authorized = Auth::check('default');
	
			$info = Forums::find('first', array(
				'conditions' => array('id' => $id)
			));
			if (!$info) { 
				return $this->redirect('/forum'); 
			}
			$info = $info->to('array');
			if ($info['permission'] > 0 && $info['permission'] > $authorized['permission']) {
				return $this->redirect("/forum"); 
			}
			
			$threads = Threads::find('all', array(
				'conditions' => array('fid' => $id)
			))->to('array');
			
			$this->_render['layout'] = 'forum';
			$this->set(array(
				'title' => $info['name'],
				'pageheader' => $info['name'], 
				'pagesub' => 'Forum'
			));
			
			$breadcrumbs = array(
				'path' => array("Forum", $info['name']),
				'link' => array("/forum", "/board/view/{$id}")
			);
			
			foreach ($threads as $key => $thread) {
				$user = Users::find('first', array(
					'conditions' => array('id' => $thread['uid'])
				))->to('array');
				$threads[$key]['author'] = $user['alias'];
				
				$messages = Messages::find('all', array(
					'conditions' => array('tid' => $thread['id']),
					'order' => array('tstamp' => 'DESC')
				))->to('array');
				$threads[$key]['count'] = count($messages);
				$threads[$key]['recent'] = reset($messages);
				
				if ($threads[$key]['recent']) {
					$user = Users::find('first', array(
						'conditions' => array('id' => $threads[$key]['recent']['uid'])
					))->to('array');
					$threads[$key]['recent']['author'] = $user['alias'];
				}
			}
			
			return compact('id', 'authorized', 'threads', 'breadcrumbs');
		}
		return $this->redirect('/forum');
	}
}