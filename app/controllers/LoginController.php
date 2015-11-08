<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;
use app\models\utils\Notifications;

class LoginController extends \lithium\action\Controller 
{
	public function index() 
	{
		if (!($authorized = Auth::check('default'))) 
		{
			$breadcrumbs = array(
				'path' => array('MPC', 'Login'),
				'link' => array('/', '/login'));
			
			if ($this->request->data) 
			{
				if (Auth::check('default', $this->request))
					return $this->redirect('/user/profile');
				else
					return $this->redirect('/login?status=failed&op=login');
			}	
			
			$notification = Notifications::parse($this->request->query);
			return compact ('authorized', 'breadcrumbs', 'notification');
		}
		return $this->redirect('/user/profile');
	}
}
