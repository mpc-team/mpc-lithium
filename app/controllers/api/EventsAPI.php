<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\Events;
use app\models\Permissions;

class EventsAPI extends ContentController
{
	public function index()
    {
        $limit = 25;
        $events = Events::All($limit);

        return $this->render(array('json' => $events, 'status' => 200));   
    }

    public function create()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => null, 'status' => 500));

        if (!Permissions::is_admin($authorized))
            return $this->render(array('json' => null, 'status' => 500));

        $requiredData = ['title','start','finish'];
        foreach ($requiredData as $req)
            if (!isset($this->request->data[$req]))
                return $this->render(array('json' => null, 'status' => 500));

        $title = $this->request->data['title'];
        $startDate = $this->request->data['start'];
        $finishDate = $this->request->data['finish'];

        return $this->render(array('json' => Events::NewEvent($title, $startDate, $finishDate)));
    }
}