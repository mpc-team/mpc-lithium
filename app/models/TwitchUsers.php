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
    * DELETES an Exisiting $autherizedID/MPC ID in the Twitch Users Table
    *
    * Return Boolean.
    */
    public static function DeleteCaster($uid)
    {
		if ($caster = self::find('first', array('conditions' => array('uid' => $uid)))) 
        {
            if ($caster->delete())
            {
                return true;
            }
        }
		return false;
	}
    /**
    * CHECKS for an Exisiting $autherizedID/MPC ID in the Twitch Users Table
    *
    * @returns Boolean.
    */
    public static function ExistingUId ($uid) 
    {
		$caster = self::find('first', array('conditions' => array('uid' => $uid)));
		if( $caster )
			return true;
		else
			return false; 
	}
    /**
    * Checks for an Exisiting Twitch ID in the Database
    *
    * @Returns Boolean.
    */
    public static function ExistingTId ($tid) 
    {
		$caster = self::find('first', array('conditions' => array('tid' => $tid)));
		if( $caster )
			return true;
		else
			return false; 
	}
    /**
    * Checks for an Exisiting Twitch Names in the Database
    *
    * Return Boolean.
    */
    public static function ExistingTName ($tname) 
    {
		$caster = self::find('first', array('conditions' => array('tname' => $tname)));
		if( $caster )
			return true;
		else
			return false; 
	}
}