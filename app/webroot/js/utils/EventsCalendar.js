/**
 * Events Calendar
 * 
 * 
 */

// Namespace.
var EventsCalendar = {};

/**
 * This element is queried with jQuery and used to parent the Calendar components.
 * This criteria would appear in an HTML template.
 */ 
EventsCalendar.element = "#calendar";

EventsCalendar.requestEvents = function (callback)
{
	$.get('/api/events', null, callback);
}

/**
 * Inserts an Event into a specified Calendar configuration object.
 * 
 * @param {object} calendar: The Calendar config object.
 * @param {string} title: Title of the Event.
 * @param {string} start: Start-time.
 * @param {string} end: End-time.
 */
EventsCalendar.insertEvent = function (calendar, title, start, end)
{
	var event = {
		'title': title,
		'start': start,
		'end': end,
	};
	calendar['events'].push(event);
}

/**
 * Returns a default configuration object for a Calendar. No events are configured
 * by default, and need to be added to the Calendar.
 * 
 * @returns {object}: Default Calendar configuration.
 */
EventsCalendar.createDefault = function ()
{
	var obj = {
		'header': {
			'left': 'prev,next today',
			'center': 'title',
			'right': 'month,agendaWeek,agendaDay',
		},
		'defaultDate': '2016-01-01',
		'editable': false,
		'eventLimit': true,
		'events': [],
	};
	return obj;
}

// Initialization.
$(function ()
{
	EventsCalendar.requestEvents(function (events)
	{
		var calendar = EventsCalendar.createDefault();
		for (key in events)
		{
			var event = events[key];

			EventsCalendar.insertEvent(calendar, event['title'], event['start'], event['end']);
		}
		$(EventsCalendar.element).fullCalendar(calendar);
	});
});