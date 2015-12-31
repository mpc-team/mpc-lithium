<?php
/**
 * Error Layout
 * 
 * @author Steve
 * 
 * Built on Lithium.
 */

use app\views\layouts\LayoutConstants;

/**
 * This layout is used to render error pages in both development and production. It is recommended
 * that you maintain a separate, simplified layout for rendering errors that does not involve any
 * complex logic or dynamic data, which could potentially trigger recursive errors.
 */
use lithium\core\Libraries;

$path = Libraries::get(true, 'path');

?>
<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<?php echo $this->html->charset(); ?>
	<title>MPC | Page Not Found</title>
	<?php echo $this->html->style(array(
		'bootstrap',
		'font-awesome',
		'website',
        'markup',
        'navbar',
        'headerbar',
        'external/effects/hover',
        'external/effects/component',
        'utils/nanoscroller',
        'utils/fileselect',
        'announcements',
        'information-page',
	));?>
	<?php echo $this->html->script(array(
		LayoutConstants::JQUERY_PATH,
        'bootstrap',
        'utils/fileselect',
        'utils/jquery.nanoscroller',
        'utils/AreYouSure',
        'user/user',
        'user/auth',
        'user/notification',
        'background',
		'navbar', 
        'headerbar',
        'moment',
		'field-selection',	
        'members',
		'validate',					
        'texttags',
		'markup',
		'scroller',	
        'announcements',
        'texttags',
	));?>
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
            <?= 
                $this->view()->render(
                    array('element' => 'banner'),
                    array()
                )
            ?>
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

		<div class="content">
			<?php echo $this->content(); ?>
		</div>
	</div>
</body>
</html>