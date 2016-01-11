<div id="communication">
    <div class="row">
        <img src="/img/clash_of_clans/communication-banner.png" alt="communication-banner.png" class="img-rounded img-responsive coc-img-center" />
        <br />
        <p class="text-center" style="color: #aaffaa;">Join us on our server via DiscordApp:</p>
        <p>These buttons are for MPC Assassins. Use the connect button at the bottom of the live server status to connect to MPC's HQ Lobby.</p>
        <div class="btn-group" role="group" aria-label="discordconnect-arialabel">
            <a type="button" class="btn btn-edit btn-lg" href="https://discord.gg/0iDKElOIs9mVj3hR" target="_blank">
                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                Text
            </a>
            <a type="button" class="btn btn-edit btn-lg" href="https://discord.gg/0iDKElOIs9qOseol" target="_blank">
                <span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span>
                Voice
            </a>
            <a type="button" class="btn btn-edit btn-lg" data-toggle="collapse" href="#discord-cochelp" aria-expanded="false" aria-controls="discord-cochelp-arialabel">
                <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                Help
            </a>
            <a type="button" class="btn btn-edit btn-lg" data-toggle="collapse" href="#discordapp-status" aria-expanded="false" aria-controls="discordapp-status-arialabel">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                Server Status
            </a>
        </div>
        <div class="collapse" id="discord-cochelp"> 
            <div class="well">
                <?=
                    $this->view()->render(
                        array('element' => 'discordapp/tutorial')
                    )
                ?>
            </div>
        </div>
        <div class="collapse" id="discordapp-status">
            <div class="well">
                <?=
                $this->view()->render(
                    array('element' => 'discordapp')
                )
                ?>
            </div>
        </div>       
    </div>
</div>
