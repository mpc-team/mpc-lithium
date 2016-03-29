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
        <div class="jumbotron">
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
        <div class="page-icon pull-right">
            <i style="transform:rotate(13deg);" class="fa fa-cogs"></i>
        </div>
	</div>
	<div class="since">
		Member since <b><?= $authorized['date'] ?></b>
	</div>
</div>

<div class="profile-content">


    <!--<div class="row">
        <h3>Notifications</h3>
        <div class="profile-notifications">
            
        </div>
    </div>-->

    <hr />

	<a id="op-avch"></a>

	<?php if (isset($notification['enabled']) && $notification['enabled']): ?>
		<span class="row">
			<div class="<?= $notification_type; ?>">
				<?= $notification['text']; ?>
			</div>
		</span>
    <?php endif; ?>

	<div class="row">

        <!-- User Clan -->
        <div class="col-md-4">
            <div class="row">
                <h2><small>CLAN</small></h2>
                <h1 id='user-profile-clan' style='margin-top: -10px'>None</h1>
                <button id="clan-leave" style="display: none" class="btn btn-default btn-are-you-sure" data-message="Are you sure you want to leave your Clan?">Leave Clan</button>
            </div>
        </div>

        <!-- User Avatar -->
        <div class="col-md-8">
		    <div class="user-avatar-select pull-left">
                <div class="fs-container" data-id="1">
                    <button class="btn btn-edit fs-btn-modify" data-id="1">
                        <div class="user-avatar-container" 
                            style="background-image: url('<?= $avatar ?>');">
                        </div>
                        <div class="info">
                            Click to Change Avatar Image
                        </div>
                    </button>

                    <div class="modal fade fs-conf-modal" data-id="1" role="dialog">
                        <div class="modal-dialog dialog-transparent">
                            <div class="modal-content">
                                <div class="pending" data-id="1">
                                    <center>
                                        <h1>
                                            Select Avatar Image
                                        </h1>
                                        <h3>
                                            Click to Cancel
                                        </h3>
                                    </center>
                                </div>
                                <div class="selected" data-id="1">
                                    <center>
                                        <h1 style='padding-bottom: 20px'>
                                            Avatar Selected
                                        </h1>
                                        <div class="user-avatar-container fs-img-preview" data-id="1">
                                            <!--<img class="fs-img-preview" src="" data-id="1" />-->
                                        </div>
                                        <div>
                                            <button class="btn btn-edit fs-btn-confirm" data-id="1">
                                                <b>Confirm Change</b>
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-edit fs-btn-modify" data-id="1">
                                                <b>Select Different Image</b>
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-edit fs-btn-cancel" data-id="1">
                                                <b>Cancel</b>
                                            </button>
                                        </div>
                                    </center>
                                </div>
                                <div class="error" data-id="1">
                                    <center>
                                        <h1>
                                            Unsupported Image Format
                                        </h1>
                                        <h3 style='padding-bottom: 20px'>Supported Image Formats include <i>.PNG</i>, <i>.JPG</i>, and <i>.GIF</i></h3>
                                        <div>
                                            <button class="btn btn-edit fs-btn-modify" data-id="1">
                                                <b>Select Different Image</b>
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-edit fs-btn-cancel" data-id="1">
                                                <b>Cancel</b>
                                            </button>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			    <div class='well well-sm'>
                    <center>
				        <i class="fa fa-info-circle"></i>
				        Supported formats are <b>PNG</b>, <b>JPG</b>, and <b>JPEG</b>.
                    </center>
			    </div>
		    </div>
        </div>
	</div>
	
    <hr />

	<div class="row">
        <div class="col-md-4" style='padding-right: 10px'>
            <h3><small>Your</small> Games</h3>

		    <?= $this->view()->render(
			    array('element' => 'user/games'),
			    array('games' => $data['games'], 'gamesClickable' => true)
		    )?>
        </div>

        <div class="col-md-8">
            <h3><small>Your</small> Wall</h3>

		    <?= $this->view()->render(
			    array('element' => 'user/wall'),
			    array('options' => $data['options'])
		    )?>
        </div>
	</div>
	
	<div class="recent" style="padding-bottom: 50px">
		<div class="row">
			<h3 style="margin-bottom: 10px; margin-top: 10px;">
                <small>Your</small> Forum Activity
            </h3>
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
