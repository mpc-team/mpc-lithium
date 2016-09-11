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
<div class="well text-center" style="color: #fff;">
    <p>Members can link up their party applications to this website for Various Actions that can be performed from MPCgaming.com.</p>
</div>
<div id="connectdiscord"><a name="discord"></a>
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <img src="/img/connect/discord-banner.png" alt="discord-banner.png" class="img-rounded img-responsive connect-banner"/>
            </div><!--panel-heading-->
            <div class="panel-body">
                <div class="row">
                    <center>                       
                        <div class="btn-group btn-lg" role="group">
                            <a href="https://discordapp.com/apps" target="_blank">
                                <button role="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-download-alt"></span>
                                    Download Discord
                                </button>
                            </a>
                        </div><!--btn-->
                        <div class="btn-group btn-lg" role="group">
                            <a href="https://discordapp.com" target="_blank">
                                <button role="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-home"></span>
                                    Official Website
                                </button>
                            </a>
                        </div><!--btn-->
                        <div class="btn-group btn-lg" role="group">
                            <a href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank">
                                <button role="button" class="btn btn-default">
                                    <span class="fa fa-youtube"></span>
                                    Tutorials
                                </button>
                            </a>
                        </div><!--btn-->
                        <div class="btn-group btn-lg" role="group">
                            <button role="button" class="btn btn-default" data-toggle="modal" data-target="#notice">
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                Notices
                            </button>
                        </div><!--btn-->
                    </center>
                </div><!--row-->
                <div class="modal fade" id="notice" tabindex="-1" role="dialog" aria-labelledby="discordNoticeLBL">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Known Update Bug</h4>
                      </div><!--modal-header-->
                      <div class="modal-body">
                         <p>Stuck in a never ending update loop?  There's a couple of steps that we can take to help get you back up and running. Better than ever before! Locate Discord in the local appdata folder. The easies...</p>
                         <a href="https://support.discordapp.com/hc/en-us/articles/217801498--Windows-Stuck-in-an-update-fail-loop-" target="_blank">https://support.discordapp.com/hc/en-us/articles/217801498--Windows-Stuck-in-an-update-fail-loop-</a>
                      </div><!--modal-body-->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div><!--modal-footer-->
                    </div><!--modal-content-->
                  </div><!--modal-dialog-->
                </div><!--modal-->
                <div class="well">
                    <div class="row">
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
                        </div><!--row-->
                        <div class="row text-center">
                            <h4>
                                MPC's Discord URL:
                            </h4>
                            <a href="https://discord.gg/0iDKElOIs9mib3Oc" target="_blank" style="color: #fff; font-weight: 600;">https://discord.gg/0iDKElOIs9mib3Oc</a>
                        </div><!--row-->
                        <div class="row text-center">
                            <h4>
                                MPC's Discord Logo:
                            </h4>
                            <img src="/img/logo2016.jpg" alt="logo2016.jpg" style="border: 2px solid #111; width: 64px; margin: auto;" class="img-responsive img-rounded" />
                        </div><!--row-->
                    </div><!--parent row-->
                </div><!--well-->
            </div><!--panel-body-->
        </div><!--panel-->
    </div><a name="twitch"></a><!--panel-group-->
