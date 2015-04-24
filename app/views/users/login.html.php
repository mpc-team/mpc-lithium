<?php
	
	$this->title('Login');
	
	$self = $this;
	
?>
<div class="content">
	<div class="panel-login">
		<img src="/img/mpclogo.png" class="img-responsive" id="image-banner-login"/>
		<div class="panel panel-default">
			<h1>Login</h1>
			<?= $this->form->create(NULL); ?>
				<div class="form-group form-login">
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
				<div class="form-group form-login">
					<div class="input-group">
						<span class="input-group-addon">
							Password:
						</span>     
						<?= $this->form->password('password', array(
							'class' => 'form-control',
							'placeholder' => 'Password'
						)); ?>
					</div>
				</div>
				<center>
					<div class="form-group form-login">
						<?= $this->form->submit('Login', array(
							'class' => 'btn btn-login',
							'value' => 'Login'
						)); ?>
					</div>
				</center>
			<?= $this->form->end(); ?>
		</div>
	</div>
</div>