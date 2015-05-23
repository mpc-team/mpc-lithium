<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

class MessagesController extends \lithium\action\Controller {

	public static function clean ($text) {
		$text = trim($text);
		$text = str_replace('\r\n', '', $text);
		$text = str_replace('\n', '', $text);
		$text = str_replace('\r', '', $text);
		return strip_tags($text);
	}
	
}
