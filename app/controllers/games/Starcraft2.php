<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class Starcraft2 extends ContentController {

	public function index() {
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
		$options=array();
		$options['template']='../games/starcraft2/index';
		return $this->render($options);
	}
}