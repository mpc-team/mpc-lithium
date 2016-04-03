<?php

namespace app\models;

class Timestamp extends \lithium\data\Model  
{ 
    /* Number of seconds in a Day */
	const DAY_IN_SECONDS = 86400;
 
	/**
	 * Transforms a Date/Time from a Database into a prseentable form.
     * @params
     *  $timestamp: The Date/Time reference.
     *  $options: Options for the output format.
     * @returns
     *  Returns a PHP Date/Time object.
     */
	public static function toDisplayFormat($timestamp, $options = array()) 
    {
        // Working-set of the format-string.
		$datestring  = "F jS Y";

        // `time-if-today` option specifies the `time` option if the day is today.
        if (in_array('time-if-today', $options))
            if (self::IsDateToday($timestamp))
                array_push($options, 'time'); 

        // `time` option prints the specified time as well.
		if (in_array('time', $options))
			$datestring .= ", g:i A";

        // `day` option appends the full day before everything.
		if (in_array('day', $options))
			$datestring = "D, " . $datestring;

        // Return PHP format date.
		return date($datestring, strtotime($timestamp));
	}

    /**
     * Determines if a specified Date/Time is today.
     * @params
     *  $timestamp: Date/Time referenece.
     * @returns
     *  True if Date/Time is today, otherwise False.
     */
    private static function IsDateToday ($timestamp)
    {
        $today = date('dmY');
        $date = date('dmY', strtotime($timestamp));

        return $today == $date;
    }
}