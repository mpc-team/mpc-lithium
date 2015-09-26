<?php

use app\controllers\UserController;

$this->title('Password Reset');

$self = $this;

if( isset( $user['email'] ) ) {
	$email = $user['email'];
} else {
	$email = '<Error>';
}

$PENDING = ( strtolower($status) == strtolower(UserController::STATUS_PENDING) );
$NO_USER = ( strtolower($status) == strtolower(UserController::STATUS_NO_USER) );
$KEY_ERROR = ( strtolower($status) == strtolower(UserController::STATUS_KEY_ERROR) );
$CONFIRMED = ( strtolower($status) == strtolower(UserController::STATUS_CONFIRMED) );

?>
<div class="reset-password">
	<div class="panel panel-default">
		<div class="rpass-group">
		
			<h1>Reset Password</h1>
			
			<?php if( $CONFIRMED ): ?>
		
				<h5>Choose a new password</h5>
				<hr>
				<form 	action="/user/changepassword?confirm=<?= $key ?>" 
								onsubmit="return validatePasswords('#fg-resetpw-confirm')" 
								method="post" >
					<div class="form-group has-feedback" id="fg-resetpw-pw">
						<label class="control-label" for="password">
							New Password:
						</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
					</div>
					<div class="form-group has-feedback" id="fg-resetpw-confirm">
						<label class="control-label" for="confirm">
							Confirm New Password:
						</label>
						<input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm Password"/>
					</div>
					<hr>
					<div class="form-group">
						<center>
							<input type="submit" class="btn btn-login" value="Change Password"/>
						</center>
					</div>
				</form>
				
				<script type="text/javascript">
					$(document).ready( function() {
						$('#password')	.keyup(		function(){ validatePasswords("#fg-resetpw-confirm"); });
						$('#password')	.change(	function(){ validatePasswords("#fg-resetpw-confirm"); });
						$('#confirm')		.keyup(		function(){ validatePasswords("#fg-resetpw-confirm"); });
						$('#confirm')		.change(	function(){ validatePasswords("#fg-resetpw-confirm"); });
					});
				</script>
			
			<?php elseif( $PENDING ): ?>
			
				<section class="rpass-info">
					<div class="alert alert-success">
						An email has been sent to <?= $email ?>.
					</div>
				</section>
				
			<?php else: ?>
			
				<?php if( $NO_USER ): ?>
				
					<section class="rpass-info">
						<div class="alert alert-danger">
							That e-mail address does not exist. Perhaps a mistake was made.
						</div>
					</section>
					
				<?php endif; ?>
					
				<section class="rpass-info">
					<div class="well">
						<small>
							A confirmation email will be sent to the specified email and 
							forward you to a page where you may choose a new password.
						</small>
					</div>
				</section>
					
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
			
			<?php endif; ?>
				
			<hr>
				
			<section class="return">
				<h5>
					<i class="fa fa-chevron-right"></i>
					<a href="/login">
						Return to Login page
					</a>
				</h5>
			</section>
			
		</div>
	</div>
</div>