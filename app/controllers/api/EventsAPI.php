<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\Events;

class EventsAPI extends ContentController
{
	public function index()
    {
        return $this->render(array('json' => Events::All(25), 'status' => 200));   
    }
}