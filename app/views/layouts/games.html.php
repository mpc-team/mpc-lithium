<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use app\views\layouts\LayoutConstants;

?>
<!doctype html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	
	<?php echo $this->html->charset();?>
	
	<title>MPC | Games | <?php echo $this->title(); ?></title>
	
	<?php echo $this->html->style(array(
		'bootstrap',
		'font-awesome',
		'website',
        'markup',
        'headerbar',
        'navbar',
        'utils/nanoscroller',
        'external/effects/hover',
        'external/effects/component',
        'clash-of-clans',
	));?>
	<?php echo $this->html->script(array(
		LayoutConstants::JQUERY_PATH,
        'bootstrap',
        'utils/fileselect',
        'utils/jquery.nanoscroller',
        'user/user',
        'user/auth',
        'user/notification',
        'background',
		'navbar',
        'texttags',
        'headerbar',
        'moment',
		'field-selection',	
        'members',
		'validate',
		'markup',
		'scroller',
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
