<?php

use app\controllers\ForumController;

$this->title('Forum');

$self = $this;

?>
<div class="row">
	<h3 style="margin-top:0; margin-bottom:10px">Recent Activity</h3>
</div>

<div class="row">
	<?= $this->view()->render(
		array('element' => 'recentfeed'),
		array(
			'recentfeed' => $data['recentfeed'],
			'recentlimit' => ForumController::RECENT_LIMIT
		)
	)?>
</div>

<div class="row page-header">
	<h1 style="margin-top: 20px; margin-bottom: 10px;">
		<div class="title">
			Forum 
		</div>
		<small>
			<div class="subtitle">
				Categories
			</div>
		</small>
	</h1>
</div>
<div class="categories">
	<?php foreach ($data['categories'] as $category): ?>
        <section id="<?= $category['name'] ?>">
            <?php if (array_key_exists('forums', $category)): ?>
		        <div class="row">
			        <div class="name">
				        <h3 style="margin-bottom: 10px; margin-top: 10px;">
					        <?= $category['name'] ?> <small>Forums</small>
				        </h3>
			        </div>
			        <?php foreach ($category['forums'] as $forum): ?>		
				        <div class="col-md-4">
					        <div class="panel-group">
						        <div class="panel panel-default">
							        <a class="btn btn-forum" href="/board/view/<?= $forum['id'] ?>">
							
								        <div class="panel-forum">
									        <div class="row">
										        <div class="forum">
											        <h5>
												        <?= $forum['name'] ?><br>
											        </h5>
											        <h4>
												        <small>
													        <?= $forum['descr'] ?>
												        </small>
											        </h4>
										        </div>
									        </div>
									        <div class="row">
										        <div class="count">
											        <h4>
												        <b><?= $forum['count'] ?></b>
												        <small><?= ($forum['count'] == 1) ? "thread" : "threads"; ?></small>
											        </h4>
										        </div>
									        </div>
								        </div>
								
							        </a>
						        </div>
					        </div>
				        </div>
			        <?php endforeach; ?>
		        </div>
            <?php endif; ?>
        </section>
	<?php endforeach; ?>
</div>