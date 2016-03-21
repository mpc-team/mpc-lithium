/**
 * Announcements
 * @author Steve
 * 
 */

var announcements = {};
announcements.ui = {};
announcements.ui.displayLimit = 10;

/**
 * HTML Elements.
 */
announcements.htmlElements =
{
	content: '#announcements-content',
};

/**
 * Validates the content of an Announcement.
 * 
 * @param {string} content - Content being validated.
 * 
 * @returns {bool} - True if the content is valid.
 */
announcements.validate = function (content)
{
	if (content == null)
		return "nulldata";
	else if (content.length == 0)
		return "empty";
	else
		return "valid";
}

/**
 * Returns HTML representing an Announcement.
 * 
 * @param {object} object - The Announcement.
 * 
 * @returns {string} - HTML representing the UI of the Announcement.
 */
announcements.ui.stringify = function (object)
{
	var date = moment(object.tstamp);
	var result = '';
	result += "<div class='announcement padded-panel-med bordered-panel shadow-med-1' data-id='" + object.id + "'>";
	result += "<div class='title' data-id='" + object.id + "'>";
	if (object.title != null && object.title != "")
		result += "<h2>" + object.title + "</h2>";
	else
		result += "<h2>Announcement #" + object.id + "</h2>";
	result += "</div>";
	result += "<div class='title-edit' data-id='" + object.id + "'>";
	if (object.title == null || object.title == "")
	{
		result += "<input type='text' class='form-control input-title' placeholder='Enter title...' data-id='" + object.id + "'/>";
	}
	else
	{
		object.title = object.title.replace(/\'/g, '&#39;').replace(/\"/g, '&quot;');
		result += "<input type='text' class='form-control input-title' value='" + object.title + "' data-id='" + object.id + "'/>";
	}
	result += "</div>";

	result += "<div class='content' data-id='" + object.id + "'>";
	result += "<div class='nano'>";
	result += "<div class='nano-content'>";
	result += markup.process(object.content, markup.NORMAL | markup.MARKDOWN);
	result += "</div>";
	result += "</div>";
	result += "</div>";

	result += "<div class='content-edit' data-id='" + object.id + "'>";
	result += "<textarea type='text' class='form-control' data-id='" + object.id + "'>";
	result += object.content;
	result += "</textarea>";
	result += "</div>";

	result += "<div class='feedback' data-id='" + object.id + "'></div>";
	result += "<hr />";

	result += "<table>";
	result += "<tbody>";
	result += "<tr>";
	result += "<td>";

	result += "<div class='info'>";
	result += "<div class='author'>Created by ";
	result += "<a href='/user/view/" + object.authorid + "'>" + object.author + "</a>";
	result += " on " + date.format("dddd - MMMM Do YYYY");
	result += "</div>";
	result += "</div>";
	result += "</div>";

	result += "</td>";
	result += "<td align='right'>";

	result += "<div class='control'>";
	result += "<button class='btn btn-edit ctrl-confirm' data-id='" + object.id + "'>";
	result += " Confirm";
	result += "</button>";
	result += "<button class='btn btn-edit ctrl-cancel' data-id='" + object.id + "'>";
	result += " Cancel";
	result += "</button>";
	result += "<button class='btn btn-edit ctrl-edit' data-id='" + object.id + "'>";
	result += " Edit";
	result += "</button>";
	result += "<button class='btn btn-edit ctrl-delete' data-id='" + object.id + "'>";
	result += " Delete";
	result += "</button>";
	result += "</div>";

	result += "</td>";
	result += "</tr>";
	result += "</tbody>";
	result += "</table>";

	result += "</div>";
	return result;
}

/* Helpers to retrieve JQuery elements by their `data-id`. */
announcements.ui.title = function (dataid) { return $('.title').filter('[data-id="' + dataid + '"]'); }
announcements.ui.content = function (dataid) { return $('.content').filter('[data-id="' + dataid + '"]'); }

announcements.ui.editTitle = function (dataid) { return $('.title-edit').filter('[data-id="' + dataid + '"]'); }
announcements.ui.editContent = function (dataid) { return $('.content-edit').filter('[data-id="' + dataid + '"]'); }
announcements.ui.editTitleInput = function (dataid) { return $('.title-edit input').filter('[data-id="' + dataid + '"]'); }
announcements.ui.editContentInput = function (dataid) { return $('.content-edit textarea').filter('[data-id="' + dataid + '"]'); }

announcements.ui.editButton = function (dataid) { return $('.ctrl-edit').filter('[data-id="' + dataid + '"]'); }
announcements.ui.cancelButton = function (dataid) { return $('.ctrl-cancel').filter('[data-id="' + dataid + '"]'); }
announcements.ui.deleteButton = function (dataid) { return $('.ctrl-delete').filter('[data-id="' + dataid + '"]'); }
announcements.ui.confirmButton = function (dataid) { return $('.ctrl-confirm').filter('[data-id="' + dataid + '"]'); }
announcements.ui.container = function (dataid) { return $('.announcement').filter('[data-id="' + dataid + '"]'); }

/**
 * Edit Button Clicked callback.
 */
announcements.ui.onEditClicked = function ()
{
	announcements.ui.setEditMode($(this).data('id'), true);
}

/**
 * Cancel Button Clicked callback.
 */
announcements.ui.onCancelClicked = function ()
{
	announcements.ui.setEditMode($(this).data('id'), false);
}

/**
 * Delete Button Clicked callback.
 */
announcements.ui.onDeleteClicked = function ()
{
	if (window.confirm("Are you sure you want to delete this Announcement?"))
	{
		announcements.delete($(this).data('id'));
		announcements.ui.setEditMode($(this).data('id'), false);
	}
}

/**
 * Confirm Button Clicked callback.
 */
announcements.ui.onConfirmClicked = function ()
{
	var id = $(this).data('id');
	var title = announcements.ui.editTitleInput(id).val();
	var content = announcements.ui.editContentInput(id).val();

	var editStatus = announcements.edit(id, title, content);

	if (editStatus != true)
		$('.announcement .feedback').filter('[data-id="' + id + '"]').html("Error: " + editStatus);
	else if (editStatus == true)
		$('.announcement .feedback').filter('[data-id="' + id + '"]').html("Success: Created!");
		
	announcements.ui.setEditMode(id, false);
}

/**
 * Enables/Disables the Editing mode.
 * 
 * @param {String} id - unique identifier of Announcement.
 * @param {Boolean} flag - specify True to enable Editing.
 */
announcements.ui.setEditMode = function (id, flag)
{
	if (flag)
	{
		announcements.ui.title(id).hide();
		announcements.ui.content(id).hide();

		announcements.ui.editTitle(id).show();
		announcements.ui.editContent(id).show();
		announcements.ui.cancelButton(id).show();
		announcements.ui.confirmButton(id).show();
		announcements.ui.editButton(id).prop('disabled', true);
	}
	else
	{
		announcements.ui.title(id).show();
		announcements.ui.content(id).show();

		announcements.ui.editTitle(id).hide();
		announcements.ui.editContent(id).hide();
		announcements.ui.cancelButton(id).hide();
		announcements.ui.confirmButton(id).hide();
		announcements.ui.editButton(id).prop('disabled', false);
	}
}

/**
 * Registers event callbacks for the Announcement and adjusts UI components.
 * 
 * @param {string} id - The data-id (unique identifier) of the Announcement.
 */
announcements.ui.register = function (id)
{
	announcements.ui.editTitle(id).hide();
	announcements.ui.editContent(id).hide();
	announcements.ui.cancelButton(id).hide();
	announcements.ui.confirmButton(id).hide();

	announcements.ui.editButton(id).click(announcements.ui.onEditClicked);
	announcements.ui.cancelButton(id).click(announcements.ui.onCancelClicked);
	announcements.ui.deleteButton(id).click(announcements.ui.onDeleteClicked);
	announcements.ui.confirmButton(id).click(announcements.ui.onConfirmClicked);
}

/**
 * Prints entire UI list of Announcements.
 * 
 * @param {Object} objects - List of Announcement objects to print.
 */
announcements.ui.print = function (objects)
{
	var output = $(announcements.htmlElements.content);
	var outputString = '';

	for (key in objects)
		outputString += announcements.ui.stringify(objects[key]);
	output.html(outputString);

	$(announcements.htmlElements.content + " .announcement .nano").nanoScroller({ preventPageScrolling: true, alwaysVisible: true });

	for (key in objects)
		announcements.ui.register(objects[key].id);
}

/**
 * Appends to UI list of Announcements.
 * 
 * @param {Object} object - Announcement object to print.
 */
announcements.ui.append = function (object)
{
	var output = $(announcements.htmlElements.content);
	var outputString = output.html();

	outputString = announcements.ui.stringify(object) + outputString;
	output.html(outputString);

	$(announcements.htmlElements.content + " .announcement .nano").nanoScroller({ preventPageScrolling: true, alwaysVisible: true });
	$('.announcement').each(function () { announcements.ui.register($(this).data('id')); });
}

/**
 * Removes a specified Announcement.
 * 
 * @param {string} id - Announcement identifier.
 */
announcements.ui.remove = function (id)
{
	announcements.ui.container(id).remove();
}

/**
 * Updates an Announcement.
 * @param {String} id - Announcement identifier.
 * @param {Object} object - The Announcement JSON object.
 */
announcements.ui.update = function (id, object)
{
	announcements.ui.container(id).replaceWith(announcements.ui.stringify(object));

	announcements.ui.register(id);
	announcements.ui.setEditMode(id, false);
}

/**
 * Creates an Announcement with a REST API call.
 * 
 * @param {string} message - Content of the Announcement to create.
 * 
 * @returns {bool} - False if validation failed, otherwise true.
 */
announcements.create = function (title, message)
{
	var validStatus = announcements.validate(message);
	if (validStatus != "valid")
	{
		return validStatus;
	}
	var body = {
		'title': title,
		'content': message,
	};
	$.post('/announcements/create', body, function (data)
	{
		announcements.ui.append(data['announcement']);
	});
	return true;
}

/**
 * Deletes an existing Announcement. Updates the UI accordingly.
 * 
 * @param {String} id - The unique identifier of the Announcement.
 */
announcements.delete = function (id)
{
	$.get('/announcements/delete/' + id, null, function (data)
	{
		if (data && !('error' in data))
			announcements.ui.remove(id);
	});
}

announcements.edit = function (id, title, content)
{
	var validStatus = announcements.validate(content);
	if (validStatus != "valid")
	{
		return validStatus;
	}
	var body = {
		'title': title,
		'content': content,
	};
	$.post('/announcements/edit/' + id, body, function (data)
	{
		if (data && !('error' in data))
		{
			announcements.ui.update(id, data['announcement']);
		}
	});
	return true;
}

/**
 * Sends a GET request to `/announcements/all`.
 */
announcements.pull = function ()
{
	$.get('/announcements/all?limit=' + announcements.ui.displayLimit, null,
		/**
		 * Response callback for the GET request.
		 * 
		 * @param {object} data - The requested announcements.
		 */
		function (data)
		{
			var dataArray = [];
			for (key in data)
				dataArray.push(data[key]);

			dataArray.sort(function (a, b)
			{
				var time = [new Date(a.tstamp), new Date(b.tstamp), ];
				return time[1].getTime() - time[0].getTime();
			});
			announcements.ui.print(dataArray);
		}
	);
}

$(function ()
{
	announcements.pull();
	//setInterval(announcements.pull, 15000);
})