<?php

namespace app\models;

class UserClans extends \lithium\data\Model  
{
    
    /** 
     * Returns the Clan a User is registered with.
     *
     * @param int $userid User identifier.
     *
     * @return Clans Clan model object.
     */
    public static function GetUserClan ($userid)
    {
        $clanEntry = self::find('first', array('conditions' => array('uid' => $userid)));
        if ($clanEntry)
            return Clans::Get($clanEntry->cid);
        else
            return null;
    }

    /**
     * Returns a list of Users in the specified Clan.
     *
     * @param int $clanid Clan identifier.
     *
     * @return Array List of User identifiers that are in the Clan.
     */
    public static function GetClanUsers ($clanid)
    {
        return self::find('all', array('conditions' => array('cid' => $clanid)))->to('array');
    }

    /**
     * Removes all Users from a specified Clan.
     *
     * @param int $clanid Clan identifier.
     *
     * @return bool True on success.
     */
    public static function ClanRemoveUsers ($clanid)
    {
        return self::remove(array('conditions' => array('cid' => $clanid)));
    }

    /**
     * Removes a specified User from a Clan.
     *
     * @param int $clanid Clan identifier.
     * @param int $userid User identifier.
     *
     * @return bool True on successful removal.
     */
    public static function ClanRemoveUser ($clanid, $userid)
    {
        return self::remove(array('conditions' => array('cid' => $clanid, 'uid' => $userid)));
    }

    /** 
     * Registers a specified User with a specified Clan. The User cannot already
     * be registered in a Clan. 
     *
     * @param int $clanid Clan identifier.
     * @param int $userid User identifier.
     *
     * @return bool True on success.
     */
    public static function AddUser ($clanid, $userid)
    {
        // Does the User exist?
        if (!Users::Get($userid))
            return null;

        // Is the User already registered in a Clan?
        if (self::GetUserClan($userid) != null)
            return null;
        
        // Does the Clan exist?
        if (!Clans::Get($clanid))
            return null;

        $userClanEntry = self::create(array('cid' => $clanid, 'uid' => $userid));
        if ($userClanEntry)
            return $userClanEntry->save();
        else
            return false;
    }
}
