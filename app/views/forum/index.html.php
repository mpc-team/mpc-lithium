<?php

$this->title($title);

$self = $this;

?>
<table class="table-forum-layout">
	<?php foreach ($forums as $forum): ?>
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-category">
					<!-- Forum Content -->
					<div class="row">
						<div class="col-xs-6">
							<a class="btn" href="/board/view/<?= $forum['id'] ?>">
								<h5>
									<div><?= $forum['name'] ?></div>
									<small><div><?= $forum['descr'] ?></div></small>
								</h5>
							</a>
						</div>
						<div class="col-xs-1">
							<h4><b><?= $forum['count'] ?></b><br><small>threads</small></h4>
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
