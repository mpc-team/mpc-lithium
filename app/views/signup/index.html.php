<?php

$this->title('Signup');

$self = $this;

$icons = array(
	'signup' => "<span class=\"glyphicon glyphicon-new-window\"></span>"
);

?>
<div class="row">
	<div class="signup">
		<h2>
			Member Signup
		</h2>
		<?=$this->form->create(NULL, array(
			'onsubmit' => "return validateSignup()"
		)); ?>
			<?=$this->form->field('email', array(
				'label'       => array('Email' => array('class' => 'control-label', 'for' => 'email')),
				'wrap'        => array('class' => 'form-group form-signup has-feedback', 'id' => 'input-signup-email'),
				'id'          => 'email', 'type' => 'email',
				'placeholder' => 'address@example.com',
				'class'       => 'form-control'
			))?>
			<?=$this->form->field('password', array(
				'label'       => array('Password' => array('class' => 'control-label', 'for' => 'password')),
				'wrap'        => array('class' => 'form-group form-signup has-feedback', 'id' => 'input-signup-pass'),
				'id'          => 'password', 'type' => 'password',
				'placeholder' => 'Password',
				'class'       => 'form-control'
			))?>
			<?=$this->form->field('confirm', array(
				'label'       => array('Confirm Password' => array('class' => 'control-label', 'for' => 'confirm')),
				'wrap'        => array('class' => 'form-group form-signup has-feedback', 'id' => 'input-signup-confirm'),
				'id'          => 'confirm', 'type' => 'password',
				'placeholder' => 'Re-enter Password',
				'class'       => 'form-control'
			))?>
			<?=$this->form->field('alias', array(
				'label'       => array('Alias' => array('class' => 'control-label', 'for' => 'alias')),
				'wrap'        => array('class' => 'form-group form-signup has-feedback', 'id' => 'input-signup-alias'),
				'id'          => 'alias',
				'placeholder' => 'Enter name or game-tag',
				'class'       => 'form-control'
			))?>
			<?=$this->form->submit("Create Account", array(
				'class'       => 'btn btn-signup pull-right',
				'type'        => 'submit'
			));?>
		<?=$this->form->end(); ?>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#input-signup-email")   .keyup (  function(){ validateSignup(); });
		$("#input-signup-email")   .change(  function(){ validateSignup(); });
		$("#input-signup-pass")    .keyup (  function(){ validateSignup(); });
		$("#input-signup-pass")    .change(  function(){ validateSignup(); });
		$("#input-signup-confirm") .keyup (  function(){ validateSignup(); });
		$("#input-signup-confirm") .change(  function(){ validateSignup(); });
		$("#input-signup-alias")   .keyup (  function(){ validateSignup(); });
		$("#input-signup-alias")   .change(  function(){ validateSignup(); });
	});
</script>