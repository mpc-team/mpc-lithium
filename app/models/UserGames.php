<?php

namespace app\models;

class UserGames extends \lithium\data\Model  {

  /**
   * Retrieves the associated game and user combination if it exists. This 
	 * indicates whether a specific user 'uid' plays a specific game 'gid'.
   */
  public static function getByIds ($gid, $uid) {
    return self::find('first', array('conditions' => array('gid' => $gid, 'uid' => $uid)));
  }
	
  /**
   * Retrieves multiple games associated with a specific user ID. Games returned 
	 * by this function are all "played" by the user specified.
   */
  public static function getById ($uid) {
    return self::find('all', array('conditions' => array('uid' => $uid)))->to('array');
  }
	
  /**
   * Sets the specified game for the specified user to played or not. This 
	 * function provides the necessary error-checking associated with any 
	 * Database-end integrity.
   */
  public static function set ($uid, $gid, $flag) {
    $game = self::getByIds($gid, $uid);
    if ($flag && !$game) {
      $game = self::create(array('gid' => $gid, 'uid' => $uid));
			return $game->save();
    } elseif (!$flag && $game) {
			return $game->delete();
    }
    return false;
  }
}
