<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;
use app\models\TwitchUsers;

class ConnectController extends \lithium\action\Controller 
{
	public function index( ) 
	{
        //Check Authorization of the User.
		$authorized = Auth::check('default');	
        //Declare Breadcrumbs and Link
		$breadcrumbs = array(
			'path' => array('MPC','Connect'),
			'link' => array('/','/connect')
		);
        //Information from Twitch Users.
        $casters = TwitchUsers::All();
        $count = TwitchUsers::count();
        //OutPut to the View Folder -> to the Connect's Index File.
        $this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
			'casters' => $casters,
            'totalCasters' => $count,
		));	

	}
    public function appendtwitch( )
    {//Submit To Twitch Users
        $authorized = Auth::check('default');	
        if($this->request->data)
        {            
            //Phase 1: Get the Data.
            $uid = $authorized['id'];//mpc ID
            $tid = $this->request->data['twitch-userid'];// Twitch ID
            $tname = $this->request->data['twitch-username'];//Twitch Name
            //Phase 2: Check for Existance on Twitch Users Table and Numeric Values Tid and Uid
            $uidCheck = TwitchUsers::ExistingUId(is_numeric($uid));//Boolean: False -> Proceed
            $tidCheck = TwitchUsers::ExistingTId(is_numeric($tid));//Boolean: False -> Proceed
            $tnameCheck = TwitchUsers::ExistingTName($tname);//Boolean: False -> Proceed 
            //Verify The Applicant Does not Exist by Twitch Name, Twitch ID, MPC ID to avoid Duplication Accounts.
            if ($uidCheck == 0 && $tidCheck == 0 && $tnameCheck == 0 && $tname !== null && $tid !== null && $uid !== null && $tid !== "" && $uid !== "" && $tname !== "")
            {//Phase 3: Save the $uid $tid $tname to Twitch Users Table and Redirect.
                $caster = TwitchUsers::AddAccount($tid, $tname, $uid);//Success
                return $this->redirect('/streams?TwitchAccount=Completed');
            }//If Failed, Redirect.
            return $this->redirect('/connect?TwitchAccount=Failed');
        }//On Fail for retrieving Data, Redirect.            
        return $this->redirect('/connect?TwitchAccount=Request+Data+Failure');
    }    
    public function removetwitchuser( )
    {	
        $authorized = Auth::check('default');
        if($this->request->data)
        {            
            $uid = $authorized['id'];//mpc ID
            $tid = $this->request->data['deletetwitch-userid'];// Twitch ID
            $tname = $this->request->data['deletetwitch-username'];//Twitch Name
            //Phase 2: Check for Existance on Twitch Users Table so no Duplicate IDs are Stored. False Match.
            $uidCheck = TwitchUsers::ExistingUId(is_numeric($uid));//Boolean: True -> Proceed
            $tidCheck = TwitchUsers::ExistingTId(is_numeric($tid));//Boolean: True -> Proceed
            $tnameCheck = TwitchUsers::ExistingTName($tname);//Boolean: True -> Proceed 
            //Verify The Applicant Does Exist by Twitch Name, Twitch ID, MPC ID; to avoid unAuthorized Twitch Users to remove Accounts.
            if ($uidCheck == 1 && $tidCheck == 1 && $tnameCheck == 1 && $tname !== null && $tid !== null && $uid !== null && $tid !== "" && $uid !== "" && $tname !== "")
            {
                TwitchUsers::DeleteCaster($authorized['id']);
                return $this->redirect('/connect?TwitchAccountDeletion=Success');//Success

            }
            return $this->redirect('/connect?TwitchAccountDeletion=Failed+Not+Connected+To+Twitch');//Fail
        }
        return $this->redirect('/connect?TwitchAccount=Request+Data+Failure');//Fail
    }
//Youtube Function
    
}
