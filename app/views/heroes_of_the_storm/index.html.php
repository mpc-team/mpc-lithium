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


                   $warriors = array(
                        'anub-arak' => 'Anub\'arak',
                        'artanis' => 'Artanis',
                        'arthas' => 'Arthas',
                        'chen' => 'Chen',
                        'cho-gall' => 'Cho-Gall',
                        'diablo' => 'Diablo',
                        'etc' => 'E.T.C.',
                        'johanna' => 'Johanna',
                        'leoric' => 'Leoric',
                        'muradin' => 'Muradin',
                        'rexxar' => 'Rexxar',
                        'sonya' => 'Sonya',
                        'stitches' => 'Stitches',
                        'tyrael' => 'Tyrael',               
                    );

                   $assassins = array(

                        'falstad' => 'Falstad',
                        'greymane' => 'GreyMane',
                        'illidan' => 'Illidan',
                        'jaina' => 'Jaina',
                        'kael-thas' => 'Kael-Thas',
                        'kerrigan' =>'Kerrigan',
                        'lunara' =>'Lunara',
                        'nova' =>'Nova',
                        'raynor'=>'Raynor',
                        'the-butcher'=>'The Butcher',
                        'thrall'=>'Thrall',
                        'tychus'=>'Tychus',
                        'valla' =>'Valla',
                        'zeratul' =>'Zeratul',                

                    ); 

                    $supports = array(
                        
                        'brightwing' => 'BrightWing',
                        'kharazim'=>'Kharazim',
                        'li-li'=>'Li Li',
                        'lt-morales'=>'Lt. Morales',
                        'malfurion'=>'Malfurion',
                        'rehgar'=>'Rehgar',
                        'tassadar'=>'Tassadar',
                        'tyrande'=>'Tyrande',
                        'uther'=>'Uther',
                    );

                    $specialists = array(

                        'abathur' =>'Abathur',
                        'azmodan'=>'Azmodan',
                        'gazlowe'=>'Gazlowe',
                        'murky'=>'Murky',
                        'nazeebo'=>'Nazeebo',
                        'sgt-hammer'=>'Sgt. Hammer',
                        'sylvanas'=>'Sylvanas',
                        'the-lost-vikings'=>'The Lost Viking',
                        'zagara'=>'Zagara',
                        
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




                <!-- information on the classes -->
                <div class="row">
                    <?php foreach($classes as $class => $classDisplay): ?>
                    <div class="collapse" id="collapse<?= $class ?>">
                        <?php if($class == 'warriors'): ?>
                        <div class="row">
                            <?php foreach($warriors as $id => $displayName): ?>                                         
                                <div class="col-xs-4 class-portrait" style="padding: 2px 1px 2px 1px;">
                                    <a href="#">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive " />
                                            </div>
                                            <div class="panel-body text-center">
                                                <h2 class="panel-title">
                                                    <?= $displayName ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>                                
                            <?php endforeach; ?>
                        </div>
                        <?php elseif($class == 'assassins'): ?>
                        <div class="row">
                            <?php foreach($assassins as $id => $displayName): ?>
                                <div class="col-xs-4 class-portrait" style="padding: 2px 1px 2px 1px;">
                                    <a href="#">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive " />
                                            </div>
                                            <div class="panel-body text-center">
                                                <h2 class="panel-title">
                                                    <?= $displayName ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>           
                            <?php endforeach; ?>
                        </div>
                        <?php elseif($class == 'supports'): ?>
                        <div class="row">
                            <?php foreach($supports as $id => $displayName): ?>
                                <div class="col-xs-4 class-portrait" style="padding: 2px 1px 2px 1px;">
                                    <a href="#">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive " />
                                            </div>
                                            <div class="panel-body text-center">
                                                <h2 class="panel-title">
                                                    <?= $displayName ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>           
                            <?php endforeach; ?>
                        </div>
                        <?php elseif($class == 'specialists'): ?>
                        <div class="row">
                            <?php foreach($specialists as $id => $displayName): ?>
                                 <div class="col-xs-4 class-portrait" style="padding: 2px 1px 2px 1px;">
                                    <a href="#">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <img src="/img/hots/heroes/<?= $id ?>/portrait.png" alt="<?= $id ?>.png" class="img-rounded img-responsive " />
                                            </div>
                                            <div class="panel-body text-center">
                                                <h2 class="panel-title">
                                                    <?= $displayName ?>
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
                </div><!--row in parent panel--> 
            </div><!--panelbody-->
            <div class="panel-footer">
                <small>Review</small>
            </div><!--panel-footer-->
        </div>
    </div>
</div>


