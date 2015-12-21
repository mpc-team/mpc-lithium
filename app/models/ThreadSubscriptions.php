<?php
/**
 * Thread Subscription
 *
 * When Users create Threads or respond to others' Threads, they can be
 * "subscribed" to the Thread such that they will receive notifications
 * in their Profile, as well as (optionally) through e-mail.
 */

namespace app\models;

class ThreadSubscriptions extends \lithium\data\Model  
{
    /**
     * Create a subscription entry for a User in a Thread.
     */
    public static function NewSubscription ($userid, $threadid)
    {
        // If the User is already subscribed then ignore.
        if (self::find('first', array('conditions' => array(
                'userid' => $userid, 
                'threadid' => $threadid
            ))))
            return false;

        $tsub = self::create(array(
            'threadid' => $threadid, 
            'userid' => $userid
        ));
        return $tsub->save();
    }

    /**
     * Retrieves a ThreadSubscription by ID.
     *
     * @param 
     */
    public static function GetByThread ($threadid)
    {
        if ($tsub = self::find('all', array('conditions' => array('threadid' => $threadid))))
            return $tsub->to('array');
        else
            return null;
    }

    /** 
     * Deletes all Subscriptions associated with a Thread.
     *
     * @param int $threadid Thread identifier.
     *
     * @return bool True if deleted.
     */
    public static function DeleteByThread ($threadid)
    {
        $subscriptions = self::find('all', array('conditions' => array('threadid' => $threadid)));
        if ($subscriptions)
            return $subscriptions->delete();
        else
            return false;
    }

    /**
     * Retrieve all ThreadSubscriptions by a specific User.
     *
     * @param int $userid User identifier.
     *
     * @return array List of subscriptions for the User.
     */
    public static function GetByUser ($userid)
    {
        if ($tsub = self::find('all', array('conditions' => array('userid' => $userid))))
            return $tsub->to('array');
        else
            return null;
    }

    /**
     * Whether a User is subscribed to a Thread.
     *
     * @param int $userid User identifier.
     * @param int $threadid Thread identifier.
     *
     * @return bool True if subscribed.
     */
    public static function IsSubscribed ($userid, $threadid)
    {
        $subsc = self::find('first', array('conditions' => array(
            'userid' => $userid, 'threadid' => $threadid)));
        if ($subsc)
            return true;
        else
            return false;
    }
}