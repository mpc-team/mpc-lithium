<?php

use app\controllers\ForumController;

$this->title('Forum');

$self = $this;

$ctgry_col_count = 0;

?>

<div class="jumbotron">
    <h1>FORUMS</h1>
</div>

<div class="page-icon pull-right">
    <i style="transform: rotate(13deg);" class="fa fa-list-alt"></i>
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
                <?php if (array_key_exists('forums', $category)): ?>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php $ctgry_col_count++; ?>
                <?php endif; ?>
            <?php if ($ctgry_col_count % 2 == 0): ?>
            </div>
            <?php endif; ?>
	        <?php endforeach; ?>
    </div> <!-- End Accordion -->
</div> <!-- End Categories -->