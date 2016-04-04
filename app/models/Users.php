<?php

namespace app\models;

use lithium\security\Password;
use Exception;

class Users extends \lithium\data\Model  
{ 
    public static $FIELDS_PRIVATE = array('alias', 'email', 'id', 'permission', 'subsc_thread_on_post', 'tstamp', 'last_logged');
    public static $FIELDS_PUBLIC  = array('alias', 'tstamp', 'id');

	public static function Get ($id, $fields = array('alias', 'tstamp', 'last_logged', 'id')) 
	{   
		$user = self::find('first', array('conditions' => array('id' => $id), 'fields' => $fields));
		if($user)
			return $user->to('array');
		else
			return null;
	} 

    /**
     * Retrieves all Users. Can be filtered to only return a specific amount of results
     * or only specific "fields" from the Users object (such as alias or email).
     * @params
     *  $limit: Limit number of results. Defaults to no limit.
     *  $fields: Fields to retrieve for the Users. Defaults to "alias", "tstamp", and "id".
     * @returns
     *  Returns an array of Users in associative array format.
     */
    public static function All ($limit = null, $fields = array('alias', 'tstamp', 'id'))
    {
        $users = self::find('all', array('limit' => $limit, 'fields' => $fields,));
        if ($users)
            return $users->to('array');
        else
            return null;
    }
	
    /**
     * Retrieves a specific User by Email.
     * @params
     *  $email: User's email address.
     * @returns
     *  Returns the User object in associative array format.
     */
	public static function GetByEmail ($email) 
    {
		$user = self::find('first', array('conditions' => array('email' => $email)));
		if( $user )
			return $user->to( 'array' );
		else
			return null; 
	}
	
    /**
     * Changes a User's password. The password is hashed before being stored.
     * @params
     *  $email: User's email address.
     *  $password: New password in plaintext.
     * @returns
     *  Returns <TRUE> on success and <FALSE> otherwise.
     * @exceptions
     *  Throws exception if the User doesn't exist.
     */
	public static function SetPassword ($email, $password) 
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
	public static function FindAvatarFiles ($id) 
    {
		$exts = array('jpg', 'png', 'JPG', 'PNG');
		$path = '/users/avatars/' . $id . '.';
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
	public static function FindAvatarFile($id) {
    	
		$files = self::FindAvatarFiles($id);
		
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
	public static function CleanAvatarFiles ($id) 
    {
		$files = self::FindAvatarFiles($id);
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

    /**
     * Updates the Last Logged timestamp with the current datetime.
     * @params
     *  $uid: User identifier.
     * @returns
     *  True on success.
     */
    public static function UpdateLastLogged ($uid)
    {
        $user = self::find('first', array('conditions' => array('id' => $uid)));
        if ($user != null)
        {
            $user->last_logged = date('Y-m-d H:i:s');
            return $user->save();
        }
        return false;
    }
}