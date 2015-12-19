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

?>
<div id="clash-of-clans">
    <ul class="nav nav-pills navbar-clash-of-clans">
        <?php foreach($coc_navBar as $coc_btnTitle => $coc_btnLink): ?>
        <li role="presentation">
            <a href="<?= $coc_btnLink; ?>"><?= $coc_btnTitle; ?></a>
        </li>
        <?php endforeach;?>
        <li class="navbar-right" id="cocnavbar-title">MPC Assassins</li>
    </ul>
    <div class="row">

        <div class="col-md-9">

            <div class="well">

                <p>test</p>

            </div>

        </div>
        <div class="col-md-3">

            <div class="well">
                <p>test</p>

            </div>
            <div class="well">
                <p>test</p>

            </div>
            <div class="well">

                <p>test</p>
            </div>
            <div class="well">
                <p>test</p>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="well">

            <h2>footer</h2>

        </div>
    </div>
</div>