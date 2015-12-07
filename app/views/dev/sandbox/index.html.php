<?php

$this->title('information');

$self = $this;

?>

<h2>
	<span class="glyphicon glyphicon-info-sign"></span>
		MPC Gaming Apparatuses
</h2>
<div class="panel panel-default">			
	<div class="panel-heading">
		<?php

			$tabIDs = array(
			
				'kik' => 'kikAria',
				'forum' => 'forumAria',
				'ventrilo' => 'ventriloAria'
				
			);
			
		?>
		<h2>Methods to Communicate</h2>
	</div>				
	<div class="panel-body">		
		<ul class="nav nav-tabs" role="tablist">
			<?php foreach($tabIDs as $tabID => $tabAria): ?>
				<li role="presentation">
					<a href="#<?= $tabID; ?>" aria-controls="<?= $tabAria; ?>" role="tab" data-toggle="tab">
						<?= $tabID; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="firstview">
				<div class="well">
					<small>MPC's Form of Clan Communication is based on the follow selections above. Use these methods to get in contact with MPC members outside of the games you play, and during your gaming experience...</small>
				</div>
			</div>
			<?php foreach($tabIDs as $tabID => $tabAria): ?>
				<div role="tabpanel" class="tab-pane fade in" id="<?= $tabID; ?>">
					<div class="well">
						<?php include('../views/information/' . $tabID . '.html.php'); ?>
					</div>
				</div>					
			<?php endforeach; ?>
		</div>		
	</div>				
	<div class="panel-footer">
		<small>Test Footer</small>
	</div>				
</div>

