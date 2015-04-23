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
	<title>MPC &gt; <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('bootstrap', 'simple-sidebar', 'website')); ?>
	<?php echo $this->html->script(array('jquery-1.11.2', 'bootstrap', 'field-selection',	'util', 'forum-message-userpanel', 'page-scroll-on-load')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
	<?php echo $this->html->link('glyphs', "//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css", array('rel' => 'stylesheet', 'type' => 'atom')); ?>
</head>
<body>
	<div class="container-fluid">
		<?php $authorized = Auth::check('default'); ?>
		<?=$this->view()->render(
			array('element' => 'navbar'), 
			array('authorized' => $authorized)
		)?>
	</div>
	
	<div class="container">
		
		<?php echo $this->content(); ?>
		
	</div>
</body>
</html>