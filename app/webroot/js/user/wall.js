/**
 * wall.js
 * 
 * Subdomain of the `profile` object. 
 */

profile.wall = {};
profile.wall.messageCount = 0;

/* Wall Interface Elements
-------------------------------------------------------------------------------------------------------- */

profile.wall.ui = {};
profile.wall.ui.textarea = "#profile-wall-textarea";

/* Initialization
-------------------------------------------------------------------------------------------------------- */

profile.wall.init = function (userid) {
	$(profile.wall.ui.textarea).keypress(function (ev) {
		ev = ev || event;
		if (ev.which == 13 && !ev.shiftKey) {
			ev.preventDefault();
			var message = $(this).val();
			if (message != null && message.length > 0) {
				profile.wall.sendMessage(userid, message);
				$(this).val("").change();
			}
		}
	})
};

profile.wall.sendMessage = function (userid, content) {
	var obj = { wall: content };
	$.post("/user/edit/" + userid, obj, function (data) {
		data = JSON.parse(data);
		if (data.status) {
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
profile.wall.stringify = function (object) {
	var date = moment(object.tstamp).format('MMMM DD, YYYY');
	var time = moment(object.tstamp).format('h:mm A')
	var html =
	"<div class='message'>" +
		"<div class='name'>" +
			"<a href=/user/view/" + object.senderid + ">" +
				"<h4>" + object.sender + " <small>sent on " + date + " at " + time + "</small>" + "</h4>" +
			"</a>" +
		"</div>" +
		"<div class='text'>" +
			markup.process(object.content, markup.NORMAL | markup.MARKDOWN) +
		"</div>" +
	"</div>";
	return html;
}

profile.wall.refreshMessages = function (userid, scrollToRecent) {
	$.get("/api/users/messages/" + userid,
		function (messages) {
			/* Sort Messages such that the most recent Messages appears 
			 * at the end of the list. */
			messages.sort(function (a, b) {
				var time = [new Date(a.tstamp), new Date(b.tstamp), ];
				return time[0].getTime() - time[1].getTime();
			});

			var html = '';
			if (messages.length > 0) {
				for (var index in messages)
					html += profile.wall.stringify(messages[index]);
			}
			else {
				html += "<center><h4>No messages to display.</h4></center>";
			}
			$(".profile-content .wall .nano-content").html(html);

			setTimeout(function () {
				if (scrollToRecent)
					$(".profile-content .wall .nano").nanoScroller({ preventPageScrolling: true, alwaysVisible: true, scroll: 'bottom' });
				else
					$(".profile-content .wall .nano").nanoScroller({ preventPageScrolling: true, alwaysVisible: true });
			}, 1000);

		}
	);
}