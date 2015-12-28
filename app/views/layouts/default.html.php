<?php
/**
 * Default Layout
 * 
 * @author Steve
 * 
 * Built on Lithium.
 */

use app\views\layouts\LayoutConstants;

?>
<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<?php echo $this->html->charset();?>
	<title>MPC | <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array(
		'bootstrap',
		'font-awesome',
		'website',
        'markup',
        'navbar',
        'headerbar',
        'user',
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
        'user/profile',
        'user/notification',
        'user/wall',
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
