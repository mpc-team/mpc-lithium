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
						    array(
                                'id' => $reply['id'], 
                                'disabled' => $disabled
                            )
					    )?>
				    </div>
				    <div class="row">
					    <div class="input-group">
						    <textarea name="content" id='thread-reply-text' class="form-control edit-content-text" 
							    data-id='<?= $reply['id'] ?>' placeholder='<?= $placeholder ?>'
							    required <?= $disabled ?>></textarea>
					    </div>
				    </div>
				    <div class="row btn-reply-row">
					    <div class="input-group">
						    <button title="Submit Reply" type="submit" style="height: 50px;" class="btn btn-edit" <?= $disabled ?>>
							    <i style="opacity: 0.8; transform: rotate(-180deg); position: absolute; left: 0; right: 0; bottom: 0; height: 50px; overflow: hidden; font-size:500%; z-index: 0;" class="fa fa-reply"></i>

                                <span style="color: rgba(255, 255, 255, 255);">
                                    <h5 style="font-size: 150%;">Reply</h5>
                                </span>
						    </button>
					    </div>
				    </div>
			    </div>
		    </form>
	    </div>
    </div>
</div>