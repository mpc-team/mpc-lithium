<?php
$this->title('Heroes of the Storm');
$self = $this;

?>
<style>
/*typography styling*/
#heroes-of-the-storm > .row > .panel-group > .panel > .panel-body > p, #heroes-of-the-storm > .row > .panel-group > .panel > .panel-body > .row > p {
    color: rgba(110,138,225,.9);
    text-indent: 20px;
    text-shadow: 1px 1px 15px #000;
}
#heroes-of-the-storm > h3 small {color: #aaffaa;}
#heroes-of-the-storm > h3 {
    color: rgb(108, 62, 204);
    font-weight: 700;
    text-shadow: 1px 1px 20px #000000;    
}

/*outer panels layout*/
#heroes-of-the-storm > h3 > small {
    color: #aaffaa;
}

/*inner panels layout*/
#heroes-of-the-storm > .row > .panel-group > .panel > .panel-body > .panel-title {
    color: rgba(202,255,255,.9);
    font-weight: 700;
    margin-top: 10px;
    margin-bottom: 10px;
}
#heroes-of-the-storm > .row > .panel-group > .panel > .panel-body > .row > .col-md-6 > .list-group > .list-group-item {
    background-color: #eeeeee;
    color: rgb(108, 62, 204);
    font-weight: 700;
    text-shadow: 1px 1px 20px #000000;  
}
#heroes-of-the-storm > .row > .panel-group > .panel > .panel-body {
    padding: 15px;
}
</style>
<div id="heroes-of-the-storm">
   <div class="jumbotron">
        <h1 style="white-space: nowrap;">
            Heroes of the Storm
        </h1>
    </div>
    <h3>
        Into the Nexus
        <small>Community Development</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        What we are trying to accomplish in the H.O.T.S. Community:
                    </h3>
                </div>
                <div class="panel-body">
                    <p>As of today, there is no clan based in Heroes of the Storm -- system built in the game, but we as MPC still likes to focus on a collection of quality members, and officers to run Hero League, and Team League Squads. We feel the game will eventually add a scenario for clans and teams, so we like to prepare and participate on helping other players perform, and meet goals to becoming a strong high performance player.</p>
                    <p>Our clan welcomes the Heroes of the Storm community, enthusiasts, and prideful players to learn how to play with a winning solution for ever problem that can occur on the battlefield. Certain Players in MPC are familliar with the mechanics of the game, and broken the game into it's most simplest form. If interested in playing with some serious core developing teammates, management, strategies, then feel free to reach us on Discord to inquire all the information you need.</p>
                    <p>You will find helpful information on this page regarding characters that we feel we've mastered in. Along with facts and details, philosophy and meta, map decision and control, positioning as the heroe and team, selecting heroes for map or composition aggragation, how to train and perform, understanding which priorities should be met and when.</p>
                    <p>Over time this section will be populated with useful, and educational process, and yet discoveries for this game; with updates, nerfs, and patches happening will cause this section to be very dynamic and simplified every day.</p>
                </div><!--panel-body-->
            </div><!--panel-->
        </div><!--panel-grou-->
    </div><!--row-->
    <h3>
        Chair League
        <small>Where MPC Competes</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Clan Information
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <p>MPC will be competing in Season 3 for placement matches. To try out for the upcoming season, contact either AcidSnake, or Steve for the screening process. Tryouts can be done at any time, and unlimited multiple attempts. Speak to us on discord, or forums to begin the try out initiation. Good Luck Have Fun.</p>
                        <p>Ways to increase chances to be approved to the team?</p>
                        <ol>
                            <li>Basic knowledge on the game.</li>
                            <li>Cooperative and Suggestive Character and Attitude.</li>
                            <li>Show up to practices.</li>
                            <li>Request a Tryout for a spot on the Team.</li>
                        </ol>
                    </div>
                    <div class="row">
                        <h3 class="panel-title">Getting Started</h3>
                        <p>To help make the process quicker to join Team MPC, you can save some time by preparing these few helpful tips:</p>
                        <ul>
                            <li>Register for an account on <a href="/signup">MPCGaming</a>.</li>
                            <li>Register for an account on <a href="http://www.chairleague.com" target="_blank">ChairLeague</a>.</li>
                            <li>Rules for ChairLeague <a href="http://www.chairleague.com/rules" target="_blank">Here</a>.</li>
                            <li>Register for an account on <a href="http://www.topdrafter.com" target="_blank">TopDrafter</a>.</li>
                            <li>Submit an Application to MPC <a href="https://www.chairleague.com/teams/778" target="_blank">Team</a>.</li>
                            <li>MPC Officers will decide if they shall approve, and notify back otherwise.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>        
    </div><!--row-->
    <h3>
        Developing Skills
        <small>Mastering the Game</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel" style="background-color: transparent;">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Helpful Topics
                    </h3>
                </div>
                <div class="panel-body" style="box-shadow: 0px 0px 20px #88bb88 inset;">
                    <!--COLLAPSE Rows-->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <span class='glyphicon glyphicon-collapse-down'></span>
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Kills, Deaths, XP, Beginning Meta
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <h4>Kills and Deaths</h4>
                                    <p>For every time a player dies, the team suffers the lost of the following: soaking XP from lanes, chancing imbalance in mini-fight scenarios because shortage in death(s), or even objective losts. Placing a team member atleast in each lane to absorb XP optimally; this means that kills are less important compared to lane XP priority. Do not chase in the beginning of the game for kills, and reduce deaths to a minimum because there's no reason why a team player should die in the first 10 minutes of the game. A good player has more kills, than a 1/3 of their deaths, and a Great player is someone who gets 0 Deaths in a game.</p>
                                    <hr>
                                    <h4>XP</h4>
                                    <p>XP comes in time waves from the minoins. Picture in your mind the three lanes of minions, and those minions are all moving at the same pace to the middle of each lane, since XP is what gives the team Talents to power up their abilities and gain advantages over the enemy team, the minions must soak from the first encounted wave til atleast 10. Ignoring enemy teams that are aggressively trying to kill strandid solo lane individuals that are actually trying to soak XP from each lane optimally, is the BEST thing a person can do for the team. Yes, the enemy team will be heavily engaging a person in a lane, but it will be up to the support to assist, and once the next lane team mate has <b>cleaned</b> their lane, will also too be able to assist the support and defender. Soaking is the highest priority that lasts all game, objectives are normally 2nd to that. Learn More About Objectives.</p>
                                    <hr>
                                    <h4>Beginning Meta</h4>
                                    <p><b>Soaking</b> XP until atleast level 10. Then based on the Enemy Team's action will have variation into Mid-Game. Talent Selection should be based on the Map, Enemy Team's combination of Heroes and considering which Ultimate Abilities and Talents are currently selected. Once a team reaches level Ten, the opposing team should "<b>bait</b>" the Enemy Team into using their Ultimate Abilities without Casualities from the Allied Team. The ideal reverse effect is to use Allied Ults when the Enemy Team's Ults are on Cool Down. If the Allied Team is ahead in Team Levels, then the Allied Ults need to be percise and used in the correct sequence. Learn more about Ultimate Sequences.</p>
                                 </div>
                             </div>
                         </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <span class='glyphicon glyphicon-collapse-down'></span>
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Priorities As a Team and As an Individual
                                        </a>
                                    </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <h4>The Team's Responsibility</h4>
                                    <p>During the game, the Team has goals to be met. The Highest goal is keeping minion XP <b>soak</b> optimal as possible. In beginning of the game, the object is to absorb all XP from each wave that is given by the enemy bases. Players don't have to engage and die to soak for XP, but instead keep in XP range only for the deaths of Enemy Minions. Soak Passively, and Defensively when the enemy team has greater quantity in heroes, than of a player's own team. Avoid verbaly harrassment, conflict, or disturbing the "vibe" between each other as that will let opportunities pass or reconciliting the situation in it's most positive outcome. Pick the drafts intelligent with counter-picking the Enemy Team's Selection Choices, and Context Clues on their Ban Selection. Let More about Ban and Heroe Selection.</p>
                                    <hr>
                                    <h4>The Player's Responsibility</h4>
                                    <p>A Player's main focus is to have mini-map awareness -- observing when danage is rotation to a nearby lane, or unseen enemy players. Avoiding death as that leads to <b>Decrease Soak Income</b> for the allied team. Participating in Team Fights, Engagements, and Ping only when Neccessary. Unless Practicing in Unranked/Quick Match -- only select one of the top three most played heroes on your profile; stick to what you know for ranked games as MMR is dreadful adjusting and for the courtesy of your MPC mates. Players should consider the Map Selection as judgement towards their decision of Heroe Selection, or Talent Selection. Discuss with your team as quickly as possible to assemble the most competent Allied team. A player also must consider their current positioning every time they make a move, and if a player gets OOP -- the Enemy Team is should be on the Offense in most cases. Learn More About Positioning.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <span class='glyphicon glyphicon-collapse-down'></span>
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Distance and Environmental Observing
                                        </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <p>Knowing whether or not if the time it takes to go from point A to point B is worth spending due to distance. Keep in mind it is important to calculate time to meeting with your team for map objectives, defending forts, taking control of camps, pushing into enemy forts alone or with the team. Arriving too late can or will result in team breakdowns, and losing games. </p>
                                    <p> When you're new, its hard to tell where and when you're suppose to be somewhere, but here are some useful tips to obey:</p>
                                    <ul>
                                        <li>Keep an eye on the minimap as often as possible</li>
                                        <li>The mini-map shows where allies, pings, objectives(above), and enemies.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <span class='glyphicon glyphicon-collapse-down'></span>
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Positioning of The Heroes & The Team
                                        </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <p>Next most important thing during the game, is understanding where you should be through out the game, and when to step up to strike. For most new players, understanding positioning engagements, defensive positions, and deciding when to perform or act. Here we'll stride to explain in the most simplest form, while making it easier to remember, yet providing useful guides and strategies to go along with it. Depending on which Heroe is selected, what your team of heroes consist of, what the enemy team of heroes consists of, what map is currently being played on, if an objective is overiding certain circumstances, and which talents each heroe in the game has selected, the various ways of deciding what is the best position can have a higher probability of failing than success. We'll be covering details at a slow pace, then adding more variations on what could happen, and how to identify where to be -- when it's needed to be.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title">
                                    <span class='glyphicon glyphicon-collapse-down'></span>
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Using all the Hotkeys
                                        </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <p>Believe it or not, this is a computer game, and computers come with keyboards, so it's vital that you use them instead of just mouse click abilities during the game. Considering the fact that you can reduce time it takes to trigger actions that leads to performance during the game.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingSix">
                                <h4 class="panel-title">
                                    <span class='glyphicon glyphicon-collapse-down'></span>
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Purpose Selecting Heroes
                                        </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                <div class="panel-body">
                                    <p>Making correct decisions during Hero League, Team League, or even Quick Match for selecting Heroes. Here are some small tips for just beginners. As you move up in the leagues, Hero selection will be more in depth in terms of selecting the best hero for Hero League, Team League, and pre-ogranizing for Quick Matches.</p>
                                    <ol>
                                        <li>Play the heroes you know in Ranks</li>
                                        <li>Practice in Quick Match</li>
                                        <li>Test the Hero vs A.I.</li>
                                    </ol>
                                    <p>This to consider as well for hero selecting is the map, the team's selection of heroes, your allies heroes, and the objects that correlate with the map's terrain. It will take quite some time to understand all the heroes, and how to accurately decide which is the best decision; and it's best to seek help from other players because if you do not ask, then people will not tell. Best way to approach this is simply by discussing with players that have a better rank than yourself in the clan, and in the game. Every heroe has a specific counter, meaning some heroes over power others, so it's important to know which units are best for killing others during Hero League picks, and Team League assembly.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingSeven">
                                <h4 class="panel-title">
                                    <span class='glyphicon glyphicon-collapse-down'></span>
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            Attitude and Leadership
                                        </a>
                                </h4>
                            </div>
                            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                <div class="panel-body">
                                    <p>Most people would leave their jobs if they weren't being rewarded, and offered constructive critism. So imagine in a game, where the employee doesn't get paid to tolerate how remarks are delivered because in most cases people would prefer to be surrounded by a positive working environment. For some, it's easily to blow the horn at another, but it's wise to remain calm for 2 reasons -- to keep the mental process for everyone on the team, and to have a professional characteristic. For the players that play to literally waste time on the computer for a video game, and for others it's to perfect their skill in the game by setting goals to stride for. The idea is if the attitude is sour, and the victim is blissfully not quite understanding how serious the professional is trying to be, immediately can start off on the wrong foot.</p>
                        <p>It's really good to know who you're playing with both on MPC, or quick match, or Leagues. It's possible to catch more friends being calm, and extremely likely to not missing any opportunities when under pressure or stress; both on any heated personality types, and passive types of personalities. This does make a huge impact on the team's performance, and it's best to understand your team more than a conflict that happened seconds ago.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingEight">
                                <h4 class="panel-title">
                                    <span class='glyphicon glyphicon-collapse-down'></span>
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        Stability as the Hero Role and Building Talents
                                        </a>
                                </h4>
                            </div>
                            <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                                <div class="panel-body">
                                    <p>Alot of noobs will often make the mistake on mixing up roles between characters. Sometimes it's not completely clear, but just to be sure that knowing the role goes hand in hand also with positioning. Reason is because the in standard formation, the healer would often be in the back of the team, but on certain situations can also briefly be useful to harvest kills on the enemy team. Each heroe has a role to help the team gather kills, survive engagements, and aid to victory. Later on you'll learn how each Heroe is supposed to be played, instead of memorizing build orders.</p>
                                </div>
                            </div>
                        </div>
                    </div><!--collpase accordion-->
                </div><!--panel-body-->
            </div><!--panel-->
        </div><!--panel-group-->
    </div><!--row-->
    <h3>
        Resources
        <small>Outsourcing Knowledge</small>
    </h3>    
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                Recommended Sites
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="http://www.hotslogs.com/Default" target="_blank">
                            <div class="well">
                                <img src="http://d1i1jxrdh2kvwy.cloudfront.net/Images/logo.png" class="img-rounded img-responsive" style="margin: auto; max-width: 200px; min-width: 1%; width: 100%;" />
                                <div class="text-center">                                        
                                    <p>www.hotslogs.com</p>
                                </div>
                            </div>
                        </a>
                    </div><!--col-->
                    <div class="col-md-12">
                        <a href="http://www.heroesfire.com/" target="_blank">
                            <div class="well">
                                <img src="http://www.heroesfire.com/images/bg-logo.png" class="img-rounded img-responsive" style="margin: auto; max-width: 200px; min-width: 1%; width: 100%;" />
                                <div class="text-center">
                                    <p>www.heroesfire.com</p>
                                </div>
                            </div>
                        </a>
                    </div><!--col-->
                </div><!--row-->
            </div>
        </div>
    </div>
