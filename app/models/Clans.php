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
        return self::find('all', array('limit' => $limit))->to('array');
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
    public static function Create ($fullName, $shortName)
    {
        $clan = self::create(array(
            'name' => $fullName,
            'shortname' => $shortName,
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
    public static function Remove ($clanid)
    {
        $clan = self::find('first', array('conditions' => array('id' => $clanid)));
        if ($clan)
            return UserClans::ClanRemoveUsers($clanid) && $clan->delete();
        else
            return false;
    }

}