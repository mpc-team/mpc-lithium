<?php

use app\models\Permissions;
use app\models\UserClans;
use app\models\TwitchUsers;

$this->title('Connect');

$self = $this;

$adminPermissions = $authorized && Permissions::IsAdmin($authorized);

?>
<div class="jumbotron">
    <h1>CONNECT</h1>    
</div>
<div class="page-icon lower smaller pull-right">    
    <i style="transform: rotate(13deg);" class="fa fa-rss"></i>
</div>
<div id="connectdiscord"><a name="discord"></a>
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <img src="/img/connect/discord-banner.png" alt="discord-banner.png" class="img-rounded img-responsive connect-banner"/>
            </div>
            <div class="panel-body">
                <div class="row">
                    <center>                       
                        <div class="btn-group btn-lg" role="group">
                            <button role="button" class="btn btn-default" href="https://discordapp.com/apps" target="_blank">
                                <span class="glyphicon glyphicon-download-alt"></span>
                                Download Discord
                            </button>
                        </div>
                        <div class="btn-group btn-lg" role="group">
                            <button role="button" class="btn btn-default" href="https://discordapp.com" target="_blank">
                                <span class="glyphicon glyphicon-home"></span>
                                Official Website
                            </button>
                        </div>
                        <div class="btn-group btn-lg" role="group">
                            <button role="button" class="btn btn-default" href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank">
                                <span class="fa fa-youtube"></span>
                                Tutorials
                            </button>
                        </div>
                        <div class="btn-group btn-lg" role="group">
                            <button role="button" class="btn btn-default" data-toggle="modal" data-target="#notice">
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                Notices
                            </button>
                        </div>
                    </center>
                </div>
                <div class="modal fade" id="notice" tabindex="-1" role="dialog" aria-labelledby="discordNoticeLBL">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Known Update Bug</h4>
                      </div>
                      <div class="modal-body">
                         <p>Stuck in a never ending update loop?  There's a couple of steps that we can take to help get you back up and running. Better than ever before! Locate Discord in the local appdata folder. The easies...</p>
                         <a href="https://support.discordapp.com/hc/en-us/articles/217801498--Windows-Stuck-in-an-update-fail-loop-" target="_blank">https://support.discordapp.com/hc/en-us/articles/217801498--Windows-Stuck-in-an-update-fail-loop-</a>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="well">
                    <p>Setup Instructions:</p>
                     <ol>
                        <li>Download and Install Discord with the button above.</li>
                        <li>Register with email, or create a login. (Note: without an email registration, discord server will not remember your name and password or save the location of the server.)</li>
                        <li>Click the Connect button in the Discord Web Application Below.</li>
                        <li>Ask for help in Discord if needed by text/voice.</li>
                    </ol>
                    <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true" style="height: 392px; margin-left: 5px; border: none; width: 100%;"></iframe>
                    <div class="row text-center" style="background-color: rgba(21, 21, 21, 0.81); border: 1px solid #fff; margin-left: 9px;">
                        <p style="text-indent: 15px; padding: 10px; margin-top: 2.5px; color: #fff;">
                            To get to MPC HQ, all you have to do is click the <b>"Connect"</b> button, type in a login, and you're in. Download Discord's software get optimal performance.
                        </p>
                        <div class="row text-center">
                            <h4>
                                MPC's Discord URL:
                            </h4>
                            <a href="https://discord.gg/0iDKElOIs9mib3Oc" target="_blank" style="color: #fff; font-weight: 600;">https://discord.gg/0iDKElOIs9mib3Oc</a>
                        </div>
                        <div class="row text-center">
                            <h4>
                                MPC's Discord Logo:
                            </h4>
                            <img src="/img/logo2016.jpg" alt="logo2016.jpg" style="border: 2px solid #111; width: 64px; margin: auto;" class="img-responsive img-rounded" />
                        </div>
                    </div><!--parent row-->
                </div>
            </div>
        </div>
    </div><a name="twitch"></a>
