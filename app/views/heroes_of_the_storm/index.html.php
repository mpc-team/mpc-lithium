<?php

$this->title('Heroes of the Storm');

$self = $this;

?>
<div id="heroes-of-the-storm">
    <div class="row">
        <img src="/img/hots/hots-banner.png" alt="hots-banner.png" class="img-rounded img-responsive" id="hots-bannerpng" style="margin: auto;"/>    
    </div>
    <h3>
        MPC is in
        <small><?= $this->title ?></small>
    </h3>
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                What we are about in Heroes of the Storm
            </div>
            <div class="panel-body">
                <p></p>
            </div>
            <div class="panel-footer">
                
            </div>
        </div>
    </div>
    <h3>
        Exploring depths into
        <small><?= $this->title ?></small>
    </h3>
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Knowing the Basics</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                   <div class="col-md-12">
                        <!--

                            When Logged in:
                            See the HOTS MPC Roster

                            
                            http://www.hotslogs.com/PlayerSearch?Name=acidsnake
                
                        -->
                   </div><!--col-md-12-->
                </div><!--ROW-->
            </div><!--body-->
            <div class="panel-footer">
                <p>Review</p>
            </div>
        </div>
    </div>
    <h3>
        Character
        <small>
            <?= $this->title ?>
        </small>
    </h3>
    <div class="row" id="hots-characters">
        <div class="panel">
            <div class="panel-heading">
                <small>Knowing your Character Well</small>
            </div>
            <div class="panel-body">
                <?php 

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
                        ),
                        
                        'greymane' => array(
                            'name'=>'Greymane',
                        ),

                        'illidan' => array(
                            'name'=>'Illidan',
                        ),

                        'jaina' => array(
                            'name'=>'Jaina',
                        ),

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


                <!--control buttons for classes-->
                <div class="row" style="margin-bottom: 5px;">
                    <div class="btn-group btn-group-justified" role="group">
                        <?php foreach($classes as $class => $classDisplay): ?>
                            <a class="btn btn-edit" role="button" data-toggle="collapse" href="#collapse<?= $class ?>" aria-expanded="false" aria-controls="collapse<?= $class ?>" data-parent="#accordion"><?= $class ?></a>
                        <?php endforeach; ?>
                    </div><!--btn group-->
                </div><!-- row-->
                <!--end control buttons -->



                <!-- information on the classes -->
                <div class="row">
                    <?php foreach($classes as $class => $classDisplay): ?>
                    <div class="collapse" id="collapse<?= $class ?>">
                        <?php if($class == 'warriors'): ?>
                        <div class="row">
                            <?php foreach($warriors as $id => $data): ?>                                         
                                <div class="col-xs-4 class-portrait" style="padding: 2px 1px 2px 1px;">
                                    <a type="button" data-toggle="modal" data-target=".<?= $id ?>-modal">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive " />
                                            </div>
                                            <div class="panel-body text-center">
                                                <h2 class="panel-title">
                                                    <?= $data['name'] ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>                                
                            <?php endforeach; ?>
                        </div>
                        <?php elseif($class == 'assassins'): ?>
                        <div class="row">
                            <?php foreach($assassins as $id => $data): ?>
                                <div class="col-xs-4 class-portrait" style="padding: 2px 1px 2px 1px;">
                                    <a type="button" data-toggle="modal" data-target=".<?= $id ?>-modal">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive " />
                                            </div>
                                            <div class="panel-body text-center">
                                                <h2 class="panel-title">
                                                    <?= $data['name'] ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>           
                            <?php endforeach; ?>
                        </div>
                        <?php elseif($class == 'supports'): ?>
                        <div class="row">
                            <?php foreach($supports as $id => $data): ?>
                                <div class="col-xs-4 class-portrait" style="padding: 2px 1px 2px 1px;">
                                    <a type="button" data-toggle="modal" data-target=".<?= $id ?>-modal">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive " />
                                            </div>
                                            <div class="panel-body text-center">
                                                <h2 class="panel-title">
                                                    <?= $data['name'] ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>           
                            <?php endforeach; ?>
                        </div>
                        <?php elseif($class == 'specialists'): ?>
                        <div class="row">
                            <?php foreach($specialists as $id => $data): ?>
                                 <div class="col-xs-4 class-portrait" style="padding: 2px 1px 2px 1px;">
                                    <a type="button" data-toggle="modal" data-target=".<?= $id ?>-modal">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive " />
                                            </div>
                                            <div class="panel-body text-center">
                                                <h2 class="panel-title">
                                                    <?= $data['name'] ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>           
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div><!--collapse-->
                <?php endforeach; ?>

                <?php foreach($warriors as $id => $data): ?>
                    <div class="modal fade <?= $id ?>-modal" tabindex="-1" role="dialog" aria-labelledby="<?= $id ?>-ModalLabel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3><?= $data['name'] ?></h3>
                                    <small><?= $data['header-content'] ?></small>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><?= $data['body-content'] ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= $data['ability-q'] ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $data['ability-w'] ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $data['ability-e'] ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $data['ability-r'] ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php foreach($supports as $id => $data): ?>
                    <div class="modal fade <?= $id ?>-modal" tabindex="-1" role="dialog" aria-labelledby="<?= $id ?>-ModalLabel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3><?= $data['name'] ?></h3>
                                    <small><?= $data['header-content'] ?></small>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><?= $data['body-content'] ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?= $data['ability-q'] ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= $data['ability-w'] ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= $data['ability-e'] ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= $data['ability-r'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php foreach($assassins as $id => $data): ?>
                    <div class="modal fade <?= $id ?>-modal" tabindex="-1" role="dialog" aria-labelledby="<?= $id ?>-ModalLabel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3><?= $data['name'] ?></h3>
                                    <small><?= $data['header-content'] ?></small>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><?= $data['body-content'] ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= $data['ability-q'] ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $data['ability-w'] ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $data['ability-e'] ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $data['ability-r'] ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php foreach($specialists as $id => $data): ?>
                    <div class="modal fade <?= $id ?>-modal" tabindex="-1" role="dialog" aria-labelledby="<?= $id ?>-ModalLabel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3><?= $data['name'] ?></h3>
                                    <small><?= $data['header-content'] ?></small>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><?= $data['body-content'] ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= $data['ability-q'] ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $data['ability-w'] ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $data['ability-e'] ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $data['ability-r'] ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div><!--row in parent panel--> 
            </div><!--panelbody-->
            <div class="panel-footer">
                <small>Review</small>
            </div><!--panel-footer-->
        </div>
    </div>
</div>


