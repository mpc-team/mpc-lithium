<?php
/**
 * navbar.html
 *
 * Top navbar template with all HTML elements defined. JQuery and CSS are used to actively style
 * components on the client-side rather than performing processing on the server.
 */
?>
<nav role="navigation" class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-header">
		<button type="button" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<ul class="nav navbar-nav">
			<li id='navbar-home'>
				<a href='/' class='navbar-brand'>MPC</a>
			</li>
		</ul>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li id='navbar-members'>
				<a href='/members'>Members</a>
			</li>
			<li id='navbar-forum'>
				<a href='/forum'>Forum</a>
			</li>
			<li id='navbar-games' class='dropdown'>
				<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>
					Games <span class='caret'></span>
				</a>
				<ul class='dropdown-menu' role='menu'>
					<li>
						<a href='/games'>All Games</a>
					</li>
					<li class='divider'></li>
					<li>
						<a href='/games/heroes'>Heroes of the Storm</a>
					</li>
					<li>
						<a href='/games/sc2'>StarCraft II</a>
					</li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if ($authorized): ?>
				<li id='navbar-user' class='dropdown'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>
						<span class='glyphicon glyphicon-user'></span>
						<?= $authorized['alias'] ?> <span class='caret'></span>
					</a>
					<ul class='dropdown-menu' role='menu'>
						<li>
							<a href='/user/profile'>Profile</a>
						</li>
						<li class='divider'></li>
						<li>
							<a href='/logout'>
								<span class='glyphicon glyphicon-log-out'></span>
								Logout
							</a>
						</li>
					</ul>
				</li>
			<?php else: ?>
				<li id='navbar-signup'>
					<a href='/signup'>Signup</a>
				</li>
				<li id='navbar-login'>
					<a href='/login'>Login</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</nav>
