<?php

namespace app\models;

class Timestamp extends \lithium\data\Model  { 
/**
 * class Timestamp
 *
 *	Timestamp information that is obtained from our Database should be
 *	filtered through this class. As an example, the following controllers currently
 *	filter timestamps through this function:
 *
 *	'ForumController', 'BoardController', 'ThreadController', 'ProfileController'
 *
 *	The above controllers pass timestamp information to the view from Threads
 *	and Messages; the view does not know the format that should be displayed, it
 *	will simply print what it gets from the controller.
 */
	const DAY_IN_SECONDS = 86400;
 
	public static function toDisplayFormat($timestamp, $options = array()) {
	/**
	 * toDisplayFormat
	 *	
	 *	Converts timestamp data into a formatted Date string. We can apply conditional
	 *	date processing, such as only displaying the TIME portion if the Message was created
	 *	on the current day.
	 */
		$time = strtotime($timestamp);
		$current = time();
		
		$datestring  = "j F Y";
		if (in_array('time', $options)) {
			$datestring .= " - g:i A";
		}
		if (in_array('day', $options)) {
			$datestring = "D, " . $datestring;
		}
		return date($datestring, $time);
	}
}