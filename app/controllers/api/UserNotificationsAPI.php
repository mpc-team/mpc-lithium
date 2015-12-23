<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;
use app\models\UserNotifications;
use app\models\Posts;
use app\models\Threads;
use app\models\Forums;
use app\models\Users;

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
                    $notifications = UserNotificationsAPI::GetUserPostNotifications($authorized['id'], $limit);
                    break;
            }
        }
        else
        {
            $notifications = UserNotifications::GetUserNotifications($authorized['id']);
        }
        return $this->render(array('json' => $notifications, 'status' => 200));
    }

    public function count()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => null, 'status' => 500));

        $count = UserNotifications::CountUserNotifications($authorized['id']);
        return $this->render(array('json' => $count, 'status' => 200));
    }
    
# ------------------------------------------------------------------------------------------------------

    /**
     * Retrieves information for Notifications associated with a Forum Post.
     *
     * @param int $userid User identifier.
     * @param int $limit Limit number of results.
     *
     * @return array List of Notifications with the `post` attribute for storing information.
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

}