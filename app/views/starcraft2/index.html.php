<?php

$this->title('StarCraft II');

$self = $this;

?>
<script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>
<style>
   #starcraft2lotv h3{color: rgba(123,171,232,.9); font-weight: 700;}
   #starcraft2lotv small{color: #aaffaa; font-weight: 500;}   
   #discordsetupbtn:hover {color: #000; background-color: #aaffaa; box-shadow: 1px 1px 10px #aaffaa; border: 3px solid black;}
   #discordsetupbtn {color: #fff; background-color: rgba(123,171,232,.9); margin: 2px 0 2px 0; width: 200px; font-weight: 600; border: 3px solid rgba(123,171,232,.9);}
   #starcraft2lotv p {text-indent: 20px; color: #aaffaa !important; text-shadow: 1px 1px 15px #000;}
   #starcraft2lotv .btn-edit {color: #fff; background-color: rgba(123,171,232,.9); border: 3px solid #000; margin: auto; cursor:pointer;}
   #starcraft2lotv .btn-edit:hover{color: #000; background-color: #aaffaa; box-shadow: 1px 1px 10px #aaffaa;}
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
        MPC - "Miacro Power Clan"
        <small>The Sc2 Clan</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <h3 class="panel-title">
                            The First Game Migration.
                        </h3>
                        <p>Miacro Power Clan was originally formed from another game, and some migrated into Starcraft 2. During it's period of Wings of Liberty, M.P.C. grew widely, and competed against clans from around the world. We help our members improve everyday, and always looking for coaches, or players that like to get involved with clan war tournaments. Miacro Power Clan was formally known as Micro Power Clan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--row-->  
    <h3>
        Clan War
        <small>
            Community Tournaments
        </small>
    </h3>
    <div class="row">                
        <div class="col-md-6">            
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <h3 class="panel-title">
                                How it Works
                            </h3>
                            <p>In a Starcraft 2 Clan War, a player from each clan must select a race and will play a pre-defined game (or games) until one of them is defeated. The choice of which map to play is decided by veto; that is, each clan will remove a map from the current 1 vs 1 ladder pool until there is only one map remaining. The loser of the 1 vs 1 will decide which map will be used in next round and a player cannot select any previously chosen map until all maps in the ladder pool have been played. Skill levels are determined by highest rank achieved.</p>
                            <p>The loser of the 1 vs 1 will decide which map will be used in next round and a player cannot select any previously chosen map until all maps in the ladder pool have been played. Skill levels are determined by highest rank achieved.</p>
                            <p>Only people in the actual clan match game:</p>
                            <ul>
                                <li>The Players</li>
                                <li>The Casters</li>
                                <li>The Officer / Clan Manager.</li>
                            </ul>
                            <p>Types of Clan Wars we play:</p>
                            <ul>
                                <li>Traditional 1 vs 1</li>
                                <li>Archon Games</li>
                                <li>2 vs 2</li>
                                <li>3 vs 3</li>
                                <li>4 vs 4</li>
                            </ul>
                            <p>Types of ways to play Clan Wars</p>
                            <ul>
                                <li>1 Best of 3 : Per Point</li>
                                <li>Single Elimination : Per Point</li>
                            </ul>
                            <p>MPC members use the button below to sign up, others may use discord, or in game links to locate an officer.</p>
                        </div><!--panel-body-->
                    </div><!--row-->
                </div><!--panel-->
            </div><!--panel-group-->
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            How To Join Our Team
                        </h3>
                    </div><!--panel-heading-->
                    <div class="panel-body">
                        <p>MPC is always looking to recruit quality members that like to perform effectivly, and actively in clan war tournaments. People revert to contacting an officer for MPC's Starcraft 2 Team. Methods to reaching and officer is through this website, in game, or on discord. All you have to do is just say hello, describe what goals you're looking to achieve with Starcraft 2, and you're set.</p>
                        <p>MPC is divided a mixture of perfectionists, coaching, and loyalist. We wish to put you in touch with proper MPC members that might aid the goals you're working for in Starcraft 2. Use the <a href="#contact">Officer Contact Information</a> to help you locate the proper personnel.</p>
                    </div><!--panel-body-->
                </div><!--panel-->
            </div><!--panel-group-->
            <div class="panel-group" id="mpcsc2-signupinfo">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <h3 class="panel-title">
                                MPC's Clan War Sign up Process [Members Only]
                            </h3>
                            <p>There's <b>two</b> ways to sign up for the clan war when playing for clan MPC.</p>
                            <ol>
                                <li>Login to your Account, and either search the forums, or on the Starcraft 2 page, you'll need to post in the thread with a reply stating you are in. This is the safest way, and you will not have to show up an hour prior to the event to register, instead you may show up when you are needed. First come first serve based on the post time made by the players.</li>
                                <li>Show up an hour prior to the match, and contact the clan officer regarding to attend the event, but beaware it's first come first serve. No guranetee that there will be a spot reserved for you. Either in game, or on <a href="/connect">Discord</a></li>
                            </ol>
                        </div><!--row in panel-body-->
                    </div><!--panel-body-->
                </div><!--panel-->
            </div><!--panel-group-->
            <div class="panel-group" id="sc2-signup-panel">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Clan War Sign Ups [Members Only]
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <p>To register for the upcoming clan wars as seen on the SC2 Clan MPC's events tab in the game Starcraft 2 Lotv. Sign ups must also have completed the sign up process. To reserve your seat in the clan wars, you have to post in one of these threads. Be sure to read the details carefully, and submit:</p>
                            <ol>
                                <li>In Game Alias</li>
                                <li>Rank</li>
                                <li>Comments/Questions</li>
                            </ol>
                            <p>On the day of the clan war, a hour before the match, the officer will collect the sign ups first on the forum, then those members automatically have those spots reserved with a grace period of 10 minutes, and any of the remaining spots open for each rank allowed in the clan war event, will then be allowed to participate in the event; anyone who signs up on that day, through discord, or on the clan chat in Starcraft 2, will be accepted as first come first serve process. Never recommended to sign up outside of the forum, the forum is what will host regulation and timestamp equality.</p>
                            <center>
                                <a href="/board/view/11" class="btn btn-edit">Register for Clan Wars</a>
                            </center>
                        </div>
                    </div>                
                </div>                
            </div><!--panel-group-->
            <div class="panel-group">
                <div class="panel">
                     <div class="panel-heading"><a name="discord"></a>
                        <h3 class="panel-title">MPC's Discord Server</h3>
                    </div>
                    <div class="panel-body text-center">                           
                        <div class="well" style="border: 2px solid rgba(123,171,232,.9); margin-left: 10px;">
                            <center>
                                <iframe src="https://discordapp.com/widget?id=127671174648823808&theme=dark" allowtransparency="true" style="height: 317px;" class="small"></iframe>
                            </center>
                        </div><!--well-->
                            <small>Need Help with Discord?</small>
                        <div class="btn-group btn-lg" role="group">
                            <a id="discordsetupbtn" class="btn" href="/connect">
                                Set Up Page
                            </a>
                        </div><!--btn group-->
                    </div><!--row-->
                </div><!--panel-->
            </div><!--panel-group-->
        </div><!--col-->
        <div class="col-md-6">
            <div class="panel-group">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <h3 class="panel-title">
                            Schedule with MPC
                        </h3>
                        <p>MPC has their clan wars based on certain days of the week, and they: Monday, Tuesday, and Thursdays). Our rank range is gold - master level players. Use the <b>Contact Officers Options</b> to find an MPC member, and request a date time to host a Clan War Event. IF you're interested in becoming an MPC Member, and play in these clan wars, then you may also contact an officer for additional support to get signed up, and registered with MPC. We expect to obtain your point of contact peron's in game link, and referred to an hour prior to the match. If you play on using casters, please revert to the <b>caster's rules and guide.</b>Please provide atleast a week in advance notice for the requested clan war.</p>
                            <div class="row">
                                <ul>
                                    <li>Broadcasts set 2 minute delay.</li>
                                    <li>Please limit Text messaging during casts as it MAY disrupt MPC's casters.</li>
                                    <li>Limit Beacons during matches.</li>
                                    <li>Only Casters and Co-Commentators; excluding clan manager.</li>
                                </ul>
                            </div><!--child row-->
                        </div><!--parent row-->
                    </div><!--panel-body-->
                </div><!--panel-->
            </div><!--panel-group-->
            <div class="panel-group" id="sc2officer-cwguide">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Officer Guide [Officers Only]
                        </h3>
                    </div><!--panel-heading-->
                    <div class="panel-body">
                        <p>Use this as a check off list for running the clan war against other clans for MPC.</p>
                        <ul>
                            <li>Is it map agreed prompt?</li>
                            <li>Is the highest rank achieved correct?</li>
                            <li>Are the casters set 2 minute delays?</li>
                            <li>Is is single elmination, or best of 3?</li>
                            <li>Are only the players, leaders, casters, and co-casters in the game to reduce lag?</li>
                            <li>Loser's pick the next map.</li>
                            <li>Normally, 1 of each map can be chosen until all maps have been played atleast once to reset open selection.</li>
                            <li>When in the game, ask opposing players to race check, and say ready?</li>
                            <li>Say GL HF!</li>
                        </ul>
                    </div><!--panel-body-->
                </div><!--panel--><a name="contact"></a>
            </div><!--panel-group-->
            <div class="panel-group">
                <div class="panel" id="contact-instructions">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Contact an Officer                   
                        </h3>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div class="row">
                            <h3 class="panel-title">
                                In Game Links for Starcraft 2 Officers
                            </h3>
                            <small>Copy on of these links, then paste in Starcraft2's chat -- push enter, then click on the link in game, and click on the portrait to find the link to chat, or add friend's list to save it.</small>
