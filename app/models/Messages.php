<?php

namespace app\models;

class Messages extends \lithium\data\Model  {

	/**
	 * getUserMessages
	 *
	 * Returns array-formatted list of messages which have been received by a user specified by ID.
	 */
	public static function getUserMessages ($id) {
		return Messages::find('all', array(
			'conditions' => array('uidreceiver' => $id),
			'order' => array('tstamp' => 'ASC')
		))->to('array');
	}

	/**
	 * send
	 *
	 * Constructs a message given a set of parameters and saves it to the database. In order to view
	 * the message(s) a server request for the user's messages must be made.
	 */
	public static function send ($type, $sender, $receiver, $content) {
		$result = -1;
		if ($content != null) {
			$cleanedContent = self::clean($content);
			if (strlen($cleanedContent) > 0) {		
				$message = self::create(array(
					'uidsender' => $sender,
					'uidreceiver' => $receiver,
					'content' => $cleanedContent,
					'type' => $type
				));
				if ($message->save()) {
					$result = $message->id;
				}
			}
		}
		return $result;
	}

	public static function clean ($text) {
		$text = trim($text);
		$text = str_replace('\r\n', '', $text);
		$text = str_replace('\n', '', $text);
		$text = str_replace('\r', '', $text);
		return strip_tags($text);
	}
}
