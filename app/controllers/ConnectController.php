<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use app\models\Permissions;
use app\models\TwitchUsers;

class ConnectController extends \lithium\action\Controller 
{
//Index Function
	public function index( ) 
	{
        //Check Authorization
		$authorized = Auth::check('default');	
        //Declare Breadcrumbs and Link
		$breadcrumbs = array(
			'path' => array('MPC','Connect'),
			'link' => array('/','/connect')
		);
        //Grab the casters from the database.
        $casters = TwitchUsers::All();
        //Set an Array to pass associated variables to the Connect View Page from what's in this function.         
        $this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
			'casters' => $casters,
            'totalcasters' => TwitchUsers::count(),
		));	
	}
//Twitch Function
    /*
    * This function takes the POST type form values and save it to the Twitch_Users Table. It initiates the process of saving the User's id, twitch id, and twitch username for easily to read from the database. Uses Hidden Elements as Values from the Twitch Object that is sent through the Twitch API (js/twitchapi.js).
    * 
    *
    *
    */
    public function appendtwitch( )
    {
        //If Data is Called / Presented
        if($this->request->data)
        {            
            //Lithium's Method to Extract Values from Input Elements by name attritbute.
            $uid = $this->request->data['mpc-userid'];        
            $tid = $this->request->data['twitch-userid'];
            $tname = $this->request->data['twitch-username'];
            //Check if the Uid has already been added to the database. If False, a UID does NOT exist; continue with the Processing of the Twitch User.
            if( (TwitchUsers::ExistingUId($uid)) == false )
            {
                //Submit Rule: Credentials must be met by non-empty values before the Add Account
                if ($uid != null & $tid != null & $tname != null)
                {
                    $caster = TwitchUsers::AddAccount($tid, $tname, $uid);
                    return $this->redirect('/connect?TwitchAccount=Success');
                } // Empty Values are in the Hidden Input Elements
                elseif ($uid == null & $tid & null & $tname == null)
                {
                    return false;
                    return $this->redirect('/connect?TwitchAccount=Requirements+Failure');
                }                                     
            }//Existing UID Exists
            return $this->redirect('/connect?TwitchAccount=Exists');
        }            
        return $this->redirect('/connect?TwitchAccount=Request+Data+Failure');
    }    
//Youtube Function
    
}
