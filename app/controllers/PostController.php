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

# ------------------------------------------------------------------------------------------------------

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
                        /* Subscribe to the Thread if necessary. */
                        if (!ThreadSubscriptions::IsSubscribed($userid, $threadid) 
                                && $authorized['subsc_thread_on_post'])
                            ThreadSubscriptions::NewSubscription($userid, $threadid);
                        
                        /* Create a User Notification for all subscribers. */
                        $subscriptions = ThreadSubscriptions::GetByThread($threadid);
                        foreach ($subscriptions as $subsc)
                        {
                            if ($subsc['userid'] != $userid)
                                $notification = UserNotifications::NewNotification(
                                    $subsc['userid'], $post->id, UserNotifications::POST);
                        }
						return $this->redirect("/thread/view/{$threadid}#{$post->id}");
					}
				}
			}
		}
		return $this->redirect('/forum');
	}
	
	public function delete ( ) 
    {
		if (isset($this->request->id)) 
        {
			$authorized = Auth::check('default');
			if ($post = self::verify_access($authorized, '\app\models\Posts', $this->request->id)) 
            {			
				if (($authorized['id'] == $post['uid']) || Permissions::IsAdmin($authorized)) 
                {
					if (Posts::DeletePost($post['id'])) 
                    {
						if (!Posts::CountByThread($post['tid'])) 
							return $this->redirect("/thread/delete/{$post['tid']}");
                        else 
							return $this->redirect("/thread/view/{$post['tid']}");
					}
				}
			}
		}
		return $this->redirect('/forum');
	}

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
					if ($authorized['id'] == $post->uid || Permissions::IsAdmin($authorized)) 
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
	
# ------------------------------------------------------------------------------------------------------

	public function hit ( ) 
    {
		if (isset($this->request->id)) 
        {
			$authorized = Auth::check('default');
			if ($post = self::verify_access($authorized, '\app\models\Posts', $this->request->id)) 
            {
                $authid = $authorized['id'];
                $postid = $post['id'];

				if ($authorized != NULL && PostHits::IsHitEnabledForUser($postid, $authid)) 
                {
                    $notification = UserNotifications::NewNotification(
                        $post['uid'], $post['id'], UserNotifications::POST_HIT, $authid);

                    $hit = PostHits::Hit($post['id'], $authorized['id']);
                    return json_encode(array('status' => ($hit != null)));
				}
			}
		}
		return json_encode(array('status' => false));
	}
	
	public function hits ( ) 
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

# ------------------------------------------------------------------------------------------------------

}