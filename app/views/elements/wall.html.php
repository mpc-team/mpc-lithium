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
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="header">
				<div class="bar">
					<center>
						<h4>
							<small><?= $username ?></small> Wall
						</h4>
					</center>
				</div>
			</div>
			<div class="content">
				<div class="top">
					<center>
						<h4>
							Oldest Message
						</h4>
					</center>
				</div>
				<div class="messages">
					<!-- Filled By JavaScript -->
				</div>
			</div>
			<div class="footer">
				<?php if (in_array('post', $options)): ?>
					<div class="input-group">
						<div class="row">
							<div class="view pull-right">
								<a>View Messages</a>
							</div>
							<div class="text">
								<?php if (isset($member)): ?>
									Leave a message for <?= $member['alias'] ?>
								<?php else: ?>
									Post on your Wall
								<?php endif; ?>
							</div>
						</div>
						<div class="row">
							<input type="text" name="message-text" placeholder="Type message and press 'Enter'..." class="form-control"/>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>