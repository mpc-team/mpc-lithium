<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class ThreadController extends \lithium\action\Controller {
	
	public static function clean($text) {
		return str_replace(
			'\r', '',
			str_replace(
				'\n', '',
				str_replace(
					'\r\n', '', 
					strip_tags(trim($text))
				)
			)
		);
	}
	
	public function view() {
	
		if (isset($this->request->id)) {
			$id = $this->request->id;
			$authorized = Auth::check('default');		
			$info = Threads::find('first', array(
				'conditions' => array('id' => $id)
			));
			if (!$info) { return $this->redirect('/forum'); }

			$info = $info->to('array');
			if ($info['permission'] > 0 && $info['permission'] > $authorized['permission']) {
				return $this->redirect("/forum"); 
			}
			$user = Users::find('first', array(
				'conditions' => array('id' => $info['uid'])
			));
			$info['author'] = $user->alias;
			
			$forum = Forums::find('first', array(
				'conditions' => array('id' => $info['fid'])
			));
			$this->_render['layout'] = 'forum';
			$this->set(array(
				'title' => $info['name'],
				'pageheader' => $info['name'], 
				'pagesub' => $forum->name,
				'pageauthor' => $info['author'],
				'pagedate' => $info['tstamp']
			));
			
			if ($authorized) {			
				$replyform = array(
					'authenticated' => true,
					'user' => $authorized,
					'id' => $id
				);
			} else {
				$replyform = array(
					'authenticated' => false,
					'user' => null,
					'id' => null
				);
			}
			
			$breadcrumbs = array(
				'path' => array("Forum", $forum->name, $info['name']),
				'link' => array("/forum", "/board/view/{$forum->id}", "/thread/view/{$id}")
			);
			
			$messages = Messages::find('all', array(
				'conditions' => array('tid' => $id)
			))->to('array');
			if ($messages) {
				$fmsg = reset($messages);
				$fmsgkey = key($messages);
				$messages[$fmsgkey]['first'] = true;
				foreach ($messages as $key => $msg) {
					$user = Users::find('first', array(
						'conditions' => array('id' => $msg['uid'])
					));
					$messages[$key]['author'] = $user->alias;
				}
			}
			return compact('authorized', 'breadcrumbs', 'messages', 'replyform');
		}
		return $this->redirect('/forum');
	}
	
	public function delete() {
	
		if (isset($this->request->id)) {
			$id = $this->request->id;
			$authorized = Auth::check('default');
			$thread = Threads::find('first', array(
				'conditions' => array('id' => $id)
			));
			if (!$thread) {
				return $this->redirect("/forum");
			} elseif (!$authorized) {
				return $this->redirect("/thread/view/{$id}");
			} elseif ($authorized['id'] != $thread->uid) {
				return $this->redirect("/thread/view/{$id}");
			}
			$forum = Forums::find('first', array(
				'conditions' => array('id' => $thread->fid)
			)); 
			$thread->delete();
			return $this->redirect("/board/view/{$forum->id}");
		}	
		return $this->redirect('/forum');
	}
	
	/**
	 * For the 'create' action the ID taken corresponds to the Forum that is creating 
	 * he Thread. The page is rerouted to the Thread view using the newly created ID.
	 */
	public function create() {
	
		if (isset($this->request->id) && $this->request->data) {
			$id = $this->request->id;
			$authorized = Auth::check('default');
			$info = Forums::find('first', array(
				'conditions' => array('id' => $id)
			));
			
			if (!$authorized) {
				return $this->redirect("/board/view/{$id}");
			} elseif (!$info) { 
				return $this->redirect('/forum'); 
			}
			
			$info = $info->to('array');
			if ($info['permission'] > 0 && $info['permission'] > $authorized['permission']) {
				return $this->redirect("/forum"); 
			}
			
			$thread = Threads::create(array(
				'fid' => $id,
				'name' => self::clean($this->request->data['title']),
				'uid' => $authorized['id']
			));
			if (!$thread->save()) {
				return $this->redirect("/board/view/{$id}");
			}
			
			$message = Messages::create(array(
				'tid' => $thread->id,
				'content' => PostController::clean($this->request->data['content']),
				'uid' => $authorized['id']
			));
			if (!$message->save()) {
				$thread->delete();
				return $this->redirect("/board/view/{$id}");
			}
			
			return $this->redirect("/thread/view/{$thread->id}");
		}
		return $this->redirect('/forum');
	}
}
