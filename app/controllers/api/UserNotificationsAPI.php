<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\UserNotifications;
use app\models\Announcements;
use app\models\Posts;
use app\models\Threads;
use app\models\Forums;
use app\models\Users;
use app\models\Messages;

class UserNotificationsAPI extends ContentController
{

# ------------------------------------------------------------------------------------------------------

    public function all()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => null, 'status' => 500));

        if (isset($this->request->query['type']))
        {
            $limit = (isset($this->request->query['limit'])) ? $this->request->query['limit'] : null;
            switch ($this->request->query['type'])
            {
                case 'posts':
                case 'post':
                    $notifications = self::GetUserPostNotifications($authorized['id'], $limit);
                    break;
                case 'posthits':
                case 'posthit':
                    $notifications = self::GetUserPostHitNotifications($authorized['id'], $limit);
                    break;
                case 'announcements':
                case 'announcement':
                    $notifications = self::GetUserAnnouncementNotifications($authorized['id'], $limit);
                    break;
                case 'messages':
                case 'message':
                    $notifications = self::GetUserMessageNotifications($authorized['id'], $limit);
                    break;
                default:
                    $notifications = null;
                    break;
            }
        }
        else
        {
            $notifications = UserNotifications::GetUserNotifications($authorized['id']);
        }
        return $this->render(array('json' => $notifications, 'status' => 200));
    }

    /**
     * Responds with a total count on the Notifications that the authorized User
     * has. This includes Notifications for the Forum, etc.
     */
    public function count()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => null, 'status' => 500));

        $count = UserNotifications::CountUserNotifications($authorized['id']);
        return $this->render(array('json' => $count, 'status' => 200));
    }
    
    /**
     * Deletes a User Notification.
     *
     * @param int $this->request->id Notification identifier.
     * 
     * @return json Boolean whether the deletion was successful. If it wasn't
     *  then there was most likely an exception (internal error) thrown.
     */ 
    public function delete()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => null, 'status' => 500));

        if (!isset($this->request->id))
            return $this->render(array('json' => null, 'status' => 500));

        $notification = UserNotifications::Get($this->request->id);
        if ($notification && $authorized['id'] != $notification['userid'])
            return $this->render(array('json' => null, 'status' => 500));

        $deleted = UserNotifications::DeleteById($this->request->id);
        return $this->render(array('json' => $deleted, 'status' => 200));
    }


    /* Internal Behavior
    ------------------------------------------------------------------------------------------------ */

    /**
     * Retrieve Post-related Notification data for the authorized User.
     *
     * @param int $userid User identifier.
     * @param int $limit Limit number of results.
     *
     * @return array List of Notifications with the `post` attribute for related information.
     */
    private static function GetUserPostNotifications($userid, $limit)
    {
        $notifications = UserNotifications::GetUserNotificationsOfType($userid, 'post', $limit);
        foreach ($notifications as $key => $notification)
        {
            $post = Posts::Get($notification['contentid']);
            $author = Users::Get($post['uid']);
            $thread = Threads::Get($post['tid']);
            $forum = Forums::Get($thread['fid']);
            $notifications[$key]['post'] = array(
                'thread' => stripslashes($thread['name']),
                'threadid' => $thread['id'],
                'forum' => stripslashes($forum['name']),
                'content' => stripslashes($post['content']),
                'author' => stripslashes($author['alias']),
                'authorid' => $author['id'],
            );
        }
        return $notifications;
    }

    /**
     * Retrieve Post "Hit"-related Notification data for the authorized User.
     *
     * @param int $userid User identifier.
     * @param int $limit Limit number of results.
     *
     * @return array List of Notifications with the `posthit` attribute for related information.
     */
    private static function GetUserPostHitNotifications($userid, $limit)
    {
        $notifications = UserNotifications::GetUserNotificationsOfType($userid, 'posthit', $limit);
        foreach ($notifications as $key => $notification)
        {
            $post = Posts::Get($notification['contentid']);
            $sender = Users::Get($notification['senderid']);
            $thread = Threads::Get($post['tid']);
            $forum = Forums::Get($thread['fid']);
            $notifications[$key]['posthit'] = array(
                'thread' => stripslashes($thread['name']),
                'threadid' => $thread['id'],
                'forum' => stripslashes($forum['name']),
                'sender' => stripslashes($sender['alias']),
            );
        }
        return $notifications;
    }

    /**
     * Retrieve Announcement-related Notification data for the authorized User.
     *
     * @param int $userid User identifier.
     * @param int $limit Limit number of results.
     *
     * @return array List of Notifications.
     */
    private static function GetUserAnnouncementNotifications($userid, $limit)
    {
        $notifications = UserNotifications::GetUserNotificationsOfType($userid, 'announcement', $limit);
        foreach ($notifications as $key => $notification)
        {
            $announcement = Announcements::Get($notification['contentid']);
            $sender = Users::Get($notification['senderid']);
            $notifications[$key]['sender'] = $sender['alias'];
            $notifications[$key]['title'] = $announcement['title'];
            $notifications[$key]['content'] = $announcement['content'];
        }
        return $notifications;
    }

    /**
     * Retrieves Message-related Notification data for the authorized User.
     *
     * @param int $userid User identifier.
     * @param int $limit Limit number of results.
     * 
     * @return array List of Notifications.
     */
    private static function GetUserMessageNotifications ($userid, $limit)
    {
        $notifications = UserNotifications::GetUserNotificationsOfType($userid, 'message', $limit);
        foreach ($notifications as $key => $notification)
        {
            $message = Messages::Get($notification['contentid']);
            $sender = Users::Get($notification['senderid']);
            $notifications[$key]['sender'] = $sender['alias'];
            $notifications[$key]['content'] = $message['content'];
        }
        return $notifications;
    }
}