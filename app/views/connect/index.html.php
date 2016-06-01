<?php

$this->title('Connect');

$self = $this;

?>
<style>
    #caster-heading > .media > .media-body > p {font-size: 10pt;}
    #caster-heading > .media > .media-left > p {font-size: 10pt;}
</style>
<!--twitch api feed -->
<div class="jumbotron">
    <h1>CONNECT</h1>    
    <small id="connect-status"></small>
    <br / >
    <small id="connect-twitchstatus"></small>
    <br />
    <small id="connect-notification"></small>
    <br />
    <small id="connect-error"></small>
</div>
<div class="page-icon lower smaller pull-right">    
    <i style="transform: rotate(13deg);" class="fa fa-rss"></i>
</div>
<div id="connectdiscord">    
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/connect/discord-banner.png" alt="discord-banner.png" class="img-rounded img-responsive" id="connect-discordbanner" />
                </center>
            </div>
            <div class="panel-body">
                <div class="row">
                    <center>
                        <div class="btn-group btn-lg" role="group">
                            <a role="button" class="btn btn-default" href="https://discordapp.com/apps" target="_blank">
                                <span class="glyphicon glyphicon-download-alt"></span>
                                Download Discord
                            </a>
                        </div>
                        <div class="btn-group btn-lg" role="group">
                            <a role="button" class="btn btn-default" href="https://discordapp.com" target="_blank">
                                <span class="glyphicon glyphicon-home"></span>
                                Official Website
                            </a>
                        </div>
                        <div class="btn-group btn-lg" role="group">
                            <a role="button" class="btn btn-default" href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank">
                                <span class="fa fa-youtube"></span>
                                Tutorials
                            </a>
                        </div>
                    </center>
                    <p>MPC follows one basic rule, and that's being respectful to all members on the server. Please note, that any of the channels that have the "[In-Game]" title are members that are focusing on the game to try to win. As a tip, just ask politely if they are currently in game, and they will respond nicely back, but try not to disturb or interupt other players. Spamming/Communication Clutter will get you banned -- this is your warning.</p>
                </div>
                <div class="well">
                    <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true" style="height: 392px; margin-left: 5px; border: none;"></iframe>
                    <div class="row text-center" style="background-color: rgba(21, 21, 21, 0.81); border: 1px solid #fff; margin-left: 9px;">
                        <p style="text-indent: 15px; padding: 10px; margin-top: 2.5px; color: #fff;">
                            To get to MPC HQ, all you have to do is click the <b>"Connect"</b> button, type in a login, and you're in. Discord's software gives optimal performance.
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
    </div>
