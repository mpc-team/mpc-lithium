<?php
/**
 * Side-page Navigation Bar
 *
 */
?>
<div class="col-md-3">
	<div class="sidebar">
		<ul class="nav">
			<?php foreach ($sidebar as $key => $side): ?>
				<li role="presentation">
					<a href="<?= $side ?>" class="btn">
						<?= $key ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class="col-md-9">
	<div class="sidebar-content">
		<?php echo $content ?>
	</div>
</div>


