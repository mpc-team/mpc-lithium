<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class ClashRoyaleController extends ContentController 
{
	public function index() 
	{
		$this->_render['layout'] = 'games';		
		//

                

        //
		$this->set(array(
			'authorized' => Auth::check('default'),
			'breadcrumbs' => array(
				'path' => array('MPC','Games','Clash Royale'),
				'link' => array('/','/games','/games/clash_royale')
			),
		));
	}

}