</div><!--discord-->
<div id="connecttwitch">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/connect/twitch-banner.png" alt="twitch-banner.png" class="img-rounded img-responsive" />
                 </center>
            </div>
            <div class="panel-body">
                <div class="row">
                    <p>Sign into your Twitch account, and allow the MPCommunity to follow your every performance.</p>
                    <ol>
                        <li>First Login to MPCgaming</li>
                        <li>A "Sign into Twitch" button will appear clickable below.</li>
                        <li>After clicking, the website will take you to Twitch.tv to verify your account, and return you back here.</li>
                        <li>Once logged into Twitch, Read Terms of Service, and Click the "I Understand" button.</li>
                        <li>See yourself on Mpcgaming.com.</li>
                    </ol>
                    <center>
                        <div class="btn-group btn-lg">
                            <a role="button" href="http://www.twitch.tv" target="_blank" class="btn btn-default">
                            <span class="fa fa-twitch"></span>
                                Official Website
                            </a>
                        </div>
                        <!--
                        <div class="btn-group btn-lg" id="twitch-logout-btn">
                            <a role="button" href="#" class="btn btn-default twitch-disconnect">
                            </a>
                        </div>
                            -->
                        <div class="btn-group btn-lg">
                            <a role="button" href="https://www.google.com/search?q=twitch+setup+tutorials&espv=2&biw=947&bih=690&tbm=vid&source=lnms&sa=X&ved=0ahUKEwipzbKW2_7MAhXoz4MKHWXFA8gQ_AUIBygB&dpr=1.35" class="btn btn-default" target="_blank">
                                <span class="fa fa-twitch"></span>
                                 Tutorials
                            </a>
                        </div>
                        <div class="btn-group btn-lg" id="twitch-login-btn">
                            <a role="button" href="#" class="btn btn-default twitch-connect">
                                <span class="glyphicon glyphicon-log-in"></span>
                                Sign Into Twitch
                            </a>
                        </div>            
                    </center>
                </div><!--row-->
                <div class="row">
                    <div class="well">
                        <div class="panel-group">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3>
                                    <span class="fa fa-twitch"></span>
                                    <small>Your</small> Twitch Account Application Sign up and Terms of Service Agreement</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <form action="/connect/appendtwitch" method="post">
                                        <input type="hidden" class="form-control" aria-describedby="mpcuser-id-label" name="mpc-userid" value="<?= $authorized['id'] ?>" readonly/>
                                        <input type="hidden" class="form-control" aria-describedby="twitch-name-label" id="twitch-username" name="twitch-username" readonly/>
                                        <input type="hidden" class="form-control" aria-describedby="twitchid-label" id="twitch-userid" name="twitch-userid" readonly/>
                                                                                
                                        <p>Submit for your Broadcast to Show up on MPCgaming.com. <b>Note:</b> No passwords will be given to mpcgaming.com from twitch.tv, and nor would you share your password for your MPC / Twitch account with anyone on this website -- Including Admins. After clicking I understand, you'll see your Twitch Account appear below under Community Broadcasting. Any reports of abuse will be resolved by Twitch, and be aware to adjust mature settings as formal warning to minors, or young viewers to avoid confrontation complaints to twitch.</p>
                                            <div class="btn-group btn-small">
                                                <button type="submit" role="button" class="btn btn-default" name="submit" id="twitch-submit">I Understand</button>
                                            </div>
                                        </form>
                                    </div><!--parent row-->
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--panel-group-->
                    </div><!--well-->
                </div><!--row-->
                <div class="row">
                    <div class="well">                       
                        <div class="panel-group">
                            <div class="panel">
                                <div class="panel-heading">                                    
                                    <h3>
                                    <span class="fa fa-twitch"></span>
                                    <small>Our</small> Community Broadcasts</h3>
                                    <small>Total Casters: <?= $totalCasters['count'] ?></small>
                                </div><!--panel-heading-->
                                <div class="panel-body">
                                    <div class="row">      
                                    <?php foreach($casters as $caster): ?>
                                        <div class="panel panel-default" id="<?= $caster['tname'] . '-' . $caster['tid'] ?>">
                                            <!--panel - heading -->
                                                <div class="panel-heading">
                                                    <div class="media">
                                                        <div class="media-left text-center" style="padding-right: 5px; padding-left: 5px;">
                                                            <img class="media-object user-avatar-container" id="twitch-<?= $caster['tname'] ?>-logo" />
                                                            <h4 class="media-heading" id ="twitch-<?= $caster['tname'] ?>-displayname"></h4>
                                                            <p class="twitch-signal-<?= $caster['tname'] ?>"><span class="label"><!--game-name--></span></p>
                                                        </div><!--media-left-->  
                                                        <div class="media-body" style="padding-left: 5px; padding-right: 5px;">
                                                            <p>Title: <span id="twitch-<?= $caster['tname'] ?>-panel-title" style="font-size: smaller"></span></p>
                                                            <p>Bio: <span id="twitch-<?= $caster['tname'] ?>-panel-bio" style="font-size: smaller"></span></p>
                                                            <p>Game: <span id="twitch-<?= $caster['tname'] ?>-panel-game" style="font-size: smaller"></span></p>
                                                            <p>url: <span id="twitch-<?= $caster['tname'] ?>-url" style="font-size: smaller"></span></p>
                                                            <p>followers: <span id="twitch-<?= $caster['tname'] ?>-followers" style="font-size: smaller"></span></p>
                                                            <p>viewers total: <span id="twitch-<?= $caster['tname'] ?>-viewers" style="font-size: smaller"></span></p>
                                                            <p>language: <span id="twitch-<?= $caster['tname'] ?>-language" style="font-size: smaller"></span></p>
                                                            <p>Mature Rating: <span id="twitch-<?= $caster['tname'] ?>-mature" style="font-size: smaller"></span></p>
                                                            <div class="btn-group" role="group" aria-label="">
                                                                <button role="button" class="btn btn-default" data-toggle="modal" data-target="#<?= $caster['tname'] . '-modal' ?>">
                                                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                                                        Show Broadcast
                                                                </button>
                                                            </div>
                                                        </div><!--media-body-->
                                                    </div><!--media-->
                                                </div>
                                            <!-- end panel-heading--> 
                                            <!-- modal per user -->
                                                <div class="modal fade" id="<?= $caster['tname'] . '-modal' ?>" tabindex="-1" role="dialog" aria-labelledby="#<?= $caster['tname'] . '-modal' ?>"Label">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="twitch-<?= $caster['tname'] ?>-modal-displayname"></h4>
                                                        <h4 class="modal-title" id="twitch-<?= $caster['tname'] ?>-modal-title"></h4>
                                                        <h4 class="modal-title" id="twitch-<?= $caster['tname'] ?>-modal-game"></h4>                                                        
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="row">
                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                <iframe id="<?= $caster['tname'] ?>-broadcast" allowfullscreen="allowfullscreen" src="http://player.twitch.tv/?channel=<?= $caster['tname'] ?>"><!--video--></iframe>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center">   
                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                <iframe id="<?= $caster['tname'] ?>-chat" src="http://www.twitch.tv/<?= $caster['tname'] ?>/chat" ><!--Chat--></iframe>
                                                            </div>
                                                        </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            <!-- end modal per user -->                                          
                                        </div><!--panel-default-->
                                        <?php endforeach; ?>
                                    </div><!--row-->
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--panel-group-->
                    </div><!--well-->
                </div><!--row-->
            </div><!--panel-body-->
        </div><!--panel-->    
    </div><!--panel-group-->
