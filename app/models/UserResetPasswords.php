<?php

namespace app\models;

class UserResetPasswords extends \lithium\data\Model  { 

	public static function SendResetEmail( $user, $key ) 
	{
		$message = 
<<<EOD
This email is in regards to a Password Reset request that has been made corresponding to this email. If you did not make the request or want to cancel then simply disregard this email.

Click on the link below to be redirected to a page that will facilitate choosing a new password.

EOD;
		$message .= 'http://www.mpcgaming.com/user/resetpassword' . '?confirm=' . $key;
		$message .=
<<<EOD

If you did not sign up with us, please ignore this message.

EOD;
		mail( $user['email'], 'Password Reset Request', $message, 'From: passwordreset-noreply@mpcgaming.com' );
	}
	
	public static function getByKey( $key )
	{
		if( $user = self::find( 'first', array( 'conditions' => array( 'key' => $key ) ) ) ) {
			return $user->to( 'array' );
		} else {
			return null;
		}
	}
	
	public static function getByEmail( $email )
	{
		if( $user = self::find( 'first', array( 'conditions' => array( 'email' => $email ) ) ) ) {
			return $user->to( 'array' );
		} else {
			return null;
		}
	}
	
	public static function deleteByEmail( $email )
	{
		if( $user = self::find( 'first', array( 'conditions' => array( 'email' => $email ) ) ) ) {
			$user->delete();
			return true;
		} else {
			return false;
		}
	}
}