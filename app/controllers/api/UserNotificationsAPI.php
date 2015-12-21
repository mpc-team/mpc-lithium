<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;
use app\models\UserNotifications;

class UserNotificationsAPI extends ContentController
{
	public function GetByType() 
	{
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => null, 'status' => 500));

        if (!isset($this->request->id))
            return $this->render(array('json' => null, 'status' => 500));

        $type = $this->request->id;
		$notifications = UserNotifications::GetUserNotificationsOfType($authorized['id'], $type);
		
		return $this->render(array('json' => $notifications, 'status' => 200));
	}
}