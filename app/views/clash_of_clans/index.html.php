<?php

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

        'coc-chat-box' => 'Chat Box',
        'coc-online-members' => 'Online Members',
        'coc-member-status' => 'Member Availability',
        'coc-events' => 'Events',

        );
$coc_mainIndexes = array
    (
        'coc-welcome-msg' => 'Welcome',
        'coc-activity-feed' => 'Activity Feed Show What\'s New',
        'coc-forum' => 'Forum',
    );

?>

<div id="clash-of-clans">
    <img src="/img/clash_of_clans/sidebackground.png" class="img-responsive ." alt="sidebackground.png" />
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
                    <?php include('../views/clash_of_clans/' . $coc_index . '.html.php'); ?>
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
                    <?php include('../views/clash_of_clans/' . $coc_index . '.html.php'); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="well coc-footer">

            <h2>footer</h2>

        </div>
    </div>
    <img src="/img/clash_of_clans/sidebackground.png" class="img-responsive .right" alt="sidebackground.png" />
</div>
