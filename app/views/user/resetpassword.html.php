<?php

use app\controllers\UserController;

$this->title('Password Reset');

$self = $this;

?>
<div class="reset-password">
	<div class="panel panel-default">
		<div class="rpass-group">
			<h1>Reset Password</h1>
			<section class="rpass-info">
				<div class="well">
					<small><i>A confirmation email will be sent to the
						specified email and forward you to a page where you may choose a new
						password.</i>
					</small>
				</div>
			</section>
			
			<?php if( isset($data) ): ?>
				<?= $data ?>
			<?php endif; ?>
			
			<hr>
			
			<form action="/user/resetpassword" method="post">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							Email:
						</span>
						<?= $this->form->text('email', array(
							'type' => 'email',
							'class' => 'form-control',
							'placeholder' => 'address@example.com'
						)); ?>
					</div>
				</div>
				
				<hr>
						
				<div class="form-group">
					<center>
						<input class="btn btn-login" type="submit" value="Reset"/>
					</center>
				</div>
			</form>
			
		</div>
	</div>
</div>