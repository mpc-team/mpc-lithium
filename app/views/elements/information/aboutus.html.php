<?php
/*
 * element/information/aboutus.html.php
 */
//array to operate tabs.
$aboutUs_styles = array
(
    'micro',
    'macro',
    'miacro',
    'community',
    'organization',
);    
// dialogvalue => URL video source.
$aboutUs_dialogSource = array
(
    'mpcintro'=>'https://www.youtube.com/embed/ZfK_PgBBacs',
    'micro'=>'https://www.youtube.com/embed/YbpCLqryN-Q',
); 

$array = array
(
    'mpcintro' => array
    ('source'=>'https://www.youtube.com/embed/ZfK_PgBBacs','credit'=>'MPC-SeaDog'),

    'micro' => array
    ('source'=>'https://www.youtube.com/embed/YbpCLqryN-Q','credit'=>'Nada & Moon'),

    'macro' => array
    ('source'=>'https://www.youtube.com/embed/dhs17SOnTCs','credit'=>'Someone Unknown')

);   
?>
<div id="infoaboutus">
    <div class="row">
        <h1 class="text-center">
            Miacro Power Clan:
            <span class="label label-default">MPC</span>
        </h1>
        <p>"Miacro" is a combination of words, and an invented word that was derives from the clan's gaming theory itself. The meaning of the word is "Micro" and "Macro" that references gaming terminologies. Micro is the physical performance that a person has to take in order to develop qualified extreme skill in competitive gaming. Micro consists of the speed reaction, thought process, constructive cognitive decision making, accurate usuage of the keyboard and mouse management to play the game. Macro is the meta phases a gamer takes from the game simulation in order to claim victor of the competition. These Meta Phases consist differently in each game. None are actually the same.</p>
    </div>

    <div class="row">
    <!--Trigger Dialog mpcintro video-->
        <a type="button" class="btn btn-edit" data-toggle="modal" data-target=".mpcintro-modal" href="#">
            <img src="/img/information/mpcintro.png" class="img-responsive img-rounded" alt="mpcintro.png" />
        </a>
    </div>
    <div class="row">
<!--Public Content-->
        <h2>What is MPCgaming</h2>
        <div class="btn-group btn-group-justified" role="tablist" aria-label="infoaboutus-label">
            <?php foreach($aboutUs_styles as $type):?>
                <a href="#infoaboutus-<?= $type ?>" aria-controls="infoaboutus-<?= $type ?>" class="btn btn-edit" role="tab" data-toggle="tab">
                    <?= $type ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="tab-content">
            <?php foreach($aboutUs_styles as $type):?>
                <div role="tabpanel" class="tab-pane fade" id="infoaboutus-<?= $type ?>">
                    <?= 
                        $this->view()->render(
                        array('element' => 'information/' . $type )
                    ); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<!--Hidden Content-->
    <?php foreach($array as $key => $item): ?>
    <div class="modal fade <?= $key ?>-modal" tabindex="-1" role="dialog" aria-labelledby="<?= $key ?>ModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="<?= $item['source'] ?>"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <?= $item['credit'] ?>
                </div>                
            </div>

        </div>
    </div>
    <?php endforeach; ?>
</div>

