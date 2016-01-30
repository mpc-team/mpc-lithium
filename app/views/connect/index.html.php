<?php

$this->title('Connect');

$self = $this;

?>
<div id="connectdiscord">
    <div class="row">
        <img src="/img/connect/discord-banner.png" alt="discord-banner.png" class="img-rounded img-responsive" id="connect-discordbanner">
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="collapse" id="serverstatus-collapse">
                <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true"></iframe>
                <br />
            </div>
        </div><!--col-md-5-->
        <div class="col-md-7-offset">
            <div class="btn-group pull-right" role="group" aria-label="discord-btns" id="discord-btns">     
              <a role="button" class="btn btn-edit" data-toggle="collapse" href="#serverstatus-collapse" aria-expanded="false" aria-controls="serverstatus-collapse" id="discord-showbtn">Show Server</a>
              <a role="button" class="btn btn-edit" href="https://discord.gg/0iDKElOIs9m3KN86" target="_blank">Server Connect</a>
              <a role="button" class="btn btn-edit" href="https://discordapp.com/apps" target="_blank">Download</a>
              <a role="button" class="btn btn-edit" href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank">YouTube</a>
            </div><!--btngroup-->
            <ul class="list-group pull-left" id="discord-directionlist" style="margin: 15px 20px 0 0;">
                <li class="list-group-item">
                    <p>1) Create a Name.</p>
                </li>
                <li class="list-group-item">
                    <p>2) Use either the "Show", or "Connect to Server" button.</p>
                </li>
                <li class="list-group-item">
                    <p>3) Begin Speaking, and texting. Done!</p>
                </li>
            </ul>
        </div><!--col-md-7-->    
    </div><!--row-->
</div>
<script>

    $(function(){
        $('#serverstatus-collapse').on('show.bs.collapse', function(){
            $('#discord-directionlist').removeClass('pull-left');
            $('#discord-directionlist').addClass('pull-right');
            $('#discord-showbtn').html("Hide Server");            
        })
        $('#serverstatus-collapse').on('hidden.bs.collapse', function(){
            $('#discord-directionlist').removeClass('pull-right');
            $('#discord-directionlist').addClass('pull-left');
            $('#discord-showbtn').html("Show Server");
        })
    });//end ready
</script>
