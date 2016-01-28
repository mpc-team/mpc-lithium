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

class ForumController extends \lithium\action\Controller {

	/**
	 * Limit amount of posts displayed in the recent-feed. 
	 */
	const RECENT_LIMIT = 9;
	
	/**
	 * @returns:
	 *	• $authorized - required by navbar element and possibly other components.
	 *	• $breadcrumbs - required by breadcrumbs element referenced in the layout.
	 *	• $data - any page-specific information is returned through this associative array.
	 */
	public function index() 
	{		
		$this->_render['layout'] = 'forum';		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array("MPC", "Forum"), 
			'link' => array("/", "/forum")
		);
		$data = array(
			'recentfeed' => Posts::find('all', array(
				   // 'limit' => self::RECENT_LIMIT,
				   'order' => array('tstamp' => 'DESC')))->to('array'),
			'categories' => Categories::find('all')->to('array'),
		);
		$recentCount = 0;
		foreach ($data['recentfeed'] as $key => $recent) 
		{
			$author = Users::Get($recent['uid']);
			$thread = Threads::Get($recent['tid']);
			
			if ($recentCount < self::RECENT_LIMIT && Permissions::is_public($thread)) 
			{
				$forum = Forums::Get($thread['fid']);
				$data['recentfeed'][$key]['content'] = stripslashes($data['recentfeed'][$key]['content']);
				$data['recentfeed'][$key]['author'] = stripslashes($author['alias']);
				$data['recentfeed'][$key]['thread'] = stripslashes($thread['name']);
				$data['recentfeed'][$key]['forum'] = stripslashes($forum['name']);
				$data['recentfeed'][$key]['date'] = Timestamp::toDisplayFormat($recent['tstamp']);
				$recentCount += 1;
			} 
			else 
			{
				unset($data['recentfeed'][$key]);
			}
		}		
		
		$forums = Forums::all()->to('array');
		foreach ($forums as $key => $forum) 
		{
			$category = Categories::Get($forum['cid']);
			$threads = Threads::GetByForum($forum['id']);
			$forums[$key]['count'] = count($threads);
			$forums[$key]['category'] = $category['name'];
			$data['categories'][$category['id']]['forums'][$key] = $forums[$key];
		}
		
		foreach ($data['categories'] as $ckey => $category) 
		{
            if (array_key_exists('forums', $data['categories'][$ckey]) && $data['categories'][$ckey]['forums'] != null)
			    usort($data['categories'][$ckey]['forums'], array('self', 'forum_sort'));
		}
		
		return compact('authorized', 'breadcrumbs', 'data');
	}
	
	/**
	 * forum_sort
	 *
	 * Function determines how Forums are sorted when the list is passed to the View.
	 *
	 * First priority is the category. All forums are sorted by category first. Then, within each
	 * category, forums are sorted by permission. In cases where permissions and categories are
	 * identical, forums are ordered alphabetically.
	 */
	public static function forum_sort($a, $b) {
		if ($a['category'] == $b['category']) {
			if ($a['permission'] == $b['permission']) {
				return $a['name'] > $b['name'];
			} else {
				return $a['permission'] > $b['permission'];
			}
		} else {
			return $a['category'] > $b['category'];
		}
	}
}