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
			$vent_downloadsArray = array(
				// f.e. $method => $downloadURL
				
				//Andriod Phone
				'Download for Andriod Phones (Google Play Store).' => 'https://play.google.com/store/apps/details?id=com.jtxdriggers.android.ventriloid&hl=en',
				//Iphone
				'Download for Iphones (MAC Apps).' => 'https://itunes.apple.com/us/app/ventrilode/id486115720?ls=1&mt=8',
				//Windows PC 
				'PC Windows 32bit - XP, Vista, Windows 7' => 'http://www.ventrilo.com/dlprod.php?id=1',
				'PC Windows 64bit - All 64bit platforms' => 'http://www.ventrilo.com/dlprod.php?id=4',
				'PC: Windows 9x/2000 - 95/98/ME and Windows 2000' => 'http://www.ventrilo.com/dlprod.php?id=5',
				//Mac OS
				'MAC: OSX10.4 or Higher - 32bit' => 'http://www.ventrilo.com/dlprod.php?id=2'
				
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

