<?php
/**
 * Reply Form (Forum)
 *
 */

$texttags = function($id, $disabled) {
	$helper = function ($id, $title, $class, $icon, $disabled) {
		$result = "<button title='{$title}' type='button' class='btn btn-edit edit-tag-{$class}' data-id='{$id}' {$disabled}>";
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
		<button type='button' class='btn btn-edit dropdown-toggle' data-toggle='dropdown' {$disabled}>
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
	foreach ($helpers as $h) {
		$html .= $helper($id, $h['title'], $h['class'], $h['icon'], $disabled);
	}
	return $html;
};

$disabled = !$replyform['enabled'] ? 'disabled' : '';
$disabled_placeholder = 'Please Login or Signup before posting on the Forum';
$placeholder = $replyform['enabled'] ? 'Enter a message...' : $disabled_placeholder;
 
?>
<a id='reply-to-thread'></a>
<div class="panel panel-default">
	<div class="page-header">
		<h3>Reply to thread</h3>
	</div>
	<div class="panel-reply">
		<form role='form' class='form-horizontal' action='/post/create/<?= $replyform['id'] ?>' method='post'>
			<div class="form-group">
				<?php if ($replyform['enabled']): ?>
					<div class="row">
						<h4>
							&nbsp <span class="glyphicon glyphicon-user"></span> 
							<?= $replyform['user']['alias'] ?>
						</h4>
					</div>
				<?php endif; ?>
				<div class='row'>
						<?php echo $texttags($replyform['id'], $replyform['enabled'] ? '' : 'disabled'); ?>
				</div>
				<div class="row">
					<div class="input-group">
						<textarea name="content" id='input-reply-text' class="form-control edit-content-text" 
							data-id='<?= $replyform['id'] ?>' placeholder='<?= $placeholder ?>'
							required <?= $disabled ?>></textarea>
					</div>
				</div>
				<div class="row btn-reply-row">
					<div class="input-group">
						<button title="Submit Reply" type="submit" class="btn btn-reply" <?= $disabled ?>>
							<span class="glyphicon glyphicon-send"></span>
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>