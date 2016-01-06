<div id="infocommunication">
    <div class="row">
        <h1 class="text-center">
            <span class="label label-default">
                <a href="https://discordapp.com/apps" target="_blank">
                    DiscordApp
                </a>
            </span>
        </h1>
    </div>    
    <div class="row">
        <img src="/img/information/discord.png" alt="discord.png" class="img-responsive img-rounded" />
        <p class="text-center">Some of the games that MPC plays for do have some regulation on using this application to play in the ranked, league games. None of the members are forced to download this application, but for higher quality communication, and team member management control, this will be required to participate in the serious-go-getters divisions of MPC.</p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Install on which device?</h3>
            <ul class="list-group">
                <a href="https://discordapp.com/api/download?platform=osx"><li class="list-group-item">MAC OSX</li></a>
                <a href="https://discordapp.com/api/download?platform=win"><li class="list-group-item">Win. PC</li></a>
                <li class="list-group-item disabled" href="#">Linux</li>
                <a href="https://itunes.apple.com/us/app/discord-chat-for-games/id985746746"><li class="list-group-item">Apple IOS</li></a>
                <a href="https://play.google.com/store/apps/details?id=com.discord"><li class="list-group-item">Android</li></a>
            </ul>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-edit">Discord Dropdown</button>
            <?= $this->view()->render(
		      array('element' => 'discordapp')
	        )?>
        </div>
    </div>
</div>
