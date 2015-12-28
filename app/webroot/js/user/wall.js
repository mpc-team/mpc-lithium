/**
 * wall.js
 * 
 * Subdomain of the `profile` object. 
 */

profile.wall = {};

profile.wall.sendMessage = function (userid, content)
{
	var obj = { wall: content };
	$.post("/user/edit/" + userid, obj, function (data)
	{
		data = JSON.parse(data);
		if (data.status)
			profile.wall.refreshMessages(userid);
	});
}

profile.wall.refreshMessages = function (userid)
{
	$.get("/user/messages/" + userid,
		function (messages)
		{
			var json = $.parseJSON(messages);
			var html = '';
			for (var key in json.response)
			{
				html += "<div class='message'>";
				html += "<div class='name'>";
				html += "<a href=/user/view/" + json.response[key].senderid + ">";
				html += json.response[key].sender;
				html += "</a>";
				html += "</div>";
				html += "<div class='text'>";
				html += json.response[key].content;
				html += "</div>";
				html += "<div class='time'>";
				var date = moment(json.response[key].tstamp);
				html += moment(json.response[key].tstamp).format("h:mm A - dddd DD/MM/YY");
				html += "</div>";
				html += "</div>";
			}
			var feed = $(".profile-content .wall .nano-content");
			var container = $(".profile-content .wall .nano");
			feed.html(html);
			if (profile.messageCount < json.response.length)
				container.scrollTop(container[0].scrollHeight);

			profile.messageCount = json.response.length;

			$(".nano").nanoScroller();
		}
	);
}