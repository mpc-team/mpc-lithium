<?php

namespace app\controllers\api;

use lithium\security\Auth;
use app\utilities\TextEntry;
use app\controllers\ContentController;
use app\models\Events;
use app\models\Permissions;

class EventsAPI extends ContentController
{
    /* Service Endpoints
    -------------------------------------------------------------------------------------------- */

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
        
        $events = Events::Upcoming($days, $limit);
        $auth = Auth::check('default');
        foreach ($events as $key => $event)
            if ($auth && Permissions::IsAdmin($auth))
                $events[$key]['controls'] = array('edit', 'delete');
            else
                $events[$key]['controls'] = array();

        return $this->render(array('json' => $events, 'status' => 200));
    }

    /* Create Event (/events/create)
    -------------------------------------------------------------------------------------------- */

    /**
     * Create a new Event. Requires the fields `title`, `start` (date), `end` (date), 
     * `link` (optional), and `description` (optional).
     * @params
     *  $this->request->data['title']: Title of the Event.
     *  $this->request->data['start']: Start date/time of the Event.
     *  $this->request->data['end']: End date/time of the Event.
     *  $this->request->data['link']: Optional URL link when the Event is clicked.
     *  $this->request->data['description']: Description of the Event.
     * @returns 
     *  On success, return the serialized Event object that was created.
     */
    public function create()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => null, 'status' => 500));

        // Only Administrators can make Events?
        if (!Permissions::IsAdmin($authorized))
            return $this->render(array('json' => null, 'status' => 500));

        $requiredData = array('title', 'start', 'finish', 'link', 'description');
        foreach ($requiredData as $req)
            if (!isset($this->request->data[$req]))
                return $this->render(array('json' => null, 'status' => 500));

        $title = TextEntry::Clean($this->request->data['title']);
        $startDate = $this->request->data['start'];
        $finishDate = $this->request->data['finish'];
        $link = $this->request->data['link'];
        $description = TextEntry::Clean($this->request->data['description']);

        return $this->render(array('json' => Events::NewEvent($title, $startDate, $finishDate, $link, $description)));
    }
}