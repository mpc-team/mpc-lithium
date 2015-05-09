<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>MPC | <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('bootstrap', 'simple-sidebar', 'website', 'font-awesome')); ?>
	<?php echo $this->html->script(array('jquery-1.11.2', 'bootstrap', 'field-selection', 'util', 'ftools', 'scroller', 'markup')); ?>
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
				
				<?php echo $this->content(); ?>
			
			</div>
		</div>
	</div>
</body>
</html>