var profile = {
/**
 * profile.js
 *
 * Functions that are used for the JavaScript elements that appear on the Profile page.
 *
 * "Games You Play"
 * "Messages & Invitations"
 */
	messageCount: 0,
 
	searchGames: function (played, gameid) {
		return played.indexOf(gameid + "") > -1;
	},

	modifyGames: function (played, userid, gameid, flag) {
		var obj = {game: gameid, flag: flag};
		$.post("/user/edit/" + userid,
			obj, function (data) {
				data = JSON.parse(data);
				if (data.status) {
					played.length = 0;
					for (var i = 0; i < data.response.length; i++) {
						played.push(data.response[i]);
					}
					$(".game[data-id='" + gameid + "'] .status").html("<span class='glyphicon glyphicon-ok'></span>");
					if (profile.searchGames(played, gameid)) {
						$(".game[data-id='" + gameid + "'] .status").addClass("active");
						$(".game[data-id='" + gameid + "'] .panel").addClass("active");
					} else {
						$(".game[data-id='" + gameid + "'] .status").removeClass("active");
						$(".game[data-id='" + gameid + "'] .panel").removeClass("active");
					}
					profile.refreshGames(played);
					$(".game[data-id='" + gameid + "'] button").blur();
				}
			}
		);
	},

	sendMessage: function (userid, content) {
		var obj = {post: content};
		$.post("/user/edit/" + userid, obj, function (data) {
			data = JSON.parse(data);
			if (data.status) {
				profile.refreshMessages(userid);
			}
		});
	},

	refreshGames: function (played) {
		$(".game .status").each(function () {
			var id = $(this).data('id');
			if (profile.searchGames(played, id)) {
				$(this).html("<span class='glyphicon glyphicon-ok'></span>");
				$(".game[data-id='" + id + "'] .status").addClass("active");
				$(".game[data-id='" + id + "'] .panel").addClass("active");
			} else {
				$(this).html("");
				$(".game[data-id='" + id + "'] .status").removeClass("active");
				$(".game[data-id='" + id + "'] .panel").removeClass("active");
			}
		});
	},

	refreshMessages: function (userid) {
		$.get("/user/messages/" + userid,
			function (messages) {
				var json = $.parseJSON(messages);
				var html = '';
				for (var key in json.response) {
					html += "<div class='message'>";
					html += "<span class='name'>";
					html += "<center>";
					html += "<a href=/user/view/" + userid + ">";
					html += json.response[key].sender;
					html += "</a>";
					html += "</center>";
					html += "</span>";
					html += "<span class='text'>";
					html += "<center>";
					html += json.response[key].content;
					html += "</center>";
					html += "</span>";
					html += "<div class='time'>";
					html += "<center>";
					var date = moment(json.response[key].tstamp);
					html += moment(json.response[key].tstamp).format("h:mm A - dddd DD/MM/YY");
					html += "</center>";
					html += "</div>";
					html += "</div>";
				}
				var feed = $(".profile-content .wall .content .messages");
				var container = $(".profile-content .wall .content");
				feed.html(html);
				if (profile.messageCount < json.response.length) {
					container.scrollTop(container[0].scrollHeight);
				}
				profile.messageCount = json.response.length;
			}
		);
	},
	
	init: function (userid, played) {	
		profile.refreshGames(played);
		setInterval(function () { profile.refreshMessages(userid); }, 4000);
		profile.refreshMessages(userid);
		$(".profile-content .game button").click(function () {
			var gameid = $(this).data('id');
			if (profile.searchGames(played, gameid)) {
				profile.modifyGames(played, userid, gameid, false);
			} else {
				profile.modifyGames(played, userid, gameid, true);
			}
		});
		$(".profile-content .wall .footer input[type='text']").keyup(function (event) {
			if (event.keyCode == 13) { /* detect 'Enter' key press */
				var message = $(".profile-content .wall .footer input").val();
				if (message != null && message.length > 0) {
					profile.sendMessage(userid, message);
					$(".profile-content .wall .footer input").val("");
				}
			}
		});
	}

};
