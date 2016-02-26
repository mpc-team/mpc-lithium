<?php

$this->title('Connect');

$self = $this;

?>
<div id="connectdiscord">    
    <div class="row" style="background-color: rgba(115,139,215, .3); padding: 12px; margin: 15px 0 15px 0;">
        <div class="col-md-7">
            <img src="/img/connect/discord-banner.png" alt="discord-banner.png" class="img-rounded img-responsive" id="connect-discordbanner" style="height: 300px; border-bottom: none;border-right: 1px solid #fff; border-top: 1px solid #fff;">
            <p style="text-indent: 15px; border-bottom: 1px solid #fff;border-left: 1px solid #fff; border-top: 1px solid #fff;padding: 10px; max-width: 570px; margin-top: .5px; color: #fff;background-color: rgba(21,21,21,.1);/* box-shadow: 1px 1px 15px #fff inset; */">
                To Setup on Discord, you must first download the software, or use on your web browser. When done, click on the "Connect URL" to join MPC HQ.                
            </p>            
            <br />
            <div class="btn-group btn-lg" role="group" aria-label="..." style="margin-top: -30px;">                    
                    <a role="button" class="btn btn-default" href="https://discordapp.com" target="_blank" style="background-color: rgba(115,139,215, .3);margin: 5px;color: #fff;border-color: rgba(0,0,0,.9);">Official Website</a>
                    <a role="button" class="btn btn-default" href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank" style="background-color: rgba(115,139,215, .3);margin: 5px;color: #fff;border-color: rgba(0,0,0,.9);">YouTube Tutorials</a>
            </div>
        </div>
        <div class="col-md-5">
        <div class="row">
            <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true" style="height: 300px;border-top: 1px solid #fff; border-bottom: none; border-right: 1px solid #fff; border-right: none; margin-bottom: -5px;" class="small"></iframe>
        </div>
            <br />
            <p style="text-indent: 15px; border-bottom: 1px solid #fff;border-right: 1px solid #fff;border-top: 1px solid #fff;padding: 10px; max-width: 570px; margin-top: 1.5px; color: #fff;background-color: rgba(21, 21, 21, 0.81);/* box-shadow: 1px 1px 15px #fff inset; */">
                MPC HQ Server Status, and join by clicking the "Connect" button (above). Then say hello, or write a friendly message greeting.
            </p>
            <div class="btn-group btn-lg">
                <a role="button" class="btn btn-default" href="https://discordapp.com/apps" target="_blank" style="background-color: rgba(115,139,215, .3);margin: 5px;color: #fff;border-color: rgba(0,0,0,.9); margin-top: -5px;">
                    Download Discord
                </a>
            </div>
            <div class="btn-group btn-lg">
                <a role="button" class="btn btn-default" style="background-color: rgba(115,139,215, .3); margin: 5px;color: #fff; border-color: rgba(0,0,0,.9); margin-top: -5px;" id="showdiscord">
                    Expand Full Discord
                </a>
            </div>            
        </div><!--col-->
    </div><!--row-->
</div><!--discord-->

<div class="connecttwitch">
    <div class="row" style="margin: 15px 0 15px 0; background-color: rgba(100,65,165,.3); padding: 12px;">
        <div class="col-md-7">
             <img src="/img/connect/twitch-banner.png" alt="twitch-banner.png" class="img-rounded img-responsive" id="connect-twitchbanner" style="height: 300px;border-bottom: none;border-right: 1px solid #fff;border-top: 1px solid #fff;">
             <p style="text-indent: 15px; border-bottom: 1px solid #fff;border-left: 1px solid #fff; border-top: 1px solid #fff;padding: 10px; max-width: 570px; margin-top: .5px; color: #fff;background-color: rgba(21,21,21,.1);/* box-shadow: 1px 1px 15px #fff inset; */">
                Share the broadcast on mpcgaming.com! Login with your twitch account, and follow our members. More updates coming soon!
             </p>
            <div class="btn-group btn-lg">
                <a role="button" href="http://www.twitch.tv" target="_blank" class="btn btn-default" style="color: #fff; background-color: rgba(100,65,165,.9);">
                    Official Website
                </a>
            </div>
            <div class="btn-group btn-lg">
                <a role="button" href="#" class="btn btn-default disabled" style="color: #fff; background-color: rgba(100,65,165,.9);">
                    Login
                </a>
            </div>            
            <div class="btn-group btn-lg" >
                <a role="button" href="#" class="btn btn-default disabled" style="color: #fff; background-color: rgba(100,65,165,.9);">
                    Request to Cast
                </a>
            </div>
        </div><!--col-->
        <div class="col-md-5">
            <div class="row" style="height: 300px;">
                 <div class="panel" style="border-bottom: 1px solid #fff; color: #fff; border-top: 1px solid #fff; height: 300px;" >
                 <?php 
                        $casters = array('lovetorub16'=>'LovetoRub','seadogsc2'=>'sEadogsc2','marshallmpc'=>'Marshall','chefsstream'=>'Chef','vaevictissc'=>'VaeVictisSc');
                ?>
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">MPC Casters</h3>
                        <ul class="nav nav-tabs" role="tablist">
                            <?php foreach($casters as $id => $displayName): ?>
                                <li role="presentation"><a href="#<?= $id ?>" style="color: #fff;" aria-controls="<?= $id ?>" role="tab" data-toggle="tab"><?= $displayName ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!--panelheading-->
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tabpanel" class="tab-pane fade in"> 
                                <h3>Select a Caster Above...</h3>                                
                            </div>
                            <?php foreach($casters as $id => $displayName): ?>
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
                                        <p>Not Showing up properly? View His <a class="btn" href="http://www.twitch.tv/<?= $id ?>" target="_blank">Page</a></p>
                                    </div><!--Collapse Div-->
                                </div> <!-- Caster ID -->
                            </div><!--tab panel-->
                            <?php endforeach; ?>
                        </div><!--tab content-->                       
                    </div><!--panel body-->
                </div><!--panel-->
                <p style="text-indent: 15px; border-bottom: 1px solid #fff;border-right: 1px solid #fff; border-top: 1px solid #fff;padding: 10px; max-width: 570px; margin-top: .5px; color: #fff;background-color: rgba(21,21,21,.1);/* box-shadow: 1px 1px 15px #fff inset; */">
                    <b>Disclaimer:</b> some casters have a mature audience only. Viewer descresion is advised!
                </p>
            </div><!--row-->            
        </div><!--col-->        
    </div><!--row-->
</div><!--connecttwitch-->

