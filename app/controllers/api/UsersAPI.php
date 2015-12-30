<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\Messages;
use app\models\Users;

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

    /**
     * Either returns the authenticated User, or authenticates a User based
     * on credentials provided in the body of a request.
     *
     * @param int $this->request->id User identifier.
     * @param array $this->request->data Request body.
     *
     * @return object Authenticated User.
     */
    public function auth()
    {
        if (isset($this->request->id) && isset($this->request->data))
            return $this->Authenticate($this->request->id, $this->request->data);
        else
            return $this->Authenticated();
    }

//--------------------------------------------------------------------------------------

    /**
     * Authenticates with specified credentials.
     */
    private function Authenticate ($userid, $credentials)
    {
        return $this->render(array('json' => array(), 'status' => 200));
    }
    
    /**
     * Returns a JSON serialized User object representing the currently
     * authenticated/authorized User.
     *
     * @return object Authenticated User.
     */
    private function Authenticated ()
    {
        $auth = Auth::check('default');
        if ($auth)
            return $this->render(array('json' => Auth::check('default'), 'status' => 200));
        else
            return $this->render(array('json' => null, 'status' => 200));
    }

}