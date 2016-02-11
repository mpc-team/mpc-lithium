<?php

namespace app\models;

abstract class MessageTypes
{
    const TEXT = "text";
    const CLAN_INVITE = "claninvite";
}

class Messages extends \lithium\data\Model  
{
    public static function Get ($id)
    {
        $message = self::find('first', array('conditions' => array('id' => $id)));
        if ($message)
            return $message->to('array');
        else
            return null;
    }

	public static function GetUserMessages ($id, $limit) 
    {
		return self::find('all', array(
			'conditions' => array('uidreceiver' => $id, 'type' => 'text'),
			'order' => array('tstamp' => 'DESC'),
            'limit' => $limit,
		))->to('array');
	}

    public static function GetUserClanInvites ($id, $limit)
    {
        return self::find('all', array(
            'conditions' => array('uidreceiver' => $id, 'type' => 'claninvite'),
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
                {
                    $result = $message->id;
                }
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
