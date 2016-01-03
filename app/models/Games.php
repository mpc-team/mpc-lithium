<?php

namespace app\models;

class Games extends \lithium\data\Model  
{
    /**
     * Retrieves a specified Game by its ID. Used primarily for looking up
     * information when only the Game's identifier is available.
     *
     * @param int $gameid Game identifier.
     */
    public static function Get ($gameid)
    {
        $game = self::find('first', array('conditions' => array('id' => $gameid)));
        if ($game)
            return $game->to('array');
        else
            return null;
    }

    /**
     * Retrieves all Game information. Optionally allows for the response to
     * be limited to a certain number of Games.
     *
     * @param int $limit Limit of results.
     *
     * @return array List of Games.
     */
	public static function All ($limit = null) 
	{
		return self::find('all', array('limit' => $limit))->to('array');
	}
}
