<?php

namespace app\models;

class Messages extends \lithium\data\Model  
{
	public static function GetUserMessages ($id, $limit) 
    {
		return self::find('all', array(
			'conditions' => array('uidreceiver' => $id),
			'order' => array('tstamp' => 'DESC'),
            'limit' => $limit,
		))->to('array');
	}
	
	public static function Send ($type, $sender, $receiver, $content) 
    {
		$result = -1;
		if ($content != null) 
        {
			$cleanedContent = self::CleanMessage($content);
			if (strlen($cleanedContent) > 0) 
            {		
				$message = self::create(array(
					'uidsender' => $sender,
					'uidreceiver' => $receiver,
					'content' => $cleanedContent,
					'type' => $type
				));

				if ($message->save())
					$result = $message->id;
			}
		}
		return $result;
	}

	public static function CleanMessage ($text) 
    {
		$text = trim($text);
		$text = str_replace('\r\n', '', $text);
		$text = str_replace('\n', '', $text);
		$text = str_replace('\r', '', $text);
		return strip_tags($text);
	}
}
