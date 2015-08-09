<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Posts;
use app\models\Permissions;
use app\models\Timestamp;

class BoardController extends ContentController {

	public function view() {	
		$authorized = Auth::check('default');
		$data = array();
		if (isset($this->request->id)) {
			$this->_render['layout'] = 'forum';
			if ($forum = self::verify_access($authorized, '\app\models\Forums', $this->request->id)) {
				$breadcrumbs = array(
					'path' => array("MPC", "Forum", stripslashes($forum['name'])),
					'link' => array("/", "/forum", "/board/view/{$this->request->id}")
				);
				$data['forum'] = $forum;
				$data['threads'] = Threads::getByForumId($this->request->id);
				$data['permissions'] = ($authorized) ? array('create') : array();
				foreach ($data['threads'] as $key => $thread) {
					$posts = Posts::find('all', array(
						'conditions' => array('tid' => $thread['id']),
						'order' => array('tstamp' => 'DESC')
					))->to('array');
					$author = Users::getById($thread['uid']);
					$data['threads'][$key]['name'] = stripslashes($thread['name']);
					$data['threads'][$key]['author'] = stripslashes($author['alias']);
					$data['threads'][$key]['date'] = Timestamp::toDisplayFormat($thread['tstamp']);
					$data['threads'][$key]['count'] = count($posts);
					$data['threads'][$key]['recent'] = reset($posts);
					$data['threads'][$key]['features'] = ($author['id'] == $authorized['id'] || 
						Permissions::is_admin($authorized)) ? array('delete') : array();
						
					if ($data['threads'][$key]['recent']) {
						$author = Users::getById($data['threads'][$key]['recent']['uid']);
						$data['threads'][$key]['recent']['author'] = stripslashes($author['alias']);
						$data['threads'][$key]['recent']['date'] = 
							Timestamp::toDisplayFormat($data['threads'][$key]['recent']['tstamp'], array());
					}
				}
				usort($data['threads'], array("self", "thread_sort"));
				return compact('authorized', 'breadcrumbs', 'data');	
			}
		}
		return $this->redirect('/forum');
	}
	
	/**
	 * thread_sort:
	 *
	 * Sort threads in the order of their 'recent' timestamp. The 'recent' property is only available
	 * after it has been added by processing done in BoardController::view().
	 */
	public static function thread_sort($a, $b) {
		return $a['recent']['tstamp'] < $b['recent']['tstamp'];
	}
}







