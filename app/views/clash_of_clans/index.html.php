<?php

use app\controllers\games\ClashOfClansController;

$this->title('Clash of Clans');

$self = $this;



?>
<div id="clash-of-clans">
<div class="jumbotron">
    <h1 style="white-space: nowrap;">
        Clash of Clans
    </h1>
</div>
<div class="row">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <img src="/img/clash_of_clans/overview-banner.png" class="img-responsive img-rounded" />
                </h3>
            </div>
            <div class="panel-body" >
                <div class="row text-center">
                    <p>MPC Assassins is a professional Clash of Clans group, part of MPC organization - a developing gaming clan.</p>
                    <p>We are a dedicated and passionate clan; everything we do is to win our wars.</p>
                    <p>MPC has training clans that review over war recaps for members willing to learn, and understand Clash of Clans. MPCs secondary clans are designed to train green collar members into brilliant strategists. Speak to one of the MPC Officers on discord to learn more about the process, and upbringing of a fully fledged, organized clan.</p>
                </div>
            </div>
        </div>
    </div>
</div>   
    <h3>
        Discord
        <small>Clash of Clans</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-heading">
                    <img src="/img/clash_of_clans/communication-banner.png" alt="communication-banner.png" class="img-rounded img-responsive" />
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well" style="background-color: #faf1bf; margin: 1px 0 10px 0; border: 3px solid #000;">
                                <p style="color: #000; font-weight: 600;">Discord offers features that allow MPC to function, and organize the clan's gaming success both on a competitive, or community base level. With Discord you'll be able to conquer your foes. Discord can provide:</p>
                            </div>                            
                            <ul class="list-group">
                                <?php
                                    $bsArray = array(
                                        'Performs well on Computers.',
                                        'Optimized App. for Mobile Devices.',
                                        'Voice Chat.',
                                        'Coordinate Attacks to Win Wars.',
                                        'Meet Clan Mates, and Make Friends.',
                                        'Quick Setup, and optional installation for desktop.',
                                    );
                                ?>
                                <?php foreach($bsArray as $msg): ?> 
                                    <li class="list-group-item" style="font-weight: 600; border-color: #faf1bf;">
                                        <?= $msg ?>
                                    </li>
                                <?php endforeach; ?>                             
                            </ul>
                            <div class="alert alert-success" role="alert">
                                <small>Becareful speaking in the voice chat rooms as some players are currently playing and coordinating together. The rooms are marked with [In Game] will help justify which game they are playing, and ask politely if they are in game to avoid disruption.</small>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <small>Need Help with Discord?</small>
                            <div class="btn-group btn-lg" role="group">
                                <a class="btn" href="/connect" style="color: #000; background-color: #FAF1BF; margin: 2px 0 2px 0; width: 200px; font-weight: 600; border: 3px solid #000;">Set Up Page</a>
                            </div><!--btn group-->
                            <div class="well" style="border: 2px solid #faf1bf; margin-left: 10px;">
                            <center>
                                <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true" style="height: 317px;" class="small"></iframe>
                            </center>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div><!--panel-->
        </div><!--panel group-->
    </div>
    <h3>
        Rules from MPC
        <small>Clash of Clans</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-heading">
                    <img src="/img/clash_of_clans/rules-banner.png" alt="rules-banner.png" class="img-responsive img-rounded" style="margin-bottom: 5%;" />
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6" style="padding: 0 5px 0 5px;">
                            <ul class="list-group">
                                <li role="presentation" class="list-group-item">
                                    If you plan on participating we need you to Use the Discord APP.
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Have a proper target selected; that you can realistically clear a three star base.
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Plan your army, and attack with a leader. 
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Call your attack on clash caller, and execute the planned attack in the first four hours of war.
                                </li>
                                <li role="presentation" class="list-group-item">
                                    When war begins, use both attacks with the first four hours, or notify an offier when you can possible attack, or ASAP. 
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Best Behavoir, and respectiable kindness to members, and hard working Officers.
                                </li>
                                <li role="presentation" class="list-group-item">
                                    Most Importantly Have fun.
                                </li>
                            </ul>
                        </div><!--col-->
                        <div class="col-md-6" style="padding: 0 5px 0 5px;">
                            <div class="well" style="background-color: #faf1bf; margin: 1px 0 10px 0; border: 3px solid #000;">
                                <p style="color: #000; font-weight: 600;">Every member will be given the opportunity of a verbal warning, and if you feel the need talk about a problem then please contact any clan officers. Please feel reach the following officers down by logging onto Discord, or K.I.K. for attack advise, or regarding an problem.</p>
                            </div>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--panel-body-->
            </div><!--panel-->
        </div><!--panel group-->
    </div><!--row-->
    <h3>
        Official Website
        <small>Clash of Clans</small>
    </h3>
      <div class="row">
         <a href="http://www.clashofclans.com" target="_blank">
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <img src="/img/clash_of_clans/official-website-banner.png" alt="official-website-banner.png" class="img-responsive img-rounded coc-img-center" />
                    </div><!--panel-heading-->
                    <div class="panel-body text-center">
                        <small><a href="http://www.clashofclans.com" target="_blank">www.clashofclans.com</a></small>
                    </div><!--panel-body-->
                </div><!--panel-->
            </div><!--panel-group-->
        </a>
    </div><!--row-->
