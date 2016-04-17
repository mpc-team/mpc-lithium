/**
 * profile.js
 *
 * Functions that are used for the JavaScript elements that appear on the 
 * Profile page.
 */
//
// This is already defined in /user/wall
var profile = {};

/* User Clan
------------------------------------------------------------------------------------------------ */

profile.Clan = {};
profile.Clan.PageElementId = "#user-profile-clan";
profile.Clan.LeaveClanButton = "#clan-leave";
profile.Clan.ClanInviteButton = "#clan-invite";

/**
 * Update the User Clan UI Elements.
 * 
 * @param {int} userid: User identifier (of authorized User).
 */
profile.Clan.UpdatePageElements = function (authid, userid)
{
	$.get('/api/users/single/' + authid + "?ext=true", null, function (authUser)
	{
		$.get('/api/users/single/' + userid + "?ext=true", null, function (userObject)
		{
			var clanText = (userObject.clan != null) ? userObject.clan.shortname : "None";

			/* Leave Your Own Clan (only if you're in a Clan) */
			if (userObject.clan != null)
				$(profile.Clan.LeaveClanButton).css('display', 'block');
			else
				$(profile.Clan.LeaveClanButton).css('display', 'none');

			/* Invite User to Your Clan (Only if you are the Owner of your Clan and User doesn't) */
			if (authUser.id != userObject.id && authUser.clan != null && userObject.clan == null && authUser.clan.owner == authUser.id)
				$(profile.Clan.ClanInviteButton).css('display', 'block');
			else
				$(profile.Clan.ClanInviteButton).css('display', 'none');

			$(profile.Clan.PageElementId).html(clanText);
		});
	});
}

/**
 * Removes the authorized User his/her Clan.
 * 
 * @param {int} userid: User identifier (of authorized User).
 */
profile.Clan.LeaveClan = function (authid, userid)
{
	$.get('/api/clans/leave', null, function (response)
	{
		if (!('Error' in response))
			profile.Clan.UpdatePageElements(authid, userid);
	});
}

profile.Clan.SendClanInvite = function (authid, userid)
{
	$.get('/api/clans/invite?users=' + userid, null, function (response)
	{
		if (!('Error' in response))
			profile.Clan.UpdatePageElements(authid, userid);
	});
}

/* Player's Games
------------------------------------------------------------------------------------------------ */

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

/* Initialization
------------------------------------------------------------------------------------------------ */

profile.init = function (userid, played) 
{
	user.auth.check(function (authorizedUser)
	{
		/* Initialize User Clan Element */
		profile.Clan.UpdatePageElements(authorizedUser.id, userid);

		$(profile.Clan.LeaveClanButton).click(function () { profile.Clan.LeaveClan(authorizedUser.id, userid); });
		$(profile.Clan.ClanInviteButton).click(function () { profile.Clan.SendClanInvite(authorizedUser.id, userid); });
	});

	profile.refreshGames(played);

	/* Initialize User Messages */
	profile.wall.refreshMessages(userid, true);
	setInterval(function () { profile.wall.refreshMessages(userid, false); }, 10000);
	
	/* Initialize Game Buttons */
	$(".profile-content .game button").click(function () 
	{
		var gameid = $(this).data('id');
		if (profile.searchGames(played, gameid))
			profile.updateGame(played, userid, gameid, false);
		else
			profile.updateGame(played, userid, gameid, true);
	});

	/* Initialize Wall */
	profile.wall.init(userid);
}