<div id="ventrilo">
	<div class="row">
		<img class="img-responsive img-rounded" src="img/information_page/ventrilobanner.PNG" alt="ventrilobanner.PNG" id="ventrilobanner"/>			
	</div>
	<div class="row">
		<div class="media-list">
			<?php
				include('../views/information/ventrilo_content/medialist.php');
			?>
		</div>
	</div>
    <a name="connectventrilo"></a>
	<div class="row">
		<h2>Live Feed on MPC's Ventrilo Server:</h2>
		<script type="text/javascript" src="//www.typefrag.com/Server-Status/script.aspx?id=eabda7e4-f526-42e0-aaed-8c113747ef5e"></script>
	</div>
	<a name="downloadventrilo"></a>
	<div class="row">
		<h2>Download Ventrilo:</h2>
		<ul class="list-group">
			<?php foreach($vent_downloadsArray as $method => $downloadURL): ?>
				<li class="list-group-item">
					<span class="glyphicon glyphicon-download">
						<a href="<?= $downloadURL; ?>" target="_blank">
							<?= $method; ?>
						</a>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="row">
		<h2>Ventrilo Setup Documents:</h2>
		<?php 
			include('../views/information/ventrilo_content/vent_accordion.php');
		?>
	</div>
	<div class="row">
		<h2>Video Tutorials for Ventrilo:</h2>
		<?php 
			include('../views/information/ventrilo_content/vent_tutorial.php');
		?>
	</div>
</div>