</div><!--discord-->
<div id="connecttwitch">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <img src="/img/connect/twitch-banner.png" alt="twitch-banner.png" class="img-rounded img-responsive connect-banner" />
            </div>
            <div class="panel-body">
                <div class="row">
                    <center>
                        <div class="btn-group btn-lg">
                            <button role="button" href="http://www.twitch.tv" target="_blank" class="btn btn-default">
                            <span class="fa fa-twitch"></span>
                                Official Website
                            </button>
                        </div>
                        <div class="btn-group btn-lg">
                            <button role="button" href="https://www.google.com/search?q=twitch+setup+tutorials&espv=2&biw=947&bih=690&tbm=vid&source=lnms&sa=X&ved=0ahUKEwipzbKW2_7MAhXoz4MKHWXFA8gQ_AUIBygB&dpr=1.35" class="btn btn-default" target="_blank">
                                <span class="fa fa-twitch"></span>
                                 Tutorials
                            </button>
                        </div>
                        <div class="btn-group btn-lg" id="twitch-login-btn">
                            <button role="button" href="#" class="btn btn-default twitch-connect disabled">
                                <span class="glyphicon glyphicon-log-in"></span>
                                Sign Into Your Twitch
                            </button>
                        </div>
                        <div class="btn-group btn-lg" id="twitch-logout-btn">
                            <button role="button" href="#" class="btn btn-default twitch-disconnect disabled">
                                <span class="glyphicon glyphicon-log-out"></span>
                                Sign Out of Your Twitch
                            </button>
                        </div>                        
                    </center>
                </div><!--row-->
                <div class="well">
                    <p>Setup Instructions:</p>
                    <ol>
                        <li>First Login to MPCgaming</li>
                        <li>A "Sign into Twitch" button will appear available Above.</li>
                        <li>After Authenticating on Twitch, you'll return here to continue the next step.</li>
                        <li>Read Notice, and Press the "Connect" button.</li>
                    </ol>
                    <div class="panel-heading" style="background-color: #6441A5;">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 style="color: #fff; text-shadow: #fff;">
                                    <span class="fa fa-2x fa-twitch"></span>
                                    <span class="font-weight: 900; margin-bottom: 5px;">
                                        Twitch
                                    </span>                                    
                                </h3>
                            </div><!--col-->
                            <div class="col-md-6">
                                <p class="pull-right" style="font-size: small; color: #fff; text-shadow: #fff;">                                           
                                </p>
                            </div><!--col-->
                        </div><!--row-->
                    </div><!--panel-heading-->
                    <div class="panel-body">
                        <?php if($adminPermissions): ?>
                        <div class="row" style="margin-bottom: 10px;">                            
                                <h3>
                                    Cast List Management
                                    <small>(Admin)</small>
                                </h3>
                                <div class="col-md-6">
                                    <small>Select Someone To Remove their Casts</small>
                                    <div class="row">
                                        <div class="btn-group btn-small pull-left">
                                            <button type="submit" role="button" class="btn btn-default" name="delete" id="twitch-delete">Delete</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--modals of are you sure before form submit -->
                                        <?php //var_dump($casters) ?>
                                        <?php //var_dump($authorized['id']) ?>
                                    </div>
                                    <div class="row">
                                        <!--preview of the person-->
                                    </div>
                                </div><!--col-->
                                <div class="col-md-6">                                
                                    <div class="well">                                    
                                        <select name="admin-twitchuserlist" form="admin-twitchuser" style="color: #88bb88; font-size: 14pt; width: 100%;">

                                        <?php foreach($casters as $caster): ?>
                                            <option value="<?= $caster['id'] ?>"><?= $caster['tname'] ?></option>
                                        <?php endforeach; ?>

                                        </select>
                                    </div><!--well-->                                
                                </div><!--col-->
                             </form>
                        </div><!--row-->
                        <?php endif; ?>
                        <div class="row text-center">
                            <p style="border: 1px solid #fff;">Twitch allows MPC to retrieve your account information, and allow twitch users to perform actions. Submit for your Broadcast to Show up on MPCgaming.com. <b>Note:</b> You <u>MUST NEVER</u> share your password for your MPC, or Twitch account, with anyone -- including Admins, and Officers of MPC, or any other person. <br /> Please Obey Twitch's Policies for Broadcasting. Your Twitch Account will appear on the Community Section. All reports of abuse will be resolved by Twitch, and be aware to adjust your <b>mature</b> settings on twitch.tv, for young viewers, that will help avoid confrontation complaints; to and from Twitch -- viewer descreation is advised for Mature Audiences.</p>                
                            <form action="/connect/appendtwitch" name="appendtwitch" method="post" >
                                <div class="btn-group btn-small pull-right">
                                    <button type="submit" role="button" class="btn btn-default disabled" name="twitch-subscribe" id="twitch-subscribe">Connect</button>
                                </div><!--subscribe-->                               
                                <?php if($authorized['id']): ?>
                                <input type="hidden" class="form-control" aria-describedby="mpcuser-id-label" name="mpc-userid" value="<?= $authorized['id'] ?>" readonly/>
                                <input type="hidden" class="form-control" aria-describedby="twitch-name-label" id="twitch-username" name="twitch-username" readonly/>
                                <input type="hidden" class="form-control" aria-describedby="twitchid-label" id="twitch-userid" name="twitch-userid" readonly/>
                                <?php endif; ?>
                            </form>
                            <form action="/connect/removetwitchuser" id="removetwitchuser" name="removetwitchuser" method="post">
                                <div class="btn-group btn-small pull-right">
                                    <button type="submit" role="button" class="btn btn-default disabled" name="twitch-unsubscribe" id="twitch-unsubscribe">Remove Cast</button>
                                </div><!--unsubscribe-->
                            </form>
                            <div class="btn-group btn-small pull-right">
                                <a href="/community">
                                    <button role="button" class="btn btn-default">View Community</button>
                                </a>
                            </div><!--view-community-->
                        </div><!--parent row-->
                    </div><!--panel-body-->
                </div><!--row-->              
            </div><!--panel-body-->
        </div><!--panel-->    
    </div><!--panel-group-->
