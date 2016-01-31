<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\UserGames;
use app\models\Messages;
use app\models\Users;
use app\models\Games;
use app\models\Permissions;

class UsersAPI extends ContentController
{
 
    // The number of days before Users are no longer considered "new members".
    const NEW_MEMBER_DAYS = 7;

    /* User Information
    -------------------------------------------------------------------------------------------------------- */
   
    /**
     * Returns a list of all the Users with options.
     *
     * @param int $this->request->query['limit'] Limit of Users returned.
     * @param bool $this->request->query['ext'] Extended information of Users (games played, etc.).
     *
     * @return json List of members.
     */
    public function all()
    {
        $authorized = Auth::check('default');
        $fields = ($authorized && Permissions::is_admin($authorized)) ? Users::$FIELDS_PRIVATE : Users::$FIELDS_PUBLIC;

        if (isset($this->request->query['limit']))
            $members = Users::All($this->request->query['limit'], $fields);
        else
            $members = Users::All(null, $fields);

        if (isset($this->request->query['ext']) && $this->request->query['ext'])
            $this->GetExtendedUserInformation($members);

        return $this->render(array('json' => $members, 'status' => 200));
    }

    /* User Messages
    -------------------------------------------------------------------------------------------------------- */

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

    /* Authentication
    -------------------------------------------------------------------------------------------------------- */

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

    /* Extended User Information
    -------------------------------------------------------------------------------------------------------- */

    /**
     * Get extended information for a list of Users. Information is
     * directly inserted into the passed array in the appropriate position.
     *
     * @param array $users List of Users. Passed by reference.
     */
    private function GetExtendedUserInformation (&$users)
    {
        $today = strtotime(date('Y-m-d H:i:s'));

        foreach ($users as $key => $user)
        {
            // Find User's avatar image.
            $userData = Users::Get($user['id'], Users::$FIELDS_PRIVATE);
            $users[$key]['avatar'] = Users::FindAvatarFile($userData['email']);

            // Calculate if the User is new based on the number of days since creation.
            $daysSinceJoined = $today - strtotime($users[$key]['tstamp']);
            $daysSinceJoined = $daysSinceJoined / 86400.0;
            $users[$key]['newuser'] = $daysSinceJoined < self::NEW_MEMBER_DAYS;
            
            // Add Games played by the User.
            $playedGames = UserGames::GetPlayedGames($user['id']);
            $users[$key]['games'] = array();
            foreach ($playedGames as $userGame)
                array_push($users[$key]['games'], Games::Get($userGame['gid']));
        }
    }

    private function IsNewUser ($user)
    {
        
    }

}