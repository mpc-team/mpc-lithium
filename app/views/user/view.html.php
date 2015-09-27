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
		<div class="col-md-4">
			<div class="games">
				<div class="row">
					<h3>Games <small>This User Plays</small></h3>
				</div>
				<div class="row">
					<?php foreach ($data['games'] as $game): ?>
						<div class="col-md-6">
							<div class="game" data-id='<?= $game['id'] ?>'>
								<div class="panel panel-default">
									<div class="row">
										<div class="col-xs-6">
											<div class="icon">
												<img src="<?= $game['icon'] ?>" height='40' width='40'></img>
											</div>
											<div class="name"><?= $game['name'] ?></div>
										</div>
										<div class="col-xs-6">
											<div class="status" data-id='<?= $game['id'] ?>'>
												<!-- Content Modified by JavaScript -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<?= $this->view()->render(
				array('element' => 'wall'),
				array('member' => $data['member'], 'options' => $data['options'])
			)?>
		</div>
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
