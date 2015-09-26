<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;

class LoginController extends \lithium\action\Controller {

	public function index() 
	{
		if (!($authorized = Auth::check('default'))) {
			// Notifications are used typically when redirecting the User after an
			// operation has been performed and allowing the page to display a tooltip.
			$notification = array('enabled' => false, 'text' => '');
			$breadcrumbs = array(
				'path' => array('MPC', 'Login'),
				'link' => array('/', '/login')
			);
			if ($this->request->data) {
				Auth::clear('default');
				if (Auth::check('default', $this->request)) {
					return $this->redirect('/user/profile');
				}
			}
			if (isset($this->request->query['status']) && 
					isset($this->request->query['op'])) {
				$status = $this->request->query['status'];
				$operation = $this->request->query['op'];
				if ($status == 'success') {
					switch ($operation) {
						case 'pwc':
							$notification['enabled'] = true;
							$notification['text'] = 'Your password change has been processed successfully.';
							break;
					}
				}
			}
			return compact ('authorized', 'breadcrumbs', 'notification');
		}
		return $this->redirect('/user/profile');
	}
}
