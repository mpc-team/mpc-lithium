/**
 * members.js
 *
 * Interactive list of members that can be searched/filtered and provides
 * additional information when individual Members names are moused over.
 */
var members = {};

//----------------------------------------------------------------------------------------------------------
//
//		NETWORK UPDATES
//
//----------------------------------------------------------------------------------------------------------

members.games = {};
members.games.list = [];
members.games.updated = false;
members.games.update = function (additionalCallback)
{
	$.get('/api/games/all', null, function (games)
	{
		members.games.list = [];
		for (index in games)
			members.games.list.push(games[index]);
		members.games.updated = true;
		if (typeof(additionalCallback) == "function")
			additionalCallback(games);
	});
}

members.users = {};
members.users.list = [];
members.users.updated = false;
members.users.update = function (additionalCallback)
{
	$.get('/api/users/all?ext=true', null, function (users)
	{
		members.users.list = [];
		for (index in users)
			members.users.list.push(users[index]);
		members.users.updated = true;
		if (typeof (additionalCallback) == "function")
			additionalCallback(users);
	});
}

//----------------------------------------------------------------------------------------------------------
//
//		UI FUNCTIONS
//
//----------------------------------------------------------------------------------------------------------

members.ui = {};

/**
 * Input/Output HTML Elements.
 */
members.ui.elements =
{
	result: "#members-results",
	count: '#members-count',
	clear: "#members-clear",
	inputs: {
		email: '#email',
		alias: '#alias',
		games: '#members-games',
		game: '.game input',
	},
};

/**
 * Renders a specified list of Users into the result table.
 * 
 * @param {array} users: List of Users/Members.
 */
members.ui.renderMembers = function (users)
{
	var html = "";
	var alternate = true;
	
	users = $.map(users, function (property) { return property; });
	users.sort(function (a, b) { return (a.alias.toLowerCase() < b.alias.toLowerCase()) ? -1 : 1; });

	for (index in users)
	{
		html += (alternate) ? "<tr class='row alt'>" : "<tr class='row'>";
		alternate = !alternate;
		html += members.ui.alias.stringify(users[index]);
		if ('email' in users[index])
			html += members.ui.email.stringify(users[index]);
		html += members.ui.games.stringify(users[index]);
		html += "</tr>";
	}
	$(members.ui.elements.result).html(html);
	$(members.ui.elements.count).html(members.users.list.length);
}

members.ui.renderGameInputs = function (games)
{
	var html = "";
	for (index in games)
	{
		html += members.ui.input.game.stringify(games[index]);
	}
	$(members.ui.elements.inputs.games).html(html);
	$(members.ui.elements.inputs.game).change(members.updateMembers);
}

members.ui.input = {};
members.ui.input.clear = function ()
{
	$(members.ui.elements.inputs.email).val('');
	$(members.ui.elements.inputs.alias).val('');
	$(members.ui.elements.inputs.game).each(function () { $(this).attr('checked', false) });
}

members.ui.input.game = {};
members.ui.input.game.stringify = function (game)
{
	var html = "<div class='col-md-3'>";
	html += "<div class='game'>";
	html += "<div class='row'>";

	html += "<div class='col-xs-2'>";
	html += "<span class='input-group-addon'>";
	html += "<input type='checkbox' id='" + game.realname + "' />";
	html += "</span>";
	html += "</div>";

	html += "<div class='col-xs-10'>";
	html += "<span class='input-group-addon'>";
	html += game.name;
	html += "</span>";
	html += "</div>";

	html += "</div>";
	html += "</div>";
	html += "</div>";
	return html;
}

members.ui.email = {};
members.ui.email.stringify = function (object)
{
	var result = "<td>";
	result += "<div class='email'>";
	result += object.email;
	result += "</div>";
	result += "</td>";
	return result;
}

members.ui.alias = {};
members.ui.alias.stringify = function (object)
{
	var memberSince = moment(object.tstamp).format('MMMM Do YYYY');
	var result = "<td>";
	result += "<a href='/user/view/" + object.id + "' onmouseover='tooltip.pop(this, \"#tooltip" + object.id + "\")'>";
	result += "<div class='name'>";
	result += "<span class='glyphicon glyphicon-user'></span> ";
	result += object.alias;
	result += "</div>";
	result += "</a>";

	result += "<div class='tooltip-container' style='display:none'>";
	result += "<div id='tooltip" + object.id + "'>";
	result += "<a href='/user/view/" + object.id + "'>" + "<h2>" + object.alias + "</h2>" + "</a>";
	if ('email' in object)
		result += "<h2><small>" + object.email + "</small></h2>";
	else
		result += "<br />";
	result += "Member since <b>" + memberSince + "</b>";
	result += "<img src='" + object.avatar + "' style='width: 300px'></img>";
	result += "</div>";
	result += "</div>";

	result += "</td>";
	return result;
}

