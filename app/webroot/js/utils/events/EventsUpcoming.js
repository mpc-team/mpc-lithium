
/* Namespace Declaration */
var EventsUpcoming = {};

/* Network Requests
------------------------------------------------------------------------------------------------ */

/* Request Upcoming Events from the Server */
EventsUpcoming.RequestEventsLimit = '10';
EventsUpcoming.RequestEventsUri = '/api/events/upcoming?limit=' + EventsUpcoming.RequestEventsLimit;
EventsUpcoming.RequestEvents = function (callback) { $.get(EventsUpcoming.RequestEventsUri, null, callback); }

/* JQuery Render
------------------------------------------------------------------------------------------------ */

/* UI Namespace Declaration */
EventsUpcoming.UI = {};

/**
 * Initializes the HTML associated with an Event.
 * 
 * @param {Object} eventObject: The Event object to generate UI data for.
 */
EventsUpcoming.UI.Event = function (eventObject)
{
	var startDate = moment(new Date(eventObject.start));
	var endDate = moment(new Date(eventObject.end));
	var duration = endDate.from(startDate, true);
	var startFormat = (startDate.format('mm') == '00') ? 'h A' : 'h:mm A';
	var endFormat = (endDate.format('mm') == '00') ? 'h A' : 'h:mm A';
	var dateFormat = 'dddd, MMM. Do YYYY';
	var description = (eventObject.description != null) ? eventObject.description : "";
	this.eventObject = eventObject;
	this.html =
	"<div class='row'>" +
		"<div class='panel-group' style='margin-bottom: 7px'>" +
			"<div class='panel panel-default padded-panel-med bordered-panel shadow-med-1'>" +
				"<h3>" + eventObject.title + "</h3>" +
				"<p>" + description + "</p>" +
				"<p style='font-size: 9pt'><strong>Starts:</strong> " + startDate.format(dateFormat) + " at " + startDate.format(startFormat) + "<br />" +
				"<strong>Ends:</strong> " + endDate.format(dateFormat) + " at " + endDate.format(endFormat) + "<br />" +
				"<strong>Duration:</strong> " + duration + "</p>" +
			"</div>" +
		"</div>" +
	"</div>";
}

/* Initialization
------------------------------------------------------------------------------------------------ */

EventsUpcoming.Initialize = function (id)
{
	EventsUpcoming.RequestEvents(function (response)
	{
		var htmlToRender = "";
		for (key in response)
		{
			eventUI = new EventsUpcoming.UI.Event(response[key]);
			htmlToRender += eventUI.html;
		}
		$(id).html(htmlToRender);
	});
}