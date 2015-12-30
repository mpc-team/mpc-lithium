/***
 *
 *	User Authentication with REST API.
 * 
 *	Provides functions to wrap the hosted REST API.
 *
 ***************************************************************************/

user.auth = {};

//$.ajax({
//	url: "/api/games/all",
//	success: function (games)
//	{
//		var name;
//		var icon;

//		for (var game in games)
//		{
//			name = games[game]['name'];
//			icon = games[game]['icon'];

//			members.iconMap[name.toLowerCase()] = icon;
//		}
//	},
//	async: false,
//});

user.auth.check = function (callback)
{
	$.get('/api/users/auth', null, function (user)
	{
		callback(user);
	});
}