members.ui.games = {};
members.ui.games.stringify = function (object) 
{
	var result = "<td>";
	result += "<div class='games'>";
	for (var index in object.games) 
	{
		if ('icon' in object.games[index] && object.games[index].icon)
		{
			result += "<span class='icon'>";
			result += "<img src='" + object.games[index].icon + "'></img>";
			result += "</span>";
		}
	}
	result += "</div>";
	result += "</td>";
	return result;
}

//----------------------------------------------------------------------------------------------------------
//
//		FILTER FUNCTIONS
//
//----------------------------------------------------------------------------------------------------------

members.list = {};
members.list.filtertypes = {};
members.list.filtertypes.ALIAS = 0;
members.list.filtertypes.EMAIL = 1;

/**
 * Checks if a User "has" a Game.
 * 
 * @param {object} user: User object.
 * @param {string} game: Name (realname) of the Game.
 * 
 * @return {bool}: True if the User "has" the Game.
 */
members.list.isGamePlayed = function (user, game)
{
	for (index in user.games)
	{
		if (user.games[index].realname == game)
			return true;
	}
	return false;
}

/**
 * Filters Userlist based on Name/Alias and Email.
 * 
 * @param {array} users: List of Users.
 * @param {string} criteria: Filter criteria.
 * @param {int} filterBy: Specifies the property to filter by.
 * 
 * @returns {array}: Filtered list of Users.
 */
members.list.filter = function (users, criteria, filterBy) 
{
	var regex = new RegExp(criteria.toLowerCase().replace(/[.?*+^$[\]\\(){}|-]/g, "\\$&"));
	var filtered = [];
	var len = users.length;
	for (var i = 0; i < len; i++) 
	{
		var matched = null;
		switch (filterBy) 
		{
			// Filter by specified Alias.	
			case members.list.filtertypes.ALIAS:
				matched = users[i].alias.toLowerCase().match(regex);
				break;

			// Filter by specified Email.
			case members.list.filtertypes.EMAIL:
				matched = users[i].email.toLowerCase().match(regex);
				break;
		}
		if (matched) 
		{
			filtered.push(users[i]);
		}
	}
	return filtered;
}

/**
 * Filters list of Users based on Games. 
 * 
 * @param {array} user: List of Users.
 * @param {array} games: List of Games to filter by.
 * 
 * @returns {array}: Filtered list of Users.
 */
members.list.filterByGames = function (users, games) 
{
	var filtered = [];
	var passed;

	for (u in users)
	{
		passed = true;
		for (g in games)
		{
			if (!members.list.isGamePlayed(users[u], games[g]))
				passed = false;
		}
		if (passed)
			filtered.push(users[u]);
	}
	return filtered;
}

//----------------------------------------------------------------------------------------------------------
//
//		UPDATE
//
//----------------------------------------------------------------------------------------------------------

/**
 * Updates the Members UI to reflect the controls applied by the User. We don't need to actually
 * request all of the Users and additional information each time the search filter is changed. 
 * Instead, we populate/update these lists periodically and use them whenever a UI control is applied.
 */
members.updateMembers = function ()
{
	if (!members.users.updated || !members.games.updated)
		// We need the above components in order to actually process anything.
		return;

	if (members.users.list.length == 0)
		// Unnecessary to process on an empty list.
		return;

	var filterAlias = $(members.ui.elements.inputs.alias).val();
	var filteredUsers = members.list.filter(members.users.list, filterAlias, members.list.filtertypes.ALIAS);

	if ('email' in members.users.list[0])
	{
		var filterEmail = $(members.ui.elements.inputs.email).val();
		filteredUsers = members.list.filter(filteredUsers, filterEmail, members.list.filtertypes.EMAIL);
	}

	var filterGames = [];
	$(members.ui.elements.inputs.game).each(function ()
	{
		if ($(this).context.checked)
			filterGames.push($(this).attr('id'));
	});
	filteredUsers = members.list.filterByGames(filteredUsers, filterGames);

	members.ui.renderMembers(filteredUsers);
}

//----------------------------------------------------------------------------------------------------------
//
//		INITIALIZATION
//
//----------------------------------------------------------------------------------------------------------

//Initialization.
$(function ()
{
	// Update Games immediately and periodically.
	members.games.update(members.ui.renderGameInputs);
	setInterval(function () { members.games.update(members.ui.renderGameInputs); }, 60000);

	// Update Users immediately and periodically.
	members.users.update(members.ui.renderMembers);
	setInterval(function () { members.users.update(); }, 10000);

	// Setup Event Callbacks.
	$(members.ui.elements.inputs.alias).keyup(members.updateMembers);
	$(members.ui.elements.inputs.email).keyup(members.updateMembers);
	$(members.ui.elements.inputs.alias).change(members.updateMembers);
	$(members.ui.elements.inputs.email).change(members.updateMembers);
	$(members.ui.elements.clear).click(function ()
	{
		members.ui.input.clear();
		members.updateMembers();
	});
});