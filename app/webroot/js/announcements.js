/**
 * Announcements
 * @author Steve
 * 
 */

var announcements = {};

/**
 *
 */
announcements.htmlElements = {
	content: '#announcements-content',
};

/**
 * 
 * @param {type} object
 * @returns {type} 
 */
announcements.stringify = function (object)
{
	var result = '';
	result += "<div class='well well-sm'>";
	result += "<div class='info'>";
	result += 'Written by: ' + object.author + '<br />';
	result += 'Written on: ' + object.tstamp + '<br />';
	result += "</div>";
	result += "<div class='content'>";
	result += object.content;
	result += "</div>";
	result += "</div>";
	return result;
}

/**
 * 
 * @param {type} objects
 */
announcements.print = function (objects)
{
	var output = $(announcements.htmlElements.content);
	var outputString = '';

	for (key in objects)
	{
		outputString += announcements.stringify(objects[key]);
	}

	outputString = markup.process(outputString, markup.NORMAL);
	output.html(outputString);
}

/**
 * 
 * @param {type} object
 */
announcements.append = function (object)
{
	var output = $(announcements.htmlElements.content);
	var outputString = output.html();

	outputString = markup.process(announcements.stringify(object)) + outputString;
	output.html(outputString);
}

/**
 * 
 * @param {type} message
 */
announcements.create = function (message)
{ 
	var data = { 'content': message };

	$.post('/announcements/create', data, function (data)
	{
		announcements.append(data['announcement']);
	});
}

/**
 * Returns a list of all Announcements.
 */
announcements.pull = function ()
{
	$.get('/announcements/all', null, function (data)
	{
		announcements.print(data);
	});
}