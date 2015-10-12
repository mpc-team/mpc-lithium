/**
 * profile.js
 *
 * Functions that are used for the JavaScript elements that appear on the 
 * Profile page.
 */
var profile = {

	messageCount: 0,
 
	searchGames: function (played, gameid) {
		return played.indexOf(gameid + "") > -1;
	},

	updateGameUI: function (gameid, status) {				
		if (status) {
			$(".btn-edit[data-id='" + gameid + "']").addClass("active");
			$(".game[data-id='" + gameid + "'] .status").html("<span class='glyphicon glyphicon-ok'></span>");
			$(".game[data-id='" + gameid + "'] .status").addClass("active");
			$(".game[data-id='" + gameid + "'] .panel").addClass("active");
		} else {
			$(".btn-edit[data-id='" + gameid + "']").removeClass("active");
			$(".game[data-id='" + gameid + "'] .status").html("");
			$(".game[data-id='" + gameid + "'] .status").removeClass("active");
			$(".game[data-id='" + gameid + "'] .panel").removeClass("active");
		}
		/* this is a little UI trick to make the button never appear selected */
		$(".game[data-id='" + gameid + "'] button").blur();
	},
	
	updateGame: function (played, userid, gameid, flag) {
		var obj = {game: gameid, flag: flag};
		var find = played.indexOf("" + gameid);
		/* synchronize local list of played games and assume success, revert changes
			after AJAX request if the action was not successful */
		if (!flag) {
			if (find > -1) {
				played.splice(find);
			}
		} else {
			if (find < 0) {
				played.push(("" + gameid));
			}
		}
		profile.updateGameUI(gameid, flag);
		
		$.post("/user/edit/" + userid, obj, function (data) {
			data = JSON.parse(data);
			/* if the request was not successful then revert the UI changes */
			if (!data.status) {
				profile.updateGameUI(gameid, !flag);
			} else {
				/* synchronize games played data with server */
				played.length = 0;
				for (var i = 0; i < data.response.length; i++) {
					played.push(data.response[i]);
				}
				/* synchronize UI with data returned by server */
				profile.refreshGames(played);	
			}
		});
	},

	sendMessage: function (userid, content) {
		var obj = {wall: content};
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
			profile.updateGameUI(id, profile.searchGames(played, id));
		});
	},

	refreshMessages: function (userid) {
		$.get("/user/messages/" + userid,
			function (messages) {
				var json = $.parseJSON(messages);
				var html = '';				
				for (var key in json.response) {
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
		profile.refreshMessages(userid);
		
		setInterval(function () { profile.refreshMessages(userid); }, 4000);
		
		$(".profile-content .game button").click(function () {
			var gameid = $(this).data('id');
			if (profile.searchGames(played, gameid)) {
				profile.updateGame(played, userid, gameid, false);
			} else {
				profile.updateGame(played, userid, gameid, true);
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
