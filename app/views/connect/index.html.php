<?php

$this->title('Connect');

$self = $this;

?>

<div id="connectdiscord">
    <div class="row">
        <img src="/img/connect/discord-banner.png" alt="discord-banner.png" class="img-rounded img-responsive" id="connect-discordbanner">
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="collapse" id="serverstatus-collapse">
                <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true"></iframe>
                <br />
                <a role="button" class="btn btn-edit" data-toggle="collapse" href="#serverstatus-collapse" aria-expanded="false" aria-controls="serverstatus-collapse" id="discord-hidebtn">Hide Server</a>
            </div>
        </div><!--col-md-4-->
        <div class="col-md-8-offset">
            <div class="btn-group pull-right" role="group" aria-label="discord-btns" id="discord-btns">     
              <a role="button" class="btn btn-edit" data-toggle="collapse" href="#serverstatus-collapse" aria-expanded="false" aria-controls="serverstatus-collapse" id="discord-showbtn">Show Server</a>
              <a role="button" class="btn btn-edit" href="https://discord.gg/0iDKElOIs9qLPTTd" target="_blank">Server Connect</a>
              <a role="button" class="btn btn-edit" href="https://discordapp.com/apps" target="_blank">Download</a>
              <a role="button" class="btn btn-edit" href="https://discordapp.com" target="_blank">Website</a>
              <a role="button" class="btn btn-edit" href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank">YouTube</a>
            </div><!--btngroup-->
            <ul class="list-group pull-left" id="discord-directionlist" style="margin: 5px 20px 5px 0;">
               <li class="list-group-item">
                    1) Click Show, or Connect Server.
                </li>
                <li class="list-group-item">
                    2) Consider to download, or using web browser access.
                </li>
                <li class="list-group-item">
                    3) Use temporary, or Register a Login with an email.
                </li>
                <li class="list-group-item">
                    4) Begin Speaking, and texting. Done!
                </li>
            </ul>
        </div><!--col-md-8-->    
    </div><!--row-->
</div><!--discord-->
<div id="connecttwitch">
    <script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>
    <div class="row">       
        <img src="/img/connect/twitch-banner.png" class="img-rounded img-responsive" id="connect-twitchbanner-png" />
    </div>
    <div class="row">
        <div class="col-md-8-offset">
            <div class="btn-group pull-left" role="group" aria-label="twitch-btns" id="twitch-btns">     
                <a role="button" class="btn btn-edit twitch-connect" id="twitch-connectbtn">
                    Connect
                </a>
                <a role="button" class="btn btn-edit" id="twitch-connectbtn">
                    Profile
                </a>
                <a role="button" class="btn btn-edit" href="http://www.twitch.tv" target="_blank">
                    Website
                </a>
            </div><!--btngroup-->            
        <ul class="list-group pull-right" id="twitch-directionlist" style="margin: 5px 0px 5px 0px;">    
            <li class="list-group-item">
                1) Login to Twitch from Here.
            </li>
            <li class="list-group-item">
                2) Stream Games.
            </li>
            <li class="list-group-item">
                3) Viewer interaction.
            </li>
            <li class="list-group-item">
                4) Brand yourself.
            </li>
            <li class="list-group-item">
                5) Generate Followers.
            </li>
         </ul>
      </div><!--twitch-colmd8-->
      <div class="col-md-4">
            
      </div><!--twitch-colmd4-->
    </div><!--row-->
    <script>
      
    </script>
</div><!--connect-twitch-->
<script>

//Twitch API

Twitch.init({clientId:'4fzsmbnkisk18wiuvdq3ds3xzhts31w'}, function(error, status) {
    // error encountered while loading
    if (error) {        
        console.log(error);
    }
    // the sdk is now loaded
    if (status.authenticated) {
        $('#twitch-connectbtn').html('Disconnect');
    } else if (!status.authenticated){
        $('#twitch-connectbtn').html('Connect');
    }
});

//Twitch Connect Button
$('.twitch-connect').click(function() {
    Twitch.login({
    scope: ['user_read', 'channel_read']
    });
})

//Changing Text on Click Events for Discord buttons.
$(function(){
    $('#serverstatus-collapse').on('show.bs.collapse', function(){
        $('#discord-directionlist').removeClass('pull-left');
        $('#discord-directionlist').addClass('pull-right');
        $('#discord-showbtn').html("Hide Server");
        $('#discord-hidebtn').html("Hide Server");                        
    })
    $('#serverstatus-collapse').on('hidden.bs.collapse', function(){
        $('#discord-directionlist').removeClass('pull-right');
        $('#discord-directionlist').addClass('pull-left');
        $('#discord-showbtn').html("Show Server");
        $('#discord-hidebtn').html("Show Server");
    })
});//end ready
</script>
