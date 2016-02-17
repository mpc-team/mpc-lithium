<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\Clans;
use app\models\Users;
use app\models\UserClans;
use app\models\UserNotifications;
use app\models\Messages;


class ClansAPI extends ContentController
{

    /* Error Types
    ---------------------------------------------------------------------------------------------------- */

    private static $ErrorMessage = array
    (
        'NameErrors' => array
        (
            'ShortName' => array
            (
                'NoError',
                'NullName',
                'TooLong',
                'InvalidCharacter',
            ),
            'LongName' => array
            (
                'NoError',
                'NullName',
                'NameTaken',
            ),
        ),
        'MemberErrors' => array
        (
            'NoError',
            'NullList',
            'NotEnoughUsers',
            'UserNotFound',
            'UserInClan',
            'SelfInvite',
        ),
    );

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

    /* Decline Clan Invitation
    ---------------------------------------------------------------------------------------------------- */

    public function decline()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => array('Error' => 'Authentication required.'), 'status' => 200));

        if (!isset($this->request->id))
            return $this->render(array('json' => array('Error' => 'Invitation identifier required.'), 'status' => 200));

        UserNotifications::DeleteNotifications($this->request->id, UserNotifications::CLAN_INVITE);
        return $this->render(array('json' => Messages::DeclineInvite($this->request->id), 'status' => 200));
    }

    /* Leave Clan
    ---------------------------------------------------------------------------------------------------- */

    public function leave()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => array('Error' => 'Authentication required.'), 'status' => 200));

        $clan = UserClans::GetUserClan($authorized['id']);
        if ($clan == null)
            return $this->render(array('json' => array('Error' => 'Not currently in Clan.'), 'status' => 200));

        return $this->render(array('json' => UserClans::RemoveUser($clan['id'], $authorized['id'])));
    }

    /* Accept Clan Invitation
    ---------------------------------------------------------------------------------------------------- */
    
    public function accept()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => array('Error' => 'Authentication required.'), 'status' => 200));

        if (!isset($this->request->id))
            return $this->render(array('json' => array('Error' => 'Invitation identifier required.'), 'status' => 200));

        UserNotifications::DeleteNotifications($this->request->id, UserNotifications::CLAN_INVITE);
        return $this->render(array('json' => Messages::AcceptInvite($this->request->id), 'status' => 200));
    }

    /* Clan Creation and Initialization
    ---------------------------------------------------------------------------------------------------- */

    /**
     * Create a Clan with data specified in a POST request. Must specify a full name and
     * a short name, as well as a set of Users to initiate the Clan with. There must be a
     * certain number of Users specified. 
     *
     * Messages are sent to the Users that are specified indicating they have been invited
     * to participate in the Clan. If enough people decline the invite such that there are no
     * longer enough people to meet the minimum requirement, the Clan will be terminated.
     *
     * @param string $this->request->data['name'] Full name of the Clan.
     * @param string $this->request->data['shortname'] Short name of the Clan.
     * @param string $this->request->data['users'] List of Users to invite to initiate the Clan.
     */
    public function create()
    {
        $authorized = Auth::check('default');
        if (!$authorized)
            return $this->render(array('json' => array(
                'Error' => 'Authentication required.',), 'status' => 200));
        if (UserClans::GetUserClan($authorized['id'] != null))
            return $this->render(array('json' => array(
                'Error' => 'You are already in a Clan.'), 'status' => 200));

        $fullName = null;
        $shortName = null;
        if (isset($this->request->data['name']))
            $fullName = $this->request->data['name'];
        if (isset($this->request->data['shortname']))
            $shortName = $this->request->data['shortname'];
        $validateFullName = self::ValidateFullName($fullName);
        $validateShortName = self::ValidateShortName($shortName);
        if ($validateFullName < 0 || $validateShortName < 0)
            return $this->render(array('json' => array(
                'Error' => 'Specified name error.', 
                'Code_A' => $validateFullName, 
                'Code_B' => $validateShortName,
                'Message_A' => self::$ErrorMessage['NameErrors']['LongName'][$validateFullName * -1],
                'Message_B' => self::$ErrorMessage['NameErrors']['ShortName'][$validateShortName * -1],
                'Name' => $fullName,
                'Short_Name' => $shortName), 'status' => 200));

        $users = null;
        if (isset($this->request->data['users']))
            $users = $this->request->data['users'];
        $validateUsers = self::ValidateUsers($authorized, $users);
        if ($validateUsers < 0)
            return $this->render(array('json' => array(
                'Error' => 'Member specification error.', 
                'Code' => $validateUsers,
                'Message' => self::$ErrorMessage['MemberErrors'][$validateUsers * -1]), 'status' => 200));

        $createdClan = Clans::Start($fullName, $shortName, $authorized['id']);
        if ($createdClan == null)
            return $this->render(array('json' => array(
                'Error' => 'Clan initialization error.'), 'status' => 200));   

        $inviteErrors = self::SendClanInvites($authorized['id'], $users, $createdClan);
        $successfulInvites = count($users) - count($inviteErrors);
        if ($successfulInvites < UserClans::MINIMUM_USERS)
        {
            self::DeleteClanInvites($createdClan['id']);
            return $this->render(array('json' => array(
                'Error' => 'Invitation transmission error (not enough to start Clan).',
                'Terminate' => Clans::Terminate($createdClan['id'])), 'status' => 200));     
        }
        UserClans::AddUser($createdClan['id'], $authorized['id'], UserClans::RANK_OWNER);

        return $this->render(array('json' => array(
            'Success' => array(
                'successfulInvites' => $successfulInvites,
                'clanObject' => $createdClan)), 'status' => 200));
    }

    /**
     * Sends Clan Invitations via Messages.
     *
     * @param int $senderid User identifier of the sender.
     * @param int $userids Users to receive the invitation Message.
     * @param string $clanFullName Full name of the Clan, already validated.
     * @param string $clanShortName Short name of the Clan, already validated.
     * 
     * @return array List of User IDs taht the Message could not be sent to.
     */
    private static function SendClanInvites ($senderid, $userids, $clan)
    {
        $errors = array();
        $sender = Users::Get($senderid);
        foreach ($userids as $userid)
        {
            $result = Messages::Send(Messages::CLAN_INVITE, $senderid, $userid, 
                "[{$sender['alias']}](/user/view/{$senderid}) has invited you to join clan [h3]".$clan['shortname']."[/h3], [h3]*".$clan['name']."*[/h3]", $clan['id']);
            if ($result < 0)
                array_push($errors, $userid);
            else
                UserNotifications::NewNotification($userid, $result, UserNotifications::CLAN_INVITE, $senderid);
        }
        return $errors;
    }

    /**
     * Deletes invitations that are currently Pending for a Clan.
     *
     * @param int $clanid Clan identifier. Specified in the `idtag` of the Message.
     * 
     * @return bool True if successful.
     */
    private static function DeleteClanInvites ($clanid)
    {
        return Messages::DeletePendingClanInvites($clanid);
    }

    /* Validation
    ---------------------------------------------------------------------------------------------------- */

    /**
     * Initial validation of the specified Users. If Users cannot
     * be found in the Database it is detected later. The validation
     * criteria requires there be a minimum amount of Users specified. 
     * Users that are specified cannot already be in a Clan. The
     * authorized User cannot invite himself tot he Clan. This should
     * not be allowed through the UI anyway.
     *
     * @param array $users List of User IDs.
     *
     * @return bool True if the Users list meets the above criteria.
     */
    private static function ValidateUsers ($authorized, $users)
    {
        // Not null.
        if ($users == null) 
            return -1;
        
        // Check count.
        if (count($users) < UserClans::MINIMUM_USERS)
            return -2;

        foreach ($users as $userid)
        {
            // Check Users exist.
            if (Users::Get($userid) == null)
                return -3;
            // Check Users are not in Clan already.
            if (UserClans::GetUserClan($userid) != null)
                return -4;
            // Check list of Users does not include the authorized User.
            if ($userid == $authorized['id'])
                return -5;
        }
        return 0;
    }

    /**
     * Validates the Clan's full name. Cannot be null.
     *
     * @param string $fullName Clan's full name.
     *
     * @return bool True if the name meets the above criteria.
     */
    private static function ValidateFullName ($fullName)
    {
        // Not null.
        if ($fullName == null) 
            return -1;

        // Name is taken.
        if (Clans::GetByName($fullName) != null)
            return -2;

        return 0;
    }

    /**
     * Validates the Clan's short name. Cannot be null, must be
     * shorter than 6 characters, cannot contain spaces.
     *
     * @param string $shortName Clan's short name.
     * 
     * @return bool True if short name meets the above criteria.
     */
    private static function ValidateShortName ($shortName)
    {
        // Not null.
        if ($shortName == null) 
            return -1;

        // Name length meets requirements.
        if (strlen($shortName) > UserClans::SHORTNAME_MAX)
            return -2;

        // No spaces.
        for ($i = 0; $i < strlen($shortName); $i++)
            if ($shortName[$i] == ' ')
                return -3;

        return 0;
    }
}