<?php

namespace app\models;

class Forums extends \lithium\data\Model  {

	/**
	 * getById
	 *
	 * Returns a Forum (or null if one cannot be found) that matches the specified ID.
	 */
	public static function Get ($id) 
    {
        $forum = self::find('first', array('conditions' => array('id' => $id)));
		if ($forum)
			return $forum->to('array');
		else
			return null;
	}

    /**
     * Returns a list of the current Forums, categorized by their "Category".
     */
    public static function GetList ()
    {
        $forums = self::find('all', array('fields' => array('id', 'cid', 'name',)));
        $forums = $forums->to('array');

        foreach ($forums as $key => $forum)
        {
            $forums[$key]['category'] = Categories::Get($forum['cid']);
        }
        return $forums;
    }

    /**
     * Returns a list of Categories that each have a list of Forums.
     */
    public static function GetByCategory ()
    {
        $forums = self::find('all', array('fields' => array('id', 'cid', 'name',)))->to('array');
        $categories = array();

        foreach ($forums as $forum)
        {
            if (!array_key_exists($forum['cid'], $categories))
            {
                $categories[$forum['cid']] = array(
                    'name' => null,
                    'forums' => array(),
                );
            }
            array_push($categories[$forum['cid']]['forums'], $forum);
        }

        foreach ($categories as $key => $category)
        {
            $cobject = Categories::Get($key);
            $categories[$key]['name'] = $cobject['name'];
        }

        return $categories;
    }
}