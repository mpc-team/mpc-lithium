<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;
use app\models\Permissions;
use app\models\Timestamp;

class BoardController extends ContentController {
/**
 * BoardController
 *
 *
 */
	public function view() {
	
		if (isset($this->request->id)) {
			$this->_render['layout'] = 'forum';
			$id = $this->request->id;
			$authorized = Auth::check('default');
			
			if ($forum = self::verify_access($authorized, '\app\models\Forums', $id)) {
				$breadcrumbs = array(
					'path' => array("Forum", stripslashes($forum->name)),
					'link' => array("/forum", "/board/view/{$id}")
				);
				$page = array(
					'title' => stripslashes($forum->name), 
					'header' => stripslashes($forum->name), 
					'subheader' => 'Board'
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
					$threads[$key]['name'] = stripslashes($threads[$key]['name']);
					$threads[$key]['author'] = stripslashes($author['alias']);
					$threads[$key]['count'] = count($messages);
					$threads[$key]['recent'] = reset($messages);
					$threads[$key]['date'] = Timestamp::toDisplayFormat($thread['tstamp']);
					$is_author = ($author['id'] == $authorized['id']);
					$is_admin = Permissions::is_admin($authorized);
					$threads[$key]['editpanel'] = ($is_author || $is_admin);
					
					if ($threads[$key]['recent']) {
						$author = Users::find('first', array(
							'conditions' => array('id' => $threads[$key]['recent']['uid'])
						))->to('array');
						$threads[$key]['recent']['author'] = stripslashes($author['alias']);
						$threads[$key]['recent']['date'] = Timestamp::toDisplayFormat($threads[$key]['recent']['tstamp'], array());
					}
				}
				
				$permissions = ($authorized) ? array('create') : array();
				usort($threads, array("self", "thread_sort"));
				return compact('id', 'authorized', 'permissions', 'page', 'threads', 'breadcrumbs');
				
			}
		}
		
		return $this->redirect('/forum');
		
	}
	
	public static function thread_sort($a, $b) {
	/**
	 * thread_sort:
	 *
	 * Threads are sorted with the "usort" function, this is the comparison
	 *	function that determines sorting order.
	 */
		return $a['recent']['tstamp'] < $b['recent']['tstamp'];
	}
}







