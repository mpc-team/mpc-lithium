<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class WorldOfWarcraft extends ContentController {

	public function index() {
		$this->_render['layout'] = 'games';		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC','Games','World of Warcraft'),
			'link' => array('/','/games','/games/world_of_warcraft')
		);
		$this->set(array(
			'authorized'=>$authorized,
			'breadcrumbs'=>$breadcrumbs
		));
		$options=array();
		$options['template']='../games/world_of_warcraft/index';
		return $this->render($options);
	}
}