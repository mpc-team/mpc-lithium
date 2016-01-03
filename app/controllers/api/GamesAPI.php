<?php

namespace app\controllers\api;

use app\controllers\ContentController;

use app\models\Games;

class GamesAPI extends ContentController
{
	/**
	 * Returns the list of all games as a JSON object.
	 *	@params
	 *	@returns
	 *		List of all Games.
	 */
	public function all() 
	{
        if (isset($this->request->query['limit']))
		    $games = Games::All($this->request->query['limit']);
        else
            $games = Games::All();
		
		return $this->render(array('json' => $games, 'status' => 200));
	}
}