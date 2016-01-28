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
        MPC on Twitch T.V.
        <small>Clash of Clans</small>
    </h3>
    <?php $cocCasters = array('lovetorub16', 'marshall'); ?>
    <div class="row">
        <?php foreach($cocCasters as $id): ?>
        <div class="col-md-6">
             <a role="button" data-toggle="collapse" href="#caster-<?= $id ?>-collapse" aria-expanded="false" aria-controls="caster-<?= $id ?>-collapse" >
                <div class="panel-group">
                    <div class="panel">
                        <div class="panel-heading">
                            Caster
                        </div>
                        <div class="panel-body">
                             <div class="row">
                                <img src="/img/clash_of_clans/<?= $id ?>/description.png" alt="description.png" class="img-responsive img-rounded" id="<?= $id?>-descriptionpng" />
                            </div>                            
                        </div>
                        <div class="panel-footer">
                            <span class="glyphicon glyphicon-arrow-down" style="margin-left: 50%;"></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>        
    </div>
    <div class="collapse" id="caster-lovetorub16-collapse">
            <div id="caster-lovetorub16-twitchdiv">
                <div class="row" style="padding-top: 5%; padding-left: 8%;">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="http://www.twitch.tv/widgets/live_embed_player.swf?channel=lovetorub16"></iframe>
                    </div>                
                    <a role="button" class="btn btn-lg" href="#casterchat-lovetorub16-collapse" data-toggle="collapse" aria-expnded="false" aria-controls="casterchat-lovetorub16-collapse" style="background-color: #fff; border: 1px #00fff; color: #000;">Show Chat</a>
                </div>
                <div class="collapse text-center" id="casterchat-lovetorub16-collapse" style="padding-top: 5%; padding-left: 8%;">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe frameborder="0" scrolling="yes" src="http://twitch.tv/lovetorub16/chat?popout=">
                        </iframe>
                    </div>
                    <p>Not Showing up properly? View His <a class="btn" href="http://www.twitch.tv/lovetorub16" target="_blank">Page</a>.</p>
                </div>
            </div> 
        </div>
        <div class="collapse" id="caster-marshall-collapse">
            <div id="caster-marshall-twitchdiv">
                <div class="row" style="padding-top: 5%; padding-left: 8%;">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="http://www.twitch.tv/widgets/live_embed_player.swf?channel=marshall"></iframe>
                    </div>                
                    <a role="button" class="btn btn-lg" href="#casterchat-marshall-collapse" data-toggle="collapse" aria-expnded="false" aria-controls="casterchat-marshall-collapse" style="background-color: #fff; border: 1px #00fff; color: #000;">Show Chat</a>
                </div>
                <div class="collapse text-center" id="casterchat-marshall-collapse" style="padding-top: 5%; padding-left: 8%;">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe frameborder="0" scrolling="yes" src="http://twitch.tv/marshall/chat?popout=">
                        </iframe>
                    </div>
                    <p>Not Showing up properly? View His <a class="btn" href="http://www.twitch.tv/marshall" target="_blank">Page</a>.</p>
                </div>
            </div>   
        </div>
    <h3>
        Communication is Key
        <small>Clash of Clans</small>
    </h3>
    <div class="row">
        <a>
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <img src="/img/clash_of_clans/communication-banner.png" alt="communication-banner.png" class="img-rounded img-responsive" />
                    </div>
                    <div class="panel-body">
                         <div class="row text-center">        
                            <p style="color: #aaffaa;">Join us on our server via DiscordApp:</p>
                            <p>These buttons are for MPC Assassins. Use the connect button at the bottom of the live server status to connect to MPC's HQ Lobby.</p>
                            <div class="btn-group" role="group" aria-label="discordconnect-arialabel">
                        <a type="button" class="btn btn-edit btn-lg" href="https://discord.gg/0iDKElOIs9mVj3hR" target="_blank">
                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                            Text
                        </a>
                        <a type="button" class="btn btn-edit btn-lg" href="https://discord.gg/0iDKElOIs9qOseol" target="_blank">
                            <span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span>
                            Voice
                        </a>
                        <a type="button" class="btn btn-edit btn-lg" data-toggle="collapse" href="#discord-cochelp" aria-expanded="false" aria-controls="discord-cochelp-arialabel">
                            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                            Help
                        </a>
                        <a type="button" class="btn btn-edit btn-lg" data-toggle="collapse" href="/connect" aria-expanded="false" aria-controls="discordapp-status-arialabel">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            Server Status
                        </a>
                    </div><!--btn group-->                            
                        </div><!--row-->
                        <div class="collapse" id="discordapp-status">
                            <div class="well">
                                <?=
                                $this->view()->render(
                                    array('element' => 'discordapp/discordapp')
                                )
                                ?>
                            </div>
                        </div><!--collapse-->       
                    </div><!--row-->
                </div><!--panel body-->
                <div class="panel-footer">
                    
                </div><!--Footer-->
                </div><!--panel-->
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
                         <div class="row">
                            <p>See what's happening, and leave a post on the board. Learn, discuss, compare strategies, offer suggestions, and create insightful topics for others to see when they arrive here. Don't be shy because you might have something.</p>
                        </div>
                    </div>
                    <div class="panel-footer">
        
                    </div>
                </div>
            </div>
        </a>
    </div>
    <h3>
        Law and Order
        <small>Clash of Clans</small>
    </h3>
    <div class="row">
        <a>
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Clan Rules of Regulation</h3>
                    </div>
                    <div class="panel-body">
                        <?= $this->view()->render(array('element' => 'clash_of_clans/rules')) ?>
                    </div>
                    <div class="panel-footer">
                        <p>Updated: 01/25/2016</p>
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