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
			$this->_render['layout'] = 'forum';
			$id = $this->request->id;
			$authorized = Auth::check('default');		
	
			$replyform = array('user' => $authorized,	'id' => $id, 'enabled' => (bool) $authorized);
			
			if (!($thread = Threads::find('first', array('conditions' => array('id' => $id))))) { 
				return $this->redirect('/forum'); 
			}
			
			if ($thread->permission > 0 && $thread->permission > $authorized['permission']) {
				return $this->redirect("/forum"); 
			}
			
			$user = Users::find('first', array('conditions' => array('id' => $thread->uid)));
			$forum = Forums::find('first', array('conditions' => array('id' => $thread->fid)));
			$messages = Messages::find('all', array('conditions' => array('tid' => $id)))->to('array');
			
			$breadcrumbs = array(
				'path' => array("Forum", $forum->name, $thread->name),
				'link' => array("/forum", "/board/view/{$forum->id}", "/thread/view/{$id}")
			);
			
			if ($messages) {
				reset($messages);
				$messages[key($messages)]['first'] = true;
				foreach ($messages as $key => $msg) {
					$user = Users::find('first', array('conditions' => array('id' => $msg['uid'])));
					$messages[$key]['author'] = $user->alias;
				}
			}
			
			$thread = $thread->to('array');
			$thread['author'] = $user->alias;
			$page = array(
				'title' => $thread['name'],
				'header' => $thread['name'],
				'subheader' => $forum->name,
				'author' => $thread['author'],
				'date' => $thread['tstamp']
			);
			
			return compact('authorized', 'page', 'messages', 'breadcrumbs', 'replyform');
		}
		
		return $this->redirect('/forum');
	}
	
	/**
	 * Delete the specified thread. Do authorization checks before deleting, then redirect
	 * to the parent forum board.
	 */
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
			$thread->delete();
			
			$forum = Forums::find('first', array('conditions' => array('id' => $thread->fid))); 
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
			$thread = Threads::find('first', array(
				'conditions' => array('id' => $id)
			));
			
			if (!$authorized) {
				return $this->redirect("/board/view/{$id}");
			} elseif (!$thread) { 
				return $this->redirect('/forum'); 
			}
			
			if ($thread->permission > 0 && $thread->permission > $authorized['permission']) {
				return $this->redirect("/forum"); 
			}
			
			$thread = $thread->to('array');
			
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
