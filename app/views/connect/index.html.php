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
        </div><!--col-md-5-->
        <div class="col-md-8-offset">
            <div class="btn-group pull-right" role="group" aria-label="discord-btns" id="discord-btns">     
              <a role="button" class="btn btn-edit" data-toggle="collapse" href="#serverstatus-collapse" aria-expanded="false" aria-controls="serverstatus-collapse" id="discord-showbtn">Show Server</a>
              <a role="button" class="btn btn-edit" href="https://discord.gg/0iDKElOIs9m3KN86" target="_blank">Server Connect</a>
              <a role="button" class="btn btn-edit" href="https://discordapp.com/apps" target="_blank">Download</a>
              <a role="button" class="btn btn-edit" href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank">YouTube</a>
            </div><!--btngroup-->
            <ul class="list-group pull-left" id="discord-directionlist" style="margin: 5px 20px 0 0;">
                <li class="list-group-item">
                    1) Click Show, or Connect.
                </li>
                <li class="list-group-item">
                    2) Consider Downloading, or using a web browser.
                </li>
                <li class="list-group-item">
                    3) Use, or Register a Login.

                </li>
                <li class="list-group-item">
                    3) Begin Speaking, and texting. Done!
                </li>
            </ul>
        </div><!--col-md-7-->    
    </div><!--row-->
</div><!--discord-->
<div id="connect-twitch">
    <div class="row">
        //img
    </div>
    <div class="row">
        panelhead//buttons tab navs of casters

        panelbody//collapse casters

        panelfoot//butons tab navs of casters
    </div>
</div>
<script>

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
