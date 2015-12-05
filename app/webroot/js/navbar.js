/**
 * navbar.js
 *
 * JQuery adds the 'active' class to the appropriate navbar list-item. In turn applies the CSS style
 * that causes highlighting and other visual enhancers.
 *
 * requires jquery.
 */
 
var navbar = {};

/**
 * navbar.items
 *
 * HTML elements IDs that identify the appropriate elements to modify within the template. These
 * are used to select and modify elements via JQuery.
 */
navbar.items = {		
	home: "#navbar-home",
	members: "#navbar-members",
	forum: "#navbar-forum",
	user: "#navbar-user",
	signup: "#navbar-signup",
	login: "#navbar-login"
};

/**
 * navbar.enhance
 *
 * Processes a controller/action pair and adds the appropriate classes to the appropriate element.
 */
navbar.enhance = function (controller, action) {	
	if (action == null) {
		if (controller == null || controller.length == 0) {
			$(this.items.home).addClass('active');
		} else {
			$(this.items[controller]).addClass('active');
		}
	} else {
		switch (controller) {
			case 'user':
				if (action == 'profile') {
					$(this.items.user).addClass('active');
				} else if (action == 'resetpassword') {
					$(this.items.login).addClass('active');
				} else {
					$(this.items.members).addClass('active');
				}
				break;
			case 'forum':
			case 'board':
			case 'thread':
				$(this.items.forum).addClass('active');
		}
		if (controller == 'user') {
			if (action == 'profile') {	
				$(this.items.user).addClass('active');
			} else if (action == 'view') {
				$(this.items.members).addClass('active');
			}
		}
	}
};
 
$(document).ready(function () {
	var components = window.location.href.split('/');
	var controller = (components.length > 3) ? components[3] : null;
	var action     = (components.length > 4) ? components[4].split('?')[0] : null;
	
	navbar.enhance( controller, action );
});