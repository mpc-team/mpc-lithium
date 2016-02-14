<?php

namespace app\models;

class Clans extends \lithium\data\Model  
{
    /**
     * Returns all Clans from the Database.
     *
     * @param int $limit Optional limit to the number of results.
     *
     * @return array List of Clans.
     */
    public static function All ($limit = null)
    {
        return self::find('all', array(
            'conditions' => array('active' => true),
            'limit' => $limit))->to('array');
    }

    /**
     * Activates a specified Clan. Usually done once the Clan exceeds the minimum
     * number of required members.
     *
     * @param int $clanid Clan identifier.
     *
     * @return bool True on successful activation.
     */
    public static function Activate ($clanid)
    {
        $clan = self::find('first', array('conditions' => array('id' => $clanid)));
        $clan->active = true;
        return $clan->save();
    }

    /**
     * Deactivates a specified Clan. Usually done when the Clan falls below 
     * the minimum number of required members.
     *
     * @param int $clanid Clan identifier.
     *
     * @return bool True on successful deactivation.
     */
    public static function Deactivate ($clanid)
    {
        $clan = self::find('first', array('conditions' => array('id' => $clanid)));
        $clan->active = false;
        return $clan->save();
    }

    /**
     * Returns Clan object from the Database. 
     *
     * @param int $clanid Clan identifier.
     *
     * @return Clans Object as associative array.
     */
	public static function Get ($clanid)
    {
        $clan = self::find('first', array('conditions' => array('id' => $clanid)));
        if ($clan)
            return $clan->to('array');
        else
            return null;
    }

    /**
     * Returns Clan object from the Database.
     *
     * @param string $fullName Clan name.
     * 
     * @return Clans Object as associative array.
     */
    public static function GetByName ($fullName)
    {
        $clan = self::find('first', array('conditions' => array('name' => $fullName)));
        if ($clan)
            return $clan->to('array');
        else
            return null;
    }

    /**
     * Creates a new Clan. Cannot have the same $fullName as another Clan. The
     * members list in the Clan is initially empty.
     *
     * @param string $fullName Full name of the Clan.
     * @param string $shortName Shortened Clan name, usually a 3-letter acronym (MPC).
     *
     * @return Clans On success, returns the Clan object taht was created as an array.
     */
    public static function Start ($fullName, $shortName, $owner)
    {
        $clan = self::create(array(
            'name' => $fullName,
            'shortname' => $shortName,
            'owner' => $owner,
        ));
        if ($clan->save())
            return $clan->to('array');
        else
            return null;
    }

    /**
     * Deletes a specified Clan. Removes any Users that may currently 
     * be registered in the Clan.
     *
     * @param int $clanid Clan identifier.
     *
     * @return bool True on success.
     */
    public static function Terminate ($clanid)
    {
        $clan = self::find('first', array('conditions' => array('id' => $clanid)));
        if ($clan)
            return UserClans::RemoveUsers($clanid) && $clan->delete();
        else
            return false;
    }

}