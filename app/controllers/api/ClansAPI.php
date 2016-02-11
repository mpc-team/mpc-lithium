<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\Clans;

class ClansAPI extends ContentController
{
    /**
     * Returns list of all Clans.
     *
     * @param int $limit Limit of results.
     *
     * @return array List of Clans in JSON.
     */
    public function all()
    {
        if (isset($this->request->query['limit']))
            $clans = Clans::All($this->request->query['limit']);
        else
            $clans = Clans::All();

        return $this->render(array('json' => $clans, 'status' => 200));
    }
}