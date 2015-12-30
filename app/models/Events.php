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

    public static function All ($limit)
    {
        $events = self::find('all', array('limit' => $limit));
        if ($events)
            return $events->to('array');
        else
            return null;
    }
}
