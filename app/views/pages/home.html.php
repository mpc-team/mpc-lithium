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

<div id="calendar"></div>
<section id="announcements">
    <h1>Announcements</h1>
    <?php if ($permissions['announcements']['CREATE']): ?>
	    <div class="row">
		    <button class="btn btn-edit" type="button" data-toggle="collapse" data-target="#announcement-create" aria-expanded="false" id="announcement-btn">
		        <span class="glyphicon glyphicon-plus"></span>
		        Add an Announcement
		    </button>
		    <div class="collapse" id="announcement-create">
			    <div class="well well-sm">
                    <input type="text" id="announcement-title-input" class="form-control" placeholder="Title..." />
					<div class='row'>
						<?= $this->view()->render(
							array('element' => 'texttags'),
							array('id' => '1', 'disabled' => false)
						)?>
					</div>
				    <textarea type="text" class='form-control announcement-input' placeholder="Enter your Announcement and click Submit." id="announcement-input" data-id="1"></textarea>
				    <div class="btn-group btn-group-justified" role="group" aria-label="annc-label">
					    <div class="btn-group" role="group">
						    <button type="button" id="announcement-submit" class="btn btn-edit">
                                Submit Announcement
                            </button>
					    </div>
				    </div>
			    </div>
		    </div>
	    </div>
    <?php endif; ?>
    <div id="announcements-content"></div>
</section>
<script type="text/javascript">
    $(document).ready(function ()
    {
        var objects = announcements.pull();
        texttags.init('announcement-input');
        $('#announcement-create').on('shown.bs.collapse', function ()
        {
            $('#announcement-input').focus();

            $("#announcement-btn span").toggleClass("glyphicon-plus");
            $("#announcement-btn span").toggleClass("glyphicon-minus");
        });
        $('#announcement-create').on('hidden.bs.collapse', function ()
        {
            $("#announcement-btn span").toggleClass("glyphicon-plus");
            $("#announcement-btn span").toggleClass("glyphicon-minus");
        });
        $('#announcement-submit').click(function ()
        {
            var title = $('#announcement-title-input').val();
            var content = $('#announcement-input').val();

            announcements.create(title, content);

            $('#announcement-input').val('');
            $('#announcement-title-input').val('');
            $('#announcement-btn').click();
        });
    });
</script>
