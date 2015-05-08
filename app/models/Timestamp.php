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
	const DAY_IN_SECONDS = 60 * 60 * 24;
 
	public static function toDisplayFormat($timestamp) {
	/**
	 * toDisplayFormat
	 *	
	 *	Converts timestamp data into a formatted Date string. We can apply conditional
	 *	date processing, such as only displaying the TIME portion if the Message was created
	 *	on the current day.
	 */
		$time = strtotime($timestamp);
		$current = time();
		
		if (($current - $time) > self::DAY_IN_SECONDS) {
			$datestring = "D, d M Y";
		} else {
			$datestring = "D, d M Y g:i:s A";
		}
		return date($datestring, $time);
	}
}