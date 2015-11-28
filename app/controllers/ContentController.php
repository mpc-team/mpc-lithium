<?php
/**
 * ContentController.php
 *
 * Any general content-level activity can be intercepted by this class.
 */
namespace app\controllers;

/**
 * All types of content Models need to be included in a global scope or they will not be
 * recognized at run-time. This should mirror the classes which extend the ContentController class.
 */
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class ContentController extends \lithium\action\Controller 
{
	/**
	 * Verify access to a particular resource.
	 *	@params
	 *		$user - the user accessing the resource.
	 *		$type - the resource type defined as \lithium\data\Model classes.
	 *		$id - the resource's unique identifier.
	 */
	public function verify_access($user, $type, $id)
	{
		$content = $type::find('first', array('conditions' => array('id' => $id)));	
		if (!$content)
			return null;
		
		if ($content->permission > 0) 
		{
			// Non-public content.
			if ($user && $content->permission <= $user['permission'])
				return $content->to('array');
		}
		else
		{
			// Public content.
			return $content->to('array');
		}
	}
}