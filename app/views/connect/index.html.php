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
        <img src="/img/information/discord.png" alt="discord.png" class="img-responsive img-rounded" id="connect-discordimg"/>
        <p class="text-center">Some of the games that MPC plays for do have some regulation on using this application to play in the ranked, league games. None of the members are forced to download this application, but for higher quality communication, and team member management control, this will be required to participate in the serious-go-getters divisions of MPC.</p><br />
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
        <ul class="list-group" id="download-discordlistgroup">
            <a href="https://discordapp.com/api/download?platform=osx"><li class="list-group-item">MAC OSX</li></a>
            <a href="https://discordapp.com/api/download?platform=win"><li class="list-group-item">Windows PC</li></a>
            <li class="list-group-item disabled" href="#">
                Linux               
            </li>
            <a href="https://itunes.apple.com/us/app/discord-chat-for-games/id985746746"><li class="list-group-item">Apple IOS</li></a>
            <a href="https://play.google.com/store/apps/details?id=com.discord"><li class="list-group-item">Android</li></a>
        </ul>
        </div>
        <div class="row">
            <a class="btn btn-edit" role="button" data-toggle="collapse" href="#showdiscordserver" aria-expanded="false" aria-controls="showdiscordserver" id="showserver">
  <h1>Connect to Our Server</h1>
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
        <div class="row" >
            <?=
                $this->view()->render(array('element' => 'discordapp/tutorial'));
            ?>
        </div>
    </div>
</div>
