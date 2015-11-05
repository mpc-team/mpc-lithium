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
	
	public static function getByEmail( $email ) 
	{
		$user = self::find( 'first', array( 'conditions' => array( 
			'email' => $email 
		) ) );
		if( $user ) {
			return $user->to( 'array' );
		} else {
			return null; 
		}
	}
	
	public static function setPassword( $email, $password )
	{
		$user = self::find( 'first', array( 'conditions' => array(
			'email' => $email
		) ) );
		if( $user ) {
			$user->password = Password::hash( $password );
			return $user->save();
		} else {
			throw new Exception( "user doesn't exist" );
		}
	}
	
	public static function findAvatarImagePath($email) 
	{	
		$allowedtypes = array('jpg', 'png');
		$path = '/users/avatars/' . $email . '.';
		
		foreach ($allowedtypes as $imgtype):
			if (file_exists(getcwd() . $path . $imgtype)):
				return $path . $imgtype;
			endif;
		endforeach;
		
		return '/users/avatars/noprofile.jpg';
	}
}