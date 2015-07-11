<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
use lithium\core\ErrorHandler;
use lithium\action\Response;
use lithium\net\http\Media;
use lithium\security\Auth;

ErrorHandler::apply('lithium\action\Dispatcher::run', array(), function($info, $params) {
	$authorized = Auth::check('default');
	$response = new Response(array(
		'request' => $params['request'],
		'status' => $info['exception']->getCode()
	));
	Media::render($response, compact('info', 'params', 'authorized'), array(
		'library' => true,
		'controller' => 'errors',
		'template' => '404',
		'layout' => 'error',
		'request' => $params['request']
	));
	return $response;
});

?>