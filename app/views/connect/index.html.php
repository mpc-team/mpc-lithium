<?php

$this->title('Connect');

$self = $this;

?>
<div id="connectdiscord">

    <div class="row text-center">
        <h1>Connect to MPC HQ with</h1>
        <a href="https://discordapp.com" target="_blank">
            <img src="/img/connect/discord-logo.png" alt="discord.png" class="img-responsive img-rounded" id="connect-discordlogo" />
        </a>
    </div>  
  
    <div class="row text-center">
        <img src="/img/information/discord.png" alt="discord.png" class="img-responsive img-rounded" id="connect-discordimg" style="margin:auto;"/>        
        <small class="text-center">
            <p>Don't forget to subscribe to 
                <a class="btn btn-edit" role="button" data-toggle="collapse" href="#discord-subscriberdiv" aria-expanded="false" aria-controls="discord-subscriberdiv">
                    discord!
                </a>
            </p>
        </small>
        <div class="collapse" id="discord-subscriberdiv">
            <div class="g-ytsubscribe" data-channelid="UCZ5XnGb-3t7jCkXdawN2tkA" data-layout="full" data-theme="dark" data-count="hidden" id="test"></div>
        </div>
    </div>

    <div class="row" id="download-discord">
        <h1 class="text-center">Direct Download</h1>
        <?= 
            $this->view()->render(array('element' =>'discordapp/downloadlist')); 
        ?>        
        </div>
        <div class="row">
            <a class="btn btn-edit" role="button"href="https://discord.gg/0iDKElOIs9mPyws8" target="_blank" id="connectserver"><h1>Connect to Our Server</h1></a>
            <a class="btn btn-edit" role="button" data-toggle="collapse" href="#showdiscordserver" aria-expanded="false" aria-controls="showdiscordserver" id="showserver">
  <h1>See Our Server Status</h1>
            </a>
            <div class="collapse text-center fade" id="showdiscordserver">
                <?= $this->view()->render(
		          array('element' => 'discordapp')
	            )?>
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
        <div class="row text-center">
            <h1>Clan Wars</h1>
            <?= 
                $this->view()->render(array('element'=>'clanwars/discord')); 
            ?>           
        </div>
    </div>
</div>
