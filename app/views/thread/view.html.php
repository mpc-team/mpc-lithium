<?php

$this->title($data['forum']['name'] . ' | ' . $data['thread']['name']);

$self = $this;

$userpanel = function($mid, $options) {
	$html = "<div class='row usertool'>";
    $html .= "<div class='pull-right'>";
	if (in_array('edit', $options)) {
		$html .= <<<EOD
<button title="Edit Post" type='button' class='btn btn-edit btn-edit-edit btn-icon-only' data-id='{$mid}'>
	<i class='fa fa-pencil-square-o'></i>
</button>
EOD;
	}
	if (in_array('delete', $options)) {
		$html .= <<<EOD
<form role='form' action='/post/delete/{$mid}' method='post'>
	<button title="Delete Post" type='submit' class='btn btn-edit btn-edit-delete btn-icon-only btn-are-you-sure' data-id='{$mid}'>
		<i class='fa fa-trash-o'></i>
	</button>
	<input type='hidden' name='id' value='{$mid}'/>
</form>
EOD;
	}
    //$html .= "</div>";
    //$html .= "<div class='col-xs-8'>";
	if (in_array('quote', $options)) {
		$html .= <<<EOD
<button title="Quote Post in Reply" type='button' class='btn btn-edit btn-edit-quote btn-icon-only' data-id='{$mid}'>
	<i class='fa fa-quote-right'></i>
</button>
EOD;
	}
	if (in_array('edit', $options)) {
		$html .= <<<EOD
<button type='button' class='btn btn-edit btn-edit-cancel' data-id='{$mid}'>
	<i class='fa fa-times'></i>
	Cancel
</button>
<form class='edit-content-form' data-id='{$mid}' role='form' action='/post/edit/{$mid}' method='post'>
	<button type='button' class='btn btn-edit btn-edit-update' data-id='{$mid}'>
		<i class='fa fa-check-square-o'></i>
		Confirm
	</button>
	<input type='hidden' name='rename' class='edit-content-rename-hidden' data-id='{$mid}' value=''/>
	<input type='hidden' name='content' class='edit-content-hidden' data-id='{$mid}'/>
	<input type='hidden' name='id' value='{$mid}'/>
</form>
EOD;
	}
    //$html .= "</div></div></div>";
    $html .= "</div></div>";
	return $html;
};
?>

<div class="jumbotron">
	<h1>
		<div class='forum-title'><?= strtoupper($data['thread']['name']); ?></div>
        <div class='forum-context-title'>
            <?= strtolower($data['forum']['name']); ?>
        </div>
        <div class='forum-context-title' style="color: #444">
            <?= strtolower($data['category']['name']); ?> 
        </div>
	</h1>
</div>

<div class="forum-header">
    <div class="row" style="padding-bottom: 15px">
        <a href='#thread-reply'><button href='#thread-reply' class="btn btn-default">Reply to Topic</button></a>
    </div>
    <div class="row">
	    <div class="col-xs-6">
		    Created by
		    <a href="/user/view/<?= $data['thread']['author']['id'] ?>">
			    <span class="glyphicon glyphicon-user"></span>
			    <?= $data['thread']['author']['alias'] ?>
		    </a>
	    </div>
	    <div class="col-xs-6">
		    <div class="pull-right">
			    Created on <span class="glyphicon glyphicon-time"></span>
			    <?= $data['thread']['date'] ?>
		    </div>
	    </div>
    </div>
</div>

<?php if (!$data['posts']): ?>
	<h4>There are currently no Posts on this Topic</h4>
<?php endif; ?>

<div class="forum-content">
    <?php foreach ($data['posts'] as $post): ?>
	    <div class="panel-group">
		    <div class="panel panel-default">

			    <a id="<?= $post['id'] ?>" class="offset"></a>

			    <div class="row">
				    <div class="forum-post">
					    <div>
						    <div class="info">
							    <div class="avatar">
                                    <div class="user-avatar-container" 
                                        style="background-image: url('<?= $post['author']['avatar']; ?>');">
                                    </div>
							    </div>
							    <div class="author" data-id="<?= $post['id'] ?>">
								    <a href="/user/view/<?= $post['author']['id'] ?>">
									    <span class="glyphicon glyphicon-user"></span>
									    <?= $post['author']['alias'] ?>
								    </a>
							    </div>
							    <div class="since">
								    Join Date:<br>
								    <div class="time">
									    <span class="glyphicon glyphicon-time"></span>
									    <?= $post['author']['since'] ?>
								
								    </div>
							    </div>
						    </div>
						    <div class="content">
							    <div class="row header">
								    <?php $tooltip = ($post['hit']) ? 'You have already \'Hit\' this Post.' : '\'Hit\' this Post.'; ?>
								    <span class="hit" title="<?= $tooltip; ?>">
									    <?php $postDisabledProperty = ($post['hitEnabled']) ? '' : ' disabled'; ?>
									    <?php $postIsHitClass = ($post['hit']) ? 'post-hit-hit' : ''; ?>

									    <button class="btn btn-edit post-hit <?= $postIsHitClass ?>" data-id="<?= $post['id'] ?>"<?= $postDisabledProperty ?>>

										    <img src="/img/punch.png" width="20px" height="20px"/>
									    </button>
									    <span class="text">
                                            <span class="hits" data-id="<?= $post['id'] ?>"></span>
									    </span>
								    </span>
								    <span class="time">
									    <span class="glyphicon glyphicon-time"></span>
									    <?= $post['date'] ?>
								    </span>
							    </div>

							    <div class="edit-content" data-id="<?= $post['id'] ?>"><?php echo $post['content']; ?></div>

							    <div class="edit-content-toggle" data-id="<?= $post['id'] ?>">

								    <?php if (isset($post['first'])): ?>
									    <div class="row">

										    <input type="text" class="form-control edit-content-rename input-title" value="<?= $data['thread']['name'] ?>" placeholder="Edit title..." data-id="<?= $post['id'] ?>" />

									    </div>
								    <?php endif; ?>
								    <?= $this->view()->render(
									    array('element' => 'texttags'),
									    array('id' => $post['id'], 'disabled' => '')
								    )?>

								    <textarea class="form-control edit-content-text" data-id="<?= $post['id'] ?>"><?= $post['content']; ?></textarea>

							    </div>

						    </div>
					    </div>
				    </div>
			    </div>
			    <?php echo $userpanel($post['id'], $post['features']); ?>
		    </div>
	    </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        /* Process Markup On Posts */
        $('.edit-content').each(function (index)
        {
			$(this).html(markup.process($(this).text(), markup.NORMAL | markup.MARKDOWN));
        });
	});
</script>
