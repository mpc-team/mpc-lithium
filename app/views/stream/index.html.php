<?php

$this->title('Streaming NOW');

$self = $this;


$streamers = 
    array(
        'ID'=> array('AcidSnake' => '5 Viewing'),
        'ID' => array('Steve'=>'99 Viewing'),
        'ID' => array('Sieco'=>'99 Viewing')
    );



?>
<div id="streamdir">    
    <div class="row text-center">
        <h1>Currently Streaming</h1>
    </div>
    <!-- Show the Twitch Buttons-->
    <div class="row">
        <?= $this->view()->render(array('element'=>'stream/twitch')) ?>
    </div>
    <!--Show the list of Streamers-->
    <div class="row">
        <ul class="list-group" id="streamer-list">
        <?php foreach($streamers as $streamer): ?>    
            <?php foreach($streamer as $Name => $viewCount): ?>
                <li class="list-group-item">            
                    <span class="badge"><?= $viewCount ?></span>
                        <?= $Name ?>
                 </li>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </ul>
    </div>
</div>