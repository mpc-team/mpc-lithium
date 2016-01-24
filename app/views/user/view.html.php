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
	    Member since <b><?= $data['member']['date'] ?></b>
    </div>
</div>

<div class="profile-content">
    
    <hr />

	<div class="row">
		<div class="user-avatar-select">
			<center>
				<img id="user-avatar" src="<?= $avatar; ?>" />
			</center>
		</div>
	</div>

    <hr />

	<div class="row">
        <div class="col-md-4" style='padding-right: 10px'>
            <h3><small><?= $data['member']['alias'] ?>'s</small> Games</h3>

		    <?= $this->view()->render(
			    array('element' => 'user/games'),
			    array('games' => $data['games'], 'gamesClickable' => false)
		    )?>
        </div>
        <div class="col-md-8">
            <h3><small><?= $data['member']['alias'] ?>'s</small> Wall</h3>

		    <?= $this->view()->render(
			    array('element' => 'user/wall'),
			    array('member' => $data['member'], 'options' => $data['options'])
		    )?>
        </div>
	</div>

	<div class="recent">
		<div class="row">
			<h3><small><?= $data['member']['alias'] ?>'s</small> Forum Activity</h3>
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
