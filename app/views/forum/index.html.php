<?php

$this->title($page['title']);

$self = $this;

?>
<?= $this->view()->render(
	array('element' => 'recentfeed'),
	array('recentfeed' => $recentfeed)
)?>
<div class="row">
	<div class="page-header">
		<h1>
			<div>Forum</div>
			<small>
				<div>Categories</div>
			</small>
		</h1>
	</div>
</div>
<table class="table-forum-layout">
	<?php foreach ($forums as $forum): ?>
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-category">
					<!-- Forum Content -->
					<div class="row">
						<div class="col-xs-6">
							<a class="btn" href="/board/view/<?= $forum['id'] ?>">
								<div class="panel-forum">
									<h5>
										<?= $forum['name'] ?><br>
										<small><?= $forum['descr'] ?></small>
									</h5>
								</div>
							</a>
						</div>
						<div class="col-xs-1">
							<h4>
								<b><?= $forum['count'] ?></b><br>
								<small><?= ($forum['count'] == 1) ? "thread" : "threads"; ?></small>
							</h4>
						</div>
						<div class="col-xs-5">
							<!-- Empty -->
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</table>
