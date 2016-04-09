<?php

$this->title('Connect');

$self = $this;

?>
<style>

    /*Layout*/

    #connect-discordbanner{height: 300px; margin-right: 5px; opacity: .88;}
    #connectdiscord > .row {
            
            /* For browsers that do not support gradients */
            background: rgba(115,139,215, .9); 
            /* For Safari 5.1 to 6.0 */
            background: -webkit-linear-gradient(right, rgba(0,0,0,.5), rgba(0,0,0,.5), rgba(115,139,215, .9), rgba(0,0,0,.5), rgba(0,0,0,.5));
            /* For Opera 11.1 to 12.0 */
            background: -o-linear-gradient(right, rgba(0,0,0,.5), rgba(0,0,0,.5), rgba(115,139,215, .9), rgba(0,0,0,.5), rgba(0,0,0,.5));
            /* For Fx 3.6 to 15 */
            background: -moz-linear-gradient(right, rgba(0,0,0,.5), rgba(0,0,0,.5), rgba(115,139,215, .9), rgba(0,0,0,.5), rgba(0,0,0,.5));
            /*Standard Syntax*/
            background: linear-gradient(to right, rgba(0,0,0,.5), rgba(0,0,0,.5), rgba(115,139,215, .9), rgba(0,0,0,.5), rgba(0,0,0,.5));

    }
    #connectdiscord > .row{background-color: rgba(115,139,215, .3); padding: 12px; margin: 15px 0 15px 0;}    
    #connectdiscord > .row > .col-md-7 > p, #connectdiscord > .row > .col-md-5 > p{text-indent: 15px; padding: 10px; max-width: 570px; margin-top: 8px; color: #fff;background-color: rgba(21, 21, 21, 0.81); margin-right: 1px; border: 1px solid #fff; text-shadow: 0px 0px 15px rgba(115,139,215, .9); font-weight: 600;}

    /*discord buttons*/

    #connectdiscord > .row > .col-md-7 > .btn-group{padding: 0px;}
    #connectdiscord > .row > .col-md-7 > .btn-group > .btn-default{background-color: rgba(21, 21, 21, 0.81); margin: 5px; color: #fff;border-color: #fff; text-shadow: 0px 0px 15px rgba(115,139,215, .9); box-shadow: 0px 0px 15px rgba(115,139,215, .9);}

    /*Hover Effects*/

    #connectdiscord > .row > .col-md-5 > .row > a:hover{text-shadow: 1px 1px 15px #fff;}
    #connectdiscord > .row > .col-md-7 > .btn-group > .btn-default:hover{box-shadow: 0px 0px 20px #aaffaa;}

</style>
<div class="jumbotron">
    <h1>CONNECT</h1>
</div>
<div id="connectdiscord">    
    <div class="row">
        <div class="col-md-7">
            <img src="/img/connect/discord-banner.png" alt="discord-banner.png" class="img-rounded img-responsive" id="connect-discordbanner" />
            <p>
                Download Discord, then install the software, and you will be able to use the <b>Connect</b> button on the right, or below if you're on a mobile device.     
            </p>            
            <div class="btn-group btn-lg" role="group">
                <a role="button" class="btn btn-default" href="https://discordapp.com/apps" target="_blank">
                    Download Discord
                </a>
            </div>
            <div class="btn-group btn-lg" role="group">
                <a role="button" class="btn btn-default" href="https://discordapp.com" target="_blank">
                    Official Website
                </a>
            </div>
            <div class="btn-group btn-lg" role="group">
                <a role="button" class="btn btn-default" href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank">
                    YouTube Tutorials
                </a>
            </div>
            <p style="text-indent: 15px;max-width: 570px; color: #fff;background-color: rgba(21, 21, 21, 0.81); border: 1px solid #fff; text-shadow: 0px 0px 15px rgba(115,139,215, .9); font-weight: 600;">MPC follows one basic rule, and that's being respectful to all members on the server. Please note, that any channels that have the "[In-Game]" title are members that are focusing on the game to try to win. As a tip, just ask politely if they are currently in game, and they will respond nicely back, but try not to disturb or interupt other players. Spamming/Communication Clutter will get you banned -- this is your warning.</p>
        </div><!--col-->
        <div class="col-md-5">
                <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true" style="height: 300px; margin-left: 5px; border: none;"></iframe>
            <br />
            <p style="text-indent: 15px; padding: 10px;max-width: 570px; margin-top: 2.5px; color: #fff;background-color: rgba(21, 21, 21, 0.81); margin-left: 5px; margin-right: -5px; border: 1px solid #fff;">
                To get to MPC HQ, all you have to do is click the <b>"Connect"</b> button, type in a login, and you're in.
            </p>
            <div class="row text-center">
                <h4>
                    MPC's Discord URL:
                </h4>
                <a href="https://discord.gg/0iDKElOIs9mib3Oc" target="_blank" style="color: #fff;">https://discord.gg/0iDKElOIs9mib3Oc</a>
            </div>
            <div class="row text-center">
                <h4>
                    MPC's Discord Logo:
                </h4>
                <img src="/img/logo2016.jpg" alt="logo2016.jpg" style="border: 2px solid #111; width: 64px; margin: auto;" class="img-responsive img-rounded" />
            </div>
        </div><!--col-->
    </div><!--row-->
</div><!--discord-->
<div class="connecttwitch">
    <div class="row" style="margin: 15px 0 15px 0; background-color: rgba(100,65,165,.3); padding: 12px;">
        <div class="col-md-7">
             <img src="/img/connect/twitch-banner.png" alt="twitch-banner.png" class="img-rounded img-responsive" id="connect-twitchbanner" style="height: 300px;">
             <p style="text-indent: 15px; padding: 10px; max-width: 570px; margin-top: 8px; color: #fff;background-color: rgba(21, 21, 21, 0.81); margin-right: 1px;">
                Share the broadcast on mpcgaming.com! Login with your twitch account, and follow our members. More updates coming soon!
             </p>
            <div class="btn-group btn-lg">
                <a role="button" href="http://www.twitch.tv" target="_blank" class="btn btn-default" style="color: #fff; background-color: rgba(100,65,165,.9);">
                    Official Website
                </a>
            </div>
            <div class="btn-group btn-lg" id="twitch-login-btn">
                <a role="button" href="#" class="btn btn-default twitch-connect" style="color: #fff; background-color: rgba(100,65,165,.9);">
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
            
       </div>
    </div><!--row-->
</div><!--connecttwitch-->
<script>

    $.get('/api/users/auth', null, function (authorized)
    {
        if (Object.keys(authorized).length > 0)
        {
        // User is authenticated, which is what `authorized` is.
        $('#twitch-login-btn').show();
        }
        else
        {
        // User is not authenticated, and `authorized` is garbage (probably an empty array or Object).
        $('#twitch-login-btn').hide();
        }
    });

</script>
<script>

Twitch.init({clientId: '4fzsmbnkisk18wiuvdq3ds3xzhts31w'}, function(error, status) {
    if (error) {
    // error encountered while loading
        console.log(error);
    }
    // the sdk is now loaded
    if (status.authenticated) {
    // Already logged in, hide button
        $('.twitch-connect').html("Logged In");
    }

});     


</script>

