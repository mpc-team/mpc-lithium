<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
/**
 * Authentication is required so that we can adjust our layout depending on
 * whether a member is logged-in or not.
 *	
 * As a basic example, displaying "Login/Signup" on the navigation bar instead of
 * "Logout" can be achieved by checking the authentication information.
 */
use lithium\security\Auth;
	
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>MPC | <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('bootstrap', 'simple-sidebar', 'website', 'font-awesome')); ?>
	<?php echo $this->html->script(array('jquery-1.11.2', 'bootstrap', 'field-selection', 'util')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body>
	<div class="container-fluid">
		<?=$this->view()->render(
			array('element' => 'navbar'), 
			array(
				'authorized' => $authorized,
				'controller' => $this->_request->controller,
				'action' => $this->_request->action
			)
		)?>
	</div>
	
	<div class="container">
		
		<?php echo $this->content(); ?>
		
	</div>
</body>
</html>