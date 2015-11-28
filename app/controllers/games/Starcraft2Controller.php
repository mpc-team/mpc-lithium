<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class Starcraft2Controller extends ContentController {

	public function index() 
	{
		$this->_render['layout'] = 'games';		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC','Games','Starcraft II'),
			'link' => array('/','/games','/games/starcraft2')
		);
		
		$this->set(array(
			'authorized'=>$authorized,
			'breadcrumbs'=>$breadcrumbs
		));
		
		$cwd = getcwd();
		$path = $cwd . "/starcraft2/builds";
		$dir = scandir($path);
		$this->set(array('dir' => $dir));
	}
	
	
}