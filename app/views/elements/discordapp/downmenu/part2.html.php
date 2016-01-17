<?php

$downMenuPart2 = array
(
    //'fileName' => 'displayName' => ''Source DL Link
    'ios' => array
    ('display' => 'iPhone', 'link' => 'https://itunes.apple.com/us/app/discord-chat-for-games/id985746746'),
    'android' => array
    ('display' => 'Android', 'link' => 'https://play.google.com/store/apps/details?id=com.discord'),
);
?>
<div id="discord-downloadtilept2">
    <div class="row">
        <?php foreach($downMenuPart2 as $fileName => $item): ?>
            <div class="col-xs-5">
                <div class="panel panel-discord">
                    <div class="panel-body">
                    
                        <img src="<?= '/img/connect/modal/' . $fileName . '.png' ?>"  alt="<?= $fileName . '.png' ?>" class="img-responsive img-rounded" id="<?= $fileName ?>" />

                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">

                            <?= $item['display'] ?>

                        </h3>
                    </div>
                    <a href="<?= $item['link'] ?>" id="<?= $fileName ?>-downloadlink">
                        <div class="panel-footer" id="<?= $fileName ?>-footer">                        
                        </div>
                    </a>

                </div>
            </div>
        <?php endforeach; ?> 
</div>
<script>
     $(function(){

        
       

    });//end doc.ready
</script>