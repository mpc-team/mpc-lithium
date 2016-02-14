/**
 * AreYouSure.js.
 * 
 */

var AreYouSure = {};

AreYouSure.classes = {
	btn: '.btn-are-you-sure',
}

$(function ()
{
	for (key in AreYouSure.classes)
	{
		$(AreYouSure.classes[key]).click(function ()
		{
			var message = $(this).data('message');
			if (message == null)
				message = "Are you would like to Delete this content?";

			if (window.confirm(message))
			{
				return true;
			}
			return false;
		});
	}
});