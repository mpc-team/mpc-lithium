
/* Types & Classes
-------------------------------------------------------------------------------------------------------------------------------- */

user.notifications = {};
user.notifications.types =
{
	post: 'post',
	posthit: 'posthit',
	announcement: 'announcement',
	message: 'message',
	claninvite: 'claninvite',
};

user.notifications.classes =
{
	'dismiss-annc': 'btn-annc-dismiss',
	'dismiss-msg': 'btn-msg-dismiss',
	'accept-clan-invite': 'accept-clan-invite',
	'decline-clan-invite': 'decline-clan-invite',
};

/* Stringify Functions (Convert Objects to HTML Output)
-------------------------------------------------------------------------------------------------------------------------------- */

user.notifications.claninvites = {};
user.notifications.claninvites.stringify = function (object)
{
	console.log(object);
	var date = moment(object['tstamp']);
	var html = "<div class='row'>";
	html += "<div class='col-xs-10'>";
	html += markup.process(object['content'], markup.NORMAL | markup.MARKDOWN);
	html += "</div>";
	html += "<div class='col-xs-2'>";
	html += "<button title='Decline Clan Invite' class='btn btn-edit pull-right decline-clan-invite' data-id='"
				+ object.contentid + "'><span class='glyphicon glyphicon-remove'></span></button>";
	html += "<button title='Accept Clan Invite' class='btn btn-edit pull-right accept-clan-invite' data-id='"
				+ object.contentid + "'><span class='glyphicon glyphicon-ok'></span></button>";
	html += "</div>";
	html += "</div>";
	return html;
}

user.notifications.posts = {};
user.notifications.posts.stringify = function (object)
{
	var date = moment(object['tstamp']);
	var html = "<li>";
	html += "<a href='/thread/view/" + object['post']['threadid'] + "#" + object['contentid'] + "'>";
	html += "<div class='row'>";
	html += "<div class='col-xs-3 info'>";
	html += "<div class='row author'>";
	html += "<h4>" + object['post']['author'] + "</h4>";
	html += "</div>";
	html += "<div class='row date'>";
	html += date.format("MMM DD - h:mm A ");
	html += "</div>";
	html += "</div>";
	html += "<div class='col-xs-9 content'>";
	html += "<h3 style='display:block'>" + object['post']['thread'] + "</h3>";
	html += markup.process(object['post']['content'], markup.NORMAL | markup.MARKDOWN);
	html += "</div>";
	html += "</div>";
	html += "</a>";
	html += "</li>";
	return html;
}

user.notifications.posthits = {};
user.notifications.posthits.stringify = function (object)
{
	var html = "<li class='user-notification-hit'>";
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

	html += "<div class='col-xs-10' data-toggle='collapse' data-target='#announcement" + object['id'] + "'>";
	if (object['title'] != null && object['title'] != "")
		html += "<h3>" + object['title'] + "</h3>";
	else
		html += "<h3>Announcement #" + object['id'] + "</h3>";
	html += "</div>";

	html += "<div class='col-xs-2'>";
	html += "<button class='btn btn-edit pull-right " + user.notifications.classes['dismiss-annc'] + "' data-id='" + object['id'] + "'>";
	html += " Dismiss";
	html += "</button>";
	html += "</div>";

	html += "</div>";
	html += "<div id='announcement" + object['id'] + "' class='collapse'>";
	html += markup.process(object['content'], markup.PREVIEW | markup.MARKDOWN);
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
	html += "<button class='btn btn-edit pull-right " + user.notifications.classes['dismiss-msg'] + "' data-id='" + object['id'] + "'>";
	html += " Dismiss";
	html += "</button>";
	html += "</div>";
	html += "<p>" + markup.process(object['content'], markup.NORMAL | markup.MARKDOWN) + "</p>";
	html += "</div>";
	html += "</li>";
	return html;
}

/* Delete Notifications
-------------------------------------------------------------------------------------------------------------------------------- */

user.notifications.claninvites.accept = function (identifier)
{
	$.get('/api/clans/accept/' + identifier, null, function (data)
	{
		user.notifications.updateCountElements($('.user-notification-count'));
		user.notifications.updateClanInviteNotifications($('.user-notification-list > .row:nth-child(1)'));
	});
}

user.notifications.claninvites.decline = function (identifier)
{
	$.get('/api/clans/decline/' + identifier, null, function (data)
	{
		user.notifications.updateCountElements($('.user-notification-count'));
		user.notifications.updateClanInviteNotifications($('.user-notification-list > .row:nth-child(1)'));
	});
}

