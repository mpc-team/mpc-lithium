<?php

namespace app\models;


/**
 * Any specific Notifications that need to be alerted to the
 * User appear here. Notifications are linked with specific content,
 * and act to notify Users that new content exists.
 */
class UserNotifications extends \lithium\data\Model  
{
    const FORUM = "forum";

    /**
     * Creates a new Notification for a User.
     *
     * @param int $userid User identifier.
     * @param int $contentid Content of notification.
     * @param string $type Type of notification.
     *
     * @return bool True if successful.
     */
    public static function NewNotification ($userid, $contentid, $type)
    {
        $notification = self::create(array(
            'userid' => $userid,
            'contentid' => $contentid,
            'type' => $type,
        ));
        return $notification->save();
    }

    /**
     * Returns Notifications for a specified User.
     *
     * @param int $userid User identifier.
     *
     * @return array Notifications array, or null if the query failed.
     */
    public static function GetUserNotifications ($userid)
    {
        $notifications = self::find('all', array('conditions' => array('userid' => $userid)));
        if ($notifications)
            return $notifications->to('array');
        else
            return null;
    }

    /**
     * Returns Notifications for a specified User of a specific Type.
     *
     * @param int $userid User identifier.
     * @param string $type Type of Notification.
     *
     * @return array Notifications array, or null if the query failed.
     */
    public static function GetUserNotificationsOfType ($userid, $type)
    {
        $notifications = self::find('all', array('conditions' => array('userid' => $userid, 'type' => $type)));
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
    public static function GetNotifications ($contentid, $type)
    {
        $notifications = self::find('all', array('conditions' => array('contentid' => $contentid, 'type' => $type)));
        if ($notifications)
            return $notifications->to('array');
        else
            return null;
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
}