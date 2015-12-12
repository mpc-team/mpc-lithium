/**
 * scroller.js
 *
 * Some links benefit from scrolling the User directly to a section of the page
 * that they are linking to. For example, the recent-feed links to Forum posts
 * within threads. 'scroller.js' makes this automatically happen.
 *
 * JavaScript scrolling mechanisms should be done through '.gotoSection()', this
 * code (aside from providing .gotoSection) will translate the URL query into
 * the necessary data and automatically call .gotoSection when loaded.
 */

/**
 * Currently no better place to put this. Utility function added to JQuery that
 * scrolls to the JQuery selected element with an offset to align better.
 */
$.fn.gotoSection = function (section)
{
	if ($(this).offset() != null)
	{
		$("html, body").animate({scrollTop: $(this).offset().top - 160}, 300);
	}
}

$(window).on('load', function ()
{
	scroller.init();
});

var scroller = {};

/**
 * Gets the query parameters from the URL.
 * 
 * @param {string} url - the URL to parse.
 * 
 * @returns {object} - dictionary of query parameters.
 */
scroller.getParams = function (url)
{
	var params = url.slice(url.indexOf('?') + 1, url.length).split('&');
	var result = {};
	for (var i = 0; i < params.length; i++)
	{
		var composites = params[i].split('=');
		result[composites[0]] = composites[1];
	}
	return result;
}

/**
 * Returns the string at the end of a URL that acts as a location 
 * directory for where the page needs to load. Anything after the 
 * '#' character in the URL is returned.
 * 
 * @param {string} url - The URL as a string.
 * 
 * @returns {string} - The string that comes after '#'. 
 */
scroller.getPageDirectoryId = function (url)
{
	var index = url.indexOf('#');
	if (index > 0)
		return url.slice(index + 1, url.length);
	else
		return null;
}

scroller.init = function ()
{
	var dir = scroller.getPageDirectoryId(window.location.href);

	if (dir != null)
	{
		$('#' + dir).gotoSection();
	}
	//var params = scroller.getParams(window.location.href);
	
	//if ("post" in params)
	//	$("#post" + params.post).gotoSection();
	
	//if ("op" in params)
	//	$("#op-" + params.op).gotoSection();
}