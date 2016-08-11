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
            'totalcasters' => $count,
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
            //Phase 2: Check for Existance on Twitch Users Table so no Duplicate IDs are Stored.
            $uidCheck = TwitchUsers::ExistingUId($uid);//Boolean: False -> Proceed
            $tidCheck = TwitchUsers::ExistingTId($tid);//Boolean: False -> Proceed
            $tnameCheck = TwitchUsers::ExistingTName($tname);//Boolean: False -> Proceed 
            if ($uidCheck == 0 && $tidCheck == 0 && $tnameCheck == 0)
            {//Phase 3: Save the $uid $tid $tname to Twitch Users Table and Redirect.
                $caster = TwitchUsers::AddAccount($tid, $tname, $uid);
                return $this->redirect('/connect?TwitchAccount=Success');
            }//If Failed, Redirect.
            return $this->redirect('/connect?TwitchAccount=Failed');
        }//On Fail for retrieving Data, Redirect.            
        return $this->redirect('/connect?TwitchAccount=Request+Data+Failure');
    }    
    public function removetwitchuser( )
    {
        //Check Authorization of the User.
		$authorized = Auth::check('default');
        //Information from the Table.	
        $casters = TwitchUsers::All();
        if ($authorized['id'])
        {
            TwitchUsers::DeleteCaster($authorized['id']);
            return $this->redirect('/connect?TwitchAccountDeletion=Success');//Success
        }
        return $this->redirect('/connect?TwitchAccountDeletion=Failed');
    }
//Youtube Function
    
}
