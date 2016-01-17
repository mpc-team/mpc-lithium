
user.notifications = {};
user.notifications.types = {
	post: 'post',
	posthit: 'posthit',
	announcement: 'announcement',
	message: 'message',
};

user.notifications.classes =
{
	'dismiss-annc': 'btn-annc-dismiss',
	'dismiss-msg': 'btn-msg-dismiss',
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
	html += "<div class='row'>";

	html += "<div class='col-xs-10'>";
	if (object['title'] != null && object['title'] != "")
		html += "<h3>" + object['title'] + "</h3>";
	else
		html += "<h3>Announcement #" + object['id'] + "</h3>";
	html += markup.process(object['content'], markup.PREVIEW);
	html += "</div>";

	html += "<div class='col-xs-2'>";
	html += "<button class='btn btn-edit " + user.notifications.classes['dismiss-annc'] + "' data-id='" + object['id'] + "'>";
	html += " Dismiss";
	html += "</button>";
	html += "</div>";

	html += "</div>";
	html += "</li>";
	return html;
}

user.notifications.message = {};
user.notifications.message.stringify = function (object)
{
	var html = "<li>";
	var date = moment(object.tstamp).format('MMMM DD, YYYY');
	var time = moment(object.tstamp).format('h:mm A');
	html += "<div class='row'>";
	html += "<div class='col-xs-10'>";
	html += "<a href='/user/view/" + object['senderid'] + "'>" + object['sender'] + "</a> ";
	html += "sent on " + date + " at " + time;
	html += "</div>";
	html += "<div class='col-xs-2'>";
	html += "<button class='btn btn-edit " + user.notifications.classes['dismiss-msg'] + "' data-id='" + object['id'] + "'>";
	html += " Dismiss";
	html += "</button>";
	html += "</div>";
	html += "<p>" + object['content'] + "</p>";
	html += "</div>";
	html += "</li>";
	return html;
}

//--------------------------------------------------------------------------------------

user.notifications.message.delete = function (identifier)
{
	$.get('/api/users/notifications/delete/' + identifier, null, function (data)
	{
		user.notifications.updateCountElements($('.user-notification-count'));
		user.notifications.updateMessageNotifications($('.user-notification-list > .row:nth-child(1)'));
	});
}

user.notifications.announcement.delete = function (identifier)
{
	$.get('/api/users/notifications/delete/' + identifier, null, function (data)
	{
		user.notifications.updateCountElements($('.user-notification-count'));
		user.notifications.updateAnnouncementNotifications($('.user-notification-list > .row:nth-child(2) > .col-xs-9 > div:nth-child(2)'));
	});
}

user.notifications.announcement.onDismiss = function ()
{
	user.notifications.announcement.delete($(this).attr('data-id'));
}

user.notifications.message.onDismiss = function ()
{
	user.notifications.message.delete($(this).attr('data-id'));
}

//--------------------------------------------------------------------------------------

user.notifications.updateListElements = function (htmlListClass)
{
	user.notifications.updateForumNotifications($(htmlListClass + ' > .row:nth-child(2) > .col-xs-9 > div:nth-child(1)'));
	user.notifications.updateAnnouncementNotifications($(htmlListClass + ' > .row:nth-child(2) > .col-xs-9 > div:nth-child(2)'));
	user.notifications.updatePostHitNotifications($(htmlListClass + ' > .row:nth-child(2) > .col-xs-3'));
	user.notifications.updateMessageNotifications($(htmlListClass + ' > .row:nth-child(1)'));
}

//--------------------------------------------------------------------------------------

user.notifications.updateCountElements = function (htmlClass)
{
	$.get('/api/users/notifications/count', null, function (data)
	{
		$(htmlClass).each(function () { $(this).html(data); });
	});
}

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
		{
			html += "<div class='nano'>";
			html += "<div class='nano-content'>";
			for (key in data)
			{
				html += "<li class='divider'></li>";
				html += user.notifications.announcement.stringify(data[key]);
			}
			html += "</div>";
			html += "</div>";
		}
		jqueryElement.html(html);
		$('.nano').nanoScroller();
		
		$('.' + user.notifications.classes['dismiss-annc']).click(user.notifications.announcement.onDismiss);
	});
}

user.notifications.updateMessageNotifications = function (jqueryElement)
{
	$.get('/api/users/notifications/all?type=' + user.notifications.types.message + '&limit=4', null, function (data)
	{
		var html = "<h4>Messages</h4>";
		if (Object.keys(data).length == 0)
			html += "No Messages";
		else
			for (key in data)
			{
				html += "<li class='divider'></li>";
				html += user.notifications.message.stringify(data[key]);
			}
		html += "<li class='divider'></li>";
		jqueryElement.html(html);

		$('.' + user.notifications.classes['dismiss-msg']).click(user.notifications.message.onDismiss);
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