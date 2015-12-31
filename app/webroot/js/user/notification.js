
user.notifications = {};
user.notifications.types = {
	forum: 'forum',
	post: 'post',
	posthit: 'posthit',
	announcement: 'announcement',
};

//--------------------------------------------------------------------------------------

user.notifications.posts = {};
user.notifications.posts.stringify = function (object)
{
	var date = moment(object['tstamp']);
	var html = "<li>";
	html += "<a href='/thread/view/" + object['post']['threadid'] + "#" + object['contentid'] + "'>";
	html += "<div class='row'>";
	html += "<div class='col-xs-3 info'>";
	html += "<div class='row author'>";
	html += object['post']['author'];
	html += "</div>";
	html += "<div class='row date'>";
	html += date.format("MMM DD - h:mm A ");
	html += "</div>";
	html += "</div>";
	html += "<div class='col-xs-9 content'>";
	html += "<h3>" + object['post']['thread'] + "</h3>";
	html += markup.process(object['post']['content'], markup.NORMAL);
	html += "</div>";
	html += "</div>";
	html += "</a>";
	html += "</li>";
	return html;
}

user.notifications.posthits = {};
user.notifications.posthits.stringify = function (object)
{
	var html = "<li>";
	html += "<a href='/thread/view/" + object['posthit']['threadid'] + '#' + object['contentid'] + "'>";
	html += "<div class='row'>";
	html += "<h5>";
	html += "<div>";
	html += object['posthit']['thread'];
	html += "</div>";
	html += "<div>";
	html += "<small>";
	html += object['posthit']['sender'] + '<br />';
	html += "User has Hit your Post.";
	html += "</small>";
	html += "</div>";
	html += "</h5>";
	html += "</div>";
	html += "</a>";
	html += "</li>";
	return html;
}

user.notifications.announcement = {};
user.notifications.announcement.stringify = function (object)
{
	var html = "<li>";
	if (object['title'] != null && object['title'] != "")
		html += "<h3>" + object['title'] + "</h3>";
	else
		html += "<h3>Announcement #" + object['id'] + "</h3>";
	html += object['content'];
	html += "</li>";
	return html;
}

//--------------------------------------------------------------------------------------

user.notifications.updateCountElements = function (htmlClass)
{
	$.get('/api/users/notifications/count', null, function (data)
	{
		$(htmlClass).each(function () { $(this).html(data); });
	});
}

user.notifications.updateListElements = function (htmlListClass)
{
	user.notifications.updateForumNotifications($(htmlListClass + ' > .row > .col-xs-9 > div:nth-child(1)'));
	user.notifications.updateAnnouncementNotifications($(htmlListClass + ' > .row > .col-xs-9 > div:nth-child(2)'));
	user.notifications.updatePostHitNotifications($(htmlListClass + ' > .row > .col-xs-3'));
}

//--------------------------------------------------------------------------------------

user.notifications.updateForumNotifications = function (jqueryElement)
{
	$.get('/api/users/notifications/all?type=' + user.notifications.types.post + '&limit=4', null, function (data)
	{
		var html = "<h4>Forum Notifications</h4>";

		if (Object.keys(data).length == 0)
			html += "You have no Forum Notifications";

		for (key in data)
		{
			html += "<li class='divider'></li>";
			html += user.notifications.posts.stringify(data[key]);
		}

		jqueryElement.html(html);
	});
}

user.notifications.updatePostHitNotifications = function (jqueryElement)
{
	$.get('/api/users/notifications/all?type=' + user.notifications.types.posthit + '&limit=4', null, function (data)
	{
		var html = "<center><h4>Post Hits</h4></center>";
		for (key in data)
		{
			html += user.notifications.posthits.stringify(data[key]);
		}
		jqueryElement.html(html);
	});
}

user.notifications.updateAnnouncementNotifications = function (jqueryElement)
{
	$.get('/api/users/notifications/all?type=' + user.notifications.types.announcement + '&limit=4', null, function (data)
	{
		var html = "<h4>Announcements</h4>";

		if (Object.keys(data).length == 0)
			html += "No Announcements";
		else
			for (key in data)
			{
				html += "<li class='divider'></li>";
				html += user.notifications.announcement.stringify(data[key]);
			}
		html += "</div>";
		jqueryElement.html(html);
	});
}

//--------------------------------------------------------------------------------------

$(document).ready(function ()
{
	user.auth.check(function (authenticated)
	{
		if (authenticated.constructor !== Array)
		{
			user.notifications.updateCountElements('.user-notification-count');
			user.notifications.updateListElements('.user-notification-list');
		}
	});
	setInterval(function ()
	{
		user.auth.check(function (authenticated)
		{
			if (authenticated.constructor !== Array)
			{
				user.notifications.updateCountElements('.user-notification-count');
				user.notifications.updateListElements('.user-notification-list');
			}
		});
	}, 10000);
});