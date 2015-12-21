
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

$(document).ready(function ()
{
	user.notifications.updateBadges('.badge-usr-notify');
});