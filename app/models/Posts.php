<?php

namespace app\models;

class Posts extends \lithium\data\Model  
{ 
	public static function clean ($text) 
    {
		$text = trim($text);
		$cleaned = '';
		$linefeeds = 0;
		$length = strlen($text);
		for ($i = 0; $i < $length; $i++) 
        {
			if (ord($text[$i]) == 10) 
            {
				if ($linefeeds < 2) 
                {
					$cleaned .= $text[$i];
					$linefeeds++;
				}
			} 
            elseif (ord($text[$i]) != 13) 
            {
				$cleaned .= $text[$i];
				$linefeeds = 0;
			}
		}
		return strip_tags($cleaned);
	}

	public static function Get ($id) 
    {
		if ($post = self::find('first', array('conditions' => array('id' => $id)))) 
			return $post->to('array');
		else
			return null;
	}

    public static function UpdatePostContent ($id, $content)
    {
        $post = self::find('first', array('conditions' => array('id' => $id)));
        if ($post)
        {
            $post->content = self::clean($content);
            $post->save();
        }
    }

    public static function CreatePost ($threadid, $content, $authorid)
    {
        $post = self::create(array(
            'tid' => $threadid,
            'content' => $content,
            'uid' => $authorid,
        ));
        if ($post->save())
        {
            return $post->to('array');
        }
        return false;
    }

	public static function GetByThread ($tid) 
    {
		return self::find('all', array(
			'conditions' => array('tid' => $tid),
			'order' => array('tstamp' => 'ASC')
		))->to('array');
	}
	
	public static function CountByThread ($tid) 
    {
		return self::count('all', array(
			'conditions' => array('tid' => $tid)
		));
	}
	
    /**
     * Deletes a specific Post.
     *
     * @param int $id Post identifier.
     *
     * @return bool True if successful.
     */
	public static function DeletePost ($id) 
    {
		if ($post = self::find('first', array('conditions' => array('id' => $id)))) 
        {
            if ($post->delete())
            {
                PostHits::DeletePostHits($id);
                UserNotifications::DeleteNotifications($id, UserNotifications::POST);
                return true;
            }
        }
		return false;
	}
	
    /**
     * Deletes all Posts in a Thread.
     *
     * @param int $tid Thread identifier.
     *
     * @return array List of booleans for whether or not each deletion was successful.
     */
	public static function DeletePosts ($tid) 
    {
		$posts = self::find('all', array('conditions' => array('tid' => $tid)));
		foreach ($posts as $post)
        {
            if ($post->delete())
            {
                PostHits::DeletePostHits($post->id);
                UserNotifications::DeleteNotifications($post->id, UserNotifications::POST);
            }
        }
	}
}
