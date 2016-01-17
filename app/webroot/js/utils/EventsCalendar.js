/**
 * Events Calendar
 * 
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
EventsCalendar.UI.Elements.Inputs.StartDate = "#event-start-datepicker";
EventsCalendar.UI.Elements.Inputs.FinishDate = "#event-end-datepicker";


//----------------------------------------------------------------------------------------------------------

EventsCalendar.RequestEvents = function (callback)
{
	$.get('/api/events', null, callback);
}

EventsCalendar.SaveEvent = function (eventData, callback)
{
	$.post('/api/events/create', eventData, callback);
}

//----------------------------------------------------------------------------------------------------------

EventsCalendar.Callbacks = {};
EventsCalendar.Callbacks.CreateEvent = function ()
{
	var bodyData = {};
	var startDate = $(EventsCalendar.UI.Elements.Inputs.StartDate).data("DateTimePicker").date().format("MMMM Do YYYY hh:mm:ss");
	var endDate = $(EventsCalendar.UI.Elements.Inputs.FinishDate).data("DateTimePicker").date().format("MMMM Do YYYY hh:mm:ss");

	bodyData.title = $(EventsCalendar.UI.Elements.Inputs.Title).val();
	bodyData.start = startDate;
	bodyData.finish = endDate;

	$(EventsCalendar.UI.Elements.Inputs.Title).val("");

	EventsCalendar.SaveEvent(bodyData, function (savedEvent)
	{
		console.log(savedEvent);

		$(EventsCalendar.UI.Elements.Inputs.Title).val("");
		$(EventsCalendar.UI.Elements.Modal).modal('hide');
	});
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
EventsCalendar.Insert = function (calendar, title, start, end)
{
	var event = {
		'title': title,
		'start': start,
		'end': end,
	};
	console.log(event);
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
	var obj = {
		'header': {
			'left': 'prev,next',
			'center': 'title',
			'right': null,
		},
		'defaultDate': '2016-01-01',
		'editable': false,
		'eventLimit': true,
		'events': [],
	};
	return obj;
}

//----------------------------------------------------------------------------------------------------------

// Initialization.
$(function ()
{
	// Populate Current Events.
	EventsCalendar.RequestEvents(function (events)
	{
		console.log(events);

		var calendar = EventsCalendar.CreateDefault();
		for (key in events)
		{
			var event = events[key];

			EventsCalendar.Insert(calendar, event['title'], event['start'], event['end']);
		}
		$(EventsCalendar.UI.Elements.Container).fullCalendar(calendar);
	});

	// Register Event Callbacks.
	$(EventsCalendar.UI.Elements.CreateEvent).click(EventsCalendar.Callbacks.CreateEvent);
});