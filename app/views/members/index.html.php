<?php

use app\models\Permissions;

$this->title('Members');

$self = $this;

$adminPermissions = $authorized && Permissions::is_admin($authorized);

/* used to get the appropriate icon path when matching with the name of the game */
//foreach ($data['games'] as $key => $game) {
//    $data['games'][$key]['cleaned'] = strtolower(str_replace(' ', '', $game['name']));
//}

?>
<h1>Members</h1>
<h5>Currently <span id="members-count">0</span> members have registered.</h5>

<div class="members">
	<div class="panel-heading">
		Search <small><button id="members-clear" class='btn btn-edit'>Clear Filter</button></small>
	</div>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">Alias</span>
			<input type="text" class="form-control" name="alias" id="alias" 
				placeholder="Search by player alias..."/>				
		</div>
	</div>

	<?php if ($adminPermissions): ?>
        <!-- Email Input Only Available for Administrators/Moderators -->
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
			<div class="row" id="members-games"></div>
		</div>
	</div>
    <table class="table">
	    <thead>
		    <tr class='row'>
                <?php if ($adminPermissions): ?>
                    <th class='col-xs-4'>
                <?php else: ?>
                    <th class='col-xs-6'>
                <?php endif; ?>
                        <div class='alias'>
                            Alias
                        </div>
                    </th>

                <?php if ($adminPermissions): ?>
				    <th class='col-xs-4'>
					    <div class="email">
						    Email
					    </div>
				    </th>
                <?php endif; ?>


                <?php if ($adminPermissions): ?>
                    <th class='col-xs-4'>
                <?php else: ?>
                    <th class='col-xs-6'>
                <?php endif; ?>
				        <div class="played">
					        Games
				        </div>
			        </th>
		    </tr>
	    </thead>
	    <tbody id="members-results"></tbody>
    </table>
</div>