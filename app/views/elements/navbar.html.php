<?php
/**
 * Site Navbar
 * 
 * @ authorized - user that is currently authorized, associative array containing information
 * pulled from the Users model (id, email, alias)
 */

function navglyph ($icon) { return "<span class='glyphicon glyphicon-{$icon}'></span> "; }

function navlink($itemclass, $url, $icon, $text) {
	$itemclass = ($itemclass != null) ? " class='{$itemclass}'" : "";
	$icon = ($icon != null) ? navglyph($icon) : "";
	return "<li{$itemclass}><a href='{$url}'>{$icon} {$text}</a></li>";
}

function navbrand($itemclass, $text) {
	$itemclass = ($itemclass != null) ? " class='{$itemclass}'" : "";
	return "<li{$itemclass}><a href='/' class='navbar-brand'>{$text}</a></li>";
}

$navuserpanel = function ($authenticated) {
	$navcaret = "<span class='caret'></span>";
	$navdivider = "<li class='divider'></li>";
	$result = '';
	if ($authenticated) {
		$result .= "<li class='dropdown'>";
		$result .= "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>";
		$result .= navglyph('user');
		$result .= "{$authenticated['email']} {$navcaret} </a>";
		$result .= "<ul class='dropdown-menu' role='menu'>";
		$result .= navlink(null, '/users/profile', null, 'Account');
		$result .= $navdivider;
		$result .= navlink(null, '/users/logout', 'log-out', 'Logout');
		$result .= "</ul> </li>";
	} else {
		$result .= navlink(null, '/users/signup', 'new-window', 'Signup');
		$result .= navlink(null, '/users/login', 'log-in', 'Login');
	}
	return $result;
};
 
?>
<nav role="navigation" class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-header">
		<button type="button" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<ul class="nav navbar-nav">
			<?php echo navbrand(null, 'MPC'); ?>
		</ul>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<?php echo navlink(null, '/contact', null, 'Contact'); ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
					<i class="fa fa-users"></i> 
					Members 
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<?php echo navlink(null, '/users', 'search', 'Search'); ?>
				</ul>
			</li>
			<?php echo navlink(null, '/forum', 'th-list', 'Forum'); ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
					Gaming Room
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<?php echo navlink(null, '#', null, 'Gaming Room'); ?>
					<?php echo navlink(null, '#', null, 'Ventrilo'); ?>
					<?php echo navlink(null, '#', null, 'MPC Stream'); ?>
					<?php echo navlink(null, '#', null, 'Game Lists'); ?>
					<?php echo navlink(null, '#', null, 'Game Services'); ?>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">			
			<?php echo $navuserpanel($authorized); ?>
		</ul>
	</div>
</nav>