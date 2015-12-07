/**
 * validate.js
 *
 * Javascript that handles input validation on the client-side. There is
 * also similar validations being handled on the server-side as well.
 */
function validatePassword (password, confirmed) {
/**
 * validatePassword
 *
 * Cannot be NULL or empty, password/confirmed must match.
 */
	return (password != null && password != "" && (password == confirmed)); 
}

function validateEmail (email) {
/**
 * validateEmail
 *
 * Validation of email using a standard regular expression.
 */
	var regex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
	return((email != null) && (regex.test(email))); 
}

function validateAlias (alias) {
/**
 * validateAlias
 *
 * Validation requires Alias to be between 3 and 32 characters or numbers.
 * In addition it cannot start with a number, and must start with an 
 * alphabetic character/
 */
	var regex = /^(?=[!0-9a-zA-Z\s]{3,32}$)[a-zA-Z\s]+[a-zA-Z0-9\s]*/;
	return ((alias != null) && regex.test(alias)); 
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

function validateSignup () {
/** 
 * validateSignup
 *	
 *	Filters with 'validateEmail', 'validateAlias', and 'validatePassword'; returns
 *	true if form values pass these filters.
 */
	var email = $('#email').val();
	var alias = $('#alias').val();
	var password = $('#password').val();
	var confirmed = $('#confirm').val();
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

