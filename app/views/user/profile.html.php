<?php

use app\controllers\UserController;
use app\models\utils\Notifications;

$this->title('My Profile');

$self = $this;

// Get the type of Notification that was sent, if any.
$notification_type = 'alert alert-info';
if (isset($notification['status']))
	if (array_key_exists($notification['status'], Notifications::$s_notificationStyles))
		$notification_type = Notifications::$s_notificationStyles[$notification['status']];

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

	<a id="op-avch"></a>
	
	<?php if (isset($notification['enabled']) && $notification['enabled']): ?>
		<span class="row">
			<div class="<?= $notification_type; ?>">
				<?= $notification['text']; ?>
			</div>
		</span>
	<?php endif; ?>

	<div class="row">
		<div class="user-avatar-select">
			<center>
				<div class="panel panel-default">
					<h3>Avatar</h3>
				</div>
				<img id="user-avatar" src="<?= $avatar; ?>" height="200px"/>
				
				<form action='/user/profile/edit' method='POST' enctype="multipart/form-data">
					<div>
						<div>
							<span class="file-input btn btn-primary btn-file">
								<label for="avatarfile">
									Select Image File...
								</label>
								<input type="file" name="avatarfile" id="avatarfile" accept="image/*"/>
							</span>
						</div>
						<div>
							<input type="submit" class="btn btn-edit" value="Upload"/>
						</div>
					</div>
				</form>
			</center>
			<div class='well well-sm'>
				<center>
					<h5><i class="fa fa-info-circle"></i></h5>
					Accepted image formats are <b>PNG</b>, <b>JPG</b>, and <b>JPEG</b>.
				</center>
			</div>
		</div>
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