user.notifications.message.delete = function (identifier)
{
	$.get('/api/users/notifications/delete/' + identifier, null, function (data)
	{
		user.notifications.updateCountElements($('.user-notification-count'));
		user.notifications.updateMessageNotifications($('.user-notification-list > .row:nth-child(2)'));
	});
}

user.notifications.announcement.delete = function (identifier)
{
	$.get('/api/users/notifications/delete/' + identifier, null, function (data)
	{
		user.notifications.updateCountElements($('.user-notification-count'));
		user.notifications.updateAnnouncementNotifications($('.user-notification-list > .row:nth-child(3)'));
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

/* Update Elements
-------------------------------------------------------------------------------------------------------------------------------- */

user.notifications.updateListElements = function (htmlListClass)
{
	user.notifications.updateClanInviteNotifications($(htmlListClass + ' > .row:nth-child(1)'));
	user.notifications.updateMessageNotifications($(htmlListClass + ' > .row:nth-child(2)'));
	user.notifications.updateAnnouncementNotifications($(htmlListClass + ' > .row:nth-child(3)'));
	user.notifications.updateForumNotifications($(htmlListClass + ' > .row:nth-child(4) > .col-xs-9'));
	user.notifications.updatePostHitNotifications($(htmlListClass + ' > .row:nth-child(4) > .col-xs-3'));
}

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
		{
			html += "<div class='notification-forum-post'>";
			html += "You have no Forum Notifications";
			html += "</div>";
		}
		for (key in data)
		{
			html += "<div class='notification-forum-post'>";
			html += user.notifications.posts.stringify(data[key]);
			html += "</div>";
		}
		jqueryElement.html(html);
	});
}

user.notifications.updatePostHitNotifications = function (jqueryElement)
{
	$.get('/api/users/notifications/all?type=' + user.notifications.types.posthit + '&limit=4', null, function (data)
	{
		var html = "<h4><Center>Post Hits</center></h4>";
		for (key in data)
		{
			html += "<div class='notification-post-hit'>";
			html += user.notifications.posthits.stringify(data[key]);
			html += "</div>";
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
		{
			html += "<div class='notification-announcement'>";
			html += "No Announcements";
			html += "</div>";
		}
		else
		{
			html += "<div class='nano'>";
			html += "<div class='nano-content'>";
			for (key in data)
			{
				html += "<div class='notification-announcement'>";
				html += user.notifications.announcement.stringify(data[key]);
				html += "</div>";
			}
			html += "</div>";
			html += "</div>";
		}
		jqueryElement.html(html);
		$('.user-notification-list > .row:nth-child(3) > .nano').nanoScroller();
		$('.' + user.notifications.classes['dismiss-annc']).click(user.notifications.announcement.onDismiss);
	});
}

user.notifications.updateMessageNotifications = function (jqueryElement)
{
	$.get('/api/users/notifications/all?type=' + user.notifications.types.message + '&limit=4', null, function (data)
	{
		var html = "<h4>Messages</h4>";
		if (Object.keys(data).length == 0)
		{
			html += "<div class='notification-message'>";
			html += "No Messages";
			html += "</div>";
		}
		else
		{
			html += "<div class='nano'>";
			html += "<div class='nano-content'>";
			for (key in data)
			{
				html += "<div class='notification-message'>";
				html += user.notifications.message.stringify(data[key]);
				html += "</div>";
			}
			html += "</div>";
			html += "</div>";
		}
		jqueryElement.html(html);
		$('.user-notification-list > .row:nth-child(2) > .nano').nanoScroller();
		$('.' + user.notifications.classes['dismiss-msg']).click(user.notifications.message.onDismiss);
	});
}

user.notifications.updateClanInviteNotifications = function (jqueryElement)
{
	$.get('/api/users/notifications/all?type=' + user.notifications.types.claninvite + '&limit=4', null, function (data)
	{
		var html = "<h4>Clan Invites</h4>";
		if (Object.keys(data).length == 0)
		{
			html += "<div class='notification-clan-invite'>";
			html += "No Clan Invites";
			html += "</div>";
		}
		else
			for (key in data)
			{
				html += "<li class='divider'></li>";
				html += "<div class='notification-clan-invite'>";
				html += user.notifications.claninvites.stringify(data[key]);
				html += "</div>";
			}
		jqueryElement.html(html);
		$('.accept-clan-invite').click(function () { user.notifications.claninvites.accept($(this).data('id')); });
		$('.decline-clan-invite').click(function () { user.notifications.claninvites.decline($(this).data('id')); });
	});
}

/* Initialization
-------------------------------------------------------------------------------------------------------------------------------- */

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
	}, 5000);
});