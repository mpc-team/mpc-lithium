/**
 * Announcements
 * @author Steve
 * 
 */

var announcements = {};

/**
 * HTML Elements.
 */
announcements.htmlElements = {
	content: '#announcements-content',
};

/**
 * Validates the content of an Announcement.
 * @param {string} content - Content being validated.
 * @returns {bool} - True if the content is valid.
 */
announcements.validate = function (content)
{
	return content.length > 0;
}

/**
 * Returns HTML representing an Announcement.
 * @param {object} object - The Announcement.
 * @returns {string} - HTML representing the UI of the Announcement.
 */
announcements.stringify = function (object)
{
	var result = '';
	result += "<div class='well well-sm'>";

	result += "<div class='title'>";
	if (object.title != null)
		result += "<h2>" + object.title + "</h3>";
	else
		result += "<h3>Announcement #" + object.id + "</h3>";
	result += "</div>";

	result += "<div class='content'>";
	result += object.content;
	result += "</div>";
	result += "<div class='info'>";
	result += "<div class='author'>Written by: ";
	result += "<a href='/user/view/" + object.authorid + "'>" + object.author + "</a>";
	result += "</div>";
	result += 'Written on: ' + object.tstamp + '<br />';
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
 * Creates an Announcement with a REST API call.
 * @param {string} message - Content of the Announcement to create.
 * @returns {bool} - False if validation failed, otherwise true.
 */
announcements.create = function (title, message)
{
	if (!announcements.validate(message))
	{
		return false;
	}
	var body = {
		'title': title,
		'content': message,
	};
	$.post('/announcements/create', body, function (data)
	{
		var output = $(announcements.htmlElements.content);

		announcements.append(data['announcement']);
		output.val('');
	});
	return true;
}

/**
 * Retrieves a list of all Announcements and prints them as HTML UI elements.
 */
announcements.pull = function ()
{
	$.get('/announcements/all', null, function (data)
	{
		var dataArray = [];
		for (key in data)
		{
			dataArray.push(data[key]);
		}

		dataArray.sort(function (a, b)
		{
			var time = [new Date(a.tstamp),	new Date(b.tstamp),];

			return time[1].getTime() - time[0].getTime();
		});

		announcements.print(dataArray);
	});
}