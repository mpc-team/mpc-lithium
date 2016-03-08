<?php

$this->title('StarCraft II');

$self = $this;

?>
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
    <div class="row">
        <h3>
            Forums
            <small>
                Starcraft 2
            </small>
        </h3>
        <a href="/board/view/2">
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                           Forums
                        </h3>
                    </div>
                    <div class="panel-body" style="color: #777;">
                        <p>See what's happening, and leave a post on the board. Learn, discuss, compare strategies, offer suggestions, and create insightful topics for others to see when they arrive here. Don't be shy because you might have something.</p>
                    </div>
                </div>
            </div>
        </a>

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
                            <p style="text-indent: 20px;">In a Starcraft 2 Clan War, a player from each clan must select a race and will play a pre-defined game (or games) until one of them is defeated. The choice of which map to play is decided by veto; that is, each clan will remove a map from the current 1 vs 1 ladder pool until there is only one map remaining. The loser of the 1 vs 1 will decide which map will be used in next round and a player cannot select any previously chosen map until all maps in the ladder pool have been played.</p>
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
                                
                            </div>    
                        </div>                
                    </div>                
                </div>
            </a>
        </div><!--col-6-->
    </div><!--row-->
      <h3>
        MPC on Twitch T.V.
        <small><?= $this->title ?></small>
    </h3>
    <?php 
        
        $sc2Casters = array('vaevictissc' => 'VaeVictisSC', 'seadogsc2' => 'sEadogSC2', 'chefsstream' => 'Chef'); 
        
    ?>
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav nav-tabs" role="tablist">
                    <?php foreach($sc2Casters as $id => $displayName): ?>
                        <li role="presentation"><a href="#<?= $id ?>" aria-controls="<?= $id ?>" role="tab" data-toggle="tab"><?= $displayName ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div><!--panelheading-->
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tabpanel" class="tab-pane fade in"> 
                        <h3>Select a Caster Above...</h3>
                    </div>
                    <?php foreach($sc2Casters as $id => $displayName): ?>
                    <div role="tabpanel" class="tab-pane fade" id="<?= $id ?>">
                        <div id="caster-<?= $id ?>-twitchdiv">
                            <img src="/img/caster/<?= $id ?>/description.png" class="img-rounded img-responsive" id="coc-caster-<?= $id ?>-topimg" />
                            <div class="row" style="padding-top: 5%;">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?= $id ?>"></iframe>
                                </div><!--embed video-->              
                                <a role="button" class="btn btn-lg" href="#casterchat-<?= $id ?>-collapse" data-toggle="collapse" aria-expnded="false" aria-controls="casterchat-<?= $id ?>-collapse" style="background-color: #fff; border: 1px #00fff; color: #000;">Show Chat</a>
                            </div><!--row-->

                            <div class="collapse text-center" id="casterchat-<?= $id ?>-collapse" style="padding-top: 5%;">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <iframe frameborder="0" scrolling="yes" src="http://twitch.tv/<?= $id ?>/chat?popout=">
                                    </iframe>
                                </div><!--embed chat-->
                                <p>Not Showing up properly? View His <a class="btn" href="http://www.twitch.tv/<?= $id ?>" target="_blank">Page</a>.</p>
                            </div><!--Collapse Div-->
                        </div> <!-- Caster ID -->
                    </div><!--tab panel-->
                    <?php endforeach; ?>
                </div><!--tab content-->
            </div><!--panel body-->
            </div><!--panel-->
        </div><!--panel-group-->
    <h3>
        Official Website
        <small>Blizzard Entertainment</small>
    </h3>
    <div class="row">
        <a href="http://us.battle.net/sc2/en/legacy-of-the-void/" target="_blank">
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <img src="/img/sc2/officialwebsite.png" alt="officialwebsite.png" class="img-rounded img-responsive" id="sc2-officialwebsite-png" style="width: 100%; max-width: 600px;"/>
                    </div>
                    <div class="panel-body text-center">
                        <p>http://us.battle.net/sc2/en/legacy-of-the-void/</p>
                    </div>
                </div>
            </div>
        </a>
    </div>       
</div>