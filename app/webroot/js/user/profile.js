/**
 * profile.js
 *
 * Functions that are used for the JavaScript elements that appear on the 
 * Profile page.
 */
//
// This is already defined in /user/wall
var profile = {};

profile.updateGameUI = function (gameid, status)
{
	if (status) 
	{
		$(".btn-edit[data-id='" + gameid + "']").addClass("active");
		$(".game[data-id='" + gameid + "'] .status").html("<span class='glyphicon glyphicon-ok'></span>");
		$(".game[data-id='" + gameid + "'] .status").addClass("active");
		$(".game[data-id='" + gameid + "'] .panel").addClass("active");
	} 
	else 
	{
		$(".btn-edit[data-id='" + gameid + "']").removeClass("active");
		$(".game[data-id='" + gameid + "'] .status").html("");
		$(".game[data-id='" + gameid + "'] .status").removeClass("active");
		$(".game[data-id='" + gameid + "'] .panel").removeClass("active");
	}$
}

profile.searchGames = function (played, gameid)
{
	return played.indexOf(gameid + "") > -1;
}
	
profile.updateGame = function (played, userid, gameid, flag)
{
	var obj = {game: gameid, flag: flag};
	var find = played.indexOf("" + gameid);
	/* synchronize local list of played games and assume success, revert changes
		after AJAX request if the action was not successful */
	if (!flag) 
	{
		if (find > -1)
			played.splice(find);
	} 
	else 
	{
		if (find < 0)
			played.push(("" + gameid));
	}
	profile.updateGameUI(gameid, flag);
		
	$.post("/user/edit/" + userid, obj, function (data) 
	{
		data = JSON.parse(data);
		/* if the request was not successful then revert the UI changes */
		if (!data.status)
			profile.updateGameUI(gameid, !flag);
		else 
		{
			/* synchronize games played data with server */
			played.length = 0;
			for (var i = 0; i < data.response.length; i++)
				played.push(data.response[i]);

			/* synchronize UI with data returned by server */
			profile.refreshGames(played);	
		}
	});
}

profile.refreshGames = function (played)
{
	$(".game").each(function ()
	{
		var id = $(this).data('id');
		profile.updateGameUI(id, profile.searchGames(played, id));
	});
}

//------------------------------------------------------------------------------------------

profile.init = function (userid, played) 
{	
	profile.refreshGames(played);

	profile.wall.refreshMessages(userid, true);
	setInterval(function () 
	{
		profile.wall.refreshMessages(userid, false);
	}, 10000);
	
	$(".profile-content .game button").click(function () 
	{
		var gameid = $(this).data('id');
		if (profile.searchGames(played, gameid))
			profile.updateGame(played, userid, gameid, false);
		else
			profile.updateGame(played, userid, gameid, true);
	});

	$(".profile-content .wall .footer input[type='text']").keyup(function (event) 
	{
		if (event.keyCode == 13) 
		{ /* detect 'Enter' key press */
			var message = $(".profile-content .wall .footer input").val();
			if (message != null && message.length > 0) 
			{
				profile.wall.sendMessage(userid, message);
				$(".profile-content .wall .footer input").val("");
			}
		}
	});
}