<br />                           
                                <?php $sc2ContactA = array(
                                    'AcidSnake' => 'battlenet:://starcraft/profile/1/12293619718954156032',
                                    'Cheemo' => 'battlenet://starcraft/profile/1/1360022220574818304',
                                    'ObamaAteMaKFC' => 'battlenet:://starcraft/profile/1/11656451648326205440',
                                    'KillerJoe'=>'battlenet://starcraft/profile/1/1942371952861642752', 
                                    'MoonSwan' => 'battlenet:://starcraft/profile/1/15213899516877996032',
                                    'TryTins' => 'battlenet:://starcraft/profile/1/1968926262479028224',
                                    'ReportedDeez' => 'battlenet://starcraft/profile/1/13590669605776392192',
                                    'Light'=>'battlenet://starcraft/profile/1/1740622594345795584',
                                    'Clan MPC'=>'battlenet:://starcraft/clan/1/9466',

                                    );
                                ?>
                                <?php foreach($sc2ContactA as $id => $data): ?>
                                    <div class="well well-sm">
                                        <h3><?= $id ?></h3>
                                        <?= $data ?>
                                    </div>
                                <?php endforeach; ?>
                        </div><!--row-->
                    </div><!--panel body-->                
                </div>                
            </div>
        </div><!--col-6-->
    </div><!--row-->
    <div class="row">
        <div class="panel-group" id="sc2member-cwreplay">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Clan War Replays
                    </h3>
                </div><!--panel-heading-->
                <div class="panel-body">
                    <p>To download previous clan war replays based on the clan, and along by selecting the date of the event, you would need to use the tabs below; clicking on the tile will download the entire zip file. You will need to catch that zip file in your downloads folder. Use this guide to learn shortcuts to getting to the download folder. Once you're able to locate the downloads folder, unzip the file, and copy the files over to your starcraft 2 folder. If you're not sure where the starcraft 2 folder is, you can view this guide. Once the files are in the replay folder for starcarft 2, click on the file, and the computer should request to launch the starcraft 2 application to review the replay. If not, you can load the starcraft 2 game, and then double click on the file, or open it in starcraft 2 from the replay section.</p>
