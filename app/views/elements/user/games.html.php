<?php
/**
 * Games Played
 *
 */
 
$gamecount = 0;
 
?>
<div class="games">
	<div class="row">
		<h3>Games <small><?= $text; ?></small></h3>
	</div>
	
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
					<div class="panel panel-default hvr-pop">
					
					<?php if ($profile): ?>
						<button class='btn btn-edit' data-id='<?= $game['id'] ?>'>
					<?php endif; ?>
					
							<div class="row">
								<div class="col-xs-6">
									<div class="icon">
										<img src="<?= $game['icon'] ?>" height='40' width='40'></img>
									</div>
									<div class="name"><?= $game['name'] ?></div>
								</div>
								<div class="col-xs-6">
									<div class="status" data-id='<?= $game['id'] ?>'>

									</div>
								</div>
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