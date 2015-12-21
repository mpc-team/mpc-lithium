
var user = {};

user.notifications = {};

user.notifications.updateBadges = function (badgeClass)
{
	$.get('/api/users/notifications/forum', null, function (data)
	{
		var count = 0;
		for (key in data)
		{
			count++;
		}
		$(badgeClass).each(function () { $(this).html(count); });
	});
}

user.notifications.ofType = function (type)
{
	$.get('/api/users/notifications/' + type, null, function (notifications)
	{
		for (index in notifications)
		{
			$.get('/api/posts/' + notifications[index].contentid, null, function (post)
			{
				console.log(post);
			});
		}
	});
}

$(document).ready(function ()
{
	user.notifications.updateBadges('.badge-usr-notify');
	user.notifications.ofType('forum');
});