<?php

$this->title('Games');

$self = $this;

?>
<section>
	<h1>Games</h1>
	
	<ul>
		<?php foreach ($games as $game): ?>
			<li>
				<h3><?= $game['name'] ?></h3>
			</li>
		<?php endforeach; ?>
	</ul>
</section>