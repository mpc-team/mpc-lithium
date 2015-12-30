<?php
/**
 * reply.html
 */

$disabled = !$reply['enabled'] ? ' disabled' : '';

$disabledPlaceholder = 'Please Login or Signup before posting on the Forum';

$placeholder = $reply['enabled'] ? 'Enter a message...' : $disabledPlaceholder;
 
?>
<a id='thread-reply'></a>
<div class="thread-reply">
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
						array(
                            'id' => $reply['id'], 
                            'disabled' => $disabled
                        )
					)?>
				</div>
				<div class="row" style="padding: 0 5px 0 5px;">
					<textarea name="content" id='thread-reply-text' class="form-control edit-content-text" 
						data-id='<?= $reply['id'] ?>' placeholder='<?= $placeholder ?>'
						required <?= $disabled ?>></textarea>
				</div>
				<div class="row btn-reply-row">
					<button title="Submit Reply" type="submit" style="height: 50px; padding-left: 50px; padding-right: 50px; border: 1px solid rgba(255,255,255,0.1);" class="btn btn-edit" <?= $disabled ?>>
                        <span style="color: rgba(255, 255, 255, 255);">
                            <h5 style="font-size: 150%;">Reply</h5>
                        </span>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>