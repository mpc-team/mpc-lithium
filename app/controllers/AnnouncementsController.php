<?php

namespace app\controllers;

use lithium\security\Auth;

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
        
        $content = Announcements::cleanContent($this->request->data['content']);
        $title = Announcements::cleanTitle($this->request->data['title']);

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
            $created = Announcements::getById($announcement->id);
            $created['author'] = Users::getById($created['authorid'])['alias'];

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
     * Returns a list of *all* Announcements.
     */
    public function all()
    {
        $announcements = Announcements::getList();
        return $this->render(array('json' => $announcements, 'status' => '200'));
    }
}







