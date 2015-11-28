
			<h2>
				<span class="glyphicon glyphicon-info-sign"></span>					
					Information Guide
			</h2>
			<div class="panel panel-default">			
				<div class="panel-heading">
					<?php 

						$info_tabIDs = array(
							'ventrilo' => 'ventriloAriaControls',
							'forums' => 'forumAriaControls',
							'kik' => 'KikAriaControls',
						);
						
					?>					
				</div>				
				<div class="panel-body">
					<ul class="nav nav-tabs" role="tablist">
						<?php foreach($info_tabIDs as $info_tabID => $tabAria): ?>
							<li role="presentation">
								<a href="#<?= $info_tabID; ?>" aria-controls="<?= $tabAria; ?>" role="tab" data-toggle="tab">
									<?= $info_tabID; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>		
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="general">
							<div class="well">
								<small>MPC's Form of Clan Communication is based on the follow selections above. Use these methods to get in contact with MPC members outside of the games you play, and during your gaming experience...</small>
							</div>
						</div>
						<?php foreach($info_tabIDs as $info_tabID => $tabAria): ?>
							<div role="tabpanel" class="tab-pane fade in" id="<?= $info_tabID; ?>">
								<div class="well">
									<?php include_once('general.html.php'); ?>									
								</div>
							</div>
						<?php endforeach; ?>						
					</div>
				</div>				
				<div class="panel-footer">
					<small>Test Footer</small>
				</div>				
			</div>
			
