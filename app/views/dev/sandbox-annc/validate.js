/**
 * validate.js
 *
 * Javascript that handles input validation on the client-side. There is
 * also similar validations being handled on the server-side as well.
 */
 $('#admin-announcement-gui').validate({
	
		rules : {
			announcement-text : {
				required: true,
				minlength: 10,
				maxlength: 50
			}
		},
		messages : {
			announcement-text : {
				required : "*Required* Please Enter in an Announcement.",
				minlength : "*Minimum Length* Please extend the Announcement be more Descriptive.",
				maxlength: "*Maximum Length* Please shorten the Announcement."
			}
		}
	
 });