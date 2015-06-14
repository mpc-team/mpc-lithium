<?php
/**
 * texttags
 *
 * Helpers at the top of Forum post inputs that insert markup into the post.
 * This element displays these to the User, but the events and processing are
 * handled in "forum.js" on the Client-side.
 */
$helper = function ($id, $title, $class, $icon, $disabled) {
	$result = "<button title='{$title}' type='button' class='btn btn-edit edit-tag-{$class} {$disabled}' data-id='{$id}'>";
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
	array('title' => 'Image Reference',  'class' => 'image',       'icon' => 'picture-o'),
	array('title' => 'Video Reference',  'class' => 'video',       'icon' => 'youtube-play')
);
?>
<div class="texttags">
	<span class='dropdown'>
		<button type='button' class='btn btn-edit dropdown-toggle <?= $disabled ?>' data-toggle='dropdown'>
			<i class='fa fa-header'></i>
		</button>
		<ul class='dropdown-menu' role='menu'>
			<li>
				<button type='button' class='btn btn-edit edit-tag-header1' data-id='<?= $id ?>'>
					<h1>Heading 1</h1>
				</button>
			</li>
			<li>
				<button type='button' class='btn btn-edit edit-tag-header2' data-id='<?= $id ?>'>
					<h2>Heading 2</h2>
				</button>
			</li>
			<li>
				<button type='button' class='btn btn-edit edit-tag-header3' data-id='<?= $id ?>'>
					<h3>Heading 3</h3>
				</button>
			</li>
		</ul>
	</span>
	<?php foreach ($helpers as $tag): ?>
		<?php echo $helper($id, $tag['title'], $tag['class'], $tag['icon'], $disabled); ?>
	<?php endforeach; ?>
</div>

