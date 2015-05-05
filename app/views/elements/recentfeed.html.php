<?php
/**
 * Recent Feed (Forum)
 *	Displays recent posts throughout the public Forums.
 */
?>
<div class="row">
	<h3>Recent Activity</h3>
</div>
<div class="row">
	<?php foreach ($recentfeed as $recent): ?>
		<div class="col-md-4">
			<div class="panel-group">
				<div class="panel panel-default">
					<a class="btn" href="/thread/view/<?= $recent['tid'] ?>#forum-thread-message-<?= $recent['id'] ?>">
						<div class="panel-recentfeed-content">
							<div class="row">
								<h5>
									<?= $recent['thread'] ?><br>
									<small>
										<?= $recent['forum'] ?>
									</small>
								</h5>
							</div>
							<div class="row">
								<i style="font-size: 8pt">
									<?php echo $recent['content'] ?>
								</i>
							</div>
						</div>
						<div class="panel-recentfeed-footer">
							<div class="row">
								<div class="col-xs-6">
									<span class="glyphicon glyphicon-user"></span>
									<?= $recent['author'] ?>
								</div>
								<div class="col-xs-6">
									<div class="pull-right">
										<span class="glyphicon glyphicon-time"></span>
										<?= date("D, d M Y g:i:s A", strtotime($recent['tstamp'])); ?>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>