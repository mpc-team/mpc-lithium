<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class PostController extends \lithium\action\Controller {

	/**
	 * clean():
	 *	Cleans message content of unwanted extraneous data, such as excessive
	 * 	line-feeds and carriage returns.
	 */
	public static function clean($text) {
		$text = str_replace('\r', '', strip_tags(trim($text)));
		$exploded = explode('\n', $text);
		$count = count($exploded);
		$text = '';
		foreach ($exploded as $piece) {
			$len = strlen($piece);
			if ($len > 0) {
				$text = $text . $piece . '\n';
			}
		}
		$text = str_replace('\n', '<br>', $text);
		return $text;
	}
		
	/**
	 * create():
	 * 	The ID number passed to the '/post' controller corresponds to the
	 * 	thread that the post is being created for as '/thread/create' handles it.
	 */
	public function create() {
		
		if (isset($this->request->id)) {
			$id = $this->request->id;
			$authorized = Auth::check('default');
			$thread = Threads::find('first', array('conditions' => array('id' => $id)));
			if ($thread && isset($this->request->data['content'])) {
				if ($authorized && $authorized['permission'] >= $thread->permission) {
					$message = Messages::create(array(
						'tid' => $id,
						'content' => self::clean($this->request->data['content']),
						'uid' => $authorized['id']
					));
					if ($message->save()) {
						return $this->redirect("/thread/view/{$this->request->id}");
					}
				}
			}
		}
		return $this->redirect('/forum');
	}

	public function edit() {
	
		if (isset($this->request->id)) {
			$id = $this->request->id;
			$authorized = Auth::check('default');
			$message = Messages::find('first', array('conditions' => array('id' => $id)));
			
			if ($message) { 
				$params = array('conditions' => array('id' => $message->tid));
				$thread = Threads::find('first', $params);
				
				if ($authorized && $message->uid == $authorized['id']) {
					$message->content = self::clean($this->request->data['message']);
					$message->save();
					if ($this->request->data['rename']) {
						$thread->name = ThreadController::clean($this->request->data['rename']);
						$thread->save();
					}
					return $this->redirect("/thread/view/{$thread->id}");
				} else {
					return $this->redirect("/thread/view/{$thread->id}");
				}
			}
		}
		return $this->redirect('/forum');
	}
	
	public function delete() {
		
		if (isset($this->request->id)) {
			$id = $this->request->id;
			$authorized = Auth::check('default');
			$message = Messages::find('first', array('conditions' => array('id' => $id)));
			
			if ($message) {
				if ($authorized && $message->uid == $authorized['id']) {
					if ($message->delete()) {
						return $this->redirect("/thread/view/{$message->tid}");
					} else {
						return $this->redirect('/');
					}
				}
			}
		}
		return $this->redirect('/forum');
	}
}