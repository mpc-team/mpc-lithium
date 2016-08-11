<?php
namespace app\controllers\games;

use app\controllers\ContentController;

use lithium\security\Auth;
use app\models\Users;

class ClashOfClansController extends ContentController {

	public function index( ) 
	{
		$this->_render['layout'] = 'games';		
        $res = self::getClanInfo( );//json
        $data = self::getClanInfo( );//php array
        //OutPut to View
		$this->set(array(
			'authorized' => Auth::check('default'),
			'breadcrumbs' => array(
				'path' => array('MPC','Games','Clash of Clans'),
				'link' => array('/','/games','/games/clash_of_clans'),
			),
            'res'=> $res,//json
            'data' => $data,//php
		));

	}
    public function getClanInfo( )
    {
        header('Content-Type: text/html; charset=UTF-8');
        $clantag = array("#LP8GL0RR","#9RR8CPGY","#PGLY2QUP");
        //MPC General Token to be granted Access to Super Cell's DB (Clash of Clans).
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImEyNThkZjZjLWYxY2EtNGUxMy05NWMzLTE4NjFkNjAwOTViZCIsImlhdCI6MTQ3MDQ0MzYxNiwic3ViIjoiZGV2ZWxvcGVyLzI1MzNlMTcwLWMwZWYtOGZiZi0xMjcwLWMyYzVhZWE3YzZjNiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjE4NC4xNjguMTUyLjE4OSIsIjE4NC4xNjguMTUyLjE4OCIsIjE4NC4xNjguMTUyLjE4NiIsIjE4NC4xNjguMTUyLjE4NyJdLCJ0eXBlIjoiY2xpZW50In1dfQ.SvkO0fijjV50gMitn8-ZXTEeq9DdrnbPZV41eTmecxwapWnUEykZzGOhXwO-HDUTnXS4OYvxVlkEqSWKU5Xusg
";

        
        $url[1] = "https://api.clashofclans.com/v1/clans/" . urlencode($clantag[1]);
        $url[2] = "https://api.clashofclans.com/v1/clans/" . urlencode($clantag[2]);
        $url[3] = "https://api.clashofclans.com/v1/clans/" . urlencode($clantag[3]);

        $ch = curl_init($url[2]);
        $headr = array();
        $headr[] = "Accept: application/json";
        $headr[] = "Authorization: Bearer ".$token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $res = curl_exec($ch);
        $data = json_decode($res, true);
        curl_close($ch);  
   
        return $res;
        return $data;
    }
}