<?php
/**
 * Breadcrumbs
 * 
 * Link > Link > ... > Link
 *
 * This is the format of the breadcrumb navigation.
 */
 
$navigation = function($path, $links) {
	$pathcount = count($path);
	$html = "";
	for ($i = 0; $i < $pathcount; $i++) {
		$active = ($i == $pathcount - 1) ? " class='active'" : "";
		$html .= "<li{$active}>";
		$html .= "<a href='" . $links[$i] . "'>";
		$html .= "<div class='breadcrumb-text'>";
		$html .= stripslashes($path[$i]);
		$html .= "</div>";
		$html .= "</li>";
		$html .= "</a>";
	}
	return $html;
};

?>
<nav role='navigation' class='navbar navbar-default navbar-static-top'>
	<ul class='breadcrumb'>
		<?php echo $navigation($breadcrumbs['path'], $breadcrumbs['link']); ?>
	</ul>
</nav>
