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
		$games = Games::getList();
		
		return $this->render(array('json' => $games, 'status' => 200));
	}
}