<?php

namespace app\models;

class UserGames extends \lithium\data\Model  
{

    /**
     * Checks if a specific Game is played by a specified User.
     *
     * @param int $gid Game identifier.
     * @param int $uid User identifier.
     *
     * @return bool True if 
     */
    public static function IsPlayed ($gid, $uid) 
    {
        $played = self::find('first', array('conditions' => array('gid' => $gid, 'uid' => $uid)));
        if ($played)
            return true;
        else
            return false;
    }
	
    /**
     * Retrieves multiple games associated with a specific user ID. Games returned 
     * by this function are all "played" by the user specified.
     */
    public static function GetPlayedGames ($uid) 
    {
        return self::find('all', array(
            'conditions' => array('uid' => $uid),
            'fields' => array('gid'),
        ))->to('array');
    }
	
    /**
     * Sets the specified game for the specified user to played or not. This 
     * function provides the necessary error-checking associated with any 
     * Database-end integrity.
     */
    public static function Set ($uid, $gid, $flag) 
    {
        $isPlayed = self::IsPlayed($gid, $uid);
        if ($flag && !$isPlayed) 
        {
            $game = self::create(array('gid' => $gid, 'uid' => $uid));
	        return $game->save();
        } 
        elseif (!$flag && $isPlayed) 
        {
            $game = self::find('first', array('conditions' => array('gid' => $gid, 'uid' => $uid)));
	        return $game->delete();
        }
        return false;
    }
}
