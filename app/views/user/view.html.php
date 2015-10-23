<?php

use app\controllers\UserController;

$this->title($data['member']['alias'] . "'s Profile");

$self = $this;

?>
<div class="profile-header">
	<div class="page-header">
		<h1>
			<div class="title">
				<?= $data['member']['alias']; ?>
			</div>
		</h1>
	</div>
	<div class="since">
		<h4>
			Member since:
			<small>
				<?= $data['member']['date'] ?>
			</small>
		</div>
	</div>
</div>

<div class="profile-content">
	<div class="row">
		<div class="user-avatar-select">
			<center>
				<div class="panel panel-default">
					<h3>Avatar</h3>
				</div>
				<img id="user-avatar" src="<?= $avatar; ?>" height="200px"/>
				
			</center>
		</div>
	</div>
	<div class="row">
		<?= $this->view()->render(
			array('element' => 'user/games'),
			array(
				'games' => $data['games'],
				'text' => 'This User Plays',
				'profile' => false
			)
		)?>
	</div>
	<div class="row">
		<?= $this->view()->render(
			array('element' => 'user/wall'),
			array('member' => $data['member'], 'options' => $data['options'])
		)?>
	</div>
	<div class="recent">
		<div class="row">
			<h3>Recent Posts <small>On Forum</small></h3>
		</div>
		<div class="row">
			<?= $this->view()->render(
				array('element' => 'recentfeed'),
				array(
					'recentfeed' => $data['recentfeed'],
					'recentlimit' => UserController::RECENT_LIMIT
				)
			)?>
		</div>
	</div>
</div>
<div class="profile-footer">
	<div class="page-footer">
		<!-- Empty-->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		profile.init(<?= $data['member']['id'] ?>, <?php echo $data['played'] ?>);
	});
</script>
