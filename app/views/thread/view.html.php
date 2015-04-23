<?php

$this->title($title);

$self = $this;

$editpanel = function($authorized, $mid) {
	$html = 
<<<EOD
	<div class='row usertool'>
		<div class='col-xs-2'>
			<button type='button' class='btn btn-edit pull-left edit-content-btn-edit' data-id='{$mid}'>
				<i class='fa fa-pencil-square-o'></i>
				Edit
			</button>
		</div>
		<div class='col-xs-2'>
			<form role='form' action='/post/delete/{$mid}' method='post'>
				<button type='submit' class='btn btn-edit edit-content-btn-delete' data-id='{$mid}'>
					<i class='fa fa-trash-o'></i>
					Delete
				</button>
				<input type='hidden' name='id' value='{$mid}'/>
			</form>
		</div>
		<div class='col-xs-8'>
			<button type='button' class='btn btn-edit pull-right content-quote-btn' data-id='{$mid}'>
				<i class='fa fa-quote-right'></i>
				Quote
			</button>
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
				<input type='hidden' name='message' class='edit-content-hidden' data-id='{$mid}'/>
				<input type='hidden' name='id' value='{$mid}'/>
			</form>
		</div>
	</div>
EOD;
	return ($authorized) ? $html : "";
};

$texttags = function($id) {
	$helper = function ($id, $title, $class, $icon) {
		$result = "<button title='{$title}' type='button' class='btn btn-edit edit-tag-{$class}' data-id='{$id}'>";
		$result .= "<i class='fa fa-{$icon}'></i>";
		$result .= "</button>";
		return $result;
	};
	$helpers = array(
		array('title' => 'Bold',             'class' => 'bold',        'icon' => 'bold'),
		array('title' => 'Italic',           'class' => 'italic',      'icon' => 'italic'),
		array('title' => 'Underline',        'class' => 'underline',   'icon' => 'underline'),
		array('title' => 'Strikethrough',    'class' => 'strike',      'icon' => 'strikethrough'),
		array('title' => 'Subscript',        'class' => 'subscript',   'icon' => 'subscript'),
		array('title' => 'Superscript',      'class' => 'superscript', 'icon' => 'superscript'),
		array('title' => 'List',             'class' => 'ulist',       'icon' => 'list-ul'),
		array('title' => 'List Item',        'class' => 'ulist-item',  'icon' => 'asterisk'),
		array('title' => 'Paragraph',        'class' => 'paragraph',   'icon' => 'paragraph'),
		array('title' => 'Center Alignment', 'class' => 'center',      'icon' => 'align-center'),
		array('title' => 'Internet Link',    'class' => 'link',        'icon' => 'link'),
		array('title' => 'Image Reference',  'class' => 'image',       'icon' => 'picture-o')
	);
	$html = "<span class='dropdown'>";
	$html .=
<<<EOD
		<button type='button' class='btn btn-edit dropdown-toggle' data-toggle='dropdown'>
			<i class='fa fa-header'></i>
		</button>
		<ul class='dropdown-menu' role='menu'>
			<li>
				<button type='button' class='btn btn-edit edit-tag-header1' data-id='{$id}'>
					<h1>Heading 1</h1>
				</button>
			</li>
			<li>
				<button type='button' class='btn btn-edit edit-tag-header2' data-id='{$id}'>
					<h2>Heading 2</h2>
				</button>
			</li>
			<li>
				<button type='button' class='btn btn-edit edit-tag-header3' data-id='{$id}'>
					<h3>Heading 3</h3>
				</button>
			</li>
		</ul>
EOD;
	$html .= "</span>";
	foreach ($helpers as $h):
		$html .= $helper($id, $h['title'], $h['class'], $h['icon']);
	endforeach;
	return $html;
};
?>
<?php if ($messages): ?>
	<?php foreach ($messages as $post): ?>
		<div class="panel-group">
			<div class="panel panel-default">
				<a id="forum-thread-message-<?= $post['id'] ?>"></a>
				<div class="panel-messages">
					<div class="panel-messages-header">
						<div class="row">
							<div class="col-xs-6">
								<span class="glyphicon glyphicon-user"></span>
								<?= $post['author'] ?>
							</div>
							<div class="col-xs-6">
								<div class="row pull-right">
									<span class="glyphicon glyphicon-time"></span>
									<?= date("D, d M Y g:i:s A", strtotime($post['tstamp'])); ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="content-message edit-content" data-id="<?= $post['id'] ?>">
								<?php echo $post['content']; ?>
							</div>
							<div class="content-message edit-content-toggle" data-id="<?= $post['id'] ?>">
								<?php if (isset($post['first'])): ?>
									<div class="row">
										<input type="text" class="form-control edit-content-rename" placeholder="Type here to edit title" data-id="<?= $post['id'] ?>"/>
									</div>
								<?php endif; ?>
								<div class="row">
									<?php echo $texttags($post['id']); ?>
								</div>
								<div class="row">
									<textarea class="form-control editmessage edit-content-text" data-id="<?= $post['id'] ?>">
										<?= $post['content']; ?>
									</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo $editpanel($authorized, $post['id']); ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
