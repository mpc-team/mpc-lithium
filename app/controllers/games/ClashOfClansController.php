<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class ClashofclansController extends ContentController {

	public function index() {
		$this->_render['layout'] = 'games';		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC','Games','Clash of Clans'),
			'link' => array('/','/games','/games/clash_of_clans')
		);
		$this->set(array(
			'authorized'=>$authorized,
			'breadcrumbs'=>$breadcrumbs
		));
		// $options=array();
		// $options['template']='../games/clash_of_clans/index';
		// return $this->render($options);
	}
}