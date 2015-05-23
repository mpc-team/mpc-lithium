/**
 * scroller.js
 *
 * Scrolls to a particular element with slightly more control than simply 
 */
var scroller = {};

scroller.anchor = "#autoscroll";

$(document).ready(function() { 
	var hashsplit = window.location.hash.split("-");
	if(hashsplit.length == 4) {
		if(hashsplit[0] == '#forum' && hashsplit[1] == 'thread' && hashsplit[2] == 'message') {
			var _this = $(window.location.hash);
			window.location.hash = scroller.anchor;
			$(window).scrollTop(_this.offset().top - 80);
		} 
	}
});