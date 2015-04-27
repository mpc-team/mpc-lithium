<?php

$this->title('Member Profile');

$self = $this;

?>
<h1>
	<div class="title">
		<?= $authorized['alias']; ?>
	</div>
	<small>
		<div class="subtitle">
			<?= $authorized['email']; ?>
		</div>
	</small>
</h1>