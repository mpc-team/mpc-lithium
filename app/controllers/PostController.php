<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Forums;
use app\models\Threads;
use app\models\Posts;
use app\models\Permissions;
use app\models\PostHits;

class PostController extends ContentController 
{
	/**
	 * Summary of create
	 * @return object
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
					$message = Posts::create(array(
						'tid' => $this->request->id,
						'content' => Posts::clean($this->request->data['content']),
						'uid' => $authorized['id']
					));
					if ($message->save()) 
                    {
						return $this->redirect("/thread/view/{$this->request->id}#{$message->id}");
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
				$thread = Threads::find('first', array('conditions' => array('id' => $post->tid)));
				if (self::verify_access($authorized, '\app\models\Posts', $this->request->id)) 
                {
					if ($authorized['id'] == $post->uid || Permissions::is_admin($authorized)) 
                    {
						$post->content = Posts::clean($this->request->data['content']);
						$post->save();
						if ($this->request->data['rename']) 
                        {
							$thread->name = Threads::clean($this->request->data['rename']);
							$thread->save();
						}
						return $this->redirect("/thread/view/{$thread->id}#{$post->id}");
					}
				} 
                else 
                {
					return $this->redirect("/thread/view/{$thread->id}#{$post->id}");
				}
			}
		}
		return $this->redirect('/forum');
	}
	
	/**
	 * Summary of delete
	 * @return object
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
					if (Posts::deleteById($post['id'])) 
                    {
						PostHits::deleteByPostId($post['id']);
						if (!Posts::countByThreadId($post['tid'])) 
                        {
							return $this->redirect("/thread/delete/{$post['tid']}");
						} 
                        else 
                        {
							return $this->redirect("/thread/view/{$post['tid']}");
						}
					}
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
					PostHits::isPostHittableByUser($post['id'], $authorized['id']);

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
				$hits = PostHits::getByPostId($post['id']);
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