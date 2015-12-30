<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\Events;

class EventsAPI extends ContentController
{
	public function index()
    {
        $limit = 25;
        $events = Events::All($limit);

        return $this->render(array('json' => $events, 'status' => 200));   
    }
}