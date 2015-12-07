<div class="vent-accordion">
	<div class="panel-group" id="<?= $vent_accordionID; ?>" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="<?= $vent_accordionheadingID; ?>">
				<h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#<?= $vent_accordionID; ?>" href="#<?= $vent_collapseID; ?>" aria-expanded="true" aria-controls="<?= $vent_collapseID; ?>">
						
					</a>
				</h4>
			</div>
			<div id="<?= $vent_collapseID; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="<?= $vent_accordionheadingID; ?>">
				<div class="panel-body">
					<?php 
						include('../views/information/ventrilo_content/' . $vent_collapseID . '.php');
					?>
				</div>
			</div>
		</div>		 
	</div>
</div>