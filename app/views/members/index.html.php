<?php

$this->title('Members');

$self = $this;

?>
<div id="wrapper">
	<div id="sidebar-wrapper">
		<ul class="sidebar-nav">
			<li class='active'>
				<a href="/users">
					<span class="glyphicon glyphicon-search"></span>
					Search
				</a>
			</li>
		</ul>
	</div>
	
	<div id="page-content-wrapper">
		<div class="content">
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading page-header">
						<h1>Clan MPC<br><small>Members</small></h1>
						Currently <?= $count ?> <?= ($count > 1) ? "members have" : "member has" ?> registered.
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
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">Email</span>
							<input type="text" class="form-control" name="email" id="email" placeholder="Search by player email..."/>				
						</div>
					</div>
				</div>
			</div>
		
			<div class="panel-group">
				<div class="panel panel-default">
					<table class="table">
						<thead>
							<tr class='row'>
								<th class='col-xs-6'>Alias</th>
								<th class='col-xs-6'>Email</th>
							</tr>
						</thead>
						<tbody id="search-results">
							<!--JavaScript Here-->
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	<?php echo "var userList = " . json_encode($users) . ';'; ?>
	
	$( document ).ready(function() {
		updateList(userList, ['admin']);
	
		$('#email').keyup(function() { updateList(userList, ['admin']) });
		$('#alias').keyup(function() { updateList(userList, ['admin']) });
	});
</script>