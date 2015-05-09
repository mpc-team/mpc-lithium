<?php

$this->title($page['title']);

$self = $this;

/**
 *	Thread editing panel within the Board pages provides user functions
 *	for controlling what they have on the Forum.
 *
 *	Currently only allows an administrator or the author of a thread
 *	to delete a thread.
 */
$editpanel = function($tid) {
	$button = array(
		'delete' => "<i class='fa fa-trash-o'></i> Delete"
	);
	$html = "<div class='row usertool'>";
	$html .= "<form role='form' action='/thread/delete/{$tid}' method='post'>";
	$html .= "<button type='submit' class='btn btn-edit pull-right'>";
	$html .= $button['delete'];
	$html .= "</button>";
	$html .= "</form>";
	$html .= "</div>";
	return $html;
};
?>
<div class="row forum-header">
	<h1>
		<div><?= $page['header'] ?></div>
		<small>
			<div><?= $page['subheader'] ?></div>
		</small>
	</h1>
</div>
<div class="panel-group panel-newthread">
	<div class="panel-newthread">
		<div class="panel panel-default">
			<a class="btn" data-toggle="modal" data-target="#modal-newthread">
				<span class="glyphicon glyphicon-share-alt"></span>
				Create Thread
			</a>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-newthread" tabindex="-1" role="dialog" aria-labelledby="modal-newthread" aria-hidden="true">
	<div class="modal-dialog">
		<form action="/thread/create/<?= $id ?>" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h1 class="modal-title" id="modal-label" style="color:rgb(122, 183, 51)">
						Create Thread
					</h1>
				</div>
				<div class="modal-body">
					<div class="panel panel-default">
						<div class="form-group">
							<label class="control-label" for="title">
								<h3>Title</h3>
							</label>
							<input type="text" name="title" class="form-control" placeholder="Title..." required/>
						</div>
						<div class="form-group">						
							<div class='row'>
								<label class="control-label" for="title">
									<h3>Content</h3>
								</label>
							</div>
							<div class='row'>
								<?= $this->view()->render(
									array('element' => 'texttags'),
									array('id' => $id)
								)?>
							</div>
							<div class='row'>
								<textarea name="content" class="form-control edit-content-text" placeholder="Post content..." data-id="<?= $id ?>" required></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-default" value="Create"/>
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Cancel
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php if ($threads): ?>
	<?php foreach ($threads as $thread): ?>
		<div class="panel-group">
			<div class="panel panel-default">
				<!-- Thread Content -->
				<div class="row">
					<div class="col-xs-6">
						<a class="btn" href="/thread/view/<?= $thread['id'] ?>">
							<h5>
								<div class="row pull-left">
									<?= $thread['name'] ?>
								</div>
								<br>
								<div class="row pull-left">
									<small>
										<span class="glyphicon glyphicon-user"></span> 
										<?= $thread['author'] ?>
									</small>
								</div>
								<br>
								<div class="row pull-left">
									<small>
										<span class="glyphicon glyphicon-time"></span>  
										<?= $thread['tstamp'] ?>
									</small>
								</div>
							</h5>
						</a>
					</div>
					<div class="col-xs-1">
						<h4><b><?= $thread['count'] - 1; ?></b><br><small><?= ($thread['count'] == 2) ? "reply" : "replies" ?></small></h4>
					</div>
					<div class="col-xs-5">
						<a class="btn" href="/thread/view/<?= $thread['recent']['tid'] ?>#forum-thread-message-<?= $thread['recent']['id'] ?>">
							<h5>
								<div class="row pull-right">
									Recent Post
								</div>
								<br>
								<div class="row pull-right">
									<small>
										<span class="glyphicon glyphicon-user"></span>
										<?= $thread['recent']['author'] ?>
									</small>
								</div>
								<br>
								<div class="row pull-right">
									<small>
										<span class="glyphicon glyphicon-time"></span>
										<?= $thread['recent']['tstamp'] ?>
									</small>
								</div>
							</h5>
						</a>
					</div>
				</div>
				
				<?php if ($thread['editpanel']): ?>
					<?php echo $editpanel($thread['id']) ?>
				<?php endif; ?>
				
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
