<?php

use app\models\Permissions;

$this->title('Community');

$self = $this;

$adminPermissions = $authorized && Permissions::is_admin($authorized);

$enableMemberButton = array(
    'clanregister' => (bool) $authorized,
    'signup' => (bool) !$authorized,
);

?>
<h1>Community</h1>

<div class="clans" id="clans">
    <div class="row">
        <div class="col-md-4">
            <h1>Clans 
                <button class='btn btn-default' <?= (!$enableMemberButton['clanregister']) ? 'disabled' : '' ?> data-toggle="modal" data-target="#modal-register-clan">
                    Register Your Clan
                </button>
            </h1>
            <h3>Currently <span id="clans-count" style='font-size: 150%'>0</span> Clans have been registered.</h3>
        </div>
        <div class="col-md-8">
        </div>
        <div class="modal fade" id="modal-register-clan" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Register Your Clan</h1>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Clan Name..." style="font-size:20px; height:auto;" required/>
                        </div>
                        <h2>Clan Members</h2>
                        <div id="register-clan-users">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-edit">Submit Registration</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row container-padding-default" id="community-container">
        <!-- Create Tiles With JavaScript -->
    </div>
</div>

<div class="members" id="members">
    <div class="row">
        <div class="col-md-4">
            <h1>Members <a href='/signup'><button class='btn btn-default' <?= (!$enableMemberButton['signup']) ? 'disabled' : '' ?>>Signup</button></a></h1> 
            <h3>Currently <span id="members-count" style='font-size: 150%'>0</span> Members have been registered.</h3>
        </div>
        <div class="col-md-8">
	        <div class="panel-heading">
		        Search <small><button id="members-clear-filter" class='btn btn-edit'>Clear Filter</button></small>
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
        </div>
    </div>
    <div class="row container-padding-default">
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
</div>