<?php

$this->title('StarCraft II');

$self = $this;

?>
<h1><?=$this->title;?></h1>

<?php foreach($dir as $file): ?>
	<p><?= $file; ?></p>
<?php endforeach; ?>