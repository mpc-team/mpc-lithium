<?php
/**
 * Reply Form (Forum)
 *
 */
$disabled = !$replyform['enabled'] ? ' disabled' : '';
$disabled_placeholder = 'Please Login or Signup before posting on the Forum';
$placeholder = $replyform['enabled'] ? 'Enter a message...' : $disabled_placeholder;
 
?>
<a id='reply-to-thread'></a>
<div class="panel panel-default">
	<div class="panel-reply">
		<form role='form' class='form-horizontal' action='/post/create/<?= $replyform['id'] ?>' method='post'>
			<div class="header">
				<h3>Reply to Topic</h3>
			</div>
			<div class="form-group">
				<?php if ($replyform['enabled']): ?>
					<div class="row">
						<h4>
							&nbsp <span class="glyphicon glyphicon-user"></span> 
							<?= $replyform['user']['alias'] ?>:
						</h4>
					</div>
				<?php endif; ?>
				<div class='row'>
					<?= $this->view()->render(
						array('element' => 'texttags'),
						array(
							'id' => $replyform['id'],
							'disabled' => $disabled
						)
					)?>
				</div>
				<div class="row">
					<div class="input-group">
						<textarea name="content" id='input-reply-text' class="form-control edit-content-text" 
							data-id='<?= $replyform['id'] ?>' placeholder='<?= $placeholder ?>'
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