<?php

namespace app\models;

use lithium\security\Password;

class Confirms extends \lithium\data\Model  
{
    /**
     * Send a Member Confirmation email with a specific Confirmation code.
     * 
     * @param string $email Email address to send to.
     * @param string $key Unique key to support User's explicit confirmation.
     */    
	public static function SendMemberConfirmationEmail ($email, $key) 
    {
		$message = self::ConfirmMemberEmailMessage($key);
		mail($email, 'Account Confirmation', $message, 'From: confirm-noreply@mpcgaming.com');
	}

    /**
     * Standard message for sending a Member confirmation email.
     *
     * @param string $key Unique confirmation code.
     */
    private static function ConfirmMemberEmailMessage ($key)
    {
        $text = 
<<<EOD
This email is a confirmation request from MPCgaming.com, issued by signing up with us!

To confirm your account and complete the signup process, click the following link. You will be asked to enter your Login credentials to access your account settings and use other features of MPCgaming.com.
EOD;
        $text .= 'http://www.mpcgaming.com/confirm/user?confirm=' . $key;
        $text .= 
<<<EOD

If you did not Signup with MPCgaming.com, you may ignore this.
EOD;
        return $text;
    }
}

/**
 * Apply a filter here to ensure the password is hashed before being inserted
 * into the Database. The password should then be copied to the Users table when
 * the account has been confirmed.
 */
Confirms::applyFilter('save', function($self, $params, $chain) {
    if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }
    if (!$params['entity']->exists()) {
        $params['entity']->password = Password::hash($params['entity']->password);
    }
    return $chain->next($self, $params, $chain);
});
