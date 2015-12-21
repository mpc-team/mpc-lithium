<?php

namespace app\controllers\api;

use lithium\security\Auth;

use app\controllers\ContentController;

use app\models\Posts;

class PostsAPI extends ContentController
{
	public function GetInfo() 
	{
        if (!isset($this->request->id))
            return $this->render(array('json' => null, 'status' => 500));

        $postid = $this->request->id;
		$post = Posts::Get($postid);
		
		return $this->render(array('json' => $post, 'status' => 200));
	}
}