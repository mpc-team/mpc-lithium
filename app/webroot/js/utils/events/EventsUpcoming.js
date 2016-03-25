
/* Namespace Declaration */
var EventsUpcoming = {};

/* Network Requests
------------------------------------------------------------------------------------------------ */

/* Request Upcoming Events from the Server */
EventsUpcoming.RequestEventsLimit = 5;
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
	var startFormat = (startDate.format('mm') == '00') ? 'hA' : 'h:mmA';
	var endFormat = (endDate.format('mm') == '00') ? 'hA' : 'h:mmA';
	var dateFormat = 'dddd, MMM. Do YYYY';
	var description = (eventObject.description != null) ? eventObject.description : "";
	this.eventObject = eventObject;
	this.html =
	"<div class='row'>" +
		"<div class='panel-group' style='margin-bottom: 7px'>" +
			"<div class='panel panel-default bordered-panel shadow-med-1'>" +
				"<div class='panel-heading'>" +
					"<center>" +
						"<h3>" + eventObject.title + "</h3>" +
					"</center>" +
				"</div>" +
				"<center>" +
					"<p style='padding:10px; font-size: 9pt; margin:0;'>" +
						description +
					"</p>" +
				"</center>" +
				"<div class='panel-footer'>" +
					"<center>" +
						"<br />" +
						"<p style='font-size: 10pt; margin-bottom:0; padding: 3px 5px;'>" +
							startDate.format(dateFormat) + " at " + startDate.format(startFormat) + "<br />" +
							"to" + "<br />" +
							endDate.format(dateFormat) + " at " + endDate.format(endFormat) + "<br />" +
						"</p>" +
						"<p style='font-size: 9pt; margin-bottom: 0;'>" +
							"(" + duration + ")" +
						"</p>" +
						"<br />" +
					"</center>" +
				"</div>" +
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