<?php

use app\controllers\games\ClashOfClansController;

$this->title('Clash of Clans');

$self = $this;

?>

<div id="clash-of-clans">

    <!--<div class="well">
        <div class="row">
            <div class="col-md-6">
                <img src="/img/clash_of_clans/coc-head-banner.png" alt="coc-head-banner.png" class="img-rounded img-responsive coc-headbanner" />
            </div>
            <div class="col-md-6">
                <img src="/img/mpc/mpcgaming-logo.png" alt="mpcgaming-logo.png" class="img-rounded img-responsive coc-headbanner" style="width: 55%;" />
            </div>
        </div>
    </div>-->
    <!-- header row-->
    <h3>
        Clash of Clans - "The Revolution Begins"
        <small>Games</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <img src="/img/clash_of_clans/overview-banner.png" class="img-responsive img-rounded" />
                    </h3>
                </div>
                <div class="panel-body" >
                    <div class="row text-center">
                        <p>MPC Assassins is a professional Clash of Clans group, part of MPC organization - a developing gaming clan.</p>
                        <p>We are a dedicated and passionate clan; everything we do is to win our wars.</p>
                    </div>
                </div>
                <div class="panel-footer">
                    <p style="color: #FAF1BF;">MPC HQ is held on Discord Server. You may connect with MPC by going <a href="/connect">Here</a>.</p>
                </div>
            </div>
        </div>
    </div>
    <h3>
        Twitch
        <small>Clash of Clans</small>
    </h3>
    <?php 
        
        $cocCasters = array('lovetorub16' => 'LoveToRub', 'marshallmpc' => 'Marshall'); 
        
    ?>
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav nav-tabs" role="tablist">
                    <?php foreach($cocCasters as $id => $displayName): ?>
                        <li role="presentation"><a href="#<?= $id ?>" aria-controls="<?= $id ?>" role="tab" data-toggle="tab"><?= $displayName ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div><!--panelheading-->
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tabpanel" class="tab-pane fade in"> 
                        <h3>Select a Caster Above...</h3>
                    </div>
                    <?php foreach($cocCasters as $id => $displayName): ?>
                    <div role="tabpanel" class="tab-pane fade" id="<?= $id ?>">
                        <div id="caster-<?= $id ?>-twitchdiv">
                            <img src="/img/caster/<?= $id ?>/description.png" class="img-rounded img-responsive" id="coc-caster-<?= $id ?>-topimg" />
                            <div class="row" style="padding-top: 5%;">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?= $id ?>"></iframe>
                                </div><!--embed video-->              
                                <a role="button" class="btn btn-lg" href="#casterchat-<?= $id ?>-collapse" data-toggle="collapse" aria-expnded="false" aria-controls="casterchat-<?= $id ?>-collapse" style="background-color: #fff; border: 1px #00fff; color: #000;">Show Chat</a>
                            </div><!--row-->

                            <div class="collapse text-center" id="casterchat-<?= $id ?>-collapse" style="padding-top: 5%;">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <iframe frameborder="0" scrolling="yes" src="http://twitch.tv/<?= $id ?>/chat?popout=">
                                    </iframe>
                                </div><!--embed chat-->
                                <p>Not Showing up properly? View His <a class="btn" href="http://www.twitch.tv/<?= $id ?>" target="_blank">Page</a>.</p>
                            </div><!--Collapse Div-->
                        </div> <!-- Caster ID -->
                    </div><!--tab panel-->
                    <?php endforeach; ?>
                </div><!--tab content-->
            </div><!--panel body-->
        </div>
    <h3>
        Discord
        <small>Clash of Clans</small>
    </h3>
    <div class="row">
        <a>
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <img src="/img/clash_of_clans/communication-banner.png" alt="communication-banner.png" class="img-rounded img-responsive" />
                        <a class="btn btn-lg" href="/connect" id="coc-communication" style="color: #000; background-color: #FAF1BF; margin: 5% 0 0 0;">Connect Discord</a>
                    </div>
                </div><!--panel-->
                <div class="panel-footer">
                    
                </div>
            </div><!--panel group-->
        </a>
    </div>
    <h3>
        Forums
        <small>Clash of Clans</small>
    </h3>
    <div class="row">
        <a href="/board/view/5">
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                         <img src="/img/clash_of_clans/forum-banner.png" class="img-responsive img-rounded" alt="forum-banner.png" />
                    </div>
                    <div class="panel-body">
                         <div class="row text-center">
                            <p style="color: FAF1BF;">See what's happening, and leave a post on the board. Learn, discuss, compare strategies, offer suggestions, and create insightful topics for others to see when they arrive here. Don't be shy because you might have something.</p>
                        </div>
                    </div>
                    <div class="panel-footer">
        
                    </div>
                </div>
            </div>
        </a>
    </div>
    <h3>
        Rules from MPC
        <small>Clash of Clans</small>
    </h3>
    <div class="row">
        <a>
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <img src="/img/clash_of_clans/rules-banner.png" alt="rules-banner.png" class="img-responsive img-rounded" style="margin-bottom: 5%;" />
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <ul class="list-group">
                                <li role="presentation" class="list-group-item">
                                    If you plan on participating you
                                    <b>MUST</b>
                                    Use Discord APP.
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Have a proper target selected; that you can realistically clear a three star base.
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Plan your army, and attack with a leader. 
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Call your attack on clash caller, and execute the planned attack in the first four hours of war.
                                </li>
                                <li role="presentation" class="list-group-item">
                                    When war begins, use both attacks with the first four hours, or notify an offier when you can possible attack, or ASAP. 
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Best Behavoir, and respectiable kindness to members, and hard working Officers.
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Most Importantly Have fun.
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <p>Updated: 01/30/2016</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <h3>
        Official Website
        <small>Clash of Clans</small>
    </h3>
      <div class="row">
         <a href="http://www.clashofclans.com" target="_blank">
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <img src="/img/clash_of_clans/official-website-banner.png" alt="official-website-banner.png" class="img-responsive img-rounded coc-img-center" />
                    </div>
                    <div class="panel-body">
                        
                    </div>
                    <div class="panel-footer">
                        <small><a href="http://www.clashofclans.com" target="_blank">www.clashofclans.com</a></small>
                    </div>
                </div>
            </div>
        </a>        
    </div>
</div>