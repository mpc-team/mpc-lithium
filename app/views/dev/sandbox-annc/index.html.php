<?php

$this->title('Annoucements');

$self = $this;

?>
<div class="row" id="admin-announcement-gui">
	<div class="well">
		<h2>Announcement Board
			<span class="label label-default">Admin Software</span>
		</h2>
		<div class='row'>
			<?= $this->view()->render(
				array('element' => 'texttags'),
				array('id' => $reply['id'], 'disabled' => $disabled)
			)?>
		</div>
		<textarea type="text" placeholder="Enter an Announcement - then click submit." value="" aria-describedby="annc-addon" name="announcement-text" id="announcement-textarea" class="form-control"  rows="4" wrap="hard" autofocus></textarea>
		<div class="btn-group btn-group-justified" role="group" aria-label="annc-label">
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default annc-submitbtn">Submit Announcement</button>
			</div>
		</div>
	</div>
</div>