<?php
/**
 * Recent Feed (Forum)
 *
 *	Displays recent posts throughout the public Forums.
 *
 */
	use app\controllers\ForumController;
 
	$recentPage = 0;
	$recentPerPage = 3;
	$recentCounter = 0;
	$recentLimit = $recentlimit;
	$recentPages = $recentLimit / $recentPerPage;
?>

<div class="recentfeed">
	<?php if (count($recentfeed) > 0): ?>
		<div id="recentfeed-carousel" class="carousel slide" data-ride="carousel" data-interval="false">
			<ol class="carousel-indicators">
				<?php for ($i = 0; $i < $recentPages; $i++): ?>
				<li data-target="#recentfeed-carousel" data-slide-to="<?= $i ?>" 
					<?php if ($i == 0): ?>
						class="active"
					<?php endif; ?>
				></li>
				<?php endfor; ?>
			</ol>
			<div class="carousel-inner" role="listbox">
				<?php foreach ($recentfeed as $recent): ?>
				
					<?php if ($recentCounter == 0): ?>
						<div class="item active">
					<?php elseif ($recentCounter % $recentPerPage == 0): ?>
						<div class="item">
					<?php endif; ?>
					
						<div class="col-md-4">
							<div class="panel-group">
								<div class="panel panel-default hvr-grow">
									<a class="btn" href="/thread/view/<?= $recent['tid'] ?>#<?= $recent['id'] ?>">
										<div class="panel-recentfeed">
											<div class="row">
												<h4>
													<div class="name">
														<?= $recent['thread'] ?>
													</div>
													<small>
														<div class="forum">
															<?= $recent['forum'] ?>
														</div>
													</small>
												</h4>
											</div>
											<div class="forum-post">
												<div class="content">
													<div class="row recentfeed-content"><?php echo $recent['content'] ?></div>
												</div>
											</div>
										</div>
										<div class="panel-recentfeed-footer">
											<div class="author">
												<span class="glyphicon glyphicon-user"></span>
												<?= $recent['author'] ?>
											</div>
											<div class="time">
												<span class="glyphicon glyphicon-time"></span>
												<?= $recent['date'] ?>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
					
					<?php if ($recentCounter % $recentPerPage == ($recentPerPage - 1)): ?>
						</div>	
					<?php endif; ?>
					
					<?php $recentCounter += 1; ?>
				<?php endforeach; ?>
			</div>
			
			<a class="left carousel-control" href="#recentfeed-carousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#recentfeed-carousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	<script type="text/javascript">
        $(document).ready(function ()
        {
            $('.recentfeed-content').each(function (index)
            {
				$(this).html(markup.process($(this).text(), markup.PREVIEW));
            });

            $('.carousel-control').click(function ()
            {
                $(this).blur();
            });
		});
	</script>
	<?php else: ?>	
		<div>
			There are no recent topics to display.
		</div>	
	<?php endif; ?>
</div>