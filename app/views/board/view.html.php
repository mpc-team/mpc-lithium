<?php

$this->title($data['forum']['name']);

$self = $this;

/**
 *	Thread editing panel within the Board pages provides user functions
 *	for controlling what they have on the Forum.
 *
 *	Currently only allows an administrator or the author of a thread
 *	to delete a thread.
 */
$features = function($tid, $options) 
{
	$html = "";
	if (count($options) > 0) 
    {
		$html = "<div class='row usertool'>";
		if (in_array('delete', $options)) 
        {
			$html .= "<form role='form' action='/thread/delete/{$tid}' method='post'>";
			$html .= "<button type='submit' class='btn btn-edit btn-icon-only btn-are-you-sure pull-right'>";
			$html .= "<i class='fa fa-trash-o'></i>";
			$html .= "</button>";
			$html .= "</form>";
		}
		$html .= "</div>";
	}
	return $html;
};

?>
<div class="row forum-header">
	<h1 style='margin-bottom: 15px;'>
        <div class='forum-context-title'><?= $data['category']['name'] ?></div>
		<div class='forum-title'><?= $data['forum']['name'] ?></div>
		<small>
			<div>Topics</div>
		</small>
	</h1>
    <?php if (in_array('create', $data['permissions'])): ?>
        <div class="row" style="padding-bottom: 15px">
            <button title="Create a new Topic" class="btn btn-default" data-toggle="modal" data-target="#modal-newthread">Create Topic</button>
        </div>
	    <div class="modal fade" id="modal-newthread" tabindex="-1" aria-labelledby="modal-newthread">
		    <div class="modal-dialog">
			    <form action="/thread/create/<?= $data['forum']['id'] ?>" method="post">
				    <div class="modal-content">
					    <div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							    &times;
						    </button>
						    <h2 class="modal-title">
							    Create New Thread
						    </h2>
					    </div>
					    <div class="modal-body">
						    <div class="form-group">
							    <input type="text" name="title" class="form-control input-title" placeholder="Title..." required/>
						    </div>
						    <div class="form-group">						
							    <div class='row'>
								    <?= $this->view()->render(
									    array('element' => 'texttags'),
									    array('id' => $data['forum']['id'], 'disabled' => '')
								    )?>
							    </div>
							    <div class='row'>
								    <textarea name="content" class="form-control edit-content-text" placeholder="Post content..." data-id="<?= $data['forum']['id'] ?>" required></textarea>
							    </div>
						    </div>
					    </div>
					    <div class="modal-footer">
						    <input type="submit" class="btn btn-edit" value="Create"/>
					    </div>
				    </div>
			    </form>
		    </div>
	    </div>
    <?php endif; ?>
	<div class="forum-thread">
		<?php if ($data['threads']): ?>
			<div>
				<div class="info">
					<div class="name">
						Topic
					</div>
				</div>
				<div class="count">
					<center>
						<div>
							Replies
						</div>
					</center>
				</div>
				<div class="recent">
					<div class="name">
						Recent Activity
					</div>
				</div>
			</div>
		<?php else: ?>
			<div style='padding-top: 30px; display: block;'>
				There are no Topics posted on this Forum Board.
			</div>	
		<?php endif; ?>
	</div>
</div>
<div class="forum-content">
    <?php foreach ($data['threads'] as $thread): ?>
	    <div class="panel-group">
		    <div class="panel panel-default">
			    <div class="row">
				    <div class="forum-thread">
					    <div>
						    <a class="btn info" href="/thread/view/<?= $thread['id'] ?>">
							    <h4>
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
							    </h4>
						    </a>
						    <div class="count" style='padding-top: 15px'>
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
						    <a class="btn recent" href="/thread/view/<?= $thread['recent']['tid'] ?>#<?= $thread['recent']['id'] ?>">
							    <h4>
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
							    </h4>
						    </a>
					    </div>
				    </div>	
			    </div>
			    <?php echo $features($thread['id'], $thread['features']); ?>
		    </div>
	    </div>
    <?php endforeach; ?>
</div>