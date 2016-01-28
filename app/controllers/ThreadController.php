<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Categories;
use app\models\Forums;
use app\models\Threads;
use app\models\Posts;
use app\models\Permissions;
use app\models\Timestamp;
use app\models\PostHits;
use app\models\ThreadSubscriptions;
use app\models\UserNotifications;

class ThreadController extends ContentController 
{
	public function view ( ) 
	{
		$this->_render['layout'] = 'forum';
		
		if (!isset($this->request->id))
			return $this->redirect('/forum');
		
		$authorized = Auth::check('default');
		$thread = self::verify_access($authorized, '\app\models\Threads', $this->request->id);
		if (!$thread)
			return $this->redirect('/forum');
			
		$forum = Forums::Get($thread['fid']);
        $category = Categories::Get($forum['cid']);
		$breadcrumbs = array(
			'path' => array("MPC", "Forum", $category['name'], $forum['name'], $thread['name']),
			'link' => array(
				"/",
				"/forum", 
                "/forum#{$category['name']}",
				"/board/view/{$forum['id']}", 
				"/thread/view/{$this->request->id}"
			)
		);

		$author = Users::Get($thread['uid']);
		$thread['author'] = $author;
		$thread['date'] = Timestamp::toDisplayFormat($thread['tstamp']);
		$thread['name'] = stripslashes($thread['name']);

		$data = array(
			'thread' => $thread,
            'category' => $category,
			'forum' => $forum,
			'posts' => Posts::GetByThread($this->request->id),
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

		foreach ($data['posts'] as $key => $post) 
        {
            UserNotifications::DeleteNotification($authorized['id'], $post['id'], UserNotifications::POST);
            UserNotifications::DeleteNotification($authorized['id'], $post['id'], UserNotifications::POST_HIT);

            $privateInformation = Users::Get($post['uid'], Users::$FIELDS_PRIVATE);

			$author = Users::Get($post['uid']);
			$data['posts'][$key]['content'] = stripslashes($data['posts'][$key]['content']);
			$data['posts'][$key]['author'] = $author;
			$data['posts'][$key]['author']['since'] = Timestamp::toDisplayFormat($author['tstamp']);
			$data['posts'][$key]['author']['avatar'] = Users::FindAvatarFile($privateInformation['email']);
			$data['posts'][$key]['date'] = Timestamp::toDisplayFormat($post['tstamp'], array());
			$data['posts'][$key]['features'] = array();
			$data['posts'][$key]['hit'] = $authorized && PostHits::IsHitByUser($data['posts'][$key]['id'], $authorized['id']);
			$data['posts'][$key]['hitEnabled'] = $authorized && PostHits::IsHitEnabledForUser($data['posts'][$key]['id'], $authorized['id']);
			$conditions = array(
				'quote' => (bool) $authorized,
				'edit' => ($authorized['id'] == $author['id'] || Permissions::is_admin($authorized)),
				'delete' => ($authorized['id'] == $author['id'] || Permissions::is_admin($authorized))
			);
			foreach ($conditions as $feature => $condition)
				if ($condition)
					array_push($data['posts'][$key]['features'], $feature);
		}
		return compact('authorized', 'breadcrumbs', 'data', 'reply');
	}

	/**
	 * Deletes a specific Thread.
	 *
	 * @param int $this->request->id Thread identifier.
	 *
	 * @returns
	 *	On success, redirects to the Board where the Thread was present. Any errors redirect
	 *	to the Forum homepage (/forum).
	 */
	public function delete ( ) 
	{
		if (!isset($this->request->id))
			return $this->redirect('/forum');
	
		$authorized = Auth::check('default');
		$thread = Threads::Get($this->request->id);
		
		if (!$thread || !$authorized)
			return $this->redirect('/forum');

		if ($authorized['id'] != $thread['uid'] && !Permissions::is_admin($authorized))
			return $this->redirect('/forum');
				
		Threads::DeleteThread($this->request->id); // Should delete all associated stuff.
		return $this->redirect("/board/view/{$thread['fid']}");
	}

	/**
	 * Creates a Thread in a specified Forum.
	 *
	 * @param int $this->request->id Forum identifier.
	 * @param array $this->request->data Form data.
	 *
	 * @return
	 *	On success, redirects to the newly created thread. On failure, will return to the
	 *	Forum homepage (/forum) or the Board where the thread was attempted to be created.
	 */
	public function create ( ) 
	{
		if (!isset($this->request->id) || !$this->request->data)
			return $this->redirect('/forum');
		
		$authorized = Auth::check('default');
		$forum = Forums::Get($this->request->id);
		
		if (!self::verify_access($authorized, "\app\models\Forums", $this->request->id))
			return $this->redirect('/forum');
		
        $threadName = Threads::CleanTitle($this->request->data['title']);
        $thread = Threads::CreateThread($this->request->id, $threadName, $authorized['id'], $forum['permission']);
        if ($thread)
		{
            $content = Posts::clean($this->request->data['content']);
            $post = Posts::CreatePost($thread['id'], $content, $authorized['id']);
            if ($post)
            {
                ThreadSubscriptions::NewSubscription($authorized['id'], $thread['id']);
                return $this->redirect("/thread/view/{$thread['id']}");
            }
			else
            {
                Threads::DeleteThread($thread['id']);
            }
		}
		return $this->redirect("/board/view/{$this->request->id}");
	}
}
