<?php

$this->title('StarCraft II');

$self = $this;

?>
<style>
   #starcraft2lotv h3{color: rgba(123,171,232,.9)}
   #starcraft2lotv small{color: aaffaa;}
   #starcraft2lotv .panel-group .panel .panel-body .row p{color: #fff;}
   #sc2officerlist > .list-group-item{color: #fff; background-color: rgba(123,171,232,.9); border: 3px solid #000; width: 300px; margin: auto;}
</style>
<div id="starcraft2lotv">
    <!--header row-->
    <div class="row page-header">
        <h1>
            <div class="title">
                <?=$this->title;?>
            </div>
            <small>
            <div class="subtitle">
                Games
            </div>
        </small>   
        </h1>        
    </div>
    <h3>
        MPC - The "Miacro Power Clan"
        <small>a Sc2 clan</small>
    </h3>
    <div class="row">
        <a>
            <div class="panel-group">
                <div class="panel" style="max-width: 600px; margin: auto;">
                    <div class="panel-body">
                        <div class="row">
                            <h3 class="panel-title">
                                Welcome to Starcraft MPC
                            </h3>
                            <p class="text-indent">Miacro Power Clan was originally formed from another game, and some migrated into Starcraft 2. During it's period of Wings of Liberty, M.P.C. grew widely, and competed against clans from around the world. We help our members improve everyday, and always looking for coaches, or players that like to get involved with clan war tournaments.</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!--row-->
    <h3>
        sEadogsc2's Games
        <small>a SC2 Arcade Game</small>
    </h3>
    <div class="row">
        <div class="col-md-12">
            <a>
                <div class="panel-group">
                    <div class="panel">
                        <div class="panel-body" style="margin: 15px;">
                            <div class="row">
                                <div class="col-md-3">
                                     <img src="/img/sc2/trumpsrevenge-icon.png" alt="trumpsrevenger-banner.png" class="img-rounded img-responsive" id="trumpsrevenger-bannerimg" style="box-shadow: none; width: 150px;" />
                                     <img src="/img/sc2/trumpsrevenge-ss1.png" alt="trumpsrevenger-ss1.png" class="img-rounded img-responsive" id="trumpsrevenger-bannerimg" style="box-shadow: none; padding: 20px; width: 170px;" />
                                </div>
                                <div class="col-md-9">
                                    <h3 class="panel-title">Trump's Revenge</h3>
                                    <small>Genre: Survival</small>
                                    <p class="text-indent: 5px; padding: 5px; padding: 25px;">The Year is 2026, 10 years after Trump's defeat at the 2016 elections. For the last ten years, the name trump has fallen into a pit of obscurity as he fell away from the public eye, consumed by grief. In 2022 he disappears completely. No one can find him, or his family, the trumpz tower is deserted and the brand forgotten. Little happens in those years following Trump's disappearance. In 2021, Isis was defeated, and the USA felt its problems were over. But following Trump's disappearance, factories received millions of dollars from unknown sources in exchange for their resources. Little was said about this disturbance, money to the factories was money no matter who spent it. No one suspected trump, he was long forgotten, no one could even recall him, no one that is, but trump! Trump never forgot, he lived in his cave plotting, and his army grew with each import of resources, his forces grew and evolved as his scientists experimented on them in exchange for tens of millions in cash. Through biological engineering and mass production, his army began to assemble. He was ready to begin the true age of trump. The year is now 2026, trump rose from his underground dwelling in a wave of splendor, his armies decimating all that stood in his way. The USA army is ruins, their allies doing little to prevent trump from conquering everything he had longed for, all that stands between him and the white house is you, the elite bodyguard of the president. The universe hangs in the balance, do not let trump reach the Whitehouse</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!--row-->
    <h3>
        Clan Wars
        <small>
            SC2 Community
        </small>
    </h3>
    <div class="row">
        <div class="col-md-12">
            <a>
                <div class="panel-group">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <small style="color: rgba(123,171,232,.9); font-weight: 700;">How it Works.</small>
                                <p style="text-indent: 20px;">In a Starcraft 2 Clan War, a player from each clan must select a race and will play a pre-defined game (or games) until one of them is defeated. The choice of which map to play is decided by veto; that is, each clan will remove a map from the current 1 vs 1 ladder pool until there is only one map remaining. The loser of the 1 vs 1 will decide which map will be used in next round and a player cannot select any previously chosen map until all maps in the ladder pool have been played.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">                
        <div class="col-md-6">
            <a href="/board/view/11">
                <div class="panel-group">
                     <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                              Clan War Sign Ups [Members Only]
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <p>To register for the upcoming clan wars as seen on the clan events tab in the game Starcraft 2 Lotv. Sign ups must also have completed the connect portion.</p>
                            </div>
                        </div>                
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <a href="#clanwarsmodal" data-toggle="modal" data-target="#clanwarsmodal">
                <div class="panel-group">
                     <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                              Contact Information
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <ul class="list-group" id="sc2officerlist">
                                    <?php $bscontact = array('AcidSnake', 'Cheemo','ObamaAteMaKFC','MoonSwan','TryTins','ReportedDeez'); ?>
                                    <?php foreach($bscontact as $id): ?>
                                        <li class="list-group-item">
                                            <?= $id ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>    
                        </div>                
                    </div>                
                </div>
            </a>
        </div><!--col-6-->
    </div><!--row-->
    <h3>
        Official Website
        <small>Blizzard Entertainment</small>
    </h3>
    <div class="row">
        <a href="http://us.battle.net/sc2/en/legacy-of-the-void/" target="_blank">
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <img src="/img/sc2/officialwebsite.png" alt="officialwebsite.png" class="img-rounded img-responsive" id="sc2-officialwebsite-png" style="width: 100%; max-width: 600px; box-shadow: 1px 1px 10px rgba(123,171,232,.9);"/>
                    </div>
                    <div class="panel-body text-center">
                        <p>http://us.battle.net/sc2/en/legacy-of-the-void/</p>
                    </div>
                </div>
            </div>
        </a>
    </div>       
</div>