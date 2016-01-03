<?php

use app\controllers\games\ClashOfClansController;

$this->title('Clash of Clans');

$self = $this;

$coc_navBar = array
    (
        'Home' => '../games/clash_of_clans',
        'Forum' => '../board/view/5',
        'Activity Feed' => '../clash_of_clans/activity',
        'Events' => '../games/clash_of_clans/events',
        'News' => '../games/clash_of_clans/members',
        'WAR' => '../games.clash_of_clans/war',
    );
$coc_sideIndexes = array(

        'chat-box' => 'Chat Box',
        'online-members' => 'Online Members',
        'member-status' => 'Member Availability',
        'events' => 'Events',
        );
$coc_mainIndexes = array
    (
        'welcome-msg' => 'Welcome',
        'activity-feed' => 'Activity Feed Show What\'s New',
        'forum' => 'Forum',
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
    <div class="row">
        <div class="col-md-7">
            <?php foreach($coc_mainIndexes as $coc_index => $coc_indexTitle): ?>
            <div class="well">
                <div class="page-header coc-page-header text-center">
                    <?= $coc_indexTitle; ?>
                </div>
                <div class="row">
                    <?= $this->view()->render(
                        array('element' => 'clash_of_clans/' . $coc_index)
                    ); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-5">
            <?php foreach($coc_sideIndexes as $coc_index => $coc_indexTitle): ?>
            <div class="well">
                <div class="page-header coc-page-header text-center">
                    <?= $coc_indexTitle; ?>
                </div>
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

            $this->view()->render(
            array('element' => 'discordapp')
            )

        </div>
    </div>
</div>
