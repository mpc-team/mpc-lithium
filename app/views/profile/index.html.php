<?php

$this->title('My Profile');

$self = $this;

?>
<div class="page-header">
	<div class="profile-header">
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
	</div>
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

<div class="page-footer">
	<!-- Empty-->
</div>

