<?php

use app\controllers\ForumController;

$this->title('Forum');

$self = $this;

$ctgry_col_count = 0;

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
            <?php if ($ctgry_col_count % 2 == 0): ?>
            <div class="row">
            <?php endif; ?>
                <div class="col-md-6">
                    <section class="offset" id="<?= $category['name'] ?>">
                        <div class="panel">
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
				                        <div class="col-md-6">
					                        <div class="panel-group">
						                        <div class="panel panel-default">
							                        <a class="btn btn-forum" href="/board/view/<?= $forum['id'] ?>">
							
								                        <div class="panel-forum">
									                        <div class="row">
										                        <div class="forum">
											                        <h5><?= strtolower($forum['name']); ?></h5>
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
                                        <div class="well well-lg bordered-panel">
                                            There are no Forums for this section.
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            <?php if ($ctgry_col_count % 2 == 1): ?>
            </div>
            <?php endif; ?>
            <?php $ctgry_col_count++; ?>
	        <?php endforeach; ?>
    </div> <!-- End Accordion -->
</div> <!-- End Categories -->