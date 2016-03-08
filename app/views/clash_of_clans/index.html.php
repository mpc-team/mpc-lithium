<?php

use app\controllers\games\ClashOfClansController;

$this->title('Clash of Clans');

$self = $this;

?>

<div id="clash-of-clans">
    <h3>
        Clash of Clans - "The Revolution Begins"
        <small>Games</small>
    </h3>
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
        MPC's Clans in Clash of Clans
        <small>Clan Information</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-heading">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation">
                            <a href="#assassins" class="btn btn-edit active" aria-controls="assassins" role="tab" data-toggle="tab">
                                Assassins
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#warriors" class="btn btn-edit" aria-controls="warriors" role="tab" data-toggle="tab">
                                Warriors
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#goblins" class="btn btn-edit" aria-controls="goblins" role="tab" data-toggle="tab">
                                Goblins
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in" id="assassins">
                            Assassins
                        </div>
                        <div class="tab-pane fade" id="warriors">
                            Warriors
                        </div>
                        <div class="tab-pane fade" id="goblins">
                            Goblins
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>
        YouTube
        <small>Tutorials and Content</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-heading">                                           <script>
                        
                    </script>
                </div><!--panel-heading-->          
                <div class="panel-body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in" id="tutorials">
                            tutorials
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="war-recap">
                            war-recap
                        </div>
                    </div>
                </div><!--panel-body-->
            </div><!--panel-->
        </div><!--panel-group-->
    </div><!--row-->    
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
                            <div class="well" style="background-color: #faf1bf; margin: 1px 0 10px 0;">
                                <p style="color: #000; font-weight: 600;">Discord offers features that allow MPC to function, and organize a clan's gaming success both on a competitive, or community base level. With Discord you'll be able to conquer your foes. Discord can provide:</p>
                            </div>                            
                            <ul class="list-group">
                                <?php
                                    $bsArray = array(
                                        'Performs well on Computers.',
                                        'Optimized App. for Mobile Devices',
                                        'Voice Chat.',
                                        'Coordinate Attacks to Win Wars.',
                                        'Meet Clan Mates, and Make Friends.',
                                        'Quick Setup, and optional installation for desktop.',
                                    );
                                ?>
                                <?php foreach($bsArray as $msg): ?> 
                                    <li class="list-group-item" style="font-weight: 600;">
                                        <?= $msg ?>
                                    </li>
                                <?php endforeach; ?>                             
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group btn-lg" role="group">
                                <a class="btn" href="/connect" style="color: #000; background-color: #FAF1BF; margin: 2px 0 2px 0; width: 200px; font-weight: 600">Set Up Discord?</a>
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
        Forums
        <small>Clash of Clans</small>
    </h3>
    <div class="row">
        <a href="/board/view/5">
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                         <img src="/img/clash_of_clans/forum-banner.png" class="img-responsive img-rounded" alt="forum-banner.png" />
                    </div>
                    <div class="panel-body">
                         <div class="row text-center">
                            <p style="color: FAF1BF;">See what's happening, and leave a post on the board. Learn, discuss, compare strategies, offer suggestions, and create insightful topics for others to see when they arrive here. Don't be shy because you might have something.</p>
                        </div>
                    </div>
                    <div class="panel-footer">
        
                    </div>
                </div>
            </div>
        </a>
    </div>
    <h3>
        Rules from MPC
        <small>Clash of Clans</small>
    </h3>
    <div class="row">
        <a>
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <img src="/img/clash_of_clans/rules-banner.png" alt="rules-banner.png" class="img-responsive img-rounded" style="margin-bottom: 5%;" />
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <ul class="list-group">
                                <li role="presentation" class="list-group-item">
                                    If you plan on participating you
                                    <b>MUST</b>
                                    Use Discord APP.
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
                        </div>

                    </div>
                    <div class="panel-footer">
                        <p>Updated: 01/30/2016</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
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
                    </div>
                    <div class="panel-body">
                        
                    </div>
                    <div class="panel-footer">
                        <small><a href="http://www.clashofclans.com" target="_blank">www.clashofclans.com</a></small>
                    </div>
                </div>
            </div>
        </a>        
    </div>
</div>