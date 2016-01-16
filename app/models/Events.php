<?php

namespace app\models;

class Events extends \lithium\data\Model  
{
	public static function Get ($eventid)
    {
        $event = self::find('first', array('conditions' => array('id' => $eventid)));
        if ($event)
            return $event->to('array');
        else
            return null;
    }

    /**
     * Returns all Events.
     *
     * @param int $limit Limit number of results.
     *
     * @return array Event objects in an array.
     */
    public static function All ($limit)
    {
        $events = self::find('all', array('limit' => $limit));
        if ($events)
            return $events->to('array');
        else
            return null;
    }

    /**
     * Creates a new Events entry with some criteria.
     *
     * @param string $title Title of the Event.
     * @param string $startDate Starting Date/Time of the Event.
     * @param string $finishDate Ending Date/Time of the Event.
     *
     * @return array On success, returns the saved Event object (as array).
     */
    public static function NewEvent ($title, $startDate, $finishDate)
    {
        $event = self::create(array(
            'title' => $title,
            'start' => $startDate,
            'end' => $finishDate,
        ));
        if ($event->save())
            return $event->to('array');
        else
            return null;
    }
}
