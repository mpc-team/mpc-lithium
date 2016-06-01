<?php

namespace app\models;

class TwitchUsers extends \lithium\data\Model
{
    //Add (Save) MPC User's Twitch Credentials to Twitch_Users.
    public static function AddAccount ($twitchid, $twitchname, $userid)
    {            
        $caster = self::create(array(
            'tid'  => $twitchid,
            'tname'=> $twitchname,
            'uid'=> $userid
        ));
        $caster->save();
    }
    /**
	 * Fetch All from Database from Twitch_Users Tables.
	 *
	 * Returns All Casters.
	 */
	 public static function All ($limit = null) 
	{
		return self::find('all', array('limit' => $limit))->to('array');
	}
    /**
    * Checks for an Exisiting UID in the Database
    *
    * Return Boolean.
    */
    public static function ExistingUId ($uid) 
    {
		$caster = self::find('first', array('conditions' => array('uid' => $uid)));
		if( $caster )
			return true;
		else
			return false; 
	}
    
}