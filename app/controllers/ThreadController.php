<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class ThreadController extends ContentController {

	/**
	 * clean
	 *	Cleans a Thread name. Removes carriage-returns and linefeeds and any trailing whitespace.
	 *	HTML tags are not allowed in titles either, but the markup tags are (they are not rendered though).
	 */
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
	
	/**
	 * view
	 *	Displays the contents of the thread. Permissions need to be checked.
	 */
	public function view() {
	
		if (isset($this->request->id)) {
			$this->_render['layout'] = 'forum';
			$id = $this->request->id;
			$authorized = Auth::check('default');		
			$replyform = array(
				'user' => $authorized,	//currently authorized user
				'id' => $id, //identifier for which Thread to reply to
				'enabled' => (bool) $authorized //whether the Reply Form is enabled
			);
			
			if (!($thread = Threads::find('first', array('conditions' => array('id' => $id))))) { 
				return $this->redirect('/forum#nothread'); 
			}
			
			if (!self::verify_access($authorized, '\app\models\Threads', $id)) {
				return $this->redirect('/forum#nothreadaccess');
			}
			
			$author = Users::find('first', array('conditions' => array('id' => $thread->uid)));
			$forum = Forums::find('first', array('conditions' => array('id' => $thread->fid)));
			$messages = Messages::find('all', array(
				'conditions' => array('tid' => $id),
				'order' => array('tstamp' => 'ASC')
			))->to('array');
			
			$breadcrumbs = array(
				'path' => array("Forum", $forum->name, $thread->name),
				'link' => array("/forum", "/board/view/{$forum->id}", "/thread/view/{$id}")
			);
			
			if ($messages) {
				reset($messages);
				$messages[key($messages)]['first'] = true;
				foreach ($messages as $key => $msg) {
					$author = Users::find('first', array('conditions' => array('id' => $msg['uid'])));
					$messages[$key]['author'] = $author->alias;
				}
			}
			
			$thread = $thread->to('array');
			$thread['author'] = $author->alias;
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
	 * delete
	 *	Delete the specified thread. Do authorization checks before deleting, then redirect
	 *	to the parent forum board.
	 */
	public function delete() {
	
		if (isset($this->request->id)) {
			$id = $this->request->id;
			$authorized = Auth::check('default');
			$thread = Threads::find('first', array('conditions' => array('id' => $id)));
			
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
	 * create
	 *	For the 'create' action the ID taken corresponds to the Forum that is creating 
	 *	he Thread. The page is rerouted to the Thread view using the newly created ID.
	 *
	 *	Creating a Thread prompts a new Post to be created as well, and as such the
	 *	content must be cleaned before storing in the Database.
	 */
	public function create() {
	
		if (isset($this->request->id) && $this->request->data) {
			$id = $this->request->id;
			$authorized = Auth::check('default');
			$forum = Forums::find('first', array('conditions' => array('id' => $id)));
			
			//filters and checks
			if (!$forum) {
				return $this->redirect("/forum#noforum");
			} elseif (!$authorized) {
				return $this->redirect("/board/view/{$id}");
			} elseif ($forum->permission > 0 && $forum->permission > $authorized['permission']) {
				return $this->redirect("/forum#permissions"); 
			}
	
			//create thread
			$thread = Threads::create(array(
				'fid' => $id,
				'name' => self::clean($this->request->data['title']),
				'uid' => $authorized['id']
			));
			
			if (!$thread->save()) {
				return $this->redirect("/board/view/{$id}");
			}
			
			//create message
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
