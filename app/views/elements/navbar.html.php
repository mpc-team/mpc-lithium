<?php
/**
 * navbar.html
 *
 * Top navbar template with all HTML elements defined. JQuery and CSS are used to actively style
 * components on the client-side rather than performing processing on the server.
 *
 */

use app\models\Games;
use app\models\Forums;

$games = Games::getList();
$forums = Forums::GetList();

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
				<a title="Lobby" href='/'>MPC</a>
			</li>
		</ul>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">

			<li id='navbar-members'>
				<a title="Members" href='/members'>
                    <i class="fa fa-users"></i>
                </a>
			</li>
			
			<li id='navbar-forum' class='dropdown'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>
                    <span class="glyphicon glyphicon-th-list"></span> <span class='caret'></span>
                </a>
                <ul class='dropdown-menu' role='menu'>
                    <li>
                        <a title="Forum" href='/forum'>MPC Forums</a>
                    </li>
                    <li class='divider'></li>
                    <?php foreach ($forums as $forum): ?>
                        <li>
                            <a href='/board/view/<?= $forum['id'] ?>'>
                                <?= $forum['name'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>

                    <li>
                        <a title="General Forum" href='/forum/board/view/6'>General</a>
                    </li>
                    <li>
                        <a title="StarCraft II Forum" href='/forum/board/view/6'>StarCraft II</a>
                    </li>
                </ul>
			</li>
			
			<li id='navbar-games' class='dropdown'>
				<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>
					<i class="fa fa-gamepad"></i> <span class='caret'></span>
				</a>
				<ul class='dropdown-menu' role='menu'>
					<li>
						<a href='/games'>All Games</a>
					</li>
					
					<li class='divider'></li>
					
					<?php foreach($games as $game): ?>
						<li>
							<a href='/games/<?= $game['realname']; ?>'>
								<span class="icon">
									<img src="<?= $game['icon']; ?>"></img>
								</span>
								<?= $game['name']; ?>
							</a>
						</li>
					<?php endforeach; ?>
						
				</ul>
			</li>
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if ($authorized): ?>
				<li id='navbar-user' class='dropdown'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>
                        <span class='badge badge-usr-notify'></span>
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
