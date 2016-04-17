<?php

$this->title('Connect');

$self = $this;

?>
<script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>
<style>

</style>
<div class="jumbotron">
    <h1>CONNECT</h1>
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
                    <script type="text/javascript">
                        $(document).ready(function() {

                            function validateDiscordID (discordid) {
                            
                                
                                
                            }
                        });
                    </script>
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
                    <p>Share the broadcast on mpcgaming.com! Login with your twitch account, and follow our members. More updates coming soon!</p>
                    <center>
                        <div class="btn-group btn-lg">
                            <a role="button" href="http://www.twitch.tv" target="_blank" class="btn btn-default">
                            <span class="fa fa-twitch"></span>
                                Official Website
                            </a>
                        </div>
                        <div class="btn-group btn-lg" id="twitch-login-btn">
                            <a role="button" href="#" class="btn btn-default twitch-connect">
                                <span class="glyphicon glyphicon-log-in"></span>
                                Login
                            </a>
                        </div>
                        <div class="btn-group btn-lg" id="twitch-logout-btn">
                            <a role="button" href="#" class="btn btn-default twitch-disconnect">
                                <span class="glyphicon glyphicon-log-out"></span>
                                Log Out
                            </a>
                        </div>            
                        <div class="btn-group btn-lg" >
                            <a role="button" href="#" class="btn btn-default disabled">
                                <span class="fa fa-television"></span>
                                Request to Cast
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
                                    Account Information</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="twitch-username">User Name</span>
                                                <input type="text" class="form-control" aria-describedby="twitch-name-label" id="channel-username" readonly/>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="twitch-userid">Twitch ID</span>
                                                <input type="text" class="form-control" aria-describedby="twitch-id-label" id="channel-userid" readonly/>
                                            </div>
                                        </div><!--col-->
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="twitch-displayname">Display Name</span>
                                                <input type="text" class="form-control" aria-describedby="twitch-displayname-label" id="channel-displayname" readonly/>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="twitch-userurl">URL</span>
                                                <input type="text" class="form-control" aria-describedby="twitch-userurl-label" id="channel-userurl" readonly />
                                            </div>
                                        </div><!--col-->
                                    </div><!--parent row-->
                                    <div class="discordui-content">
                                            
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                                
                                            var discord = {};
                                            discord.ui = {};

                                            discord.htmlElements = {
                                                content: '#discordui-content',
                                            };

                                                        /**
                                                            * Validates the content of an Announcement.
                                                            * 
                                                            * @param {string} content - Content being validated.
                                                            * 
                                                            * @returns {bool} - True if the content is valid.
                                                            */

                                                        discord.validate = function(content){
                                                            if (content == null)
		                                                        return "nulldata";
	                                                        else if (content.length == 0)
		                                                        return "empty";
	                                                        else
		                                                        return "valid";
                                                        }
                                            });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--panel-body-->
        </div><!--panel-->    
    </div><!--panel-group-->
</div><!--connecttwitch-->
<script>
//MPC Website

$.get('/api/users/auth', null, function (authorized)
{
    if (Object.keys(authorized).length > 0)
    {
    // User is authenticated, which is what `authorized` is.
    $('#twitch-login-btn').show();
    $('#twitch-logout-btn').show();
    }
    else
    {
    // User is not authenticated with MPCgaming.com, and `authorized` is garbage (probably an empty array or Object).
    $('#twitch-login-btn').hide();
    $('#twitch-logout-btn').hide();
    }
});
</script>
<script>
//Twitch API

//Initiate Twitch -> load the SDK and grant access to Twitch's API with MPC's Client ID
    Twitch.init({clientId: '4fzsmbnkisk18wiuvdq3ds3xzhts31w'}, function(error, status) {
        // the sdk is now loaded
        console.log ( 'Twitch Running' );
        if (error) {
        // error encountered while loading
            console.log(error);
        }
    });
    //Get Status of the User
    Twitch.getStatus(function(err, status) {
        if (status.authenticated) {
            console.log ( 'User Authenticated' );
        }
    });   
    //Channel into the User's API Object
    Twitch.api({method: 'channel'}, function(error, channel) {
      $('#channel-displayname').val(channel.display_name);
      $('#channel-username').val(channel.name);
      $('#channel-userurl').val(channel.url);
      $('#channel-userid').val(channel._id);
    });
    //Controls
    $('.twitch-connect').click(function() {
        Twitch.login({
        scope: ['user_read', 'channel_read']
        });          
    });
    $('.twitch-disconnect').click(function() {
        Twitch.logout(function(error) {
            console.log ( 'User Disconnected from Twitch.' );
            location.reload();
        });
    }); 

  
   
</script>

