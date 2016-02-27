/**
 * Events Calendar
 * 
 * Automatically fills a Calendar with Events from the Database. The "Container" element 
 * is, as the name suggests, the container where the Calendar HTML is written.
 * 
 */

// Namespace.
var EventsCalendar = {};

//----------------------------------------------------------------------------------------------------------

EventsCalendar.UI = {};
EventsCalendar.UI.Elements = {};

EventsCalendar.UI.Elements.CreateEvent = '#create-event';
EventsCalendar.UI.Elements.Container = "#calendar";
EventsCalendar.UI.Elements.Modal = "#modal-newevent";

EventsCalendar.UI.Elements.Inputs = {};
EventsCalendar.UI.Elements.Inputs.Title = "#event-title";
EventsCalendar.UI.Elements.Inputs.Description = "#event-description";
EventsCalendar.UI.Elements.Inputs.StartDate = "#event-start-datepicker";
EventsCalendar.UI.Elements.Inputs.FinishDate = "#event-end-datepicker";
EventsCalendar.UI.Elements.Inputs.Link = '#event-link';

/* Network Gateway
------------------------------------------------------------------------------------------------------------ */

EventsCalendar.RequestEvents = function (callback)
{
	$.get('/api/events', null, callback);
}

EventsCalendar.SaveEvent = function (eventData, callback)
{
	$.post('/api/events/create', eventData, callback);
}

//----------------------------------------------------------------------------------------------------------

/**
 * Inserts an Event into a specified Calendar configuration object.
 * 
 * @param {object} calendar: The Calendar config object.
 * @param {string} title: Title of the Event.
 * @param {string} start: Start-time.
 * @param {string} end: End-time.
 */
EventsCalendar.Insert = function (calendar, title, start, end, link)
{
	var event = {
		title: title,
		start: start,
		end: end,
		url: link,
	};
	calendar['events'].push(event);
}

/**
 * Returns a default configuration object for a Calendar. No events are configured
 * by default, and need to be added to the Calendar.
 * 
 * @returns {object}: Default Calendar configuration.
 */
EventsCalendar.CreateDefault = function ()
{
	var today = new Date();
	var obj =
	{
		'header':
		{
			'left': 'prev,next today',
			'center': 'title',
			'right': 'month,agendaWeek,agendaDay',
		},
		'defaultDate': today,
		'editable': false,
		'eventLimit': true,
		'eventClick': EventsCalendar.OnEventClicked,
		'events': [],
	};
	return obj;
}

/* Event Callbacks
------------------------------------------------------------------------------------------------------------ */

EventsCalendar.Callbacks = {};
EventsCalendar.Callbacks.CreateEvent = function ()
{
	var bodyData = {};
	var startDate = $(EventsCalendar.UI.Elements.Inputs.StartDate).data("DateTimePicker").date().format("MMMM Do YYYY hh:mm:ss");
	var endDate = $(EventsCalendar.UI.Elements.Inputs.FinishDate).data("DateTimePicker").date().format("MMMM Do YYYY hh:mm:ss");

	bodyData.title = $(EventsCalendar.UI.Elements.Inputs.Title).val();
	bodyData.start = startDate;
	bodyData.finish = endDate;
	bodyData.link = $(EventsCalendar.UI.Elements.Inputs.Link).val();
	bodyData.description = $(EventsCalendar.UI.Elements.Inputs.Description).val();

	$(EventsCalendar.UI.Elements.Inputs.Title).val("");
	$(EventsCalendar.UI.Elements.Inputs.Link).val("");

	EventsCalendar.SaveEvent(bodyData, function (savedEvent)
	{
		$(EventsCalendar.UI.Elements.Inputs.Title).val("");
		$(EventsCalendar.UI.Elements.Modal).modal('hide');

		if (EventsCalendar.Calendar != null)
		{
			EventsCalendar.Initialize();
			$(EventsCalendar.UI.Elements.Container).fullCalendar('destroy');
			$(EventsCalendar.UI.Elements.Container).fullCalendar('render');
		}
	});
}

/**
 * Callback when an Event is clicked. By default, the URL property that 
 * was specified in each Event causes the Event to be treated as a link.
 * 
 * @param {Object} event: The Event object passed into the Calendar.
 * @returns {bool}: True when the browser needs to be redirected.
 */
EventsCalendar.OnEventClicked = function (event)
{
	if (event.url != null)
		return true;
	else
		return false;
}

/* Initialization
---------------------------------------------------------------------------------------------------- */

/**
 * Initializes the EventCalendar with Events pulled from the server.
 */
EventsCalendar.Initialize = function ()
{
	EventsCalendar.RequestEvents(function (events)
	{
		var calendar = EventsCalendar.CreateDefault();
		for (key in events)
		{
			var event = events[key];
			EventsCalendar.Insert(calendar, event['title'], event['start'], event['end'], event['linkref']);
		}
		EventsCalendar.Calendar = calendar;
		$(EventsCalendar.UI.Elements.Container).fullCalendar(EventsCalendar.Calendar);
	});
}

$(function ()
{
	EventsCalendar.Initialize();

	// Register Event Callbacks.
	$(EventsCalendar.UI.Elements.CreateEvent).click(EventsCalendar.Callbacks.CreateEvent);
});