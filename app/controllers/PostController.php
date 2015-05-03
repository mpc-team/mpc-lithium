<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class PostController extends ContentController {
	/**
	 * clean 
	 *	Clean post content. Trims whitespace around text and removes:
	 *		- HTML tags, excess linefeed characters, etc.
	 *
	 *	Clean should just prepare a message to be inserted into the Database
	 *	and should not be used to control what is actually displayed. The file
	 *	"markup.js" is responsible for client-side processing of the style.
	 */
	public static function clean($text) {
		$text = trim($text);
		$cleaned = '';
		$linefeeds = 0;
		$length = strlen($text);
		for ($i = 0; $i < $length; $i++) {
			if (ord($text[$i]) == 10) {
				if ($linefeeds < 2) {
					$cleaned .= $text[$i];
					$linefeeds++;
				}
			} elseif (ord($text[$i]) != 13) {
				$cleaned .= $text[$i];
				$linefeeds = 0;
			}
		}
		return strip_tags($cleaned);
	}
		
	/**
	 * create
	 *	The ID number passed to the '/post' controller corresponds to the
	 *	thread that the post is being created for as '/thread/create' handles it.
	 */
	public function create() {
		
		if (isset($this->request->id)) {
			if ($this->request->data['content']) {
				$id = $this->request->id;
				$authorized = Auth::check('default');
					
				if (self::verify_access($authorized, '\app\models\Threads', $id)) {
					$message = Messages::create(array(
						'tid' => $id,
						'content' => self::clean($this->request->data['content']),
						'uid' => $authorized['id']
					));
					if ($message->save()) {
						return $this->redirect("/thread/view/{$id}");
					}
				}
			}
		}
		
		return $this->redirect('/forum');
	}

	/**
	 * edit
	 *	Edit content of a Post/Message. Does not update the timestamp associated
	 *	with the entry in the Database.
	 */
	public function edit() {
	
		if (isset($this->request->id)) {
			$id = $this->request->id;
			
			if ($message = Messages::find('first', array('conditions' => array('id' => $id)))) { 
				$authorized = Auth::check('default');
				$thread = Threads::find('first', array('conditions' => array('id' => $message->tid)));
				$is_author = ($authorized['id'] == $message->uid);
				
				if (self::verify_access($authorized, '\app\models\Messages', $id) && $is_author) {
					$message->content = self::clean($this->request->data['content']);
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
			
			if ($message = Messages::find('first', array('conditions' => array('id' => $id)))) {
				$authorized = Auth::check('default');
				$is_author = ($authorized['id'] == $message->uid);
				
				if (self::verify_access($authorized, '\app\models\Messages', $id) && $is_author) {
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