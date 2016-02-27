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

    public function upcoming()
    {
        $limit = isset($this->request->query['limit']) ? $this->request->query['limit'] : null;
        $days = isset($this->request->query['days']) ? $this->request->query['days'] : null;
        return $this->render(array('json' => Events::Upcoming($days, $limit), 'status' => 200));
    }

    public function create()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => null, 'status' => 500));

        if (!Permissions::is_admin($authorized))
            return $this->render(array('json' => null, 'status' => 500));

        $requiredData = array('title', 'start', 'finish', 'link', 'description');
        foreach ($requiredData as $req)
            if (!isset($this->request->data[$req]))
                return $this->render(array('json' => null, 'status' => 500));

        $title = $this->request->data['title'];
        $startDate = $this->request->data['start'];
        $finishDate = $this->request->data['finish'];
        $link = $this->request->data['link'];
        $description = $this->request->data['description'];

        return $this->render(array('json' => Events::NewEvent($title, $startDate, $finishDate, $link, $description)));
    }
}