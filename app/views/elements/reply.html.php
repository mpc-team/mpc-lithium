<?php
/**
 * reply.html
 */

$disabled = !$reply['enabled'] ? ' disabled' : '';

$disabledPlaceholder = 'Please Login or Signup before posting on the Forum';

$placeholder = $reply['enabled'] ? 'Enter a message...' : $disabledPlaceholder;
 
?>
<a id='reply-to-thread'></a>
<div class="panel panel-default">
	<div class="panel-reply">
		<form role='form' class='form-horizontal' action='/post/create/<?= $reply['id'] ?>' method='post'>
			<div class="header">
				<h3>Reply to Topic</h3>
			</div>
			<div class="form-group">
				<?php if ($reply['enabled']): ?>
					<div class="row">
						<h4>
							&nbsp <span class="glyphicon glyphicon-user"></span> 
							<?= $reply['user']['alias'] ?>:
						</h4>
					</div>
				<?php endif; ?>
				<div class='row'>
					<?= $this->view()->render(
						array('element' => 'texttags'),
						array('id' => $reply['id'], 'disabled' => $disabled)
					)?>
				</div>
				<div class="row">
					<div class="input-group">
						<textarea name="content" id='input-reply-text' class="form-control edit-content-text" 
							data-id='<?= $reply['id'] ?>' placeholder='<?= $placeholder ?>'
							required <?= $disabled ?>></textarea>
					</div>
				</div>
				<div class="row btn-reply-row">
					<div class="input-group">
						<button title="Submit Reply" type="submit" class="btn btn-reply" <?= $disabled ?>>
							<span class="glyphicon glyphicon-send"></span>
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>