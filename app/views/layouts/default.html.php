<?php
/**
 * Default Layout
 * 
 * @author Steve.
 * 
 * Built on Lithium.
 */

use app\views\layouts\LayoutConstants;

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<?php echo $this->html->charset();?>
	<title>MPC | <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array(
		'bootstrap',
        'jquery-ui',
        'highlight/styles/default',
        'bootstrap-datetimepicker',
		'font-awesome',
        'fullcalendar/fullcalendar.css',
		'website',
        'markup',
        'navbar',
        'headerbar',
        'community',
        'user',
        'external/effects/hover',
        'external/effects/component',
        'utils/nanoscroller',
        'utils/fileselect',
        'utils/tooltip',
        'utils/ControlOverlay',
        'announcements',
        'information',
	));?>
	<?php echo $this->html->script(array(
		LayoutConstants::JQUERY_PATH,
        'jquery-ui',
        'moment',
        'bootstrap',
        'bootstrap-datetimepicker',
        'fullcalendar/fullcalendar',
        'highlight/highlight.pack',
        'markdown-js/markdown.min',
        'utils/fileselect',
        'utils/jquery.nanoscroller',
        'utils/ControlOverlay',
        'utils/events/EventsUpcoming',
        'utils/events/EventsCalendar',
        'utils/AreYouSure',
        'utils/tooltip/Tooltip',
        'user/user',
        'user/auth',
        'user/notifications',
        'user/profile',
        'user/wall',
        'expanding/expanding',
        'background',
		'navbar', 
        'headerbar',
		'field-selection',
        'community',
		'validate',					
        'texttags',
		'markup',
        'announcements',
        'texttags',
        'https://ttv-api.s3.amazonaws.com/twitch.min.js',
        'connect',
	));?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body>
	<div class="container-fluid">
		<?=
        $this->view()->render(
            array('element' => 'navbar'),
            array(
                'authorized' => $authorized,
                'controller' => $this->_request->controller,
                'action' => $this->_request->action
            )
        )
        ?>
	</div>
	<div class="container">
		<div class="page-header">
            <img src="/img/mpctext-aaffaa.png" class="img-responsive" alt="mpctext-aaffaa.png" />
            <!--
            <span class="page-header-text">
                MPCgaming
            </span> -->
		    <?=
                $this->view()->render(
                    array('element' => 'headerbar'),
                    array(
                        'authorized' => $authorized,
                        'controller' => $this->_request->controller,
                        'action' => $this->_request->action
                    )
                )
            ?>
		</div>
				
		<?= $this->view()->render(
			array('element' => 'breadcrumbs'),
			array('breadcrumbs' => $breadcrumbs)
		)?>
		
		<div class="content">
			<?php echo $this->content(); ?>
		</div>
	</div>
</body>
</html>
