/**
 * util.js
 *
 *	Utility functions for all pages on the site. Requires JQuery.
 *
 *	@
 *
 */

/**
 * RegExp // escape
 *	Used on text input from the user to ensure that regex do not
 *	take special characters like * and ? literally.
 */
RegExp.escape = function(text) {
	return (text+'').replace(/[.?*+^$[\]\\(){}|-]/g, "\\$&");
};
 
/**
 * Input Element Identifiers
 *	Elements that match these IDs are found with JQuery selectors.
 */
const INPUT_EMAIL = "email";
const INPUT_ALIAS = "alias";
const INPUT_PASSWORD = "password";
const INPUT_CONFIRM = "confirm";

//*************************************************************************
//*
//*		Signup // Validation
//*
//*************************************************************************

function validatePassword (password, confirmed) {
	return (password != null && password != "" && (password == confirmed)); 
}

function validateEmail (email) {
	var regex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
	return((email != null) && (regex.test(email))); 
}

function validateAlias (alias) {
	var regex = /^(?=[0-9a-zA-Z\s]{3,32}$)[a-zA-Z\s]+[a-zA-Z0-9\s]*/;
	return((alias != null) && regex.test(alias)); 
}

/**
 * function updateValidateStatus ( valid, inputval, inputid )
 *
 *	Updates valid state on a given component to notify the user whether an
 *	entry input is correct or not.
 *
 *	@param	valid
 *		Update validation state to true/false
 *
 *	@param inputval
 *		Value of element being validated, used for checking 'null' or empty values
 *
 *	@param inputid
 *		DOM identifier of the element to add/remove classes
 *
 */
function updateValidateStatus(valid, inputval, inputid) {
	var classes=["has-error","has-success"];
	var addclass = (!valid) ? "has-error" : "has-success";
	var remclass = (!valid) ? "has-success" : "has-error";
	var icon = (!valid) ? "glyphicon-remove" : "glyphicon-ok";
	
	$(inputid).find("span").remove();
	if (inputval != null && inputval != "") {
		$(inputid).addClass(addclass);
		$(inputid).removeClass(remclass);
		$(inputid).append("<span class='glyphicon "+icon+" form-control-feedback'></span>");
	} else {
		for(var i=0; i < classes.length; i++){
			$(inputid).removeClass(classes[i]);
		}
	}
}

/** 
 * function validateSignup ()
 *	Filters with 'validateEmail', 'validateAlias', and 'validatePassword'; returns
 *	true if form values pass these filters.
 *
 *	Entry point for JS, issued on the click event of an HTML element.
 */
function validateSignup () {
	var email = $('#' + INPUT_EMAIL).val();
	var alias = $('#' + INPUT_ALIAS).val();
	var password = $('#' + INPUT_PASSWORD).val();
	var confirmed = $('#' + INPUT_CONFIRM).val();
	var passmatch = validatePassword(password, confirmed);
	var emailvalid = validateEmail(email);
	var aliasvalid = validateAlias(alias);
	var addclass;
	var remclass;
	
	updateValidateStatus(emailvalid, email, "#input-signup-email");
	updateValidateStatus(passmatch, confirmed, "#input-signup-confirm");
	updateValidateStatus(aliasvalid, alias, "#input-signup-alias");
	
	return (emailvalid && passmatch && aliasvalid);
}

//*************************************************************************
//*
//*		Members // Search
//*
//*************************************************************************

/**
 * Filter Constants
 *	Describes which filter function to use. This indicates which INPUT element to 
 *	be used and indicates to "doFilter" 
 */
const FILTER_BY_ALIAS = 0;
const FILTER_BY_EMAIL = 1;

function doFilterEmail (userList, email) {
	return doFilter(email, userList, FILTER_BY_EMAIL);
}

function doFilterAlias (userList, alias) {
	return doFilter(alias, userList, FILTER_BY_ALIAS);
}

function doFilter (criteria, userList, filterBy) {
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

/**
 * HTML Helpers
 *	Provides layout for results of the search within a table element.
 */
function htmlTableEmail (user) {
	return "<td>" + user.email + "</td>";
}
function htmlTableAlias (user) {
	return "<td class='col-xs-6'><i class='fa fa-user'></i> " + user.alias + "</td>";
}
function htmlTableClass (rownum) {
	return (rownum % 2 == 0) ? "alt" : "";
}

/**
 * Member List
 *	Updates the Members list based on search criteria. The corresponding
 *	input is grabbed from elements with IDs as defined above.
 */
function isListEmptyOrNull (list) { 
	return (list == null) || (list.length == 0); 
}

function updateList (elements, userList, options) {
	if (isListEmptyOrNull(userList)) { return; }
	userList = doFilterAlias(userList, $(elements.alias).val());
	if (options.indexOf("admin") >= 0) {
		userList = doFilterEmail(userList, $(elements.email).val());
	}
	var result = '';
	for (var i = 0; i < userList.length; i++)  {
		result += "<tr class='row " + htmlTableClass(i) + "'>";
		result += htmlTableAlias(userList[i]);
		if (options.indexOf("admin") >= 0) {
			result += htmlTableEmail(userList[i]);
		}
		result += '</tr>';
	}
	$(elements.result).html(result);
}


