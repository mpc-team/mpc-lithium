/**
 * wall.js
 * 
 * Subdomain of the `profile` object. 
 */

profile.wall = {};

profile.wall.messageCount = 0;

profile.wall.sendMessage = function (userid, content)
{
	var obj = { wall: content };
	$.post("/user/edit/" + userid, obj, function (data)
	{
		data = JSON.parse(data);
		if (data.status)
		{
			profile.wall.refreshMessages(userid, true);
		}
	});
}

/**
 * Returns a String representation of a Wall message.
 * 
 * @param {type} object
 * @returns {type} 
 */
profile.wall.stringify = function (object)
{
	var date = moment(object.tstamp).format('MMMM DD, YYYY');
	var time = moment(object.tstamp).format('h:mm A')
	var html = "<div class='message'>";
	html += "<div class='name'>";
	html += "<a href=/user/view/" + object.senderid + ">";
	html += '<h4>' + object.sender + ' <small>sent on ' + date + ' at ' + time + '</small>' + '</h4>';
	html += "</a>";
	html += "</div>";
	html += "<div class='text'>";
	html += object.content;
	html += "</div>";
	html += "</div>";
	return html;
}

profile.wall.refreshMessages = function (userid, scrollToRecent)
{
	$.get("/api/users/messages/" + userid,
		function (messages)
		{
			/* Sort Messages such that the most recent Messages appears 
			 * at the end of the list. */
			messages.sort(function (a, b)
			{
				var time = [new Date(a.tstamp), new Date(b.tstamp), ];
				return time[0].getTime() - time[1].getTime();
			});

			var html = '';
			if (messages.length > 0)
			{
				for (var index in messages)
					html += profile.wall.stringify(messages[index]);
			}
			else
			{
				html += "<center><h4>No messages to display.</h4></center>";
			}
			$(".profile-content .wall .nano-content").html(html);

			$(".nano").nanoScroller();
			if (scrollToRecent)
				$(".nano").nanoScroller({ scroll: 'bottom' });
		}
	);
}