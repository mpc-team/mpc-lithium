<?php

use app\controllers\UserController;

$this->title('My Profile');

$self = $this;

?>
<div class="profile-header">
	<div class="page-header">
		<h1>
			<div class="title">
				<?= $authorized['alias']; ?>
			</div>
			<small>
				<div class="subtitle">
					<?= $authorized['email']; ?>
				</div>
			</small>
		</h1>
	</div>
	<div class="since">
		<h4>
			Member since: <small><?= $authorized['date'] ?></small>
		</div>
	</div>
</div>

<div class="profile-content">
	<div class="row">
		<h3>Avatar</h3>
		<div class="row">
			
		</div>
		<form action='' method='POST'>
			<input type="file" name="file" id="avatar-file"/>
			<input type="submit" class="btn btn-edit" value="Upload"/>
		</form>
	</div>
	<div class="row">
		<?= $this->view()->render(
			array('element' => 'user/games'),
			array(
				'games' => $data['games'],
				'text' => 'You Play',
				'profile' => true
			)
		)?>
	</div>
	<div class="row">
		<?= $this->view()->render(
			array('element' => 'user/wall'),
			array('options' => $data['options'])
		)?>
	</div>
	<div class="recent">
		<div class="row">
			<h3>Recent<small> Posts On Forum</small></h3>
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
		profile.init(<?= $authorized['id'] ?>, <?php echo $data['played'] ?>);
	});
</script>
