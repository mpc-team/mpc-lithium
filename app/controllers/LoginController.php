<?php

namespace app\controllers;

use lithium\security\Auth;
use lithium\storage\session\adapter\Cookie;

use app\models\Users;
use app\models\Permissions;
use app\models\utils\Notifications;

class LoginController extends \lithium\action\Controller 
{
	public function index() 
	{
        // Pull authenticated User as a check.
        $authorized = Auth::check('default');
			
        // Keep record of the state of the Login.
        $redirect = null; 
        $success = false;

        // Redirect to Login if already authenticated.
        if( $authorized )
        {
            $redirect = '/user/profile';
            $success = true;
        }

		if( !$success && $this->request->data ) 
			if (Auth::check('default', $this->request))
            {
                $redirect = '/user/profile';
                $success = true;
            }
			else
            {
                $redirect = '/login?status=failed&op=login';
                $success = false;
            }
			
        //// Write authentication Cookie if Login successful.
        //if( $redirect && $success )
        //    Cookie::write('Credentials', 'You\'re a Dumbass');

        if( $redirect )
            return $this->redirect( $redirect );

        // Login feedback notification data.
		$notification = Notifications::parse($this->request->query);

        // Page breadcrumb link data.
		$breadcrumbs = array('path' => array('MPC', 'Login'), 'link' => array('/', '/login'));

        // Render the Login template.
		return compact('authorized', 'breadcrumbs', 'notification');
	}
}
