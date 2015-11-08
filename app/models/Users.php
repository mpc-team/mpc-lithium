<?php

namespace app\models;

use lithium\security\Password;
use Exception;

class Users extends \lithium\data\Model  
{ 
	public static function getById( $id ) 
	{
		$user = self::find( 'first', array( 'conditions' => array( 
			'id' => $id 
		) ) );
		if( $user ) {
			return $user->to( 'array' );
		} else {
			return null;
		}
	} 
	
	public static function getByEmail ($email) {
		$user = self::find( 'first', array( 'conditions' => array( 
			'email' => $email 
		) ) );
		if( $user ) {
			return $user->to( 'array' );
		} else {
			return null; 
		}
	}
	
	public static function setPassword ($email, $password) {
		$user = self::find('first', array('conditions' => array('email' => $email)));
		if ($user) {
			$user->password = Password::hash($password);
			return $user->save();
		} else {
			throw new Exception( "user doesn't exist" );
		}
	}
	
	/**
	 * Finds all avatar image files (multiple extensions possible) that 
	 * correspond to a specified User.
	 * @params
	 *	$email: the User's email.
	 * @returns
	 *	List of filepaths as an array.
	 */
	public static function find_avatar_files ($email) {
		$exts = array('jpg', 'png', 'JPG', 'PNG');
		$path = '/users/avatars/' . $email . '.';
		$files = array();
		
		foreach ($exts as $ext):
			if (file_exists(getcwd() . $path . $ext)):
				array_push($files, $path . $ext);
			endif;
		endforeach;
		
		return $files;
	}
	
	/**
	 * Deletes any User avatar files that may be stored.
	 * @params
	 *	$email: the User email.
	 * @returns
	 *	Nothing.
	 */
	public static function clean_existing_avatar_files ($email) {
		$files = self::find_avatar_files($email);
		$result = array();
		
		foreach ($files as $file) {
			if (file_exists(getcwd() . $file))
				array_push($result, unlink(getcwd() . $file));
			else
				array_push($result, false);
		}
		return $result;
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
	public static function find_avatar_file($email) {	
		$files = self::find_avatar_files($email);
		
		if (count($files) > 0)
			return $files[0];
		else
			return '/users/avatars/noprofile.png';
	}
}