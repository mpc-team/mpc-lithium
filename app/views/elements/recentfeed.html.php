<?php
/**
 * Recent Feed (Forum)
 *
 *	Displays recent posts throughout the public Forums.
 *
 */
?>
<?php foreach ($recentfeed as $recent): ?>
	<div class="col-md-4">
		<div class="panel-group">
			<div class="panel panel-default">
				<a class="btn" href="/thread/view/<?= $recent['tid'] ?>#forum-thread-message-<?= $recent['id'] ?>">
					<div class="panel-recentfeed">
						<div class="row">
							<h5>
								<?= $recent['thread'] ?><br>
								<small>
									<?= $recent['forum'] ?>
								</small>
							</h5>
						</div>
						<div class="row recentfeed-content">
								<?php echo $recent['content'] ?>
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
									<?= $recent['tstamp'] ?>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<script type="text/javascript">
	$( document ).ready(function() {
		$('.recentfeed-content').each(function(index) {
			$(this).html(markup($(this).text()));
		});
	});
</script>