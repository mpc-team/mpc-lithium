<?php

$this->title('Signup');

$self = $this;

?>
<div class="row">
    <div class="signup">
        <div class="signup-group">

            <h1>Member Signup</h1>

            <form action="/signup/complete" onsubmit="return validateSignup()" method="post">

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

                <div class="form-group form-signup">
                    <center>
                        <input type="submit" value="Create Account" class="btn btn-signup" />
                    </center>
                </div>

            </form>
        </div>
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
