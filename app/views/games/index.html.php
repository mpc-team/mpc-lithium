<?php

$this->title('Games');

$self = $this;

?>
<section>
	<?php foreach($games as $game): ?>
		<h1><?=$game?></h1>
	<?php endforeach; ?>
</section>