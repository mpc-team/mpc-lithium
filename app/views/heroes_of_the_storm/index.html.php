<?php
$this->title('Heroes of the Storm');
$self = $this;

?>

<?php

$this->title('Heroes of the Storm');

$self = $this;

$classes = array(
        'warriors'=>
        'Warriors',
        'assassins'=>
        'Assassins',
        'supports'=>
        'Supports',
        'specialists'=>
        'Specialists',
    );

$allHeroes = array('$warriors','$assassins','$supports', '$specialists');

    $warriors = array(

        'anub-arak' => array(
            'name'=>'Anub\'arak',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'artanis' => array(
            'name'=>'Artanis',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),
        'arthas' => array(
            'name'=>'Arthas',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'chen' => array(
            'name'=>'Chen',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'cho-gall' => array(
            'name'=>'Cho Gall',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'diablo' => array(
            'name'=>'Diablo',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'etc' => array(
            'name'=>'E.T.C',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'johanna' => array(
            'name'=>'Johanna',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'leoric' => array(
            'name'=>'Leoric',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'muradin' => array(
            'name'=>'Muradin',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'rexxar' => array(
            'name'=>'Rexxar',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'sonya' => array(
            'name'=>'Sonya',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'stitches' => array(
            'name'=>'Stitches',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),

        'tyrael' => array(
            'name'=>'Tyrael',
            'header-content'=>'This is a Warrior',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'
        ),
               
    );

    $assassins = array(

        'falstad' => array(
            'name'=>'Falstad',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'greymane' => array(
            'name'=>'Greymane',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'illidan' => array(
            'name'=>'Illidan',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'jaina' => array(
            'name'=>'Jaina',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'kael-thas' => array(
            'name'=>'Kael\'Thas',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'kerrigan' => array(
            'name'=>'Kerrigan',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'lunara' => array(
            'name'=>'Lunara',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'nova' => array(
            'name'=>'Nova',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'raynor'=> array(
            'name'=>'Raynor',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'the-butcher'=> array(
            'name'=>'The Butcher',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'thrall'=> array(
            'name'=>'Thrall',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'tychus'=> array(
            'name'=>'Tychus',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'valla' => array(
            'name'=>'Valla',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'zeratul' => array(
            'name'=>'Zeratul',
            'header-content'=>'This is a Assassin',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),
                

    ); 

    $supports = array(
                        
        'brightwing' => array(
            'name'=>'Brightwing',
            'header-content'=>'This is a Support',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'kharazim'=> array(
            'name'=>'Kharazim',
            'header-content'=>'This is a Support',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'li-li'=> array(
            'name'=>'Li Li',
            'header-content'=>'This is a Support',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'lt-morales'=> array(
            'name'=>'Lt. Morales',
            'header-content'=>'This is a Support',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'malfurion'=> array(
            'name'=>'Malfurion',
            'header-content'=>'This is a Support',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'rehgar'=> array(
            'name'=>'Rehgar',
            'header-content'=>'This is a Support',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'tassadar'=> array(
            'name'=>'Tassadar',
            'header-content'=>'This is a Support',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'tyrande'=> array(
            'name'=>'Tyrande',
            'header-content'=>'This is a Support',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'uther'=> array(
            'name'=>'Uther',
            'header-content'=>'This is a Support',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

    );

    $specialists = array(

        'abathur' => array(
            'name'=>'Abathur',
            'header-content'=>'This is a Specialist',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'azmodan'=> array(
            'name'=>'Azmodan',
            'header-content'=>'This is a Specialist',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'gazlowe'=> array(
            'name'=>'Gazlowe',
            'header-content'=>'This is a Specialist',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'murky'=> array(
            'name'=>'Murky',
            'header-content'=>'This is a Specialist',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'nazeebo'=> array(
            'name'=>'Nazeebo',
            'header-content'=>'This is a Specialist',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'sgt-hammer'=> array(
            'name'=>'Sgt. Hammer',
            'header-content'=>'This is a Specialist',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'sylvanas'=> array(
            'name'=>'Sylvanas',
            'header-content'=>'This is a Specialist',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'the-lost-vikings'=> array(
            'name'=>'The Lost Vikings',
            'header-content'=>'This is a Specialist',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

        'zagara'=> array(
            'name'=>'Zagara',
            'header-content'=>'This is a Specialist',
            'body-content'=>'body ',
            'ability-q'=>'ability-q',
            'ability-w'=>'ability-w',
            'ability-e'=>'ability-e',
            'ability-r'=>'ability-r'),

                        
    );

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
                    <p>As of today, there is no clan based in Heroes of the Storm, but we as MPC still likes to focus on a collection of quality members, and officers to run Hero League, and Team League Squads. We feel the game will eventually add a scenario for clans and teams, so we like to prepare and participate on helping other players perform, and meet goals to becoming a strong high performance player.</p>
                    <p>Our clan welcomes Heroes of the Storm where enthusiasts learn to play with a winning solution for ever problem that can occur on the battlefield. Certain Players in MPC are familliar with the mechanics of this game. If interested in playing with some serious core developed teammates, then feel free to reach us on Discord.</p>
                    <p>You will find helpful information on this page regarding characters that we feel we've mastered in. Along with facts and details, philosophy and meta, map decision and control, positioning as the heroe and team, selecting heroes for map or composition aggragation, how to train and perform, understanding which priorities should be met and when.</p>
                    <p>Over time this section will be populated with useful, and educational process, and yet discoveries for this game; with updates, nerfs, and patches happening will cause this section to be very dynamic and simplified every day.</p>
                </div><!--panel-body-->
            </div><!--panel-->
        </div><!--panel-grou-->
    </div><!--row-->
    <h3>
        Developing Useful Mental and Performance Habits
        <small>at an Early Age</small>
    </h3>
    <div class="row">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Knowing How the Game Operates
                        <small>Core Values</small>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <h3 class="panel-title">
                            Kills and Deaths
                        </h3>
                        <p>We first would like to explain the obvious, just in case for those who do not complete understand the concept, regarding when to take kills and when to take deaths. Heroes of the Storm is a multiplayer online battle arena type game, therefore, the team is what gets the victories. There's never an absolute method, or forumla you should follow, but understand that the deaths gives the other team a greater advantage, and should never be given. Sensing that you're going to die is probably true, and should evade from any engagements from the enemy. Very few moments will occur when death is acceptable in exchange of taking additional kills for the team. Specific scenarios will be list over the course of time, but for now just focus on keeping deaths to a minimum.</p>
                        <p>Kills on the other hand, is something the team harvest to gain more XP and making the team powerful against the opposing team. Heroes in the game that are part of the assassins class is the major role for collecting kills, most of them are light armored, but some have special skill boundries to perform a task for the team. As you learn over time from experience, and absorbing the knowledge of the game, you'll become more proefficient to countering the opposing team to gain more XP, advantages, and then the victory.</p>
                    </div>
                    <div class="row">   
                        <h3 class="panel-title">
                            Priorities As a Team Member.
                        </h3>
                        <p>There's many ways to analyze on what factors sum up to prioritize; such as, on certain maps, specific scenarios, time, and positioning -- from there lies reaction and micro ability to get the most optimal performance in each scene of acts. Targeting often times, not all the time, is mainly the warrior's target, or melee range, that the team should "nuke" with abilities.</p>
                    </div>
                    <div class="row">
                        <h3 class="panel-title">
                            Knowing Distance and Environmental Awareness
                        </h3>
                        <p>Knowing whether or not if the time it takes to go from point A to point B is worth spending due to distance. Keep in mind it is important to calculate time to meeting with your team for map objectives, defending forts, taking control of camps, pushing into enemy forts alone or with the team. Arriving too late can or will result in team breakdowns, and losing games. </p>
                        <p> When you're new, its hard to tell where and when you're suppose to be somewhere, but here are some useful tips to obey:</p>
                        <ul>
                            <li>Keep an eye on the minimap as often as possible</li>
                            <li>The mini-map shows where allies, pings, objectives(above), and enemies.</li>
                        </ul>
                    </div>
                    <div class="row">
                        <h3 class="panel-title">
                             Positioning of The Heroes & The Team
                        </h3>
                        <p>Next most important thing during the game, is understanding where you should be through out the game, and when to step up to strike. For most new players, understanding positioning engagements, defensive positions, and deciding when to perform or act. Here we'll stride to explain in the most simplest form, while making it easier to remember, yet providing useful guides and strategies to go along with it. Depending on which Heroe is selected, what your team of heroes consist of, what the enemy team of heroes consists of, what map is currently being played on, if an objective is overiding certain circumstances, and which talents each heroe in the game has selected, the various ways of deciding what is the best position can have a higher probability of failing than success. We'll be covering details at a slow pace, then adding more variations on what could happen, and how to identify where to be -- when it's needed to be.</p>
                    </div>
                    <div class="row">
                        <h3 class="panel-title">
                            Using all the Hotkeys
                        </h3>
                        <p>Believe it or not, this is a computer game, and computers come with keyboards, so it's vital that you use them instead of just mouse click abilities during the game. Considering the fact that you can reduce time it takes to trigger actions that leads to performance during the game.</p>
                    </div>
                    <div class="row">
                        <h3 class="panel-title">
                            Purpose Selecting Heroes
                        </h3>
                        <p>Making correct decisions during Hero League, Team League, or even Quick Match for selecting Heroes. Here are some small tips for just beginners. As you move up in the leagues, Hero selection will be more in depth in terms of selecting the best hero for Hero League, Team League, and pre-ogranizing for Quick Matches.</p>
                            <ol>
                                <li>Play the heroes you know in Ranks</li>
                                <li>Practice in Quick Match</li>
                                <li>Test the Hero vs A.I.</li>
                            </ol>
                        <p>This to consider as well for hero selecting is the map, the team's selection of heroes, your allies heroes, and the objects that correlate with the map's terrain. It will take quite some time to understand all the heroes, and how to accurately decide which is the best decision; and it's best to seek help from other players because if you do not ask, then people will not tell. Best way to approach this is simply by discussing with players that have a better rank than yourself in the clan, and in the game. Every heroe has a specific counter, meaning some heroes over power others, so it's important to know which units are best for killing others during Hero League picks, and Team League assembly.</p>
                    </div>
                    <div class="row">
                        <h3 class="panel-title">
                            Attitude and Leadership
                        </h3>
                        <p>Most people would leave their jobs if they weren't being rewarded, and offered constructive critism. So imagine in a game, where the employee doesn't get paid to tolerate how remarks are delivered because in most cases people would prefer to be surrounded by a positive working environment. For some, it's easily to blow the horn at another, but it's wise to remain calm for 2 reasons -- to keep the mental process for everyone on the team, and to have a professional characteristic. For the players that play to literally waste time on the computer for a video game, and for others it's to perfect their skill in the game by setting goals to stride for. The idea is if the attitude is sour, and the victim is blissfully not quite understanding how serious the professional is trying to be, immediately can start off on the wrong foot.</p>
                        <p>It's really good to know who you're playing with both on MPC, or quick match, or Leagues. It's possible to catch more friends being calm, and extremely likely to not missing any opportunities when under pressure or stress; both on any heated personality types, and passive types of personalities. This does make a huge impact on the team's performance, and it's best to understand your team more than a conflict that happened seconds ago.</p>
                    </div>
                    <div class="row">
                        <h3 class="panel-title">
                            Stability as the Hero Role and Building Talents
                        </h3>
                        <p>Alot of noobs will often make the mistake on mixing up roles between characters. Sometimes it's not completely clear, but just to be sure that knowing the role goes hand in hand also with positioning. Reason is because the in standard formation, the healer would often be in the back of the team, but on certain situations can also briefly be useful to harvest kills on the enemy team. Each heroe has a role to help the team gather kills, survive engagements, and aid to victory. Later on you'll learn how each Heroe is supposed to be played, instead of memorizing build orders.</p>
                    </div>
                </div><!--panel-body-->
            </div><!--panel-->
        </div><!--panel-group-->
        <!--Team Agreement and Well Being-->
        <!--Usage of Abilities -->
        <!--Heroes and Teamm Alliance Agreement-->
    </div><!--row-->
    <h3>Hero League Guide</h3>
    <small>Learning how to support the team in 30 seconds.</small>
    <div class="row">
        <p>Understanding which Heroes are appropriate, for which map is selected, what the opposing has/banned, what the ally team has/banned, and expect reasoning to why the hero is selected.</p>
    </div>
</div><!--container-->
