<?php

namespace app\models;


/**
 * Any specific Notifications that need to be alerted to the
 * User appear here. Notifications are linked with specific content,
 * and act to notify Users that new content exists.
 */
class UserNotifications extends \lithium\data\Model  
{
    const POST = "post";
    const POST_HIT = "posthit";
    const FORUM = "forum";
    const ANNOUNCEMENT = "announcement";
    const MESSAGE = "message";
    const CLAN_INVITE = "claninvite";

    /**
     * Returns a User Notification searching by its identifier.
     *
     * @param int $id Notification identifier.
     *
     * @return object User Notification object.
     */
    public static function Get ($id)
    {
        $notification = self::find('first', array('conditions' => array('id' => $id)));
        if ($notification)
            return $notification->to('array');
        else
            return null;
    }
    
    /**
     * Creates a new Notification for a User.
     *
     * @param int $userid User identifier.
     * @param int $contentid Content of notification.
     * @param string $type Type of notification.
     *
     * @return bool True if successful.
     */
    public static function NewNotification ($userid, $contentid, $type, $senderid = null)
    {
        $notification = self::create(array(
            'userid' => $userid,
            'contentid' => $contentid,
            'type' => $type,
            'senderid' => $senderid,
        ));
        return $notification->save();
    }

    /**
     * Deletes a User Notification by its identifier.
     *
     * @param int $id Notification identifier.
     *
     * @return bool True for successful.
     */
    public static function DeleteById ($id)
    {
        if ($notification = self::find('first', array('conditions' => array('id' => $id))))
        {
            return $notification->delete();
        }
        return false;
    }

    /**
     * Deletes a specific Notification for a User.
     *
     * @param int $userid User identifier.
     * @param int $contentid Content identifier.
     * @param string $type Type of Notification.
     *
     * @return bool True if successful.
     */
    public static function DeleteNotification ($userid, $contentid, $type)
    {
        $notification = self::find('first', array('conditions' => array(
            'userid' => $userid,
            'contentid' => $contentid,
            'type' => $type
        )));
        if ($notification)
            return $notification->delete();
        else
            return false;
    }

    /**
     * Deletes Notifications for specified Content.
     *
     * @param int $contentid Content identifier.
     * @param string $type Type of Notification.
     *
     * @return bool True if deleted.
     */
    public static function DeleteNotifications ($contentid, $type)
    {
        $notifications = self::find('all', array('conditions' => array('contentid' => $contentid, 'type' => $type)));
        if ($notifications)
            return $notifications->delete();
        else
            return false;
    }

    /**
     * Returns Notifications for a specified User.
     *
     * @param int $userid User identifier.
     *
     * @return array Notifications array, or null if the query failed.
     */
    public static function GetUserNotifications ($userid, $limit = null)
    {
        $conditions = array('userid' => $userid);
        if ($limit != null)
            $notifications = self::find('all', array('conditions' => $conditions, 'limit' => $limit, 'order' => array('tstamp' => 'DESC')));
        else
            $notifications = self::find('all', array('conditions' => $conditions, 'order' => array('tstamp' => 'DESC')));

        if ($notifications)
            return $notifications->to('array');
        else
            return null;
    }

    /**
     * Count of Notifications of any Type for a specified User.
     *
     * @param int $userid User identifier.
     *
     * @return int Number of Notifications.
     */
    public static function CountUserNotifications ($userid)
    {
        return self::count('all', array('conditions' => array('userid' => $userid)));
    }

    /**
     * Returns Notifications for a specified User of a specific Type.
     *
     * @param int $userid User identifier.
     * @param string $type Type of Notification.
     *
     * @return array Notifications array, or null if the query failed.
     */
    public static function GetUserNotificationsOfType ($userid, $type, $limit = null)
    {
        $conditions = array('userid' => $userid, 'type' => $type);
        if ($limit != null)
            $notifications = self::find('all', array('conditions' => $conditions, 'limit' => $limit, 'order' => array('tstamp' => 'DESC')));
        else
            $notifications = self::find('all', array('conditions' => $conditions, 'order' => array('tstamp' => 'DESC')));

        if ($notifications)
            return $notifications->to('array');
        else
            return null;
    }
    
    /**
     * Returns Notifications for specified Content.
     *
     * @param int $contentid Content identifier.
     * @param string $type Type of notification.
     *
     * @return array Notifications of the specified type for the specified Content.
     */
    public static function GetNotifications ($contentid, $type, $limit = null)
    {
        $conditions = array('contentid' => $contentid, 'type' => $type);
        if ($limit != null)
            $notifications = self::find('all', array('conditions' => $conditions, 'limit' => $limit, 'order' => array('tstamp' => 'DESC')));
        else
            $notifications = self::find('all', array('conditions' => $conditions, 'order' => array('tstamp' => 'DESC')));

        if ($notifications)
            return $notifications->to('array');
        else
            return null;
    }
}