<?php
	
$this->title('Login');

$self = $this;
	
?>
<div class="login">
	<?= $this->form->create(NULL); ?>
		<div class="panel panel-default">
			<h1>Login</h1>
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
			<div class="form-group">
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
			<div class="form-group">
				<center>
					<?= $this->form->submit('Login', array(
						'class' => 'btn btn-login',
						'value' => 'Login'
					)); ?>
				</center>
			</div>
		</div>
	<?= $this->form->end(); ?>
</div>