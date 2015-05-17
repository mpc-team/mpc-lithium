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
<?php
/**
 * Create Thread Modal Form
 *	
 *	Obviously creating a Thread is done in a "Board" or a Forum, where the thread
 *	will be created.
 */
?>
<div class="row forum-header">
	<h1>
		<div><?= $page['header'] ?></div>
		<small>
			<div><?= $page['subheader'] ?></div>
		</small>
	</h1>
</div>
<?php if (in_array('create', $permissions)): ?>
	<div class="panel panel-default">
		<div class="panel-control">
			<div class="panel-heading">
				Board Control Panel
			</div>
			<div class="row usertool">
				<button title="New Thread" class="btn btn-edit" data-toggle="modal" data-target="#modal-newthread">
					<span class="glyphicon glyphicon-file"></span> 
				</button>
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
							New Thread
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
										array('id' => $id, 'disabled' => '')
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
<?php endif; ?>
<h2>
	Board <small>topics</small>
</h2>
<?php if ($threads): ?>
	<?php foreach ($threads as $thread): ?>
		<div class="panel-group">
			<div class="panel panel-default">
			
				<!-- Thread Content -->
				<div class="row">
					<div class="forum-thread">
					
						<div>
					
							<a class="btn info" href="/thread/view/<?= $thread['id'] ?>">
								<h5>
									<div class="name">
										<?= $thread['name'] ?>
									</div>
									<div class="author">
										<small>
											<span class="glyphicon glyphicon-user"></span> 
											<?= $thread['author'] ?>
										</small>
									</div>
									<div class="time">
										<small>
											<span class="glyphicon glyphicon-time"></span>  
											<?= $thread['date'] ?>
										</small>
									</div>
								</h5>
							</a>
							<div class="count">
								<center>
									<h4>
										<div>
											<b><?= $thread['count'] - 1; ?></b>
										</div>
										<small>
											<div>
												<?= ($thread['count'] - 1 == 1) ? "reply" : "replies" ?>
											</div>
										</small>
									</h4>
								</center>
							</div>
							<a class="btn recent" href="/thread/view/<?= $thread['recent']['tid'] ?>#forum-thread-message-<?= $thread['recent']['id'] ?>">
								<h5>
									<div class="name">
										Recent Post
									</div>
									<div class="author">
										<small>
											<span class="glyphicon glyphicon-user"></span>
											<?= $thread['recent']['author'] ?>
										</small>
									</div>
									<div class="time">
										<small>
											<span class="glyphicon glyphicon-time"></span>
											<?= $thread['recent']['date'] ?>
										</small>
									</div>
								</h5>
							</a>
						
						</div>
						
					</div>	
				</div>
			
			<?php if ($thread['editpanel']): ?>
				<?php echo $editpanel($thread['id']) ?>
			<?php endif; ?>
			
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>