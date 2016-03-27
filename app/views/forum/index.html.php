<?php

use app\controllers\ForumController;

$this->title('Forum');

$self = $this;

?>

<div class="jumbotron">
    <h1>FORUMS</h1>
</div>

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

<div class="categories">
    <div id="category-accordion">
	    <?php foreach ($data['categories'] as $category): ?>
        <section class="offset" id="<?= $category['name'] ?>">
            <a data-toggle="collapse" data-parent="#category-accordion" href="#<?= str_replace(" ", "", $category['name']) . $category['id']; ?>">
                <div class="name" style="width: 100%;">
				    <h3 style="margin-bottom: 10px; margin-top: 10px;">
					    <span class="glyphicon glyphicon-plus"></span> <?= strtoupper($category['name']); ?> <small>FORUMS</small>
				    </h3>
                </div>
            </a>
            <div class="content">
                <div class="panel-collapse collapse" id="<?= str_replace(" ", "", $category['name']) . $category['id']; ?>">
                    <div class="row">
                        <?php if (array_key_exists('forums', $category)): ?>
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
											        <p><?= $forum['descr'] ?></p>
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
                        <?php else: ?>
                        <div class="well well-lg">There are no Forums for this section.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
	    <?php endforeach; ?>
    </div> <!-- End Accordion -->
</div> <!-- End Categories -->