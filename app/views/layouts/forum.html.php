<?php
/**
 * Forum Layout
 * 
 * @author Steve
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
		'font-awesome', 
		'website',
        'forums',
        'markup',
        'navbar',
        'headerbar',
        'user',
        'utils/nanoscroller',
        'external/effects/hover',
        'external/effects/component',
	)); ?>
	<?php echo $this->html->script(array(
		LayoutConstants::JQUERY_PATH,
        'bootstrap', 
        'highlight/highlight.pack',
        'markdown-js/markdown.min',
        'utils/fileselect',
        'utils/jquery.nanoscroller',
        'utils/AreYouSure',
        'user/user',
        'user/auth',
        'user/notifications',
        'expanding/expanding',
        'background',
		'navbar',
        'headerbar',
        'moment',
        'field-selection', 
        'validate', 					
        'texttags',
		'forum',            
        'markup', 
	));?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body>
	<div class="container-fluid">
		<?=$this->view()->render(
			array('element' => 'navbar'), 
			array(
				'authorized' => $authorized,
				'controller' => $this->_request->controller,
				'action' => $this->_request->action
			)
		)?>
	</div>
	
	<div class="container">
		<div class="forum">
			<div class="content">
				<div class="page-header">
                    <!--
                    <span class="page-header-text">
                        MPCgaming
                    </span> -->
                    <img src="/img/mpctext-aaffaa.png" class="img-responsive" alt="mpctext-aaffaa.png" />
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
				
				<?php if (!$authorized): ?>
					<?= $this->view()->render(array('element' => 'loginforum'))?>
				<?php endif; ?>
				
				<?php echo $this->content(); ?>
				
				<div class="page-footer"></div>
			
				<?= $this->view()->render(
					array('element' => 'breadcrumbs'),
					array('breadcrumbs' => $breadcrumbs)
				)?>
				
				<?php if (isset($reply)): ?>
					<?= $this->view()->render(
						array('element' => 'reply'),
						array('reply' => $reply)
					)?>
				<?php endif; ?>
			
			</div>
		</div>
	</div>
</body>
</html>