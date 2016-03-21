<?php

namespace app\controllers;

use lithium\security\Auth;

use app\models\UserNotifications;
use app\models\Users;
use app\models\Permissions;
use app\models\Announcements;

class AnnouncementsController extends ContentController 
{
    
    /**
     * Validates the input received to create an Announcement.
     * 
     * @param mixed $content - The input being validated, as a string.
     * 
     * @return bool - True if the Announcement content is valid.
     */
    public static function validate($content)
    {
        return strlen($content) > 0;
    }

    /**
     * Creates an Announcement authored by the currently authorized User.
     * 
     * @param $this->request->data - The message content of the Announcement.
     * 
     * @return {JSON}: Object result of the operation, serialized in JSON.
     */
    public function create()
    {
        $authorized = Auth::check('default');
        if (!Permissions::is_admin($authorized))
        {
            $result = array('error' => 'Insufficient Permissions',);
            return $this->render(array('json' => $result, 'status' => '500'));
        }
        
        $content = Announcements::CleanContent($this->request->data['content']);
        $title = Announcements::CleanTitle($this->request->data['title']);

        if (!self::validate($content))
        {
            $result = array('error' => 'Invalid Parameters',);
            return $this->render(array('json' => $result, 'status' => '500'));
        }

        if (strlen($title) == 0)
            $title = null;

        $announcement = Announcements::create(array(
            'title' => $title,
            'content' => $content,
            'authorid' => $authorized['id'],
        ));

        if ($announcement->save())
        {
            // Go through all Users (except for the one making the Announcement) and create a Notification for them.
            $allUsers = Users::All();
            foreach ($allUsers as $user)
                if ($user['id'] != $authorized['id'])
                    UserNotifications::NewNotification($user['id'], $announcement->id, UserNotifications::ANNOUNCEMENT, $authorized['id']);            

            $created = Announcements::Get($announcement->id);
            $created['author'] = Users::Get($created['authorid']);
            if ($created['author'])
                $created['author'] = $created['author']['alias'];
            $created['content'] = stripslashes($created['content']);

            $result = array('announcement' => $created);
            return $this->render(array('json' => $result, 'status' => '200'));
        }
        else
        {
            $result = array('error' => 'Unable to Create Announcement',);
            return $this->render(array('json' => $result, 'status' => '500'));
        }
    }

    /**
     * Edits an Announcement by a specified identifier.
     *
     * @param string $this->request->id Identifier of the Announcement.
     * @param mixed $this->request->data List of arguments for operation.
     *
     * @return {JSON}: Returns the updated Announcement object.
     */
    public function edit()
    {
        if (!isset($this->request->id))
        {
            $result = array('error' => 'Insufficient Arguments.');
            return $this->render(array('json' => $result, 'status' => '500'));
        }
        $id = $this->request->id;

        $authorized = Auth::check('default');
        if (!Permissions::is_admin($authorized))
        {
            $result = array('error' => 'Insufficient Permissions');
            return $this->render(array('json' => $result, 'status' => '500'));
        }
        
        $content = Announcements::CleanContent($this->request->data['content']);
        $title = Announcements::CleanTitle($this->request->data['title']);

        if (!self::validate($content))
        {
            $result = array('error' => 'Invalid Parameters',);
            return $this->render(array('json' => $result, 'status' => '500'));
        }

        if (!Announcements::Edit($id, $title, $content))
        {
            $result = array('error' => 'Unable to Edit',);
            return $this->render(array('json' => $result, 'status' => '500'));
        }

        $updated = Announcements::Get($id);
        $updated['author'] = Users::Get($updated['authorid']);
        if ($updated['author'])
            $updated['author'] = $updated['author']['alias'];
        $updated['content'] = stripslashes($updated['content']);
        $result = array('announcement' => $updated);

        return $this->render(array('json' => $result, 'status' => 200));
    }

    /**
     * Deletes an Announcement by a specified identifier.
     *
     * @param $this->request->id - The identifier of the Announcement.
     *
     * @return {JSON}: Value `true`, or an Object with an "error" field.
     */
    public function delete()
    {
        if (!isset($this->request->id))
        {
            $result = array('error' => 'Insufficient Arguments.');
            return $this->render(array('json' => $result, 'status' => '500'));
        }
        $id = $this->request->id;

        $authorized = Auth::check('default');
        if (!Permissions::is_admin($authorized))
        {
            $result = array('error' => 'Insufficient Permissions');
            return $this->render(array('json' => $result, 'status' => '500'));
        }

        $announcement = Announcements::Get($id);
        if ($announcement == null)
        {
            $result = array('error' => 'Does not exist.');
            return $this->render(array('json' => $result, 'status' => '404'));
        }

        Announcements::DeleteAnnouncement($id);
        return $this->render(array('json' => true, 'status' => '200'));
    }

    public function all()
    {
        $limit = (isset($this->request->query['limit'])) 
            ? $this->request->query['limit'] : null;

        return $this->render(array(
            'json' => Announcements::All($limit), 
            'status' => '200'
        ));
    }
}







