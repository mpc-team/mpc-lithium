<?php

use app\models\utils\Notifications;
	
$this->title('Login');

$self = $this;
	
// Get the type of Notification that was sent, if any.
$notification_type = 'alert alert-info';
if (isset($notification['status']))
	if (array_key_exists($notification['status'], Notifications::$s_notificationStyles))
		$notification_type = Notifications::$s_notificationStyles[$notification['status']];

?>
<div class="login">
	<form action="/login" method="post">
		<div class="panel panel-default">
			<div class="login-group">
			
				<a id="op-pwc"></a>
			
				<?php if (isset($notification['enabled']) && $notification['enabled']): ?>
					<div class="<?= $notification_type ?>">
						<?= $notification['text']; ?>
					</div>
				<?php endif; ?>
				
				<h1>Login</h1>	
				<hr>
				
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							Email:
						</span>
						<input type="email" name="email" class="form-control" placeholder="address@example.com" id="Email"/>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							Password:
						</span>     
						<input type="password" name="password" class="form-control" placeholder="Password" id="Password"/>
					</div>
				</div>
				
				<hr>
				
				<div class="form-group">
					<center>
						<?= 
							$this->form->submit('Login', array(
								'class' => 'btn btn-login',
								'value' => 'Login'
							)); 
						 ?>
					</center>
				</div>
				
				<hr>
				
				<section class="well well-lg">
					<div class="password-reset" style="padding-bottom:20px">
						<h3>Password Reset</h3>
						<span>
							If you have lost or forgotten your password, or believe it may be
							compromised, it can be reset with the 
							<a href='/user/resetpassword'>password reset</a> 
							tool.
						</span>
					</div>
				</section>
			</div>
		</div>
	</form>
</div>