</div><!--connecttwitch-->  
<!--
<div id="connectbattlenet">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/connect/battlenet-banner.png" alt="battlenet-banner.png" class="img-rounded img-responsive" />      
                </center>
            </div>
            <div class="panel-body">
                <h4 class="panel-title">Coming Soon.</h4><!--
                 <div class="btn-group" role="group" aria-label="">
                    <button role="button" class="btn btn-default twitch-follow" >
                        <span class="fa fa-gamepad"></span>
                            Follow Group
                    </button>
                </div><!--button-group
            </div><!--panel-body
        </div><!--panel
    </div><!--panel-group    
</div><!--connectfacebook
-->
<!--
<div id="connectfacebook">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/connect/facebook-banner.png" alt="facebook-banner.png" class="img-rounded img-responsive" />      
                </center>
            </div>
            <div class="panel-body">
                <h4 class="panel-title">Coming Soon.</h4><!--
                 <div class="btn-group" role="group" aria-label="">
                    <button role="button" class="btn btn-default twitch-follow" >
                        <span class="fa fa-facebook-square"></span>
                            Follow Group
                    </button>
                </div><!--button-group
            </div><!--panel-body
        </div><!--panel
    </div><!--panel-group    
</div><!--connectfacebook

<div id="connectyoutube">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/connect/youtube-banner.png" alt="youtube-banner.png" class="img-rounded img-responsive" />      
                </center>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="panel-heading">
                        <h3>
                            <span class="fa fa-youtube"></span>
                            <small>TEST</small> 
                            YouTube Account Application
                        </h3>
                    </div><!--panel-heading
                </div><!--row
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>Internet Explorer 7 does not support it all the features.</li>    
                            <li>Upload Playlists</li>
                            <li>Collect Subscribers</li>
                            <!--<li></li>
                        </ul>
                        <button role="button" class="btn btn-default youtube-connect">Sign in</button>
                    </div>
                    <div class="col-md-6">
                        <center>                            
                            <div class="embed-responsive embed-responsive-16by9">
                                <div id="mpc-intro" class="embed-responsive-item"></div><!--player-test
                            </div>
                            <small>MPC Featured Intro.</small>
                        </center>
                    </div>                                       
                </div><!--row                
            </div><!--panel-body
        </div><!--panel
    </div><!--panel-group
</div><!--connectyoutube
<!--
<div id="connecttwitter">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/connect/twitter-banner.png" alt="twitter-banner.png" class="img-rounded img-responsive" />      
                </center>
            </div>
            <div class="panel-body">
                <h4 class="panel-title">Coming Soon.</h4><!--
                 <div class="btn-group" role="group" aria-label="">
                    <button role="button" class="btn btn-default" >
                        <span class="fa fa-twitter-square"></span>
                            Follow Twitter
                    </button>
                </div><!--button-group
            </div><!--panel-body
        </div><!--panel
    </div><!--panel-group    
</div><!--connecttwitter
-->
<script>
//Logged In / Logged Out of MPCgaming.com that transistions certain Buttons with the Active / Disabled Element Class.
$.get('/api/users/auth', null, function (authorized)
{
    if (Object.keys(authorized).length > 0)
    {
        // User is authenticated, which is what `authorized` is.
        $('.twitch-connect').removeClass('disabled');        
    }
    else
    {
        // User is not authenticated with MPCgaming.com, and `authorized` is garbage (probably an empty array or Object).
        $('.twitch-connect').addClass('disabled');    
        $('.twitch-disconnect').addClass('disabled');
        $('#twitch-subscribe').addClass('disabled');
        $('#twitch-unsubscribe').addClass('disabled');
    }
});
$('.twitch-connect').click(function () {
    Twitch.login({
        scope: ['user_read', 'channel_read', 'user_follows_edit']
    });
});
$('.twitch-disconnect').click(function () {
    Twitch.logout(function (error) {
        return window.location = "/connect";
    });
});
</script>