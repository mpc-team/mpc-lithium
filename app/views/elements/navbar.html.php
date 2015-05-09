<?php
/**
 * Site Navbar
 * 
 * @ authorized - user that is currently authorized, associative array containing information
 * pulled from the Users model (id, email, alias)
 */
function navbar_link($class, $url, $icon, $text) {
	$class = ($class != null) ? " class='{$class}'" : "";
	$icon = ($icon != null) ? "<span class='glyphicon glyphicon-{$icon}'></span> " : "";
	$html = "<li{$class}><a href='{$url}'>";
	$html .= ($icon) . " " . ($text);
	$html .= "</a></li>";
	return $html;
}

function navbar_brand($class, $text) {
	$class = ($class != null) ? " class='{$class}'" : "";
	return "<li{$class}><a href='/' class='navbar-brand'>{$text}</a></li>";
}

function is_current_active($current, $controller) {
	$result = false;
	if (is_array($current)) {
		foreach ($current as $allowed) {
			if (strtolower($allowed) == strtolower($controller)) {
				$result = true;
			}
		}
	}
	return ($result) ? 'active' : '';
}
?>
<nav role="navigation" class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-header">
		<button type="button" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<ul class="nav navbar-nav">
			<?php echo navbar_brand(is_current_active(array('pages'), $controller), 'MPC'); ?>
		</ul>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<?php echo navbar_link(is_current_active(array('contact'), $controller), '/contact', null, 'Contact'); ?>
			<?php echo navbar_link(is_current_active(array('members'), $controller), '/members', null, 'Members'); ?>
			<?php echo navbar_link(is_current_active(array('forum', 'board', 'thread'), $controller), '/forum', null, 'Forum'); ?>
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
			<?php if ($authorized): ?>
				<li class='dropdown <?= is_current_active(array('profile'), $controller) ?>'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>
						<span class='glyphicon glyphicon-user'></span>
						<?= $authorized['alias'] ?> <span class='caret'></span>
					</a>
					<ul class='dropdown-menu' role='menu'>
						<?php echo navbar_link(null, '/profile', null, 'Profile') ?>
						<li class='divider'></li>
						<?php echo navbar_link(null, '/logout', 'log-out', 'Logout') ?>
					</ul>
				</li>
			<?php else: ?>
				<?php echo navbar_link(is_current_active(array('signup'), $controller), '/signup', null, 'Signup') ?>
				<?php echo navbar_link(is_current_active(array('login'), $controller), '/login', null, 'Login') ?>
			<?php endif; ?>
		</ul>
	</div>
</nav>