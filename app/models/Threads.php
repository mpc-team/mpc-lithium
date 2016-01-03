<?php

namespace app\models;

class Threads extends \lithium\data\Model  
{
	public static function CleanTitle ($text) 
    {
		$text = strip_tags(trim($text));
		$text = str_replace('\r\n', '', $text);
		$text = str_replace('\n', '', $text);
		$text = str_replace('\r', '', $text);
		return $text;
	}

	public static function Get ($id) 
    {
		if ($thread = self::find('first', array('conditions' => array('id' => $id)))) 
			return $thread->to('array');
		else
			return null;
	}

    public static function UpdateThreadName ($id, $name)
    {
        $thread = self::find('first', array('conditions' => array('id' => $id)));
        if ($thread)
        {
            $thread->name = self::CleanTitle($name);
            $thread->save();
        }
    }

    public static function CreateThread ($forumid, $name, $authorid, $permission)
    {
        $thread = self::create(array(
            'fid' => $forumid,
            'name' => $name,
            'uid' => $authorid,
            'tstamp' => null,
            'permission' => $permission,
        ));
        if ($thread->save())
        {
            return $thread->to('array');
        }
        return false;
    }

	public static function GetByForum ($fid) 
    {
		return self::find('all', array('conditions' => array('fid' => $fid)))->to('array');
	}

    /**
     * Deletes all Posts, Thread Subscriptions, (and other) related entries
     * before deleting the Thread itself.
     *
     * @param int $id Thread identifier.
     *
     * @return bool True on success.
     */
	public static function DeleteThread ($id) 
    {
		if ($thread = self::find('first', array('conditions' => array('id' => $id))))
        {
            Posts::DeletePosts($id);
            ThreadSubscriptions::DeleteByThread($id);
            return $thread->delete();
        }
		else
        {
			return false;
        }
	}
}
