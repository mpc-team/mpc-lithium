<?php

$this->title($page['title']);

$self = $this;

$category = null;

?>
<div class="row">
	<h3>Recent Activity</h3>
</div>
<div class="row">
	<?= $this->view()->render(
		array('element' => 'recentfeed'),
		array('recentfeed' => $recentfeed)
	)?>
</div>
<div class="row page-header">
	<h1>
		<div>Forum </div>
		<small><div>Categories</div></small>
	</h1>
</div>
<?php foreach ($categories as $category): ?>
	<h3><?= $category['name'] ?></h3>
		
	<?php foreach ($category['forums'] as $forum): ?>		
	<div class="row">
		<div class="panel-group">
			<div class="panel panel-default">
				<a class="btn" href="/board/view/<?= $forum['id'] ?>">
					<div class="panel-forum">
						<h5>
							<?= $forum['name'] ?><br>
							<small><?= $forum['descr'] ?></small><br>
						</h5>
						<h4>
							<b><?= $forum['count'] ?></b>
							<small><?= ($forum['count'] == 1) ? "thread" : "threads"; ?></small>
						</h4>
					</div>
				</a>
			</div>
		</div>
	</div>
	<?php endforeach; ?>

<?php endforeach; ?>