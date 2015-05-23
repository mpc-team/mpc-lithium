<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Posts;
use app\models\Permissions;
use app\models\Timestamp;

class ThreadController extends ContentController {

	/**
	 * clean
	 *
	 * Cleans a Thread name. Removes carriage-returns and linefeeds and any trailing whitespace. HTML
	 * tags are not allowed in titles either, but the markup tags are (they are not rendered though).
	 */
	public static function clean($text) {
		$text = strip_tags(trim($text));
		$text = str_replace('"', '""', $text);
		$text = str_replace('\r\n', '', $text);
		$text = str_replace('\n', '', $text);
		$text = str_replace('\r', '', $text);
		return $text;
	}

	public function view() {
		if (isset($this->request->id)) {
			$this->_render['layout'] = 'forum';
			$authorized = Auth::check('default');
			if ($thread = self::verify_access($authorized, '\app\models\Threads', $this->request->id)) {
				$forum = Forums::getById($thread['fid']);
				$breadcrumbs = array(
					'path' => array("Forum", $forum['name'], $thread['name']),
					'link' => array(
						"/forum", 
						"/board/view/{$forum['id']}", 
						"/thread/view/{$this->request->id}"
					)
				);
				$author = Users::getById($thread['uid']);
				$thread['author'] = $author;
				$thread['date'] = Timestamp::toDisplayFormat($thread['tstamp']);
				$thread['name'] = stripslashes($thread['name']);
				$data = array(
					'thread' => $thread,
					'forum' => $forum,
					'posts' => Posts::getByThreadId($this->request->id),
					'replyform' => array(
						'user' => $authorized,
						'id' => $this->request->id,
						'enabled' => (bool) $authorized
					)	
				);
				$reply = array(
					'user' => $authorized, 
					'id' => $this->request->id, 
					'enabled' => (bool) $authorized
				);
				
				reset($data['posts']);
				$data['posts'][key($data['posts'])]['first'] = true;
				foreach ($data['posts'] as $key => $msg) {
					$author = Users::getById($msg['uid']);
					$data['posts'][$key]['content'] = stripslashes($data['posts'][$key]['content']);
					$data['posts'][$key]['author'] = $author;
					$data['posts'][$key]['author']['since'] = Timestamp::toDisplayFormat($author['tstamp']);
					$data['posts'][$key]['date'] = Timestamp::toDisplayFormat($msg['tstamp'], array());
					$data['posts'][$key]['features'] = array();
					$conditions = array(
						'quote' => (bool) $authorized,
						'edit' => ($authorized['id'] == $author['id'] || Permissions::is_admin($authorized)),
						'delete' => ($authorized['id'] == $author['id'] || Permissions::is_admin($authorized))
					);
					foreach ($conditions as $feature => $condition) {
						if ($condition) { 
							array_push($data['posts'][$key]['features'], $feature);
						}
					}
				}
				return compact('authorized', 'breadcrumbs', 'data', 'reply');
			}
		}
		return $this->redirect('/forum');
	}

	public function delete() {
		if (isset($this->request->id)) {
			$authorized = Auth::check('default');
			$thread = Threads::getbyId($this->request->id);
			if ($thread && $authorized) {
				if ($authorized['id'] == $thread['uid'] || Permissions::is_admin($authorized)) {
					Posts::deleteByThreadId($this->request->id);
					Threads::deleteById($this->request->id);
					return $this->redirect("/board/view/{$thread['fid']}");
				}
			}
		}
		return $this->redirect('/forum');
	}

	public function create() {
		if (isset($this->request->id) && $this->request->data) {
			$authorized = Auth::check('default');
			$forum = Forums::getById($this->request->id);
			if (self::verify_access($authorized, "\app\models\Forums", $this->request->id)) {
				$thread = Threads::create(array(
					'fid' => $this->request->id,
					'name' => self::clean($this->request->data['title']),
					'uid' => $authorized['id'],
					'tstamp' => null,
					'permission' => $forum['permission']
				));
				if ($thread->save()) {
					$post = Posts::create(array(
						'tid' => $thread->id,
						'content' => PostController::clean($this->request->data['content']),
						'uid' => $authorized['id']
					));
					if ($post->save()) {
						/* post created successfully view it with thread controller */
						return $this->redirect("/thread/view/{$thread->id}");
					} else {
						/* post wasn't created successfully, redirect back to forum board */
						$thread->delete();
					}
				}
				return $this->redirect("/board/view/{$this->request->id}");
			}
		}
		return $this->redirect('/forum');
	}
}
