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
		<div class="col-md-4">
			<div class="games">
				<div class="row">
					<h3>Games <small>You Play</small></h3>
				</div>
				<div class="row">
					<div class="well well-sm">
						<center>
							<span class="glyphicon glyphicon-info-sign"></span>
							Click Games To Select
						</center>
					</div>
				</div>
				<div class="row">
					<?php foreach ($data['games'] as $game): ?>
						<div class="col-md-6">
							<div class="game" data-id='<?= $game['id'] ?>'>
								<div class="panel panel-default">
									<button class='btn btn-edit' data-id='<?= $game['id'] ?>'>
										<div class="row">
											<div class="col-xs-6">
												<div class="icon">
													<img src="<?= $game['icon'] ?>" height='40' width='40'></img>
												</div>
												<div class="name"><?= $game['name'] ?></div>
											</div>
											<div class="col-xs-6">
												<div class="status" data-id='<?= $game['id'] ?>'>

												</div>
											</div>
										</div>
									</button>
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
				array('options' => $data['options'])
			)?>
		</div>
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
