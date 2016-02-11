
 
var headerbar = {};

headerbar.items = {
	home: "#headerbar-home",
	community: "#headerbar-community",
	forum: "#headerbar-forum",
	games: "#headerbar-games",
	user: "#headerbar-user",
	signup: "#headerbar-signup",
	login: "#headerbar-login"
};

headerbar.enhance = function (controller, action)
{
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
					$(this.items.community).addClass('active');
				}
				break;
			case 'forum':
			case 'board':
			case 'thread':
				$(this.items.forum).addClass('active');
				break;
			case 'games':
				$(this.items.games).addClass('active');
				break;
		}
		if (controller == 'user') {
			if (action == 'profile') {	
				$(this.items.user).addClass('active');
			} else if (action == 'view') {
				$(this.items.community).addClass('active');
			}
		}
	}
};
 
$(document).ready(function () {
	var components = window.location.href.split('/');
	var controller = (components.length > 3) ? components[3] : null;
	var action = (components.length > 4) ? components[4].split('?')[0] : null;
	
	headerbar.enhance( controller, action );
});