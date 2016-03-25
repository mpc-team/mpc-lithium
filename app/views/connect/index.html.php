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
            <h4>
                Resources: <span class="label label-edit">Support/FAQ</span>
            </h4>
            <div class="btn-group btn-lg" role="group" aria-label="...">                    
                    <a role="button" class="btn btn-default" href="https://discordapp.com/apps" target="_blank" style="background-color: rgba(115,139,215, .3);margin: 5px;color: #fff;border-color: rgba(0,0,0,.9);">
                        Download Discord
                    </a>
                    <a role="button" class="btn btn-default" href="https://discordapp.com" target="_blank" style="background-color: rgba(115,139,215, .3);margin: 5px;color: #fff;border-color: rgba(0,0,0,.9);">Official Website</a>
                    <a role="button" class="btn btn-default" href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank" style="background-color: rgba(115,139,215, .3);margin: 5px;color: #fff;border-color: rgba(0,0,0,.9);">YouTube Tutorials</a>
            </div>
        </div>
        <div class="col-md-5">
                <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true" style="border-top: 1px solid #fff; border-bottom: none; border-right: 1px solid #fff; border-right: none; margin-bottom: -5px; height: 300px;"></iframe>
            <br />
            <p style="text-indent: 15px; border-bottom: 1px solid #fff;border-right: 1px solid #fff;border-top: 1px solid #fff;padding: 10px;border-left: 1px solid #fff; max-width: 570px; margin-top: 1.5px; color: #fff;background-color: rgba(21, 21, 21, 0.81);/* box-shadow: 1px 1px 15px #fff inset; */">
                MPC HQ Server Status, and join by clicking the <b>"Connect" button (above)</b>. Then say hello, or write a friendly message greeting.
            </p>
            <div class="btn-group btn-lg">
                <h4>
                    MPC's Discord URL: <span class="label label-edit">0iDKElOIs9qLPTTd</span>
                </h4>
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