</div>
<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
                <?php
                    //Store the Json into this Variable.
                    $clans = array();
                    $rest = array();
                    //Function to Assemble the Decodes Responses from The Controller.
                    for($i = 0; $i <= sizeOf($jsonData); $i++)
                    {
                        $clans[$i] = json_decode($jsonData[$i]); 
                        $rest[$i] = substr($clans[$i]->tag, 1, 8);
                    }
                ?>
            <ul class="nav nav-tabs" role="tablist">
                <?php for($i = 0; $i <= (sizeOf($jsonData) -1); $i++): ?>
                    <li role="presentation"><a href="#<?= $rest[$i] ?>" aria-controls="<?= $rest[$i] ?>" role="tab" data-toggle="tab"><?= $clans[$i]->name ?></a></li>
                <?php endfor; ?>
            </ul>
        </div><!--panel-heading-->
        <div class="panel-body">
            <div class="tab-content">
                <?php for($i = 0; $i <= (sizeOf($jsonData) -1); $i++): ?>
                <div role="tabpanel" class="tab-pane fade" id="<?= $rest[$i] ?>">
                    <h3 class="panel-title">Clan Information</h3>
                    <table class="table">
                        <tr class="row"><td>Name</td><td><?= $clans[$i]->name ?></td></tr>
                        <tr class="row"><td>Invite</td><td><?= $clans[$i]->type ?></td></tr>
                        <tr class="row"><td>Description</td><td><?= $clans[$i]->description ?></td></tr>
                        <tr class="row"><td>Level</td><td><?= $clans[$i]->clanLevel ?></td></tr>
                        <tr class="row"><td>Points</td><td><?= $clans[$i]->clanPoints ?></td></tr>
                        <tr class="row"><td>Members</td><td><?= $clans[$i]->members ?></td></tr>
                        <tr class="row"><td>War Frequency</td><td><?= $clans[$i]->warFrequency ?></td></tr>
                        <tr class="row"><td>Win Streak</td><td><?= $clans[$i]->warWinStreak ?></td></tr>
                        <tr class="row"><td>Won</td><td><?= $clans[$i]->warWins ?></td></tr>
                        <tr class="row"><td>Lost</td><td><?= $clans[$i]->warLosses ?></td></tr>
                        <tr class="row"><td>Tie</td><td><?= $clans[$i]->warTies ?></td></tr>
                    </table>
                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse<?= $rest[$i] ?>" aria-expanded="false" aria-controls="collapse<?= $rest[$i] ?>">
                      Member List and Rank
                    </a>
                    <div class="collapse" id="collapse<?= $rest[$i] ?>">
                      <div class="well">
                        <table class="table">
                            <tr class="row"><td>Name</td><td>Trophies</td><td>Clan Rank</td></tr>
                            <?php foreach($clans[$i]->memberList as $member):?>
                                <tr class="row"><td><?= $member->name ?></td><td><?= $member->trophies ?></td><td><?= $member->clanRank ?></td></tr>
                            <?php endforeach; ?>
                        </table>
                      </div>
                    </div>
                </div><!--tab-panel-->
                <?php endfor; ?>
            </div><!--tab-content-->
        </div><!--panel-body-->
    </div><!--panel-->
</div><!--panel-group-->