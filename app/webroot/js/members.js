/**
 * members.js
 *
 * Supports a dynamic View for the members page that is manipulated through JQuery selectors. 
 *
 * The namespace for 'members.js' is simply 'members'.
 */
var members = {};

/**
 * RegExp.escape
 *
 * Escapes special regex characters for building a regex string with user input.
 */
RegExp.escape = function(text) {
	return (text+'').replace(/[.?*+^$[\]\\(){}|-]/g, "\\$&");
};

members.FILTER_BY_ALIAS = 0;
members.FILTER_BY_EMAIL = 1;
members.FILTER_BY_GAMES = 2;

members.elements = { 
	result: "#results",
	email: "#email",
	alias: "#alias"
};

/* The icons are retrieved from the Database synchronously to
 * make sure we have the paths loaded when we use them later. */
 
members.iconMap = {};
$.ajax({
	url: "/api/games/all",
	success: function (games) {
		var name;
		var icon;
	
		for (var game in games) {
			name = games[game]['name'];
			icon = games[game]['icon'];
		
			members.iconMap[name.toLowerCase()] = icon;
		}
	},
	async: false,
});

members.html = 
{
	email: function (user, display) 
	{
		if (display) 
		{
			var result = "<td>";
			result += "<div class='email'>";
			result += user.email;
			result += "</div>";
			return (result + "</td>");
		}
		return "";
	},
	
	alias: function (user, url) 
	{
		var result = "";
		result += "<td>";
		result += "<a href='" + url + "'>";
		result += "<div class='name'>";
		result += "<span class='glyphicon glyphicon-user'></span> ";
		result += user.alias;
		result += "</div>";
		result += "</a>";
		result += "</td>";
		return result;
	},
	
	games: function (user) 
	{
		var result = "";
		result += "<td>";
		result += "<div>";
		for (var game in user['played']) 
		{
			var icon = members.iconMap[user['played'][game].toLowerCase()];
			if (icon) 
			{
				result +=  "<span class='icon'>";
				result += "<img src='" + members.iconMap[user['played'][game].toLowerCase()] + "'></img>";
				result += "</span>";
			}
		}
		result += "</div>";
		result += "</td>";
		return result;
	}
};

members.doRegexFilter = function (userList, criteria, filterBy) 
{
	var regex = new RegExp(RegExp.escape(criteria.toLowerCase()));
	var users = [];
	var len = userList.length;
	for (var i = 0; i < len; i++) 
	{
		var matched = null;
		switch (filterBy) 
		{
			case members.FILTER_BY_ALIAS:
				matched = userList[i].alias.toLowerCase().match(regex);
				break;
			case members.FILTER_BY_EMAIL:
				matched = userList[i].email.toLowerCase().match(regex);
				break;
		}
		if (matched) 
		{
			users.push(userList[i]);
		}
	}
	return users;
}

members.doGamesFilter = function (userList, games) 
{
	var checkGroup = [];
	for (var i = 0; i < games.length; i++) 
	{
		if (games[i].checked) 
		{
			checkGroup.push(games[i].id);
		}
	}
	if (checkGroup.length > 0) 
	{
		var usersFiltered = [];
		for (var i = 0; i < userList.length; i++) 
		{
			var matched = 0;
			for (var ch = 0; ch < checkGroup.length; ch++) 
			{
				var match = false;
				for (var p = 0; (p < userList[i].played.length) && (!match); p++) 
				{
					var name = userList[i].played[p].toLowerCase().replace(/\s+/g, '');
					if (name == checkGroup[ch]) 
					{
						matched++;
						match = true;
					}
				}
			}
			if (matched == checkGroup.length) {
				usersFiltered.push(userList[i]);
			}
		}
		return usersFiltered;
	}
	return userList;
}

members.updateList = function (userList, options) 
{
	var value;
	if ((userList != null) && (userList.length > 0)) 
	{
		value = $(members.elements.alias).val();
		userList = members.doRegexFilter(userList, value, members.FILTER_BY_ALIAS);
		if (options.indexOf("admin") > -1) 
		{
			value = $(members.elements.email).val();
			userList = members.doRegexFilter(userList, value, members.FILTER_BY_EMAIL);
		}
		userList = members.doGamesFilter(userList, $(".game input"));
		var result = '';
		for (var i = 0; i < userList.length; i++)  
		{
			if (i % 2)
				result += "<tr class='row'>";
			else
				result += "<tr class='row alt'>";
				
			result += members.html.alias(userList[i], "/user/view/" + userList[i].id);
			result += members.html.email(userList[i], options.indexOf("admin") > -1);
			result += members.html.games(userList[i]);
			result += '</tr>';
		}
		$(members.elements.result).html(result);
	}
}

members.init = function (memberList, permissions, games) 
{
	for (var game in games) 
	{
		var name = games[game].name.toLowerCase();
		members.elements[name] = '#' + name.replace(/\s+/g, '');
	}
	members.updateList(memberList, permissions);
	for (var elem in members.elements) {
		$(members.elements[elem]).keyup(function () {
			members.updateList(memberList, permissions);
		});
		$(members.elements[elem]).change(function () {
			members.updateList(memberList, permissions);
		});
	}
}