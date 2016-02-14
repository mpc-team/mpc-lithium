/**
 * community.js
 *
 * Everything on the /community Page is managed here. Currently supports a list of Clans as well 
 * as a list of Members which are organized by Clan. There should be support on this page for
 * registering a new Clan with selected Members. 
 * 
 */
var community = {};
var members = {};

/* Network Updates
------------------------------------------------------------------------------------------------------------ */

community.clans = {};
community.clans.list = [];
community.clans.updated = false;
community.clans.update = function (additionalCallback)
{
	$.get('/api/clans/all', null, function (clans)
	{
		community.clans.list = [];
		for (index in clans)
			community.clans.list.push(clans[index]);
		community.clans.updated = true;
		if (typeof (additionalCallback) == "function")
			additionalCallback(clans);
	});
}

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
		if (typeof (additionalCallback) == "function")
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

/* Community UI Functions
------------------------------------------------------------------------------------------------------------ */

community.ui = {};

community.ui.elements =
{
	container: "#community-container",
	count: '#clans-count',
	register: {
		button: "#clan-register-button",
		feedback: "#clan-register-feedback",
		modal: "#clan-register-modal",
		modalClose: '#clan-register-modal .modal-header > button.close',
		name: '#clan-register-name',
		shortname: '#clan-register-shortname',
		members: "#clan-register-users",
		accept: "#clan-register-accept",
	}
}

community.ui.renderCommunity = function (clans)
{
	var html = ""
	for (index in clans)
	{
		html += "<div class='col-md-4'>";
		html += "<div class='padded-tile-sm'>"
		html += "<div class='panel panel-default padded-panel-med'>";
		html += "<div class='clan'>"
		html += "<h2>" + clans[index].name + "</h2>";
		html += "<h2><small>" + clans[index].shortname + "</small></h2>";
		html += "</div>";
		html += "</div>";
		html += "</div>";
		html += "</div>";
	}
	$(community.ui.elements.container).html(html);
	$(community.ui.elements.count).html(community.clans.list.length);
}

/**
 * Renders the Clan Member selection UI for Clan Registration.
 * 
 * @param {array} users: List of User objects to stringify.
 */
community.ui.renderClanMembers = function (users)
{
	user.auth.check(function (authenticated)
	{
		var html = "<div class='nano-content'>";
		html += "<div class='selectable-container ui-selectable'>";
		for (index in users)
		{
			if (users[index].clan == null && users[index].id != authenticated.id)
				html += community.ui.register.member.stringify(users[index]);
		}
		html += "</div>";
		html += "</div>";
		$(community.ui.elements.register.members).html(html);
		$(community.ui.elements.register.members + ' .selectable-container').selectable();
		$(community.ui.elements.register.members).addClass('nano');
		$(community.ui.elements.register.members).nanoScroller();
	});
}

community.ui.register = {};
community.ui.register.member = {};
community.ui.register.member.stringify = function (user)
{
	var date = moment(user['tstamp']);
	var html = "<div class='row ui-widget-content' style='padding: 5px;' data-id='" + user.id + "'>";
	html += "<div class='row'>";
	html += "<div class='col-xs-2'>";
	html += "<div class='user-avatar-container'>";
	html += "<img src='" + user.avatar + "' />";
	html += "</div>";
	html += "</div>";
	html += "<div class='col-xs-10'>";
	html += "<h4>" + user.alias + "</h4>";
	html += "<h4><small>" + date.format("MMM DD YYYY") + "</small></h4>";
	html += "</div>";
	html += "</div>";
	html += "</div>";
	return html;
}

/* Members UI Functions
------------------------------------------------------------------------------------------------------------ */

members.ui = {};

/**
 * Input/Output HTML Elements.
 */