</div><!--container-->
<script>
    $(function(){
        $('#collapseOne').on('hide.bs.collapse', function () {            
            $('#headingOne span').addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
        })
        $('#collapseOne').on('show.bs.collapse', function () {
            $('#headingOne span').addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
        })
        $('#collapseTwo').on('hide.bs.collapse', function () {            
            $('#headingTwo span').addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
        })
        $('#collapseTwo').on('show.bs.collapse', function () {
            $('#headingTwo span').addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
        })
        $('#collapseThree').on('hide.bs.collapse', function () {            
            $('#headingThree span').addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
        })
        $('#collapseThree').on('show.bs.collapse', function () {
            $('#headingThree span').addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
        })
        $('#collapseFour').on('hide.bs.collapse', function () {            
            $('#headingFour span').addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
        })
        $('#collapseFour').on('show.bs.collapse', function () {
            $('#headingFour span').addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
        })
        $('#collapseFive').on('hide.bs.collapse', function () {            
            $('#headingFive span').addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
        })
        $('#collapseFive').on('show.bs.collapse', function () {
            $('#headingFive span').addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
        })
        $('#collapseSix').on('hide.bs.collapse', function () {            
            $('#headingSix span').addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
        })
        $('#collapseSix').on('show.bs.collapse', function () {
            $('#headingSix span').addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
        })
        $('#collapseSeven').on('hide.bs.collapse', function () {            
            $('#headingSeven span').addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
        })
        $('#collapseSeven').on('show.bs.collapse', function () {
            $('#headingSeven span').addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
        })
                $('#collapseEight').on('hide.bs.collapse', function () {            
            $('#headingEight span').addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
        })
        $('#collapseEight').on('show.bs.collapse', function () {
            $('#headingEight span').addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
        })
    });//ready
</script>