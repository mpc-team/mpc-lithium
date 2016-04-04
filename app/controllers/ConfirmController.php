<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Confirms;

class ConfirmController extends \lithium\action\Controller 
{
    /**
     * /confirm/user?confirm=
     *
     * Confirms a User's identity associated with a specific account. 
     *
     * @param string $this->request->query['confirm'] Confirm code.
     *
     * @return redirect Either to the User's profile (likely redirected to Login page)
     *                  on success or be redirected to the /signup page if there was an issue.
     */
	public function user () 
    {
		if (isset($this->request->query['confirm'])) 
        {
			$key = $this->request->query['confirm'];
			$confirm = Confirms::find( 'first', array( 'conditions' => array( 'key' => $key ) ) );
			if ($confirm) 
            {
				$user = Users::create(array(
					'email' => $confirm->email,
					'password' => $confirm->password,
					'alias' => $confirm->alias,
                    'last_logged' => date('Y-m-d H:i:s') // Old version of MySQL need this because
				));                                      // "DEFAULT CURRENT_TIMESTAMP" is limited.
				$user->save();
				$confirm->delete();
				return $this->redirect('/user/profile');
			}
		}
		return $this->redirect('/signup');
	}
}