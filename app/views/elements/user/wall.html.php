<?php
/**
 * Wall element
 *
 * The wall element is a dynamic template that is operated by 'profile.js'. Messages are
 * populated into the template as per specifications in 'profile.js'. 
 */
 
$username = isset($member) ? $member['alias'] . "'s" : "My";
 
?>
<div class="wall">
    <div class="nano">
	    <div class="nano-content">
			<!-- Filled By JavaScript -->
	    </div>
    </div>
	<div class="footer">
		<?php if (in_array('post', $options)): ?>
			<div class="input-group">
				<div class="row">
					<input type="text" name="message-text" placeholder="Type message and press 'Enter'..." class="form-control"/>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>