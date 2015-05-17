<?php
	
	$this->title('Login');
	
	$self = $this;
	
?>
<div class="login">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Login</h1>
		</div>
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