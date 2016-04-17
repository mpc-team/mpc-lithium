<?php
/**
 * Games Played
 *
 */
 
$gamecount = 0;
 
?>
<div class="games">	
    <h3><small><?= $who ?></small> Games</h3>

	<div class="row">
            
        <?php if ($gamesClickable): ?>
		    <div class="row">
			    <div class="well well-sm">
				    <center>
					    <i class="fa fa-info-circle"></i>
					    Click games to select ones you play
				    </center>
			    </div>

		    </div> 
	    <?php endif; ?>

		<?php foreach ($games as $game): ?>
			<div class="col-xs-2">
			
				<div class="game" data-id='<?= $game['id'] ?>'>
					<div class="panel panel-default">
					
					<?php if ($gamesClickable): ?>
						<button class='btn btn-edit' data-id='<?= $game['id'] ?>'>
					<?php endif; ?>
					
						<div class="icon">
							<img class="profile-game-icon" src="<?= $game['icon'] ?>"></img>
						</div>
							
					<?php if ($gamesClickable): ?>
						</button>
					<?php endif; ?>
						
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>