</div><!--connect-discord-->
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
                            <a href="http://www.twitch.tv" target="_blank">
                                <button role="button" class="btn btn-default">
                                <span class="fa fa-twitch"></span>
                                    Official Website
                                </button>
                            </a>
                        </div>
                        <div class="btn-group btn-lg">
                            <a href="https://www.google.com/search?q=twitch+setup+tutorials&espv=2&biw=947&bih=690&tbm=vid&source=lnms&sa=X&ved=0ahUKEwipzbKW2_7MAhXoz4MKHWXFA8gQ_AUIBygB&dpr=1.35" target="_blank">
                                <button role="button" class="btn btn-default">
                                    <span class="fa fa-twitch"></span>
                                    Tutorials
                                </button>
                            </a>
                        </div>
                        <div class="btn-group btn-lg" id="twitch-login-btn">
                            <button role="button" href="#" class="btn btn-default twitch-connect disabled">
                                <span class="glyphicon glyphicon-log-in"></span>
                                Connect Twitch
                            </button>
                        </div>
                        <div class="btn-group btn-lg" id="twitch-logout-btn">
                            <button role="button" href="#" class="btn btn-default twitch-disconnect disabled">
                                <span class="glyphicon glyphicon-log-out"></span>
                                Disconnect Twitch
                            </button>
                        </div>                        
                    </center>
                </div><!--row-->
                <div class="well" id="twitchinfo">
                    <div class="row">
                        <div class="col-md-8">
                            <p>Setup Instructions:</p>
                            <ol class="list-group">
                                <li class="list-group-item">First <a href="/login">Login</a>, or if needed, you must <a href="/signup">Sign Up.</a></li>
                                <li class="list-group-item">A "Connect Twitch" button will appear available Above.</li>
                                <li class="list-group-item">After Authenticating on Twitch, you'll return here.</li>
                                <li class="list-group-item">Read Notice, and Press the "Add Cast" button.</li>
                                <li class="list-group-item">To Remove Your Registered Twitch Stream, then Press the "Remove Cast" button.</li>
                            </ol>
                        </div><!--col-->
                        <div class="col-md-4">
                            <p>Connected Benefits:</p>
                            <ul class="list-group">
                                <li class="list-group-item">Viewed Here on this Site.</li>
                                <li class="list-group-item">Helpful to Draw More Reputation.</li>
                                <li class="list-group-item">Recognized by the Community.</li>
                                <li class="list-group-item">Express Enthusiasm for Gaming.</li>
                                <li class="list-group-item">Use your Twitch to Stream, Chat, or Follow.</li>
                            </ul>
                        </div><!--col-->
                    </div><!--row-->
                    <div class="panel-heading" id="twitchapp"> 
                        <div class="row">
                            <div class="col-md-8">
                                <h3>
                                    <span class="fa fa-2x fa-twitch"></span>
                                        Twitch
                                </h3>
                            </div><!--col-->
                            <div class="col-md-4">
                                <p class="pull-right">
                                    <b><?= $totalCasters ?></b> Members Registered
                                </p>
                            </div><!--col-->
                        </div><!--row-->
                    </div><!--panel-heading-->
                    <div class="panel-body">
                        <div class="row">
                            <?php if($adminPermissions): ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr><td>Caster Name</td></tr>
                                </thead>
                                <tbody id="twitchapp-castlist">
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
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
                                            <button role="button" class="btn btn-default">Delete</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--modals of are you sure before form submit -->
                                    </div>
                                    <div class="row">
                                        <!--preview of the person-->
                                    </div>
                                    <div class="row">
                                        <p id="demo"></p>
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
                            <h3>Notice</h3>
                            <p style="border: 1px solid #fff;">Twitch allows MPC to retrieve your account information, and allow MPC Users to perform actions like view, chat, follow, but requires you to log in with permission from Twitch before you can do that here. Submit for your Broadcast to Show up on MPCgaming.com. <b>Note:</b> You <u>MUST NEVER</u> share your password for your MPC, or Twitch account, with anyone -- including Admins, and Officers of MPC, or any other person. <br /> Please Obey Twitch's Policies for Broadcasting. Your Twitch Account will appear on the Streams Section. All reports of abuse will be resolved by Twitch, and be aware to adjust your <b>mature</b> settings on twitch.tv, for young viewers, that will help avoid confrontation complaints; to and from Twitch -- viewer descreation is advised for Mature Audiences.</p>                
                            <form action="/connect/appendtwitch" name="appendtwitch" method="post" >
                                <div class="btn-group btn-small pull-right">
                                    <button type="submit" role="button" class="btn btn-default disabled" name="twitch-subscribe" id="twitch-subscribe">Add Cast</button>
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
                                <?php if($authorized['id']): ?>
                                <input type="hidden" class="form-control" aria-describedby="mpcuser-id-label" name="deletempc-userid" value="<?= $authorized['id'] ?>" readonly/>
                                <input type="hidden" class="form-control" aria-describedby="twitch-name-label" id="deletetwitch-username" name="deletetwitch-username" readonly/>
                                <input type="hidden" class="form-control" aria-describedby="twitchid-label" id="deletetwitch-userid" name="deletetwitch-userid" readonly/>
                                <?php endif; ?>
                            </form>
                            <div class="btn-group btn-small pull-right">
                                <a href="/streams">
                                    <button role="button" class="btn btn-default">View Casters</button>
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
<div id="connectfacebook">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/connect/facebook-banner.png" alt="facebook-banner.png" class="img-rounded img-responsive" />      
                </center>
            </div>
            <div class="panel-body">
                <h4 class="panel-title">Coming Soon.</h4>
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
var url = window.location;
var redirect = "/connect";
var error = "http://www.mpcgaming.com/connect?error=redirect_mismatch&error_description=Parameter+redirect_uri+does+not+match+registered+URI";
var error1 = "http://www.mpcgaming.com/connect?TwitchAccountDeletion=Failed+Not+Connected+To+Twitch";
if (url == error){
    alert('Failed Twitch Connection -- Please Try Again.');
    window.location.replace(redirect);  
}
if (url == error1){
    alert('Failed To Remove Twitch -- Must Sign Connect To Twitch First.');
    window.location.replace(redirect);
}
</script>