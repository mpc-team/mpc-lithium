<?php
/**
 * ContentController.php
 *	Any general content-level activity can be intercepted by this class.
 */
namespace app\controllers;

/**
 * All types of content Models need to be included in a global scope or they will
 * not be recognized at run-time. This should mirror the classes which extend the
 * ContentController class.
 */
use app\models\Forums;
use app\models\Threads;
use app\models\Messages;

class ContentController extends \lithium\action\Controller {
	/**
	 * verify_access
	 *	Verify access to a particular resource. The resource model should extend the 
	 *	ContentController and be added to the above imports via "use".
	 */
	public function verify_access($user, $type, $id) {
		$content = $type::find('first', array('conditions' => array('id' => $id)));
		if ($content) {
			if ($content->permission > 0) {
				// non-public content
				return ($user) && ($content->permission <= $user['permission']);
			} else {
				// public content
				return true;
			}
		}
		return false;
	}
}