<?php 


//path to sc2 replays.
//path to another set of replays.    
    
     $dir = 'starcraft2/clanwar/replays';    
     

   


    function downloadFile($file) { 
        
        if(file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
     }//function
                
      //trigger on a button
        if (isset($_GET['replay'])) {
            downloadFile($file);
        }
?>



                    <!--<a href='starcraft2?replay=true'>a button</a>-->



                    <!--
                    < php
                        
                        $clansPlayed = array(
                            
                            array('id'=>'taw','tags'=>'TAW', 'fullname'=>'The Art of WarFare','file1'=>'taw1', 'file2'=>'taw2','file3'=>'taw3'),
                            array('id'=>'drk','tags'=>'DRK', 'fullname'=>'Dark Society Community Gaming','file1'=>'drk1', 'file2'=>'drk2','file3'=>'drk3'),
                            array('id'=>'lit','tags'=>'|LiT|', 'fullname'=>'Lost in Translation','file1'=>'lit1', 'file2'=>'lit2','file3'=>'lit3'),
                            array('id'=>'rumb','tags'=>'RUMB', 'fullname'=>'R U Mad Bro','file1'=>'rumb1', 'file2'=>'rumb2', 'file3'=>'rumb3','file4'=>'rumb3'),

                        );

                     >
                    <ul class="nav nav-tabs" role="tablist">
                    < php foreach($clansPlayed as $clan => $property):  >
                        <li role="presentation">
                            <a href="#< = $property['id']  >" aria-controls="<  $property['id']  >" role="tab" data-toggle="tab">
                                < = $property['tags']  > 
                            </a>
                        </li>
                    <  endforeach;  >
                    </ul>
                    <div class="tab-content">
                        < php foreach($clansPlayed as $clan => $property): >
                        <div role="tabpanel" class="tab-pane fade" id="< = $property['id']  >">
                            <h3 class="panel-title">< = $property['fullname']  ></h3>
                            <small>< = '['. $property['tags'] . ']'  ></small>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="panel-group">
                                        <div class="panel">
                                            <div class="panel-heading">

                                            </div><!--panel-heading 
                                            <div class="panel-body">
                                                        
                                            </div><!--panel-body 
                                        </div><!--panel 
                                    </div><!--panel-group 
                                </div><!--col-md-4          
                            </div><!--row 
                        </div><!--tabpanel 
                        < php endforeach;  >
                    </div><!--tab-content -->
                </div><!--panel-body-->
            </div><!--panel--> 
        </div><!--panel-group--> 
    </div><!--row-->
    <h3>
        sEadogsc2's
        <small>Arcade Games</small>
    </h3>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group">
                <div class="panel" id="test">
                    <div class="panel-body" style="margin: 15px;">
                        <div class="row">
                            <div class="col-md-3">
                                    <img src="/img/sc2/trumpsrevenge-icon.png" alt="trumpsrevenger-banner.png" class="img-rounded img-responsive" id="trumpsrevenger-bannerimg" style="box-shadow: none; width: 150px;" />
                                    <img src="/img/sc2/trumpsrevenge-ss1.png" alt="trumpsrevenger-ss1.png" class="img-rounded img-responsive" id="trumpsrevenger-bannerimg" style="box-shadow: none; padding: 20px; width: 170px;" />
                            </div>
                            <div class="col-md-9">
                                <h3 class="panel-title">Trump's Revenge</h3>
                                <small>Genre: Survival</small>
                                <p class="padding: 5px; padding: 25px;">The Year is 2026, 10 years after Trump's defeat at the 2016 elections. For the last ten years, the name trump has fallen into a pit of obscurity as he fell away from the public eye, consumed by grief. In 2022 he disappears completely. No one can find him, or his family, the trumpz tower is deserted and the brand forgotten. Little happens in those years following Trump's disappearance. In 2021, Isis was defeated, and the USA felt its problems were over. But following Trump's disappearance, factories received millions of dollars from unknown sources in exchange for their resources. Little was said about this disturbance, money to the factories was money no matter who spent it. No one suspected trump, he was long forgotten, no one could even recall him, no one that is, but trump! Trump never forgot, he lived in his cave plotting, and his army grew with each import of resources, his forces grew and evolved as his scientists experimented on them in exchange for tens of millions in cash. Through biological engineering and mass production, his army began to assemble. He was ready to begin the true age of trump. The year is now 2026, trump rose from his underground dwelling in a wave of splendor, his armies decimating all that stood in his way. The USA army is ruins, their allies doing little to prevent trump from conquering everything he had longed for, all that stands between him and the white house is you, the elite bodyguard of the president. The universe hangs in the balance, do not let trump reach the Whitehouse</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <!--row
    <h3>
        Starcraft 2 Lotv Counter List
        <small>Updated Daily</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-heading">

                    Static Races

                </div><!--panel-heading
                <div class="panel-body">
                    Static Divs

                    Get Content Content per race

                </div><!--panel-body
            </div><!--panel
        </div><!--panel-group
    </div><!--row-->
    <h3></h3>
    <h3>
        Official Website & Forums
        <small>Blizzard Entertainment</small>
    </h3>
    <div class="row">
        <div class="col-md-6">
            <a href="http://us.battle.net/sc2/en/legacy-of-the-void/" target="_blank">
                <div class="panel-group">
                    <div class="panel">
                        <div class="panel-heading">
                            <img src="/img/sc2/officialwebsite.png" alt="officialwebsite.png" class="img-rounded img-responsive" style="width: 100%; max-width: 600px; max-height: 140px; box-shadow: 1px 1px 10px rgba(123,171,232,.9); " />
                        </div>
                        <div class="panel-body text-center">
                            <p>http://us.battle.net/sc2/en/legacy-of-the-void/</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="http://us.battle.net/sc2/en/forum/" target="_blank">
                <div class="panel-group">
                    <div class="panel">
                        <div class="panel-heading">
                            <img src="/img/sc2/sc2forumsbanner.png" alt="officialwebsite.png" class="img-rounded img-responsive" style="width: 100%; max-width: 600px; max-height: 140px; box-shadow: 1px 1px 10px rgba(123,171,232,.9);"/>
                        </div>
                        <div class="panel-body text-center">
                            <p>http://us.battle.net/sc2/en/forum/</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div><!--row-->       
</div>
 <script>
    $.get('/api/users/auth', null, function (authorized)
    {
        if (Object.keys(authorized).length > 0)
        {
        // User is authenticated, which is what `authorized` is.
        $('#sc2-signup-panel').show();
        $('#sc2member-cwreplay').show();
        $('#mpcsc2-signupinfo').show();
        $('#sc2officer-cwguide').show();
        }
        else
        {
        // User is not authenticated, and `authorized` is garbage (probably an empty array or Object).
        $('#sc2-signup-panel').hide();
        $('#sc2member-cwreplay').hide();
        $('#sc2officer-cwguide').hide();
        }
    });
</script>