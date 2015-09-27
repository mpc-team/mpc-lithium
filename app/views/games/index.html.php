<?php

$this->title('Games');

$self = $this;

$path = getcwd() . '/../views/games';
$directory = scandir($path);

// We don't want to count the files `.` or `..` and we also want to ignore the
// `/games/index.html.php` page because it is not a Game. That means we reduce 
// the number of files in our `/games` directory by 3.
$count = count($directory) - 3;

$gameList=[];
foreach($directory as $file) {
	if($file!='.' && $file!='..' && $file!='index.html.php'){
		try{
			$game=explode('.',$file)[0];
		}catch(Exception $excp){
			$game=null;
		}
		if($game!=null){
			array_push($gameList,$game);
		}
	}
}
?>
<section>
	
	<?php foreach($gameList as $game): ?>
	
		<h1><?=$game?></h1>
	
	<?php endforeach; ?>
	
</section>
