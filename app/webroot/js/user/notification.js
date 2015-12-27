
var user = {};

user.notifications = {};
user.notifications.types = {
	forum: 'forum',
	post: 'post',
};

user.notifications.stringify = function (object)
{

}

user.notifications.updateCountElements = function (htmlClass)
{
	$.get('/api/users/notifications/count', null, function (data)
	{
		$(htmlClass).each(function () { $(this).html(data); });
	});
}

user.notifications.updateListElements = function (htmlListClass)
{
	$.get('/api/users/notifications/all?type=post&limit=4', null, function (data)
	{
		var html = "<h4>Forum Notifications</h4>";

		if (Object.keys(data).length == 0)
		{
			html += "<li class='divider'></li>";
			html += "<h5>You have no Forum Notifications.</h5>";
		}

		for (key in data)
		{
			var notification = data[key];
			var date = moment(notification['tstamp']);

			html += "<li class='divider'></li>";
			html += "<li>";
			html += "<a href='/thread/view/" + notification['post']['threadid'] + "#" + notification['contentid'] + "'>";
			html += "<div class='row'>";
			html += "<div class='col-xs-3 info'>";
			html += "<div class='row author'>";
			html += notification['post']['author'];
			html += "</div>";
			html += "<div class='row date'>";
			html += date.format("MMM DD - h:mm A ");
			html += "</div>";
			html += "</div>";
			html += "<div class='col-xs-9 content'>";
			html += markup.process(notification['post']['content'], markup.NORMAL);
			html += "</div>";
			html += "</div>";
			html += "</a>";
			html += "</li>";
		}
		$(htmlListClass).html(html);
	});
}

$(document).ready(function ()
{
	user.notifications.updateCountElements('.user-notification-count');
	user.notifications.updateListElements('.user-notification-list');

	setInterval(function ()
	{
		user.notifications.updateCountElements('.user-notification-count');
		user.notifications.updateListElements('.user-notification-list');
	}, 5000);
});