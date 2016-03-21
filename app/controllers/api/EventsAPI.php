<?php

namespace app\controllers\api;

use lithium\security\Auth;
use app\utilities\TextEntry;
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

    /* Create Event (/events/create)
    -------------------------------------------------------------------------------------------- */

    /**
     * Create a new Event. Requires the fields `title`, `start` (date), `end` (date), 
     * `link` (optional), and `description` (optional).
     *
     * @param String $this->request->data['title'] Title of the Event.
     * @param Date $this->request->data['start'] Start date/time of the Event.
     * @param Date $this->request->data['end'] End date/time of the Event.
     * @param String $this->request->data['link'] Optional URL link when the Event is clicked.
     * @param String $this->request->data['description'] Description of the Event.
     *
     * @return Event On success, return the serialized Event object that was created.
     */
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

        $title = TextEntry.Clean($this->request->data['title']);
        $startDate = $this->request->data['start'];
        $finishDate = $this->request->data['finish'];
        $link = $this->request->data['link'];
        $description = TextEntry.Clean($this->request->data['description']);

        return $this->render(array('json' => Events::NewEvent($title, $startDate, $finishDate, $link, $description)));
    }
}