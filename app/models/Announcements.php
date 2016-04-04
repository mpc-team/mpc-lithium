<?php

namespace app\models;

/* Authentication Module */
use lithium\security\Auth;

class Announcements extends \lithium\data\Model
{
    /**
     * Cleans the Announcement title for insertion into the Database.
     * 
     * @param mixed $text 
     * 
     * @return mixed
     */
    public static function CleanTitle ($text)
    {
		$text = strip_tags(trim($text));
		$text = str_replace('\r\n', '', $text);
		$text = str_replace('\n', '', $text);
		$text = str_replace('\r', '', $text);
        $text = str_replace("\\", "", $text);
		return $text;
	}

	/**
	 * Cleans the Announcement content for insertion into the Database.
     * 
	 * @param mixed $text 
     * 
	 * @return string
	 */
	public static function CleanContent ($text) 
    {
		$text = trim($text);
		$cleaned = '';
		$linefeeds = 0;
		$length = strlen($text);
		for ($i = 0; $i < $length; $i++) 
        {
			if (ord($text[$i]) == 10 && $linefeeds < 2) 
            {
				$cleaned .= $text[$i];
				$linefeeds++;
			}
            elseif (ord($text[$i]) != 13) 
            {
				$cleaned .= $text[$i];
				$linefeeds = 0;
			}
		}
        $cleaned = str_replace("\\", "", $cleaned);
		return strip_tags($cleaned);
	}

	/**
     * Retrieves Announcement by a unique identifier.
     * 
     * @param mixed $id
     * 
     * @return mixed
     */
	public static function Get ($id)
    {
		if ($announcement = self::find('first', array('conditions' => array('id' => $id))))
			return $announcement->to('array');
		else
			return null;
	}

    /**
     * Deletes an Announcement by a unique identifier.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public static function DeleteAnnouncement ($id)
    {
        if ($announcement = self::find('first', array('conditions' => array('id' => $id))))
        {
            if ($announcement->delete())
            {
                UserNotifications::DeleteNotifications($id, UserNotifications::ANNOUNCEMENT);
            }
        }
    }

    /**
     * Edits a specified Announcement.
     *
     * @param string $id The identifier.
     * @param string $title The new title.
     * @param string $content The new content.
     *
     * @return boolean True if the Announcement was edited successfully.
     */
    public static function Edit ($id, $title, $content)
    {
        if ($announcement = self::find('first', array('conditions' => array('id' => $id))))
        {
            $announcement->title = $title;
            $announcement->content = $content;
            $announcement->modified = null;
            return $announcement->save();
        }
        return false;
    }

    /**
     * Return a list of *all* Announcements.
     * @params
     *  $limit: Limit the number of results. Defaults to no limit.
     * @returns
     *  List of Announcements in associative array format.
     */
    public static function All($limit = null)
    {
        // Database Query. Must sort results.
        $anncs = self::find('all', array(
            'limit' => $limit,
            'order' => array('tstamp' => 'DESC'),
        ))->to('array');

        // Authorization information.
        $auth = Auth::check('default');

        // Extra Information.
        foreach ($anncs as $key => $announcement)
        {
            $author = Users::Get($announcement['authorid']);
            $anncs[$key]['author'] = $author['alias'];
            $anncs[$key]['content'] = stripslashes($announcement['content']);
            if ($auth)
                $anncs[$key]['permissions'] = array(
                    'edit' => ($auth['id'] == $author['id']) || Permissions::IsAdmin($auth),
                    'delete' => ($auth['id'] == $author['id']) || Permissions::IsAdmin($auth)
                );
            else
                $anncs[$key]['permissions'] = array(
                    'edit' => false,
                    'delete' => false
                );
        }

        // End.
        return $anncs;
    }
}
