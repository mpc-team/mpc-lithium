<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use lithium\core\Libraries;
use lithium\core\Environment;
use lithium\data\Connections;

$this->title('Home');

$self = $this

?>
<section id="announcements" class="col-md-8">
    <h2>Announcements</h2>

    <span class="input-group-addon glyphicon"></span>
    <textarea class="form-control" type="text" placeholder="Enter an Announcement - then click submit." name="announcement-text"></textarea>
    <div class="btn-group btn-group-justified" role="group" aria-label="annc-label">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-edit">Submit Announcement</button>
        </div>
    </div>

    <div id="announcements-content">
        <!--<div class="well well-sm">
            <h5>5 in a row</h5>
            <img src="http://www.mpcgaming.com/app/webroot/img/clashofclans/assassins/victory10302015.png" class="img-rounded img-responsive" alt="victory103002015.png" style="margin: auto;" />
        </div>
        <div class="well well-sm">
            <h5>
                Congrats MPC Clash of Clans: <br />
                MPC Assassins wins 4th war in a row, and gets promoted to Clan Level 2!
            </h5>
            <img src="http://www.mpcgaming.com/app/webroot/img/clashofclans/assassins/clanlevel2.png" class="img-rounded img-responsive" alt="clanlevel2.png" style="margin: auto;" />
        </div>
        <div class="well well-sm">
            <h5>10/25/15: 1PM EST, Noon CST Starcraft 2 Heart of the Swarm Tournament on sunday 1-5PM EST for 2 vs 2</h5>
        </div>
        <div class="well well-sm">
            <h5>10/20/2015: Clash of Clans MPC assassins Starting War against Furia De Roig</h5>
        </div> -->
    </div>
</section>
<section id="news" class="col-md-4">
	<h2>News</h2>
	<div class="well well-sm">
			<h5>11/06/2015: Avatars are now in complete working order!</h5>
		</div>
	<div class="well well-sm">
		<h5>9/26/2015: Passwords can now be reset through the login page.</h5>
	</div>
	<div class="well well-sm">
		<h5>10/11/2015: Added User avatar images to the Profile and Forum section.</h5>
	</div>
</section>

<script type="text/javascript">
    $(document).ready(function ()
    {
        var objects = announcements.pull();
    });
</script>
