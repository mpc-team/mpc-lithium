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
		$time = strtotime($timestamp);
		
		$datestring  = "F jS Y";
		if (in_array('time', $options)) {
			$datestring .= " - g:i A";
		}
		if (in_array('day', $options)) {
			$datestring = "D, " . $datestring;
		}
		return date($datestring, $time);
	}
}