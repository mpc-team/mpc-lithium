<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;

class HeroesOfTheStorm extends ContentController {
	public function index() {
		$this->_render['layout'] = 'games';		
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC','Games','Heroes of the Storm'),
			'link' => array('/','/games','/games/heroes_of_the_storm')
		);
		$this->set(array(
			'authorized'=>$authorized,
			'breadcrumbs'=>$breadcrumbs
		));
		$options=array();
		$options['template']='../games/heroes_of_the_storm/index';
		return $this->render($options);
	}
}