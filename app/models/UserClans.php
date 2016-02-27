<?php

namespace app\models;

class UserClans extends \lithium\data\Model  
{
    /**
     * Constants.
     */
    const MINIMUM_USERS = 5;
    const SHORTNAME_MAX = 5;    

    const RANK_OWNER = "owner";
    const RANK_MEMBER = "member";

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
     * Returns a User's rank within his/her Clan.
     *
     * @param int $userid User identifier.
     *
     * @return string Clan rank such as 'member' or 'owner'.
     */
    public static function GetUserClanRank ($userid)
    {
        $userClanEntry = self::find('first', array('conditions' => array('uid' => $userid)));
        if ($userClanEntry)
            return $userClanEntry->rank;
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
     * Removes all Users from a specified Clan. This is typically called when
     * we want to clean up leftover Users when we're deleting a Clan. We don't need
     * to check if we ~should~ delete the Clan here (no Users means no Clan).
     *
     * @param int $clanid Clan identifier.
     *
     * @return bool True on success.
     */
    public static function RemoveUsers ($clanid)
    {
        return self::remove(array('cid' => $clanid));
    }

    /**
     * Removes a specified User from a Clan. Checks to see that the Clan is still
     * valid (enough Members, etc.) and deletes the Clan if necessary.
     *
     * @param int $clanid Clan identifier.
     * @param int $userid User identifier.
     *
     * @return bool True on successful removal.
     */
    public static function RemoveUser ($clanid, $userid)
    {
        $clanEntry = self::find('first', array(
            'conditions' => array(
                'uid' => $userid,
                'cid' => $clanid)));
        if ($clanEntry == null)
            return false;

        if ($clanEntry->delete())
        {
            $userCount = self::GetClanUsers($clanid);
            if (count($userCount) < self::MINIMUM_USERS + 1)
                Clans::Deactivate($clanid);
            return true;
        }
        return false;
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
    public static function AddUser ($clanid, $userid, $rank = self::RANK_MEMBER)
    {
        // Does the User exist?
        if (!Users::Get($userid))
            return false;

        // Is the User already registered in a Clan?
        if (self::GetUserClan($userid) != null)
            return false;
        
        // Does the Clan exist?
        if (!Clans::Get($clanid))
            return false;

        $userClanEntry = self::create(array('cid' => $clanid, 'uid' => $userid, 'rank' => $rank));
        if ($userClanEntry->save())
        {
            $clanInvites = Messages::GetUserClanInvites($userid);
            foreach ($clanInvites as $invite)
                UserNotifications::DeleteNotification($userid, $invite['id'], UserNotifications::CLAN_INVITE);
            Messages::DeleteUserClanInvites($userid);
            $clanUsers = self::GetClanUsers($clanid);
            if (count($clanUsers) > self::MINIMUM_USERS)
                Clans::Activate($clanid);
            return true;
        }
        return false;
    }

    /**
     * Modifies a User's rank within his/her Clan.
     *
     * @param int $userid User identifier.
     * @param string $rank Rank to change to.
     *
     * @return bool True if successfully modified.
     */
    public static function ModifyUserRank ($userid, $rank)
    {
        // Does the User exist?
        if (!Users::Get($userid))
            return false;   

        $userClanEntry = self::find('first', array('conditions' => array('uid' => $userid)));
        if ($userClanEntry)
        {
            $userClanEntry->rank = $rank;
            return $userClanEntry->save();
        }
        return false;
    }
}
 