<?php
use app\controllers\games\ClashOfClansController;
$this->title('Clash of Clans');
$self = $this;
$coc_navBar = array
    (
        'Home' => '../games/clash_of_clans',
        'Forum' => '../board/view/5',
        'Discord' => '../element/discordapp',
        'Events' => '../clash_of_clans/events',
        'News' => '../clash_of_clans/members',
        'WAR' => '../clash_of_clans/war',
    );
$coc_sideIndexes = array
    (
        'rules',
        'official-website',
    );
$coc_mainIndexes = array
    (
        'welcome-msg',
        'communication',
        'forum',
    );
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
        <li class="navbar-right" id="cocnavbar-title">MPC Assassins</li>
    </ul>
    <div class="row" id="coc-wellpanels">
        <div class="col-md-7">
            <?php foreach($coc_mainIndexes as $coc_index): ?>
            <div class="well">
                <div class="row">
                    <?= $this->view()->render(
                        array('element' => 'clash_of_clans/' . $coc_index)
                    ); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-5">
            <?php foreach($coc_sideIndexes as $coc_index): ?>
            <div class="well">
                <div class="row">
                    <?= $this->view()->render(
                        array('element' => 'clash_of_clans/' . $coc_index)
                    ); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="well footer">


        </div>
    </div>
</div>
