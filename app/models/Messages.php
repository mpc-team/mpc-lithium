<?php

namespace app\models;

class Messages extends \lithium\data\Model  
{
    /* Types
    -------------------------------------------------------------------------------------------- */
    
    const TEXT = "text";
    const CLAN_INVITE = "claninvite";

    /* Basic Utility
    -------------------------------------------------------------------------------------------- */

    public static function Get ($id)
    {
        $message = self::find('first', array('conditions' => array('id' => $id)));
        if ($message)
            return $message->to('array');
        else
            return null;
    }

	public static function GetUserMessages ($id, $limit = null) 
    {
		return self::find('all', array(
			'conditions' => array('uidreceiver' => $id, 'type' => 'text'),
			'order' => array('tstamp' => 'DESC'),
            'limit' => $limit,
		))->to('array');
	}

    public static function GetUserClanInvites ($id, $limit = null)
    {
        return self::find('all', array(
            'conditions' => array('uidreceiver' => $id, 'type' => 'claninvite'),
            'order' => array('tstamp' => 'DESC'),
            'limit' => $limit,
        ))->to('array');
    }
	
    /* Send Message
    -------------------------------------------------------------------------------------------- */

    /**
     * Sends a Message to a sepcified `receiver` from a specified `sender`.
     * Messages may contain content and be of several different types.
     *
     * @param string $type Type of Message.
     * @param int $sender User identifier of Sender.
     * @param int $receiver User identifier of Receiver.
     * @param string $content Content of the Message.
     *
     * @return int Returns the ID of the Message created, or -1 if unsuccessful.
     */
	public static function Send ($type, $sender, $receiver, $content, $idtag = null) 
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
					'type' => $type,
                    'idtag' => $idtag
				));
				if ($message->save())
                    $result = $message->id;
			}
		}
		return $result;
	}

    /**
     * Cleans the contents of the Message of any extraneous newline
     * and carriage return characters. Also strips any embedded HTML.
     *
     * @param string $text The text to clean.
     *
     * @return string Cleand text.
     */
	private static function CleanMessage ($text) 
    {
		$text = trim($text);
		$text = str_replace('\r\n', '', $text);
		$text = str_replace('\n', '', $text);
		$text = str_replace('\r', '', $text);
		return strip_tags($text);
	}
    
    /* User Invitations
    -------------------------------------------------------------------------------------------- */

    /**
     * Accepts an invitational Message. The resource being invited to is specified as
     * an `idtag` in the Message itself. Accepting an invitation deletes the Message.
     *
     * @param int $userid User identifier.
     * @param int $messageid Message (invitation) identifier.
     *
     * @return bool True if accepted successfully.
     */
    public static function AcceptInvite ($messageid)
    {
        $message = self::find('first', array('conditions' => array('id' => $messageid)));
        if ($message == null)
            return false;

        if ($message->type == self::CLAN_INVITE)
            return UserClans::AddUser($message->idtag, $message->uidreceiver, UserClans::RANK_MEMBER) && $message->delete();
        else
            return false;
    }

    /**
     * Declines an invitational Message.
     *
     * @param int $messageid Message (invite) identifier.
     *
     * @return bool True if declined successfully.
     */
    public static function DeclineInvite ($messageid)
    {
        $message = self::find('first', array('conditions' => array('id' => $messageid)));
        if ($message == null)
            return false;

        if ($message->type == self::CLAN_INVITE)
            return $message->delete();
        else
            return false;
    }

    /**
     * Delete any type of pending invite by an `idtag` associated with it.
     *
     * @param int $idtag Invite resource identifier.
     *
     * @return bool True on successful deletion.
     */
    public static function DeletePendingInvites ($idtag)
    {
        return self::remove(array('idtag' => $idtag));
    }

    /**
     * Deletes all pending invites associated with a specific Clan. Same thing as
     * `DeletePendingInvites` with the added `type` check.
     *
     * @param int $clanid Clan identifier.
     *
     * @return bool True on successful deletion.
     */
    public static function DeletePendingClanInvites ($clanid)
    {
        return self::remove(array('type' => self::CLAN_INVITE, 'idtag' => $clanid));
    }

    /**
     * Delete all Clan invites sent to a specific User.
     *
     * @param int $userid user identifier.
     *
     * @return bool True on successful deletion.
     */
    public static function DeleteUserClanInvites ($userid)
    {
        return self::remove(array('type' => self::CLAN_INVITE, 'uidreceiver' => $userid));
    }
}
