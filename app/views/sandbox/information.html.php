<html>
	<head>
		<title>This is a Test</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap.css">
		<link rel="stylesheet" type="text/css" href="website.css">
		<link rel="stylesheet" type="text/css" href="sandbox.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="bootstrap.js" type="text/javascript"></script>
		<script src="sandbox.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container">
		
			<h2>
				<span class="glyphicon glyphicon-info-sign"></span>					
					Information Guide
			</h2>
			<div class="panel panel-default">
			
				<div class="panel-heading">
					<?php 
						$info_tabs = [
							'Home' => 'HomeController' => 'Home',
							'Profile' => 'ProfileController' => 'Profile',
							'Messages' => 'MessageController' => 'Messages',
							'Settings' => 'SettingsController' =>'Settings',
						];
					?>
					<ul class="nav nav-tabs" role="tablist">
						<?php foreach($info_tabs as $info_tabID => $tabControllerName => $tabName): ?>
							<li role="presentation">
								<a href="#<?= $info_tabID; ?>" aria-controls="<?= $tabControllerName; ?>" role="tab" data-toggle="tab">
									<?= $tabName; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>						  
				</div>
				
				<div class="panel-body">
					<div class="tab-content">
						<?php foreach($info_tabs as $info_tabID): ?>
							<div role="tabpanel" class="tab-pane" id="<?= $info_tabID; ?>">...</div>
						<?php endforeach; ?>						
					</div>
				</div>
				
				<div class="panel-footer">
					<small>Test Footer</small>
				</div>
				
			</div>
			
		</div>
	</body>
</html>