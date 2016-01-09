<?php

$this->title('Stream');

$self = $this;

?>
<div id="streamdir">
    
    <div class="row text-center">
        <h2>Stream Zone</h2>
    </div>
    <div class="row">
        <?= $this->view()->render(array('element'=>'stream/twitch')) ?>
    </div>

</div>