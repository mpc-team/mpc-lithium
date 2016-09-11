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
                <img src="/img/clash_of_clans/overview-banner.png" class="img-responsive img-rounded" />
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
    Clan Members and Stats
    <small>Live Updates!</small>
</h3>
<div class="panel-group">
    <div class="panel panel-default">
            <div class="panel-heading text-center">
                <img src="/img/clash_of_clans/mpcstat.png" alt="mpcstat.png" class="img-rounded img-responsive" />
                <small>Select a Clan Below</small>
            </div>
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
                    $warLogEntry = json_decode($warLog);
                ?>
            <ul class="nav nav-tabs nav-justified" role="tablist" id="mpctab">
                <?php for($i = 0; $i <= (sizeOf($jsonData) -1); $i++): ?>
                    <li role="presentation"><a href="#<?= $rest[$i] ?>" aria-controls="<?= $rest[$i] ?>" role="tab" data-toggle="tab"><?= $clans[$i]->name ?></a></li>
                <?php endfor; ?>
            </ul>
        </div><!--panel-heading-->
        <div class="panel-body" style="box-shadow: 0px 0px 20px #faf1bf inset;">
            <div class="tab-content">
                <?php for($i = 0; $i <= (sizeOf($jsonData) -1); $i++): ?>
                <div role="tabpanel" class="tab-pane fade" id="<?= $rest[$i] ?>">
                    <h3 class="panel-title">Clan Information</h3>
                    <div class="row">
                        <table class="table">
                            <tr class="row"><td>Name</td><td><b><?= strtoupper($clans[$i]->name) ?></b></td></tr>
                            <tr class="row"><td>Tag</td><td><b><?= strtoupper($clans[$i]->tag) ?></b></td></tr>
                            <tr class="row"><td>Invite</td><td><b><?= strtoupper($clans[$i]->type) ?></b></td></tr>
                            <tr class="row"><td>Description</td><td><?= $clans[$i]->description ?></td></tr>
                            <tr class="row"><td>Located</td><td><b><?= $clans[$i]->location->name ?></b></td></tr>
                        </table>
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr class="row"><td>Level</td><td><b><?= $clans[$i]->clanLevel ?></b></td></tr>
                                <tr class="row"><td>Points</td><td><b><?= $clans[$i]->clanPoints ?></b></td></tr>
                                <tr class="row"><td>Members</td><td><b><?= $clans[$i]->members ?></td></b></tr>
                                <tr class="row"><td>Badge</td><td><img src="<?= $clans[$i]->badgeUrls->small ?>" class="pull-left img-rounded img-responsive" style="box-shadow: none !important; width: 60px; position: relative; left: -10px;" /></td></tr>
                            </table>
                             <center>
                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#<?= $rest[$i] ?>-warlogmodal">
                                    <?= strtoupper($clans[$i]->name) ?>'s War Log
                                </button>
                            </center>
                            <!-- Modal -->
                            <div class="modal fade" id="<?= $rest[$i]?>-warlogmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?= strtoupper($clans[$i]->name) ?>'s War Log</h4>
                                  </div>
                                  <div class="modal-body">
                                        
                                        <?php var_dump($warLogEntry) ?>
                                        
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div><!--modal-footer-->
                                </div><!--modal--content-->
                              </div><!--modal-dialog-->
                            </div><!--modal-->
                        </div><!--col-->
                        <div class="col-md-6">
                            <table class="table">
                                <tr class="row"><td>War Frequency</td><td><b><?= strtoupper($clans[$i]->warFrequency) ?></b></td></tr>
                                <tr class="row"><td>Win Streak</td><td><b><?= $clans[$i]->warWinStreak ?></b></td></tr>
                                <tr class="row"><td>Won</td><td><b><?= $clans[$i]->warWins ?></b></td></tr>
                                <tr class="row"><td>Lost</td><td><b><?= $clans[$i]->warLosses ?></b></td></tr>
                                <tr class="row"><td>Tie</td><td><b><?= $clans[$i]->warTies ?></b></td></tr>
                            </table>
                        </div><!--col-->                        
                    </div><!--row-->
                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse<?= $rest[$i] ?>" aria-expanded="false" aria-controls="collapse<?= $rest[$i] ?>">
                          Member List and Rank
                    </a>
                    <div class="collapse" id="collapse<?= $rest[$i] ?>">
                      <div class="well">
                        <?php foreach($clans[$i]->memberList as $member):?>
                            <div class="row">
                                <div class="col-xs-6">
                                    <img src="<?= $member->league->iconUrls->small ?>" style="width: 20px; box-shadow: none !important;" class="pull-left img-rounded img-responsive" />  <b><?= strtoupper($member->name) ?></b>
                                </div>
                                <div class="col-xs-6">
                                    Role: <b><?= $member->role ?></b>
                                    Trophies: <b><?= $member->trophies ?></b><br />
                                    EXP: <b><?= $member->expLevel ?></b>
                                    <b><?= $member->league->name ?></b>
                                </div>                                    
                            </div>
                        <?php endforeach; ?>
                      </div><!--well-->
                    </div><!--collapse-->
                </div><!--tab-panel-->
                <?php endfor; ?>
            </div><!--tab-content-->
        </div><!--panel-body-->
    </div><!--panel-->
</div><!--panel-group-->
<h3>
    Discord
    <small>Clash of Clans</small>
</h3>
<div class="row">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <img src="/img/connect/discord-banner.png" alt="communication-banner.png" class="img-rounded img-responsive" />
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="well" style="background-color: #faf1bf; margin: 1px 0 10px 0; border: 3px solid #000;">
                        <p style="color: #000; font-weight: 600;">Discord offers features that allow MPC to function, and organize the clan's gaming success both on a competitive, or community base level. With Discord you'll be able to conquer your foes. Discord can provide:</p>
                    </div><!--well-->                      
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
                    <center>
                        <div class="btn-group btn-lg" role="group">
                            <a class="btn" href="/connect" style="color: #000; background-color: #FAF1BF; margin: 2px 0 2px 0; width: 200px; font-weight: 600; border: 3px solid #000;">Connect Discord</a>
                        </div><!--btn group-->
                    </center>
                </div><!--row-->    
            </div><!--panel-body-->
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
                    <img src="/img/clash_of_clans/rules-banner.png" alt="rules-banner.png" class="img-responsive img-rounded" />
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12" style="padding: 0 5px 0 5px;">
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
                    </div><!--row-->
                    <div class="row">
                        <div class="well" style="background-color: #faf1bf; margin: 1px 0 10px 0; border: 3px solid #000;">
                            <p style="color: #000; font-weight: 600;">Every member will be given the opportunity of a verbal warning, and if you feel the need talk about a problem then please contact any clan officers. Please feel reach the following officers down by logging onto Discord, or K.I.K. for attack advise, or regarding an problem. Also See the Discord Setup, or speak in chat for someone to help you. Make sure not to disturb others while they are in gaming. The Lounge Channel is for social chatting.</p>
                        </div><!--well-->
                    </div<!--row-->
                </div><!--panel-body-->
            </div><!--panel-->
        </div><!--panel group-->
    </div><!--row-->
    <h3>
        Official Website
        <small>Clash of Clans</small>
    </h3>
      <div class="row">
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
    </div><!--row-->
</div><!--clash of clans-->