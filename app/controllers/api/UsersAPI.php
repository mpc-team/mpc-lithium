<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\Users;
use app\models\Messages;

class UsersAPI extends ContentController
{
    /**
     * Returns a list of Messages sent to a specified User.
     *
     * @param int $this->request->id User identifier.
     *
     * @return json List of User Messages.
     */
	public function messages() 
	{
        if (!isset($this->request->id))
            return $this->render(array('json' => null, 'status' => 500));

        $userid = $this->request->id;
		$user = Users::Get($userid);
        if ($user == null)
            return $this->render(array('json' => null, 'status' => 404));
		
        $wall = Messages::GetUserMessages($userid, 10);
        foreach ($wall as $key => $message)
        {
            $sender = Users::Get($message['uidsender']);
            $wall[$key]['sender'] = $sender['alias'];
            $wall[$key]['senderid'] = $sender['id'];
            $wall[$key]['content'] = stripslashes($message['content']);
        }
        $wall = array_values($wall);
		return $this->render(array('json' => $wall, 'status' => 200));
	}
}