<?php
namespace app\controllers\games;

use app\controllers\ContentController;

use lithium\security\Auth;
use app\models\Users;

class ClashOfClansController extends ContentController {

	public function index( ) 
	{
		$this->_render['layout'] = 'games';		
        $jsonData = self::getClanInfo( );
        $phpData = self::getClanInfo( );
        //OutPut to View
		$this->set(array(
			'authorized' => Auth::check('default'),
			'breadcrumbs' => array(
				'path' => array('MPC','Games','Clash of Clans'),
				'link' => array('/','/games','/games/clash_of_clans'),
			),
            'jsonData'=> $jsonData,
            'phpData' => $phpData,
		));

	}
    /*
    *
    * Uses the recommended API for calling clans, but modified with the usage of an Array to grab information From Super Cell based on the Clan Tags Provided.

    */
    public function getClanInfo( )
    {
        header('Content-Type: text/html; charset=UTF-8');
        $clantags = array("#LP8GL0RR","#9RR8CPGY","#PGLY2QUP");
        //MPC General Token to be granted Access to Super Cell's DB (Clash of Clans).
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImEyNThkZjZjLWYxY2EtNGUxMy05NWMzLTE4NjFkNjAwOTViZCIsImlhdCI6MTQ3MDQ0MzYxNiwic3ViIjoiZGV2ZWxvcGVyLzI1MzNlMTcwLWMwZWYtOGZiZi0xMjcwLWMyYzVhZWE3YzZjNiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjE4NC4xNjguMTUyLjE4OSIsIjE4NC4xNjguMTUyLjE4OCIsIjE4NC4xNjguMTUyLjE4NiIsIjE4NC4xNjguMTUyLjE4NyJdLCJ0eXBlIjoiY2xpZW50In1dfQ.SvkO0fijjV50gMitn8-ZXTEeq9DdrnbPZV41eTmecxwapWnUEykZzGOhXwO-HDUTnXS4OYvxVlkEqSWKU5Xusg
";
        $jsonData = array();
        $phpData = array();
        for ($i = 0; $i < sizeof($clantags); $i++) {
            $url[$i] = "https://api.clashofclans.com/v1/clans/" . urlencode($clantags[$i]);
            $ch[$i] = curl_init($url[$i]);
            $headr = array();
            $headr[] = "Accept: application/json";
            $headr[] = "Authorization: Bearer ".$token;
            curl_setopt($ch[$i], CURLOPT_HTTPHEADER, $headr);
            curl_setopt($ch[$i], CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch[$i], CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, 1); 
            $jsonData[$i] = curl_exec($ch[$i]);
            $phpData[$i] = json_decode($jsonData[$i], true);
            curl_close($ch[$i]);  
        }                           
        return $jsonData;
        return $phpData;
    }
}