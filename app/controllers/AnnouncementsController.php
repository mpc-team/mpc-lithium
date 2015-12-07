<?php

namespace app\controllers;

use lithium\security\Auth;

use app\models\Users;
use app\models\Permissions;
use app\models\Announcements;

class AnnouncementsController extends ContentController 
{
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

        $announcement = Announcements::create(array(
            'content' => $this->request->data['content'],
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
        //$result = array('hello' => 'world');
        //return $this->render(array('json' => $result, 'status' => '200'));

        $announcements = Announcements::getList();
        return $this->render(array('json' => $announcements, 'status' => '200'));
    }
}







