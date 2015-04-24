<?php
/**
 * (Forum) Breadcrumbs
 * 
 * 	Panel at the top/bottom of Forum that displays user navigation breadcrumbs.
 *
 */
$navigation = function($path, $links) {
	$pathcount = count($path);
	$html = "";
	for ($i = 0; $i < $pathcount; $i++) {
		$div = ($i < $pathcount - 1) ? " " . navglyph('chevron-right') : "";
		$active = ($i == $pathcount - 1) ? " class='active'" : "";
		$html .= "<li{$active}>";
		$html .= "<a href='{$links[$i]}'>";
		$html .= ($i == 0) ? navglyph('th-list') : "";
		$html .= $path[$i] . $div;
		$html .= "</li>";
		$html .= "</a>";
	}
	return $html;
};

?>
<div class="navbar-forum">
	<nav role='navigation' class='navbar navbar-default navbar-static-top'>
		<ul class='nav navbar-nav'>
			<?php echo $navigation($breadcrumbs['path'], $breadcrumbs['link']); ?>
		</ul>
	</nav>
</div>