</div><!--connecttwitch-->
<script>

//Connect Notifications
    //Checks the URL to display statuses
    var url = $(location).attr('href');
    //Define the Notifications with Jquery
    $('#connect-notification').hide();
if (url == 'http://www.mpcgaming.com/connect?TwitchAccount=success')
{
    $('#connect-notification').show();
    $('#connect-notification').html('*Twitch Account Successfully Registered on Mpcgaming.com!');
}
if (url == 'http://mpcgaming.com/connect?TwitchAccount=Requirements+Failure')
{
    $('#connect-error').show();
    $('#connect-error').html('*ERROR* -- Report to Admin with this Code: TwitchAccount=Requirements+Failure');
}
if (url == 'http://mpcgaming.com/connect?TwitchAccount=Request+Data+Failure')
{
    $('#connect-error').show();
    $('#connect-error').html('*ERROR* -- Report to Admin with this Code: TwitchAccount=Request+Data+Failure');
}

//Logged In / Logged Out of MPCgaming.com that transistions certain Buttons with the Active / Disabled Element Class.
$.get('/api/users/auth', null, function (authorized)
{
    if (Object.keys(authorized).length > 0)
    {
        // User is authenticated, which is what `authorized` is.
        $('#twitch-login-btn').addClass('active');
        $('#twitch-logout-btn').addClass('active');
        $('#twitch-login-btn').removeClass('disabled');
        $('#twitch-logout-btn').removeClass('disabled');
        $('#connect-status').html('*Connected to Mpcgaming.com');
    }
    else
    {
        // User is not authenticated with MPCgaming.com, and `authorized` is garbage (probably an empty array or Object).
        $('#twitch-login-btn').removeClass('active');
        $('#twitch-logout-btn').removeClass('active');
        $('#twitch-login-btn').addClass('disabled');    
        $('#twitch-logout-btn').addClass('disabled');
        $('.twitch-connect').removeClass('active');
        $('.twitch-disconnect').removeClass('active');
        $('#twitch-submit').removeClass('active');
        $('#twitch-submit').addClass('disabled');
        $('.twitch-connect').addClass('disabled');
        $('.twitch-disconnect').addClass('disabled');
        $('#connect-status').html('*Not Connected to MPCgaming.com -- All features are not shown until signed into an account.');
    }
});

//Get the Live Status of the User by an object request. [Twitch Developer Syntax / Materla]
Twitch.getStatus(function (err, status) {
    if (status.authenticated) {
        //When the User is Authenticated into Twitch.
        console.log('User Authenticated');
        $('.twitch-connect').addClass('disabled');
        $('.twitch-disconnect').removeClass('disabled');
        $('#twitch-submit').removeClass('disabled');
        $('#connect-twitchstatus').html('*Connected to Twitch on Mpcgaming.com');
    } else {
        //When the User is not Authenticated with Twitch
        $('.twitch-disconnect').addClass('disabled');
        $('.twitch-connect').removeClass('disabled');
        $('#twitch-submit').addClass('disabled');
        $('#connect-twitchstatus').html('*Not Signed on to Twitch');
    }
});

