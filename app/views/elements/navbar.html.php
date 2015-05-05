<?php
/**
 * Site Navbar
 * 
 * @ authorized - user that is currently authorized, associative array containing information
 * pulled from the Users model (id, email, alias)
 */

function navglyph ($icon) { 
	return "<span class='glyphicon glyphicon-{$icon}'></span> "; 
}

function navbar_link($class, $url, $icon, $text) {
	$class = ($class != null) ? " class='{$class}'" : "";
	$icon = ($icon != null) ? navglyph($icon) : "";
	
	return "<li{$class}><a href='{$url}'>{$icon} {$text}</a></li>";
}

function navbar_brand($class, $text) {
	$class = ($class != null) ? " class='{$class}'" : "";
	
	return "<li{$class}><a href='/' class='navbar-brand'>{$text}</a></li>";
}

function is_current_active($current, $controller) {
	return (strtolower($current) == strtolower($controller)) ? 'active' : '';
}

$navbar_user = function ($authenticated, $controller, $action) {
	$navcaret = "<span class='caret'></span>";
	$navdivider = "<li class='divider'></li>";
	$result = '';
	
	if ($authenticated) {
		$result .= "<li class='dropdown " . is_current_active('profile', $controller) . "'>";
		$result .= "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>";
		$result .= navglyph('user');
		$result .= "{$authenticated['email']} {$navcaret} </a>";
		$result .= "<ul class='dropdown-menu' role='menu'>";
		$result .= navbar_link(null, '/profile', null, 'Profile');
		$result .= $navdivider;
		$result .= navbar_link(null, '/logout', 'log-out', 'Logout');
		$result .= "</ul> </li>";
	} else {
		$result .= navbar_link(is_current_active('signup', $controller), '/signup', 'new-window', 'Signup');
		$result .= navbar_link(is_current_active('login', $controller), '/login', 'log-in', 'Login');
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
			<?php echo navbar_brand(is_current_active('pages', $controller), 'MPC'); ?>
		</ul>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<?php echo navbar_link(is_current_active('contact', $controller), '/contact', null, 'Contact'); ?>
			<li class="dropdown <?= is_current_active('members', $controller) ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
					<i class="fa fa-users"></i> 
					Members 
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<?php echo navbar_link(null, '/members', 'search', 'Search'); ?>
				</ul>
			</li>
			<?php echo navbar_link(is_current_active('forum', $controller), '/forum', 'th-list', 'Forum'); ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
					Gaming Room
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<?php echo navbar_link(null, '#', null, 'Gaming Room'); ?>
					<?php echo navbar_link(null, '#', null, 'Ventrilo'); ?>
					<?php echo navbar_link(null, '#', null, 'MPC Stream'); ?>
					<?php echo navbar_link(null, '#', null, 'Game Lists'); ?>
					<?php echo navbar_link(null, '#', null, 'Game Services'); ?>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">			
			<?php echo $navbar_user($authorized, $controller, $action); ?>
		</ul>
	</div>
</nav>