members.ui.elements =
{
	result: "#members-results",
	count: '#members-count',
	clear: "#members-clear-filter",
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
	
	// Map the `users` object to an array so we can sort it.
	users = $.map(users, function (property) { return property; });

	users.sort(function (a, b)
	{
		var dates = { 'a': new Date(a.tstamp), 'b': new Date(b.tstamp) };

		// Sort so that the newest members appear at the front of the list.
		return (dates.a > dates.b) ? -1 : 1;
	});

	for (index in users)
	{
		html += "<tr class='row";
		if (alternate) html += " alt";
		if (users[index].newuser) html += " new";
		html += "'>";
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

	html += "<div class='col-xs-10' style='margin-left: -10px'>";
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
	//result += "<a id='member-" + object.id + "' href='/user/view/" + object.id + "' onmouseover='tooltip.pop(this, \"#tooltip" + object.id + "\")'>";
	result += "<a href='/user/view/" + object.id + "'>";
	result += "<div id='member-" + object.id + "' class='name' onmouseover='Tooltip.OnMouseOver(this.id)'>";
	result += "<span class='glyphicon glyphicon-user'></span> ";
	result += object.alias;
	if (object.clan != null)
		result += ' <small style="color: #888">' + object.clan.shortname + '</small>';

	if (object.newuser)
		result += "<span class='badge'>New Member</span>";

	result += "</div>";
	result += "</a>";

	result += "<div id='member-" + object.id + "-tooltip' class='user-tooltip'>"
	result += "<div class='panel panel-default'>";

	result += "<div class='row'>";
	result += "<a href='/user/view/" + object.id + "'>";
	result += "<h2>" + object.alias;
	if (object.clan != null)
		result += " <small>" + object.clan.shortname + "</small>";
	result += "</h2></a>";
	if ('email' in object)
		result += "<h2><small>" + object.email + "</small></h2>";
	result += "</div>";

	result += "<div class='row'>";
	result += "Member since <b>" + memberSince + "</b>";
	result += "</div>";

	result += "<div class='row'>";
	result += "<img src='" + object.avatar + "' style='width: 300px'></img>";
	result += "</div>";

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

/* List Filtering Functions
------------------------------------------------------------------------------------------------------------ */

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

/* Clan Registration
------------------------------------------------------------------------------------------------------------ */

/**
 * Dictionary of the possible Error messages and a more User-friendly version to
 * display in a `feedback` widget. Use the dictionary such that you are searching
 * for keys that are within your Error message in the response object. 
 * 
 * For example, if the response contains an Error with the text `Specified name error.`,
 * we are going to first look for `Message_A` in that response, moving onto `Message_B`
 * if the former could not be found.
 */
var ErrorFeedbackMessages =
{
	'Specified name error.':
	{
		'Message_A':
		{
			'NoError': 'Successful',
			'NullName': 'You must specify a Clan Name',
			'NameTaken': 'The specified Clan Name is already taken',
		},
		'Message_B':
		{
			'NoError': 'Successful',
			'NullName': 'You must specify a letter abbreviation for the Clan',
			'TooLong': 'The specified abbreviation is too long',
			'InvalidCharacters': 'The specified abbreviation contains invalid characters',
		}
	},
	'Member specification error.':
	{
		'Message':
		{
			'NoError': 'Successful',
			'NullList': 'Specified list of Members cannot be Null',
			'NotEnoughUsers': 'Not enough Members were specified',
			'UserNotFound': 'One of the specified Users does not exist',
			'UserInClan': 'One of the specified Users is already in a Clan',
			'SelfInvite': 'You cannot invite yourself to the Clan',
		}
	}
}

community.ui.updateFeedback = function (response)
{
	var error = ErrorFeedbackMessages[response.Error];
	var message = null;
	for (key in response)
		if (key in error)
		{
			message = error[key][response[key]];
			break;
		}
	$(community.ui.elements.register.feedback).html(
		"<div class='alert alert-danger'>" + message + "</div>"
	);
}

community.registerClan = function ()
{
	var selectedUserIds = [];
	$('.ui-widget-content.ui-selected', '.selectable-container').each(function ()
	{
		selectedUserIds.push($(this).data('id'));
	});
	var body = {};
	body.name = $(community.ui.elements.register.name).val(),
	body.shortname = $(community.ui.elements.register.shortname).val(),
	body.users = selectedUserIds;
	$.post('/api/clans/create', body, function (response)
	{
		if ('Error' in response)
			community.ui.updateFeedback(response);
		else
		{
			$(community.ui.elements.register.feedback).html('');
			$(community.ui.elements.register.name).val('');
			$(community.ui.elements.register.shortname).val('');
			$(community.ui.elements.register.modal).modal('hide');
			$(community.ui.elements.register.button).attr('disabled', 'disabled');
		}
	});
}

/* Members Update
------------------------------------------------------------------------------------------------------------ */

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

/* Shared Functions
------------------------------------------------------------------------------------------------------------ */

/**
 * Renders components that require a list of Members.
 * 
 * @param {array} users List of Users.
 */
function RenderElementsWithMembers (users)
{
	members.ui.renderMembers(users);
	community.ui.renderClanMembers(users);
}

/* Initialization
------------------------------------------------------------------------------------------------------------ */

//Initialization.
$(function ()
{
	// Update Community section immediately (not periodically for now).
	community.clans.update(community.ui.renderCommunity);

	// Update Games immediately and periodically.
	members.games.update(members.ui.renderGameInputs);
	setInterval(function () { members.games.update(members.ui.renderGameInputs); }, 60000);

	// Update Users immediately and periodically.
	members.users.update(RenderElementsWithMembers);
	setInterval(function () { members.users.update(); }, 10000);

	// Setup Event Callbacks.
	$(community.ui.elements.register.accept).click(community.registerClan);
	$(community.ui.elements.register.modalClose).click(function () { $(community.ui.elements.register.modal).modal('hide'); })
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