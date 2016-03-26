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
#heroes-of-the-storm > .row > .panel-group > .panel > .panel-body > p {
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
#heroes-of-the-storm > .row > .panel-group {
    margin: 5px;
}
#heroes-of-the-storm > .row > .panel-group > .panel{max-width: 800px; margin: auto;}
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
                        What we are trying to accomplish here in this game and community:
                    </h3>
                </div>
                <div class="panel-body">
                    <p>There is no clan based yet as of today, but MPC still likes to focus on a collection of quality members, and officers to run Hero League, and Team League. We feel the game will eventually add a scenario for clans and teams.</p>
                    <p>Our clan welcomes Heroes enthuists to play with a winning solution for ever problem that can occur on the battlefield. Players in MPC are familliar with the mechanics of this game, and if looking for a group to play with daily, feel free to connect with discord.</p>
                    <p>You will find helpful information on this page regarding characters that we feel we've masted in. Myths will be replaced on this website, along with facts, philosophy, map decision, positioning decisions, selecting your first character to play as, how to train before embarrassing yourself, understanding what priorities should be met on each map, and as time goes on there will be more advance level of understanding the game.</p>
                    <p>Over time this section will be populated with useful, and educational process, and yet discoveries for this game; with updates, nerfs, and patches happening will cause this section to be very dynamic and simplified every day.</p>
                </div><!--panel-body-->
            </div><!--panel-->
        </div><!--panel-grou-->
    </div><!--row-->
    <h3>
        Getting Started With
        <small>Easy Characters</small>
    </h3>
    <div class="row">
        <p></p>
        <!--Team Agreement and Well Being-->
        <!--Usage of Abilities -->
        <!--Heroes and Teamm Alliance Agreement-->

    </div><!--row-->
</div><!--container-->
