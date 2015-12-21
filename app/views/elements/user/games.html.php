<?php
/**
 * Games Played
 *
 */
 
$gamecount = 0;
 
?>
<div class="games">	
	<?php if ($profile): ?>
		<div class="row">
			<div class="well well-sm">
				<center>
					<i class="fa fa-info-circle"></i>
					Click Games to Select
				</center>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="row">
	
		<?php foreach ($games as $game): ?>
			<div class="col-xs-2">
			
				<div class="game" data-id='<?= $game['id'] ?>'>
					<div class="panel panel-default">
					
					<?php if ($profile): ?>
						<button class='btn btn-edit' data-id='<?= $game['id'] ?>'>
					<?php endif; ?>
					
						<div class="icon">
							<img class="profile-game-icon" src="<?= $game['icon'] ?>"></img>
						</div>
							
					<?php if ($profile): ?>
						</button>
					<?php endif; ?>
						
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>