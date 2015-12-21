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

    <div class="row thread-subscriptions">
        
    </div>

	<div class="row">
		<div class="user-avatar-select">
			<center>
				<div class="panel panel-default">
					<h3>
                        Avatar
                    </h3>
				</div>

                <div class="fs-container" data-id="1">
                    <button class="btn btn-edit fs-btn-modify" data-id="1">
                        <img id="user-avatar" src="<?= $avatar; ?>" height="200px" />
                        <div class="info">
                            Click to Change Avatar Image
                        </div>
                    </button>

                    <div class="modal fade fs-conf-modal" data-id="1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="pending" data-id="1">
                                    <div>
                                        <h3>
                                            Select a new avatar image from your computer
                                        </h3>
                                    </div>
                                    <div>
                                        <h3>
                                            <small>Click to Cancel</small>
                                        </h3>
                                    </div>
                                </div>
                                <div class="selected" data-id="1">
                                    <center>
                                        <h3>
                                            You are about to change your avatar to
                                        </h3>
                                        <img class="fs-img-preview" src="" data-id="1" />
                                        <div>
                                            <button class="btn btn-edit fs-btn-confirm" data-id="1">
                                                Confirm Change
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-edit fs-btn-modify" data-id="1">
                                                Select Different Image
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-edit fs-btn-cancel" data-id="1">
                                                Cancel
                                            </button>
                                        </div>
                                    </center>
                                </div>
                                <div class="error" data-id="1">
                                    <h3>
                                        Your avatar must be a supported image type
                                    </h3>
                                    <div>
                                        <ul>
                                            <h3>
                                                <small>*.PNG</small><br />
                                                <small>*.JPG</small><br />
                                                <small>*.GIF</small><br />
                                            </h3>
                                        </ul>
                                    </div>
                                    <div>
                                        <button class="btn btn-edit fs-btn-modify" data-id="1">
                                            Select Different Image
                                        </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-edit fs-btn-cancel" data-id="1">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

			</center>
			<div class='well well-sm'>
				<center>
					<h5><i class="fa fa-info-circle"></i></h5>
					Accepted image formats are <b>PNG</b>, <b>JPG</b>, and <b>JPEG</b>.
				</center>
			</div>
		</div>
	</div>
	
    <hr />

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
	
    <hr />

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
    $(document).ready(function() 
    {
	    profile.init(<?= $authorized['id'] ?>, <?php echo $data['played'] ?>);
    });
</script>
