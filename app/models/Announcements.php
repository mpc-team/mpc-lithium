<?php

namespace app\models;

class Announcements extends \lithium\data\Model  
{
	public static function getById ($id) 
    {
		if ($announcement = self::find('first', array('conditions' => array('id' => $id))))
			return $announcement->to('array');
		else
			return null;
	}

    /**
     * Return a list of *all* Announcements.
     * 
     * @return mixed - List of Announcements.
     */
    public static function getList()
    {
        $announcements = self::find('all')->to('array');
        foreach ($announcements as $key => $announcement)
        {
            $author = Users::getById($announcement['authorid']);
            $announcements[$key]['author'] = $author['alias'];
        }
        return $announcements;
    }
}
