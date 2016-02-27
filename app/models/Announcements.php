<?php

namespace app\models;

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
			if (ord($text[$i]) == 10) 
            {
				if ($linefeeds < 2) 
                {
					$cleaned .= $text[$i];
					$linefeeds++;
				}
			} 
            elseif (ord($text[$i]) != 13) 
            {
				$cleaned .= $text[$i];
				$linefeeds = 0;
			}
		}
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
     *
     * @return mixed - List of Announcements.
     */
    public static function All($limit = null)
    {
        $announcements = self::find('all', array(
            'limit' => $limit,
            'order' => array('tstamp' => 'DESC'),
        ))->to('array');
        foreach ($announcements as $key => $announcement)
        {
            $author = Users::Get($announcement['authorid']);
            $announcements[$key]['author'] = $author['alias'];
            $announcements[$key]['content'] = stripslashes($announcement['content']);
        }
        return $announcements;
    }
}
