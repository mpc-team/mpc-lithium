<?php

$this->title('Member Profile');

$self = $this;

?>
<div class="profile-header">
	<h1>
		<div class="title">
			<?= $user['alias']; ?>
		</div>
	</h1>
</div>
<div class="profile-content">
	<div class="row">
		<h3>Recent Posts</h3>
	</div>
	<div class="row">
		<?= $this->view()->render(
			array('element' => 'recentfeed'),
			array('recentfeed' => $recentfeed)
		)?>
	</div>
</div>

