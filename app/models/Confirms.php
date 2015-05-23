<?php

namespace app\models;

use lithium\security\Password;

class Confirms extends \lithium\data\Model  { 
	
	public static function sendConfirmation ($user, $key) {
		$message = 
<<<EOD
This email is a confirmation request from mpcgaming.com, issued by signing up with us!
	
Please navigate to the following link, upon which your mpcgaming.com account will be verified.

EOD;
		$message .= 'http://www.mpcgaming.com/confirm/user' . '?confirm=' . $key;
		$message .=
<<<EOD

If you did not sign up with us, please ignore this message.

EOD;
		mail($user['email'], 'Account Confirmation', $message, 'From: confirm-noreply@mpcgaming.com');
	}
}

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
