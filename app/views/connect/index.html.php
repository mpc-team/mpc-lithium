<?php

$this->title('Connect');

$self = $this;

?>
<div id="connectdiscord">
    <div class="row">
        <img src="/img/connect/discord-banner.png" alt="discord-banner.png" class="img-rounded img-responsive" id="connect-discordbanner">
        <div class="pull-right" id="discord-menudiv">
            <div class="btn-group" role="group" id="discord-menubtns">
                  <button type="button" class="btn btn-edit btn-lg" href="https://discordapp.com/apps" target="_blank" style="color: #aaffaa;">Download</button>
                  <button class="btn btn-edit btn-lg" role="button" data-toggle="collapse" href="#showdiscordserver" aria-expanded="false" aria-controls="showdiscordserver" id="showserver" style="color: #aaffaa;">Server Status</button>
                  <a class="btn btn-edit btn-lg" role="button" href="https://discord.gg/0iDKElOIs9mPyws8" id="connectserver" style="color: #aaffaa; line-height: 2;">Connect to Server</a>
            </div>
             <?= 
            $this->view()->render(array('element' =>'discordapp/downloadlist')); 
            ?>       
        </div>

        <div class="collapse text-center fade" id="showdiscordserver">
            <?= $this->view()->render(array('element' => 'discordapp/discordapp'))?>
            <br />
            <a class="btn btn-edit" role="button" data-toggle="collapse" href="#showdiscordserver" aria-expanded="false" aria-controls="showdiscordserver">
                Close
            </a>
        </div>

    </div>     
    <div class="row text-center">
        <!--<h1>Tutorials</h1>-->
        <?=
            $this->view()->render(array('element' => 'discordapp/tutorial'));
        ?>
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