//Controls to connect and disconnect from Twitch [Twitch Developer Syntax / Material]
$('.twitch-connect').click(function () {
    Twitch.login({
        scope: ['user_read', 'channel_read', 'user_follows_edit']
    });
});
$('.twitch-disconnect').click(function () {
    Twitch.logout(function (error) {
        console.log('User Disconnected from Twitch.');
        location.reload();
    });
$('.twitch-follow').click(function () {
    
    //
    
});
});//End of Control buttons.   
<?php foreach($casters as $caster): ?>

    //User Stream API Object
    $.getJSON('https://api.twitch.tv/kraken/streams/<?= $caster['tname'] ?>', function (object) {
        if (object["stream"] == null) {
            //IF channel is offline
            $('.twitch-signal-<?= $caster['tname'] ?> span').html('Offline').addClass('label-default').removeClass('label-succes');
            $('<?= $caster['tname'] . '-' . $caster['tid'] ?>').hide;
        } else {
            //If channel is Online
            $('.twitch-signal-<?= $caster['tname'] ?> span').html('Online').addClass('label-success').removeClass('label-default');
            $('<?= $caster['tname'] . '-' . $caster['tid'] ?>').show;
        }
    });   
     //Channel API Object
    $.getJSON('https://api.twitch.tv/kraken/channels/<?= $caster['tname'] ?>', function (object) {

        //User Channel API Object
            document.getElementById("twitch-<?= $caster['tname'] ?>-panel-game").innerHTML = object.game;
            if(object.game == null)
            {
                document.getElementById("twitch-<?= $caster['tname'] ?>-panel-game").innerHTML = 'Not Available';    
            }

            document.getElementById("twitch-<?= $caster['tname'] ?>-panel-title").innerHTML = object.status;
            document.getElementById("twitch-<?= $caster['tname'] ?>-followers").innerHTML = object.followers;
            document.getElementById("twitch-<?= $caster['tname'] ?>-viewers").innerHTML = object.views;
            document.getElementById("twitch-<?= $caster['tname'] ?>-url").innerHTML = object.url;
            document.getElementById("twitch-<?= $caster['tname'] ?>-mature").innerHTML = object.mature;

            if(object["mature"] == null)
            {
                document.getElementById("twitch-<?= $caster['tname'] ?>-mature").innerHTML = 'Not Available';    
            }

            document.getElementById("twitch-<?= $caster['tname'] ?>-language").innerHTML = object.broadcaster_language;
            if(object["broadcaster_language"] == null)
            {
                document.getElementById("twitch-<?= $caster['tname'] ?>-language").innerHTML = 'Not Available';    
            }
            document.getElementById("twitch-<?= $caster['tname'] ?>-modal-title").innerHTML = object.status;
            document.getElementById("twitch-<?= $caster['tname'] ?>-modal-game").innerHTML = object.game;
            document.getElementById("twitch-<?= $caster['tname'] ?>-modal-displayname").innerHTML = object.display_name;
            if (object.game == null){
                document.getElementById("twitch-<?= $caster['tname'] ?>-panel-game").innerHTML = 'Not Available';    
                document.getElementById("twitch-<?= $caster['tname'] ?>-modal-game").innerHTML = '';    
            }

    });  
    //User API Object
    $.getJSON('https://api.twitch.tv/kraken/users/<?= $caster['tname'] ?>', function (object) {

        //User Display Name
        document.getElementById("twitch-<?= $caster['tname'] ?>-displayname").innerHTML = object.display_name;

        //Biography
        document.getElementById("twitch-<?= $caster['tname'] ?>-panel-bio").innerHTML = object.bio;
        if (object["bio"] == null || object["bio"] == " " || object["bio"] == "")
        {            
            document.getElementById("twitch-<?= $caster['tname'] ?>-panel-bio").innerHTML = 'Not Available';    
        }
        //Logo
        document.getElementById("twitch-<?= $caster['tname'] ?>-logo").src = '' + object.logo + '';        
        if (object["logo"] == null)
        {    
            document.getElementById("twitch-<?= $caster['tname'] ?>-logo").src = 'http://www.mpcgaming.com/users/avatars/noprofile.png';               
        }
    });
<?php endforeach; ?>
</script>