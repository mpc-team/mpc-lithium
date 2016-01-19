<?php

$this->title('Connect');

$self = $this;

?>
<div id="connectdiscord">
    <div class="row">
        <img src="/img/connect/discord-banner.png" alt="discord-banner.png" class="img-rounded img-responsive" id="discordbanner">
    </div>
    <div class="btn-group pull-right" role="group" aria-label="discord-btns" id="discord-btns">      
      <a role="button" class="btn btn-edit" data-toggle="collapse" href="#serverstatus-collapse" aria-expanded="false" aria-controls="serverstatus-collapse">Show Server</a>
      <a role="button" class="btn btn-edit" href="https://discord.gg/0iDKElOIs9m3KN86" target="_blank">Server Connect</a>
      <a role="button" class="btn btn-edit" href="https://discordapp.com/apps" target="_blank">Download</a>
      <a role="button" class="btn btn-edit" href="https://www.youtube.com/channel/UCZ5XnGb-3t7jCkXdawN2tkA/videos" target="_blank">YouTube</a>
    </div>        
    <div class="collapse" id="serverstatus-collapse">
        <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true"></iframe>
        <br />
        <a role="button" class="btn btn-edit" data-toggle="collapse" href="#serverstatus-collapse" aria-expanded="false" aria-controls="serverstatus-collapse" id="closeserver-btn">Close</a>
    </div>
</div>  
