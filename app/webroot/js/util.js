
/* __Constants__ */

var SEARCH_RESULTS = "#search-results";

var INPUT_EMAIL = "#email";
var INPUT_ALIAS = "#alias";
var INPUT_PASSWORD = "#password";
var INPUT_CONFIRM = "#confirm";

var FILTER_BY_ALIAS = 0;
var FILTER_BY_EMAIL = 1;

var PERMISSION_ADMIN = 'admin';

/* #### End of Constants ############################### */

/* __Functions__ */

function isListEmpty (list) { 
	return (list == null) || (list.length == 0); 
}

/* validation functions */
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

/*
 *
 * function updateValidateStatus:
 *		@param _valid_: status to be updated to.
 *		@param _inputval_: value of field being updated.
 *		@param _inputid_: DOM identifier of form-group.
 * ---------------------------------------------------
 *		Strictly for updating the UI features to properly
 *		reflect invalid formats.
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
/*
 *
 * function validateSignup:
 *		Uses:
 *			validateEmail()
 *			validateAlias()
 *			validatePassword()
 * ------------------------------------------------
 *		Responsible for validating Signup fields before
 *		information is submitted to the server. 
 *
 */
function validateSignup () {
	var email = $(INPUT_EMAIL).val();
	var alias = $(INPUT_ALIAS).val();
	var password = $(INPUT_PASSWORD).val();
	var confirmed = $(INPUT_CONFIRM).val();
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
/*
 *
 *			Members Filter Functions
 *
 */
function doFilter (criteria, userList, filterBy) {
	var regx = new RegExp(criteria.toLowerCase());
	var users = [];
	var len = userList.length;
	for (var i=0; i < len; i++) {
		var matched = userList[i][filterBy].toLowerCase().match(regx);
		if (matched != null) {
			users.push(userList[i]);
		}
	}
	return users;
}

function doFilterEmail (userList, permissions) {
	if (permissions.indexOf(PERMISSION_ADMIN) > -1) {
		var criteria = ($(INPUT_EMAIL) == null) ? "" : $(INPUT_EMAIL).val();
		userList = doFilter(criteria, userList, FILTER_BY_EMAIL);
	}
	return userList;
}

function doFilterAlias (userList, permissions) {
	var criteria = ($(INPUT_ALIAS) == null) ? "" : $(INPUT_ALIAS).val();
	return doFilter(criteria, userList, FILTER_BY_ALIAS);
}
/*
 *
 *			HTML Printing Functions
 *
 */
function htmlTableEmail (user, permissions) {
	if (permissions.indexOf(PERMISSION_ADMIN) > -1) {
		return "<td>" + user[FILTER_BY_EMAIL] + "</td>";
	}
	return "";
}
function htmlTableAlias (user, permissions) {
	var icon = (user[FILTER_BY_EMAIL] == 'b0rg3r@gmail.com') ?
			"<td class='col-xs-6'><i class='fa fa-user-secret'></i> " :
			"<td class='col-xs-6'><i class='fa fa-user'></i> ";
			// "<td><span class='glyphicon glyphicon-user'></span> ";
	return icon + user[FILTER_BY_ALIAS] + "</td>";
}
function htmlTableClass (rownum) {
	return (rownum % 2 == 0) ? "alt" : "";
}

function updateList (userList, permissions) {
	if (isListEmpty(userList)) { return; }
	userList = doFilterEmail(userList, permissions);
	userList = doFilterAlias(userList, permissions);
	var result = '';
	for (var i = 0; i < userList.length; i++)  {
		result += "<tr class='row " + htmlTableClass(i) + "'>";
		result += htmlTableAlias(userList[i], permissions);
		result += htmlTableEmail(userList[i], permissions);
		result += '</tr>';
	}
	$(SEARCH_RESULTS).html(result);
}
/* 
 *
 *
 *
 */
function br2nl(str) { return str.replace(/<br\s*\/?>/mg,"\n"); }
/* #### End of Functions ############################### */




