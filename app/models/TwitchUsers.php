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
   public static function All ($limit = null)
    {
        $all = self::find('all');
        if ($all)
            return $all->to('array');
        else
            return null;
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