<?php

$this->title($page['title']);

$self = $this;

$editpanel = function($authorized, $tid) {
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

$newthread = function($authorized, $texttags, $action) {
	$id = "new-thread-message";
	$html =
<<<EOD
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
			<form action="{$action}" method="post">
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
EOD;
	$html .= $texttags($id);
	$html .=
<<<EOD
								</div>
								<div class='row'>
									<textarea name="content" class="form-control edit-content-text" placeholder="Post content..." data-id={$id} required></textarea>
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
EOD;
	return ($authorized) ? $html : "";
};

?>
<?php if ($threads): ?>
	<?php foreach ($threads as $thread): ?>
		<div class="panel-group">
			<div class="panel panel-default">
				<!-- Thread Content -->
				<div class="row">
					<div class="col-xs-6">
						<a class="btn" href="/thread/view/<?= $thread['id'] ?>">
							<h5>
								<div class="row">
									<?= $thread['name'] ?>
								</div>
								<div class="row">
									<small>
										<span class="glyphicon glyphicon-user"></span> 
										<?= $thread['author'] ?>
									</small>
								</div>
								<div class="row">
									<small>
										<span class="glyphicon glyphicon-time"></span>  
										<?= date("D, d M Y g:i:s A", strtotime($thread['tstamp'])); ?>
									</small>
								</div>
							</h5>
						</a>
					</div>
					<div class="col-xs-1">
						<h4><b><?= $thread['count'] ?></b><br><small>replies</small></h4>
					</div>
					<div class="col-xs-5">
						<a class="btn" href="/thread/view/<?= $thread['recent']['tid'] ?>">
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
										<?= date("D, d M Y g:i:s A", strtotime($thread['recent']['tstamp'])); ?>
									</small>
								</div>
							</h5>
						</a>
					</div>
				</div>
				<?php echo $editpanel($authorized, $thread['id']) ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
<?php echo $newthread($authorized, $texttags, "/thread/create/{$id}"); ?>
