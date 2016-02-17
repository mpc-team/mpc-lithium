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

<section id="announcements">
    <h1>Announcements</h1>
    <?php if ($permissions['announcements']['CREATE']): ?>
	    <div class="row">
		    <button class="btn btn-edit" id="announcement-btn" type="button" data-toggle="collapse" data-target="#announcement-create" aria-expanded="false" style="margin-bottom:5px;font-size:100%">
		        <span class="glyphicon glyphicon-plus"></span>
		        Add an Announcement
		    </button>
		    <div class="collapse" id="announcement-create">
			    <div class="well well-sm">
                    <input type="text" id="announcement-title-input" class="form-control input-title" placeholder="Title..." />
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

<section id="events">
    <h1>Events</h1>
    <?php if ($permissions['events']['CREATE']): ?>
        <div class="row">
            <button class="btn btn-edit" data-toggle="modal" data-target="#modal-newevent" style="margin-bottom:5px;font-size:100%">
                <span class="glyphicon glyphicon-plus"></span>
                Add an Event
            </button>
            <div class="modal fade" id="modal-newevent" tabindex="-1" aria-labelledby="modal-newevent">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h2 class="modal-title">
                                Create New Event
                            </h2>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control input-title" placeholder="Event title..." id="event-title" required />
                                <div class="input-group date" id="event-start-datepicker">
                                    <span class="input-group-addon" style="border: none">
                                        Start Date/Time:
                                    </span>
                                    <input type="text" placeholder="Select a Date/Time" class="form-control" />
                                    <span class="input-group-addon input-date">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <div class="input-group date" id="event-end-datepicker">
                                    <span class="input-group-addon" style="border: none">
                                        Finish Date/Time:
                                    </span>
                                    <input type="text" placeholder="Select a Date/Time" class="form-control" />
                                    <span class="input-group-addon input-date">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-edit" id="create-event">
                                Create Event
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div id="calendar"></div>
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

        // Initialize Date/Time Pickers.
        $('#event-start-datepicker').datetimepicker();
        $('#event-end-datepicker').datetimepicker();
    });
</script>
