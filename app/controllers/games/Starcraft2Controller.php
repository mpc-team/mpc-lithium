<?php

namespace app\controllers\games;

use app\controllers\ContentController;
use lithium\security\Auth;
use app\models\Users;
use app\models\Games;
use app\models\games\StarCraft2;

class StarCraft2Controller extends ContentController {

	public function index() 
	{
		$this->_render['layout'] = 'games';		
		
		$this->set(array(
			'dir' => scandir(getcwd() . "/starcraft2/builds"),
			'authorized' => Auth::check('default'),
			'breadcrumbs' => array(
				'path' => array('MPC','Games','Starcraft II'),
				'link' => array('/','/games','/games/starcraft2'),
			),
		));

	}
	

    //example for mapping an array
    public $file = 'starcraft2/clanwar/replays/folder/file.zip';

   //folder is index,
   //file is the key,

    //This pushes the file to the user. Requires a trigger.
    public function downloadFile($file) 
    { 
        
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
     

     }//function
                 //trigger from a button on the webpage.
        if(isset($_GET['replay'])) {
            downloadFile($file)
        }   
     
	
}