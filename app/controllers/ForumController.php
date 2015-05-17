<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Categories;
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;
use app\models\Permissions;
use app\models\Timestamp;

class ForumController extends \lithium\action\Controller {

	const RECENT_LIMIT = 3;
	
	public function index() {		
	/**
	 * Forum Index
	 *
	 *	Shows all the available Forums that can be accessed. In addition, a 
	 *	panel that shows recent activity is displayed as a shortcut feature.
	 */
		$this->_render['layout'] = 'forum';		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array("Forum"), 
			'link' => array("/forum")
		);
		$page = array('title' => 'Forum');
		$forums = Forums::all()->to('array');
		$recentfeed = Messages::find('all', array(
			'limit' => self::RECENT_LIMIT,
			'order' => array('tstamp' => 'DESC')
		))->to('array');
		
		foreach ($recentfeed as $key => $recent) {
			$author = Users::find('first', array('conditions' => array('id' => $recent['uid'])));
			$thread = Threads::find('first', array('conditions' => array('id' => $recent['tid'])));
			$forum = Forums::find('first', array('conditions' => array('id' => $thread->fid)));
			$recentfeed[$key]['content'] = stripslashes($recentfeed[$key]['content']);
			$recentfeed[$key]['author'] = stripslashes($author->alias);
			$recentfeed[$key]['thread'] = stripslashes($thread->name);
			$recentfeed[$key]['forum'] = stripslashes($forum->name);
			$recentfeed[$key]['date'] = Timestamp::toDisplayFormat($recent['tstamp']);
		}		
		
		$categories = Categories::find('all')->to('array');
		
		foreach ($forums as $key => $forum) {
			$category = Categories::find('first', array('conditions' => array('id' => $forum['cid'])));
			$threads = Threads::find('all', array(
				'conditions' => array('fid' => $forum['id'])
			))->to('array');
			$forums[$key]['count'] = count($threads);
			$forums[$key]['category'] = $category->name;
			$categories[$category->id]['forums'][$key] = $forums[$key];
		}
		usort($forums, array("self", "forum_sort"));
	
		return compact('authorized', 'page', 'forums', 'categories', 'breadcrumbs', 'recentfeed');
	}
	
	public static function forum_sort($a, $b) {
	/**
	 * forum_sort
	 *
	 * Function determines how Forums are sorted when the list is passed to the View.
	 *
	 * First priority is the category. All forums are sorted by category first. Then, within
	 * each category, forums are sorted by permission. In cases where permissions and
	 * categories are identical, forums are ordered alphabetically.
	 */
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