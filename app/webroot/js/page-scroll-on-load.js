var NON_USED_ANCHOR_OVERRIDE = "#autoscroll";

function scrollToSectionOnLoad() {
	var hashsplit = window.location.hash.split("-");
	if(hashsplit.length == 4) {
		if(hashsplit[0] == '#forum' && hashsplit[1] == 'thread' && hashsplit[2] == 'message') {
			var $this = $(window.location.hash);
			window.location.hash=NON_USED_ANCHOR_OVERRIDE;
			$(window).scrollTop($this.offset().top - 120);
		}
	}
}

$(document).ready(function() { scrollToSectionOnLoad(); });