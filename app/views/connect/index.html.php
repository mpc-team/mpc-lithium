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
            <ul class="list-group pull-left" id="discord-directionlist" style="margin: 5px 20px 5px 0;">
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
        <img src="/img/connect/twitch-banner.png" class="img-rounded img-responsive" id="connect-twitchbanner-png" />
    </div>
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="#" role="button" data-toggle="collapse" data-parent="#caster-accordion" href="#caster-1-collapse" aria-expanded="false" aria-controls="caster-1-collapse">Person1</a></li>
                    <li role="presentation"><a href="#" role="button" data-toggle="collapse" data-parent="#caster-accordion" href="#caster-2-collapse" aria-expanded="false" aria-controls="caster-2-collapse">Person2</a></li>
                    <li role="presentation"><a href="#" role="button" data-toggle="collapse" data-parent="#caster-accordion" href="#caster-3-collapse" aria-expanded="false" aria-controls="caster-3-collapse">Person3</a></li>
                </ul>
            </div><!--head-->
            <div class="panel-body">
                <div class="panel-group" id="caster-accordion" role="tablist" aria-multiselectable="true">
                    <div id="caster-1-collapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse--heading">
                    one
                    </div>
                    <div id="caster-2-collapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse--heading">
                        two
                    </div>
<div id="caster-3-collapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse--heading">
                three
                    </div>
                </div><!--multi select collapseable-->
            </div><!--body-->
            <div class="panel-footer">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="#">button</a></li>
                    <li role="presentation"><a href="#">follow</a></li>
                    <li role="presentation"><a href="#">share</a></li>
                    <li role="presentation"><a href="#">url</a></li>
                </ul>
            </div><!--foot-->
        </div><!--panel-->
    </div><!--row-->
</div><!--connect-twitch-->
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
