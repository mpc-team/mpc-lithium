
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
	this.eventObject = eventObject;
	this.html =
		"<div class='row'>" +
			"<div class='panel-group' style='margin-bottom: 7px'>" +
				"<div class='panel panel-default padded-panel-med bordered-panel shadow-med-1'>" +
					"<h3>" + eventObject.title + "</h3>" +
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