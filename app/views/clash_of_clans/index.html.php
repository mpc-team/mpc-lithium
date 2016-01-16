<?php

use app\controllers\games\ClashOfClansController;

$this->title('Clash of Clans');

$self = $this;

$coc_navBar = array
    (
        'Home' => '../games/clash_of_clans',
        'Forum' => '../board/view/5',
        'Discord' => '/connect',
    );
$coc_sideIndexes = array(
        
        'coc-streamers',
        'rules',
        'official-website',

        );
$coc_mainIndexes = array
    (
        'welcome-msg',
        'communication',
        'forum',
    );

    $arrayId = array
    (

        'lovetorub16',
        'marshall',
    );

    $idAccordion = 'coc-streamers-accordion';

?>

<div id="clash-of-clans">

    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <img src="/img/clash_of_clans/coc-head-banner.png" alt="coc-head-banner.png" class="img-rounded img-responsive coc-headbanner" />
            </div>
            <div class="col-md-6">
                <img src="/img/mpc/mpcgaming-logo.png" alt="mpcgaming-logo.png" class="img-rounded img-responsive coc-headbanner" style="width: 55%;" />
            </div>
        </div>
    </div>

    <ul class="nav nav-pills navbar-clash-of-clans">
        <?php foreach($coc_navBar as $coc_btnTitle => $coc_btnLink): ?>
        <li role="presentation">
            <a href="<?= $coc_btnLink; ?>">
                <?= $coc_btnTitle; ?>
            </a>
        </li>
        <?php endforeach;?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Streaming<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">MPC Clash of Clan Casters</li>
            <li role="separator" class="divider"></li>
            <?php foreach($arrayId as $id): ?>
            <li><a href="#" data-toggle="modal" data-target="#coc-<?= $id ?>-streammodal"><?= $id ?></a></li>
            <?php endforeach; ?>
            <li role="separator" class="divider"></li>
            <li><a href="/stream">All MPC Streamers</a></li>           
          </ul>
        </li>

        <li class="navbar-right" id="cocnavbar-title">MPC Assassins</li>
    </ul>
    <div class="row">
        <div class="col-md-7">
            <?php foreach($coc_mainIndexes as $coc_index): ?>
            <div class="well">
                <?= $this->view()->render(
                    array('element' => 'clash_of_clans/' . $coc_index)
                ); ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-5">
            <?php foreach($coc_sideIndexes as $coc_index): ?>
            <div class="well">
                <div class="row">
                    <?= $this->view()->render(
                        array('element' => 'clash_of_clans/' . $coc_index )
                    ); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="well coc-footer">
            
        </div>
    </div>
</div>
<script>
    
</script>
