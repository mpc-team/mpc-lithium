<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Posts;
use app\models\Permissions;
use app\models\PostHits;
use app\models\ThreadSubscriptions;
use app\models\UserNotifications;

class PostController extends ContentController 
{
	/**
	 * Creates a Post with the Thread identifier provided.
     *
     * @param string $this->request->id Thread identifier parenting the Post.
     * @param string $this->request->data Provides the 'content' of the Post.
     *
	 * @return redirect Links to Thread to view the Post.
	 */
	public function create ( ) 
    {
		if (isset($this->request->id)) 
        {
			if ($this->request->data['content']) 
            {
				$authorized = Auth::check('default');
				if (self::verify_access($authorized, '\app\models\Threads', $this->request->id)) 
                {
                    $threadid = $this->request->id;
                    $userid = $authorized['id'];
					$post = Posts::create(array(
						'tid' => $threadid,
						'content' => Posts::clean($this->request->data['content']),
						'uid' => $userid
					));
					if ($post->save()) 
                    {   
                        if (!ThreadSubscriptions::IsSubscribed($userid, $threadid) 
                                && $authorized['subsc_thread_on_post'])
                            ThreadSubscriptions::NewSubscription($userid, $threadid);
                        
                        $subscriptions = ThreadSubscriptions::GetByThread($threadid);
                        foreach ($subscriptions as $subsc)
                        {
                            if ($subsc['userid'] != $userid)
                                $notification = UserNotifications::NewNotification(
                                    $subsc['userid'], $post->id, UserNotifications::FORUM);
                        }
						return $this->redirect("/thread/view/{$threadid}#{$post->id}");
					}
				}
			}
		}
		return $this->redirect('/forum');
	}
	
	/**
	 * Deletes a Post. If the Post is the last one in a Thread, deletes the Thread.
     *
     * @param int $this->request->id Post identifier.
     *
	 * @return redirect Redirects to view the Thread.
	 */
	public function delete ( ) 
    {
		if (isset($this->request->id)) 
        {
			$authorized = Auth::check('default');
			if ($post = self::verify_access($authorized, '\app\models\Posts', $this->request->id)) 
            {			
				if (($authorized['id'] == $post['uid']) || Permissions::is_admin($authorized)) 
                {
					if (Posts::DeletePost($post['id'])) 
                    {
						if (!Posts::countByThreadId($post['tid'])) 
							return $this->redirect("/thread/delete/{$post['tid']}");
                        else 
							return $this->redirect("/thread/view/{$post['tid']}");
					}
				}
			}
		}
		return $this->redirect('/forum');
	}

	/**
	 * Summary of edit
	 * @return object
	 */
	public function edit ( ) 
    {
		if (isset($this->request->id)) 
        {
			if ($post = Posts::find('first', array('conditions' => array('id' => $this->request->id)))) 
            { 
				$authorized = Auth::check('default');
				$thread = Threads::Get($post->tid);
				if (self::verify_access($authorized, '\app\models\Posts', $this->request->id)) 
                {
					if ($authorized['id'] == $post->uid || Permissions::is_admin($authorized)) 
                    {
                        Posts::UpdatePostContent($post->id, $this->request->data['content']);
						if ($this->request->data['rename']) 
                            Threads::UpdateThreadName($thread['id'], $this->request->data['rename']);

						return $this->redirect("/thread/view/{$thread['id']}#{$post->id}");
					}
				} 
                else 
                {
					return $this->redirect("/thread/view/{$thread['id']}#{$post->id}");
				}
			}
		}
		return $this->redirect('/forum');
	}
	
	/**
	 * Summary of hit
	 * @return string
	 */
	public function hit ( ) 
    {
		if (isset($this->request->id)) 
        {
			$authorized = Auth::check('default');
			if ($post = self::verify_access($authorized, '\app\models\Posts', $this->request->id)) 
            {
				$conditions = $authorized != NULL && 
					PostHits::IsHitEnabledForUser($post['id'], $authorized['id']);

				if ($conditions) 
                {
					$hit = PostHits::create(array(
						'pid' => $post['id'],
						'uid' => $authorized['id']
					));
					return json_encode(array('status' => $hit->save()));
				}
			}
		}
		return json_encode(array('status' => false));
	}
	
	/**
	 * Gets the number of Hits the Post has. 
	 * @return string
	 */
	public function getHits ( ) 
    {
		if (isset($this->request->id)) 
        {
			$authorized = Auth::check('default');
			if ($post = self::verify_access($authorized, '\app\models\Posts', $this->request->id)) 
            {
				$hits = PostHits::Get($post['id']);
				return json_encode(array(
					'status' => true,
					'id' => $post['id'],
					'value' => count($hits)
				));
			}
		}
		return json_encode(array('status' => false));
	}
}