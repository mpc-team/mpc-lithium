<?php

namespace app\models;

use lithium\security\Password;
use Exception;

class Users extends \lithium\data\Model  
{ 
    public static $FIELDS_PRIVATE = array('alias', 'email', 'id', 'permission', 'subsc_thread_on_post', 'tstamp');
    public static $FIELDS_PUBLIC  = array('alias', 'tstamp', 'id');

	public static function Get ($id, $fields = array('alias', 'tstamp', 'id')) 
	{   
		$user = self::find('first', array('conditions' => array('id' => $id), 'fields' => $fields));
		if($user)
			return $user->to('array');
		else
			return null;
	} 

    /**
     * Returns all Users, can optionally limit the number.
     *
     * @param int $limit Limit of results.
     *
     * @return array All Users.
     */
    public static function All ($limit = null, $fields = array('alias', 'tstamp', 'id'))
    {
        $users = self::find('all', array('limit' => $limit, 'fields' => $fields,));
        if ($users)
            return $users->to('array');
        else
            return null;
    }
	
	public static function getByEmail ($email) 
    {
		$user = self::find('first', array('conditions' => array('email' => $email)));
		if( $user )
			return $user->to( 'array' );
		else
			return null; 
	}
	
	public static function setPassword ($email, $password) 
    {
		$user = self::find('first', array('conditions' => array('email' => $email)));
		if ($user) 
        {
			$user->password = Password::hash($password);
			return $user->save();
		} 
        else
			throw new Exception( "user doesn't exist" );
	}
	
	/**
	 * Finds all avatar image files (multiple extensions possible) that 
	 * correspond to a specified User.
	 * @params
	 *	$email: the User's email.
	 * @returns
	 *	List of filepaths as an array.
	 */
	public static function FindAvatarFiles ($email) 
    {
		$exts = array('jpg', 'png', 'JPG', 'PNG');
		$path = '/users/avatars/' . $email . '.';
		$files = array();
		
		foreach ($exts as $ext)
        {
			if (file_exists(getcwd() . $path . $ext))
				array_push($files, $path . $ext);
		}
		return $files;
	}
	
	/**
	 * Returns the first Avatar image file that matches for the specified User.
	 * If no matches are found, a default `noprofile` image file path is returned.
	 * @params
	 *	$email: email address identifying the User.
	 * @returns
	 *	An image filepath corresponding to the specified User, or a generic 
	 *	`noprofile` image filepath if none exist for the User.
	 */
	public static function FindAvatarFile($email) {
    	
		$files = self::FindAvatarFiles($email);
		
		if (count($files) > 0)
			return $files[0];
		else
			return '/users/avatars/noprofile.png';
	}
	
	/**
	 * Deletes any User avatar files that may be stored.
	 * @params
	 *	$email: the User email.
	 * @returns
	 *	Nothing.
	 */
	public static function CleanAvatarFiles ($email) 
    {
		$files = self::FindAvatarFiles($email);
		$result = array();
		
		foreach ($files as $file) 
        {
			if (file_exists(getcwd() . $file))
				array_push($result, unlink(getcwd() . $file));
			else
				array_push($result, false);
		}
		return $result;
	}
}