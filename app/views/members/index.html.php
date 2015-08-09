<?php

$this->title('Members');

$self = $this;

/* used to get the appropriate icon path when matching with the name of the game */
foreach ($data['games'] as $key => $game) {
	$data['games'][$key]['cleaned'] = strtolower(str_replace(' ', '', $game['name']));
}

/* slight variances in the html layout depending on permissions granted by server */
$searchResultLayout = array(
	'admin' => in_array('admin', $data['permissions']),
	'header' => (in_array('admin', $data['permissions'])) ? "col-xs-4" : "col-xs-6"
);

?>
<h1>Members</h1>
<h4>
	Currently 
	<b><?= $data['count'] ?></b> 
	<?= ($data['count'] > 1) ? "members have" : "member has" ?> registered.
</h4>
<div class="members">
	<div class="panel-group panel-header">
		<div class="panel panel-default">
			<div class="panel-heading">
				Search
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Alias</span>
					<input type="text" class="form-control" name="alias" id="alias" 
						placeholder="Search by player alias..."/>				
				</div>
			</div>
			<?php if ($searchResultLayout['admin']): ?>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">Email</span>
						<input type="text" class="form-control" name="email" id="email" 
							placeholder="Search by player email..."/>				
					</div>
				</div>
			<?php endif; ?>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Games</span>
						<div class="row">
							<?php foreach ($data['games'] as $game): ?>
								<div class="col-md-3">
									<div class="game">
										<div class="row">	
											<div class="col-xs-2">
												<span class="input-group-addon">
													<input type="checkbox" id="<?= $game['cleaned'] ?>" value="<?= $game['cleaned'] ?>"/>
												</span>
											</div>
											<div class="col-xs-10">
												<span class="input-group-addon">
													<?= $game['name'] ?>
												</span>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-group">
		<table class="table">
		 	<thead>
				<tr class='row'>
					<th class='<?= $searchResultLayout['header'] ?>'>
						<div class="alias">
							Alias
						</div>
					</th>
					<?php if ($searchResultLayout['admin']): ?>
						<th class='col-xs-4'>
							<div class="email">
								Email
							</div>
						</th>
					<?php endif; ?>
					<th class='<?= $searchResultLayout['header'] ?>'>
						<div class="played">
							Games
						</div>
					</th>
				</tr>
			</thead>
			<tbody id="results"></tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	var memberList = <?php echo $data['members'] ?>;
	var permissions  = <?php echo json_encode($data['permissions']) ?>;
	var games = <?php echo json_encode($data['games']) ?>;
	$( document ).ready(function() {
		members.init(memberList, permissions, games);
	});
</script>