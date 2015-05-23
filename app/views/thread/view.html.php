<?php

$this->title($data['thread']['name']);

$self = $this;

$userpanel = function($mid, $options) {
	$html = "<div class='row usertool'>";
	$html .= "<div class='col-xs-2'>";
	if (in_array('edit', $options)) {
		$html .= <<<EOD
<button type='button' class='btn btn-edit pull-left edit-content-btn-edit' data-id='{$mid}'>
	<i class='fa fa-pencil-square-o'></i>
	Edit
</button>
EOD;
	}
	$html .= "</div>";
	$html .= "<div class='col-xs-2'>";
	if (in_array('delete', $options)) {
		$html .= <<<EOD
<form role='form' action='/post/delete/{$mid}' method='post'>
	<button type='submit' class='btn btn-edit edit-content-btn-delete' data-id='{$mid}'>
		<i class='fa fa-trash-o'></i>
		Delete
	</button>
	<input type='hidden' name='id' value='{$mid}'/>
</form>
EOD;
	}
	$html .= "</div>";
	$html .= "<div class='col-xs-8'>";
	if (in_array('quote', $options)) {
		$html .= <<<EOD
<button type='button' class='btn btn-edit pull-right content-quote-btn' data-id='{$mid}'>
	<i class='fa fa-quote-right'></i>
	Quote
</button>
EOD;
	}
	if (in_array('edit', $options)) {
		$html .= <<<EOD
<button type='button' class='btn btn-edit pull-right edit-content-btn-cancel' data-id='{$mid}'>
	<i class='fa fa-times'></i>
	Cancel
</button>
<form class='edit-content-form' data-id='{$mid}' role='form' action='/post/edit/{$mid}' method='post'>
	<button type='button' class='btn btn-edit pull-right edit-content-btn-update' data-id='{$mid}'>
		<i class='fa fa-check-square-o'></i>
		Confirm
	</button>
	<input type='hidden' name='rename' class='edit-content-rename-hidden' data-id='{$mid}' value=''/>
	<input type='hidden' name='content' class='edit-content-hidden' data-id='{$mid}'/>
	<input type='hidden' name='id' value='{$mid}'/>
</form>
EOD;
	}
	$html .= "</div></div>";
	return $html;
};
?>
<div class="row forum-header">
	<h1>
		<div><?= $data['thread']['name'] ?></div>
		<small>
			<div><?= $data['forum']['name'] ?></div>
		</small>
	</h1>
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
<?php if (!$data['posts']): ?>
	<h4>There are currently no Posts on this Topic</h4>
<?php endif; ?>
<?php foreach ($data['posts'] as $post): ?>
	<div class="panel-group">
		<div class="panel panel-default">
			<a id="forum-thread-message-<?= $post['id'] ?>"></a>
			<div class="row">
				<div class="forum-post">
					<div>
						<div class="info">
							<div class="author">
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
							<div class="time">
								<span class="glyphicon glyphicon-time"></span>
								<?= $post['date'] ?>
							</div>
							<div class="edit-content" data-id="<?= $post['id'] ?>"><?php echo $post['content']; ?></div>
							<div class=" edit-content-toggle" data-id="<?= $post['id'] ?>">
								<?php if (isset($post['first'])): ?>
									<div class="row">
										<input type="text" class="form-control edit-content-rename" placeholder="Type here to edit title" data-id="<?= $post['id'] ?>"/>
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
<script type="text/javascript">
	$( document ).ready(function() {
		$('.edit-content').each(function(index) {
			$(this).html(markup($(this).text()));
		});
	});
</script>
