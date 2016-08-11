<?php

namespace app\controllers\api;

use app\controllers\ContentController;

use app\models\TwitchUsers;

class TwitchUsersAPI extends ContentController
{

    /**
	 * Returns the list of all games as a JSON object.
	 *	@params
	 *	@returns
	 *		List of all Twitch Users.
	 */
	public function all() 
	{
        if (isset($this->request->query['limit']))
		    $twitchUsers = TwitchUsers::All($this->request->query['limit']);
        else
            $twitchUsers = TwitchUsers::All();
		
		return $this->render(array('json' => $twitchUsers, 'status' => 200));
	}

}
