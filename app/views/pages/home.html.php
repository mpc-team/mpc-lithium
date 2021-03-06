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

<div class="jumbotron">
    <h1 style="white-space: nowrap;">
        NEWS
    </h1>
</div>

<div class="page-icon pull-right">
    <i style="transform: rotate(13deg);" class="fa fa-newspaper-o"></i>
</div>

<section id="announcements">
    <div class="row">
        <div class="col-md-4">
            <h2>Announcements</h2>
            <?php if ($permissions['announcements']['CREATE']): ?>
	            <div class="row">
		            <button class="btn btn-default" id="announcement-btn" type="button" data-toggle="collapse" data-target="#announcement-create" aria-expanded="false" style="margin-bottom:5px;font-size:100%">
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
            <div id="announcements-content">

            </div>
        </div>
        <div class="col-md-4" style="padding-left:10px">
            <center><h2>Upcoming Events</h2></center>
            <?php if ($permissions['events']['CREATE']): ?>
                <button class="btn btn-default" data-toggle="modal" data-target="#modal-newevent" style="margin-bottom:5px;font-size:100%">
                    <!--<span class="glyphicon glyphicon-plus"></span>-->
                    Add Event
                </button>
            <?php endif; ?>
            <div id="events-upcoming">
                <!-- JavaScript -->
            </div>
            <script type="text/javascript">$(function () { EventsUpcoming.Initialize('#events-upcoming'); });</script>
        </div>
        <div class="col-md-4" style="padding-left:10px">
            <div class="row">
                <h2 class="pull-right">Member Achievements</h2>
            </div>
            <div class="row">
                <center>
                    <br />
                    <p style="font-size:20pt">More to come . . .</p>
                </center>
            </div>
        </div>
    </div>
</section>


<div class="jumbotron" style="margin-top: 30px">
    <h1 style="white-space: nowrap;">
        EVENTS
    </h1>
</div>

<div class="page-icon pull-right">
    <i style="transform: rotate(13deg);" class="fa fa-calendar"></i>
</div>

<section id="events">
    <?php if ($permissions['events']['CREATE']): ?>
        <div class="row">
            <button class="btn btn-default" data-toggle="modal" data-target="#modal-newevent" style="margin-bottom:5px;font-size:100%">
                <!--<span class="glyphicon glyphicon-plus"></span>-->
                Add Event
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
                                <div class="input-group">
                                    <input type="text" class="form-control input-title" placeholder="Event title..." id="event-title" required />
                                    <textarea class="form-control" placeholder="Brief description..." id="event-description" style="resize: none"></textarea>
                                </div>
                                <div class="input-group date" id="event-start-datepicker">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border: none">
                                                    Starts at:
                                                </span>
                                                <input type="text" placeholder="Select a Date/Time" class="form-control" />
                                                <span class="input-group-addon input-date">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group date" id="event-end-datepicker">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border: none">
                                                    Finishes at:
                                                </span>
                                                <input type="text" placeholder="Select a Date/Time" class="form-control" />
                                                <span class="input-group-addon input-date">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 10px">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border:none">
                                                Internet Link:
                                            </span>
                                            <input type="text" class="form-control" placeholder="http://" id="event-link" required />
                                        </div>
                                    </div>
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
