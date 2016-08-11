var background = {};

background.map = {
	//'default': '/img/darksky_background.jpg',
	'default': '/img/metalscratches_background.jpg',
	'games': {
	    'clash_of_clans': '/img/clash_of_clans/background.png',
	    'starcraft2': '/img/sc2/background.png',
	    'heroes_of_the_storm': '/img/hots/background.jpg',
        'clash_royale': '/img/clash_royale/background.png',
	},
};

background.change = function (uri)
{
	$('html').css('background-image', 'url("' + uri + '")');
}

background.init = function ()
{
	var uri = window.location.href;
	if (uri == null || uri.split('/').length < 5)
	{
		background.change(background.map['default']);
		return;
	}
	var components = uri.split('/');

	var controller = components[3];
	var action = components[4].split('?')[0].split('#')[0];

	var bg = background.map['default'];
	if (controller in background.map && action in background.map[controller])
	{
		bg = background.map[controller][action];
	}
	background.change(bg);
}

background.init();

