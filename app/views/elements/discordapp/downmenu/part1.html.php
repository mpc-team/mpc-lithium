<?php 

$downMenuPart1 = array
(
    //'fileName' => 'displayName'
    'mac' => array
    ('display' => 'Mac', 'link' => 'https://discordapp.com/api/download?platform=osx'),
    'windows' => array
    ('display' => 'Windows', 'link' => 'https://discordapp.com/api/download?platform=win'),
    'linux' => array('display' => 'Linux','link' => '#'),
);

?>
<div id="discord-downloadtilept1">
    <div class="row">
        <?php foreach($downMenuPart1 as $fileName => $item): ?>
        <div class="col-xs-4">
            <div class="panel panel-discord">
                <div class="panel-body">                    
                    
                    <img src="<?= '/img/connect/modal/' . $fileName . '.png' ?>"  alt="<?= $fileName . '.png' ?>" class="img-responsive img-rounded" id="<?= $fileName ?>" />

                </div>
                <div class="panel-heading">
                    <h3 class="panel-title text-center">
                        
                        <?= $item['display'] ?>

                    </h3>
                </div>
                <div class="panel-footer" id="<?= $fileName ?>-footer">

                    <a href="<?= $item['link'] ?>" id="<?= $fileName ?>-downloadlink">

                    </a>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    $(function(){
        
    });//end doc.ready
</script>