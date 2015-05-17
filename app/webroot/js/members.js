/**
 * members.js
 *
 * Members page contains dynamic elements. Any Javascript or JQuery that is
 * used to animate these components can be placed into this file.
 */
RegExp.escape = function(text) {
/**
 * RegExp.escape
 *
 * Used on text input from the user to ensure that regex do not
 * take special characters like * and ? literally.
 */
	return (text+'').replace(/[.?*+^$[\]\\(){}|-]/g, "\\$&");
};

/**
 * Filter Stuff
 *
 * Filters a List of Users pulled form the Database. In normal circumstances,
 * the User object will have an "id" and an "alias". For administrators, an
 * additional "email" field is made available through the server.
 */
const FILTER_BY_ALIAS = 0;
const FILTER_BY_EMAIL = 1;

function doFilter (userList, criteria, filterBy) {
/**
 * doFilter
 *
 * Apply filter to a list of Users, collecting the ones that pass the filter
 * into a NEW list. This retains information so that the original list can be
 * processed many times.
 */
	var regx = new RegExp(RegExp.escape(criteria.toLowerCase()));
	var users = [];
	var len = userList.length;
	for (var i=0; i < len; i++) {
		if (filterBy == FILTER_BY_ALIAS) {
			var matched = userList[i].alias.toLowerCase().match(regx);
		} else if (filterBy == FILTER_BY_EMAIL) {
			var matched = userList[i].email.toLowerCase().match(regx);
		}
		if (matched != null) {
			users.push(userList[i]);
		}
	}
	return users;
}

var HtmlTable = {
/**
 * HtmlTable
 *
 * Helpers for defining the HTML layout of results. Currently includes
 * processing for EMAILs, ALIASes, and a method of adding classes to rows
 * based on their index or "rowid".
 */
// Row Identifier Class
	rowclass: function(rowid) {
		return (!(rowid % 2)) ? "alt" : "";
	},
	
// Email Html Layout
	email: function(user) {
		var result = "<td class='col-xs-6'>";
		result += "<div class='email'>";
		result += user.email;
		result += "</div>";
		return (result + "</td>");
	},
	
// Alias Html Layout
	alias: function(user, url) {
		var result = "<td class='col-xs-6'>";
		result += "<div class='name'>";
		result += "<a href='" + url + "'>";
		result += "<span class='glyphicon glyphicon-user'></span> ";
		result += user.alias;
		result += "</div>";
		return (result + "</a></td>");
	}
};

function updateList (elements, userList, options) {
/**
 * updateList
 *
 * Filters list of Users and writes elements into an HTML table class.
 * Utilizes HTML helper functions, where the layout can be edited. Defined
 *	above.
 */
	if ((userList != null) && (userList.length > 0)) { 
		userList = doFilter(userList, $(elements.alias).val(), FILTER_BY_ALIAS);
		if (options.indexOf("admin") >= 0) {
			userList = doFilter(userList, $(elements.email).val(), FILTER_BY_EMAIL);
		}
		var result = '';
		for (var i = 0; i < userList.length; i++)  {
			result += "<tr class='row " + HtmlTable.rowclass(i) + "'>";
			result += HtmlTable.alias(userList[i], "/profile/view/" + userList[i].id);
			if (options.indexOf("admin") >= 0) {
				result += HtmlTable.email(userList[i]);
			}
			result += '</tr>';
		}
		$(elements.result).html(result);
	}
}
