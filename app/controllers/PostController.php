<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Posts;
use app\models\Permissions;

class PostController extends ContentController {

	public static function clean($text) {
		$text = trim($text);
		$cleaned = '';
		$linefeeds = 0;
		$length = strlen($text);
		for ($i = 0; $i < $length; $i++) {
			// limit number of linefeeds allowed in a row
			if (ord($text[$i]) == 10) {
				if ($linefeeds < 2) {
					$cleaned .= $text[$i];
					$linefeeds++;
				}
			// remove carriage returns completely (do not copy)
			} elseif (ord($text[$i]) != 13) {
				$cleaned .= $text[$i];
				$linefeeds = 0;
			}
		}
		return strip_tags($cleaned);
	}
		
	public function create() {
		if (isset($this->request->id)) {
			if ($this->request->data['content']) {
				$authorized = Auth::check('default');
				if (self::verify_access($authorized, '\app\models\Threads', $this->request->id)) {
					$message = Posts::create(array(
						'tid' => $this->request->id,
						'content' => self::clean($this->request->data['content']),
						'uid' => $authorized['id']
					));
					if ($message->save()) {
						return $this->redirect("/thread/view/{$this->request->id}#forum-thread-message-{$message->id}");
					}
				}
			}
		}
		return $this->redirect('/forum');
	}

	public function edit() {
		if (isset($this->request->id)) {
			if ($post = Posts::find('first', array('conditions' => array('id' => $this->request->id)))) { 
				$authorized = Auth::check('default');
				$thread = Threads::find('first', array('conditions' => array('id' => $post->tid)));
				if (self::verify_access($authorized, '\app\models\Posts', $this->request->id)) {
					if ($authorized['id'] == $post->uid || Permissions::is_admin($authorized)) {
						$post->content = self::clean($this->request->data['content']);
						$post->save();
						if ($this->request->data['rename']) {
							$thread->name = ThreadController::clean($this->request->data['rename']);
							$thread->save();
						}
						return $this->redirect("/thread/view/{$thread->id}#forum-thread-message-{$post->id}");
					}
				} else {
					return $this->redirect("/thread/view/{$thread->id}#forum-thread-message-{$post->id}");
				}
			}
		}
		return $this->redirect('/forum');
	}
	
	public function delete() {
		if (isset($this->request->id)) {
			$authorized = Auth::check('default');
			if ($post = self::verify_access($authorized, '\app\models\Posts', $this->request->id)) {			
				if (($authorized['id'] == $post['uid']) || Permissions::is_admin($authorized)) {
					if (Posts::deleteById($post['id'])) {
						if (!Posts::countByThreadId($post['tid'])) {
							return $this->redirect("/thread/delete/{$post['tid']}");
						} else {
							return $this->redirect("/thread/view/{$post['tid']}");
						}
					}
				}
			}
		}
		return $this->redirect('/forum');
	}
}