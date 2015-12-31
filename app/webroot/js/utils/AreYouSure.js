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
			console.log('CLICKED');

			if (window.confirm("Are you would like to Delete this content?"))
			{
				return true;
			}
			return false;
		});
	}
});