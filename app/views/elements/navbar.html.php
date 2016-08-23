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
use app\models\Categories;
use app\models\Users;

$games = Games::All();
$forumsByCategory = Forums::GetByCategory();

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
				<a title="Lobby" class="navbar-brand" href='/'>MPC</a>
			</li>
		</ul>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">

			<li id='navbar-community'>
				<a title="Community" href='/community'>
                    <i class="fa fa-users"></i>
                </a>
			</li><!--community-dropdown-->
			
            <li id='navbar-connect' class="dropdown">
                <a title="Connect" href='/connect' role="dropdown-toggle" role="button" style="padding-top 12px;">
                    <i class="fa fa-rss"></i> <span class='caret'></span>
                </a>
                <ul class='dropdown-menu' role='menu'>
                    <li><a href="/connect">Connections</a></li>
                    <li class='divider'></li>
                    <li id="navbar-twitch">
                        <i class="fa fa-twitch"></i>
                    </li>
                </ul>
            </li><!--connect-dropdown-->

			<li id='navbar-forum' class='dropdown'>
                <a href='/forum' class='dropdown-toggle' role='button' style="padding-top: 12px;">
                    <span class="glyphicon glyphicon-th-list"></span> <span class='caret'></span>
                </a>
                <ul class='dropdown-menu columns-3'>
                    <?php $columnsPerRow = 3; ?>
                    <?php $counterToSeparateColumns = 0; ?>
                    <?php foreach ($forumsByCategory as $cid => $category): ?>
                        <?php if ($counterToSeparateColumns % $columnsPerRow == 0): ?>
                            <div class='row'>
                        <?php endif; ?>

                        <div class="col-sm-4">

                            <h4><?= $category['name'] ?></h4>
                            <ul class="multi-column-dropdown">
                                <?php foreach ($category['forums'] as $forum): ?>
                                    <li>
                                        <a href='/board/view/<?= $forum['id'] ?>'>
                                            <?= $forum['name'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <?php if ($counterToSeparateColumns % $columnsPerRow == ($columnsPerRow - 1)): ?>
                            </div>
                        <?php endif; ?>
                        <?php $counterToSeparateColumns++; ?>
                    <?php endforeach; ?>
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
			
            <li id='navbar-streams'>
                <a title="Streams" href='/streams'>
                    <i class="fa fa-video-camera"></i>
                </a>
            </li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if ($authorized): ?>                
				<li id='navbar-user' class='dropdown'>

					<a href='/user/profile' class='dropdown-toggle' role='button'>
                        <div class="user-avatar-container" 
                            style="background-image: url('<?= Users::FindAvatarFile($authorized['id']); ?>');">
                        </div>
                        <div class="pull-right" style="padding-left: 10px">
						    <?= $authorized['alias'] ?> 
                            <span class='caret'></span>
                        </div>
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
                <li id='navbar-notifications' class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' style="padding-left:8px;padding-right:8px;">
                        <span class='badge user-notification-count'></span>
                        <span class='caret'></span>
                    </a>
                    <ul class='dropdown-menu user-notification-list' role='menu'>
                        <div class='row'></div>
                        <div class='row'></div>
                        <div class='row'></div>
                        <div class='row'>
                            <div class='col-xs-9'><div></div></div>
                            <div class='col-xs-3'></div>
                        </div>
                    </ul>
                </li>
			<?php else: ?>
				<li id='navbar-signup'>
					<a href='/signup' style="font-variant:small-caps">
                        signup
                    </a>
				</li>
				<li id='navbar-login' style="font-variant:small-caps">
					<a href='/login'>
                        login
                    </a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</nav>
<script>
//By Default
$('#navbar-twitch').hide();
</script>
