<?php

use lithium\security\Auth;
	
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>MPC Forum &gt; <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('bootstrap', 'simple-sidebar', 'website')); ?>
	<?php echo $this->html->script(array('jquery-1.11.2', 'bootstrap', 'field-selection',	'util', 'forum-message-userpanel', 'page-scroll-on-load')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
	<?php echo $this->html->link('glyphs', "//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css", array('rel' => 'stylesheet', 'type' => 'atom')); ?>
</head>
<body>
	<div class="container-fluid">
		<?php $authorized = Auth::check('default'); ?>
		<?=$this->view()->render(
			array('element' => 'navbar'), 
			array('authorized' => $authorized)
		)?>
	</div>
	
	<div class="container">
		<div class="forum">
			<div class="content">
		
				<?= $this->view()->render(
					array('element' => 'breadcrumbs'),
					array('breadcrumbs' => $breadcrumbs)
				)?>
				
				<?php if (isset($recentfeed)) { ?>
					<?= $this->view()->render(
						array('element' => 'recentfeed'),
						array('recentfeed' => $recentfeed)
					)?>
				<?php } ?>
				
				<div class="row">
					<div class="page-header">
						<h1>
							<div><?= $pageheader ?></div>
							<small>
								<div><?= $pagesub ?></div>
							</small>
						</h1>
						<div class="row thread-info">
							<div class="col-xs-6">
								<?php if (isset($pageauthor)): ?>
									Created by <span class="glyphicon glyphicon-user"></span>
									<?= $pageauthor ?>
								<?php endif; ?>
							</div>
							<div class="col-xs-6">
								<div class="pull-right">
									<?php if (isset($pagedate)): ?>
										Created on <span class="glyphicon glyphicon-time"></span>
										<?= date("D, d M Y g:i:s A", strtotime($pagedate)); ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<?php echo $this->content(); ?>
		
				<div class="page-footer">
					<!-- No Content -->
				</div>
			
				<?= $this->view()->render(
					array('element' => 'breadcrumbs'),
					array('breadcrumbs' => $breadcrumbs)
				)?>
				
				<?php if (isset($replyform) && $replyform['authenticated']): ?>
					<?= $this->view()->render(
						array('element' => 'replyform'),
						array('replyform' => $replyform)
					)?>
				<?php endif; ?>
			
			</div>
		</div>
	</div>
</body>
</html>