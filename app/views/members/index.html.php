<?php

$this->title('Members');

$self = $this;

?>
<div id="page-content-wrapper">
<div class="content">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading page-header">
				<h1>
					<div class="title">Clan MPC</div>
					<small>
						<div class="subtitle">Members</div>
					</small>
				</h1>
				<h4>
					Currently <b><?= $count ?></b> <?= ($count > 1) ? "members have" : "member has" ?> registered.
				</h4>
			</div>
		</div>
	</div>

	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				Search
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Alias</span>
					<input type="text" class="form-control" name="alias" id="alias" placeholder="Search by player alias..."/>				
				</div>
			</div>
			<?php if (in_array("admin", $permission)): ?>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Email</span>
					<input type="text" class="form-control" name="email" id="email" placeholder="Search by player email..."/>				
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="panel-group">
		<div class="panel panel-default">
			<table class="table">
				<thead>
					<tr class='row'>
						<th class='col-xs-6'>
							Alias
						</th>
						<th class='col-xs-6'>
							<?= (in_array('admin', $permission)) ? "Email" : ""; ?>
						</th>
					</tr>
				</thead>
				<tbody id="search-results">
				
					<!--JavaScript Here-->
					
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	var users = <?php echo json_encode($users); ?>;
	var perm  = <?php echo json_encode($permission); ?>;
	var elements  = {
		'result' : "#search-results",
		'email' : "#email",
		'alias' : "#alias"
	};
	
	$( document ).ready(function() {
		updateList(elements, users, perm);
		
		$(elements.email).keyup(function() { updateList(elements, users, perm) });
		$(elements.alias).keyup(function() { updateList(elements, users, perm) });
	});
</script>