<?php
/**
 * Text Tags (Forum)
 *
 *	Displays list of helper functions that encapsulate selected text with formatting tags.
 *
 *	Expected values:
 *		@ id - The ID of the Post that these tags function with. Needed to associate texttags
 *			with other elements within the HTML document.
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
	array('title' => 'Video Reference', 'class' => 'video', 'icon' => 'youtube-play')
);
?>
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
<?php foreach ($helpers as $h): ?>
	<?php echo $helper($id, $h['title'], $h['class'], $h['icon'], $disabled); ?>
<?php endforeach; ?>

