<?php

namespace app\models;

class PostHits extends \lithium\data\Model  
{
	/**
	 * Retrieves the set of entries that correspond with a specified 'pid'.
	 *	@params
	 *		$postid - unique identifier of post in database
	 */
	public static function Get ($postid) 
    {
		return self::find('all', array('conditions' => array('pid' => $postid)))->to('array');
	}
	
	/**
	 * Retrieves the set of entries that correspond with a specific User.
	 *	@params
	 *		$userid - the user that has "hit" the post.
	 */
	public static function GetByUser ($userid) 
    {
		return self::find('all', array('conditions' => array('uid' => $userid)))->to('array');
	}
	
	/**
	 * Deletes all PostHits associated with a certain Post.
	 *	@params
	 *		$postid - identifier of Post to delete hits from.
	 */
	public static function DeletePostHits ($postid) 
    {
		$hits = self::find('all', array('conditions' => array('pid' => $postid)));
		$result = true;
		foreach ($hits as $hit)
			if (!$hit->delete())
				$result = false;
		return $result;
	}
	
	/**
	 * Results in TRUE or FALSE whether or not a User has liked a specific Post.
	 *	@params
	 *		$userid - user that may have 'hit' the post.
	 *		$postid - the post in question.
	 */
	public static function IsHitByUser ($postid, $userid) 
    {
		$userHits = PostHits::GetByUser($userid);
		foreach ($userHits as $hit)
			if ($hit['pid'] == $postid)
				return true;
		return false;
	}
	
	/**
	 * Results in TRUE or FALSE whether or not the User can hit the specific Post.
	 * Users cannot Hit a post more than once, nor can they hit their own posts.
	 *	@params
	 *		$userid - user that would hit the post.
	 *		$postid - the post being specified.
	 */
	public static function IsHitEnabledForUser ($postid, $userid) 
    {
		$post = Posts::Get($postid);
		return ($post != null && $post['uid'] != $userid &&
			!PostHits::IsHitByUser($postid, $userid));
	}
	
}
