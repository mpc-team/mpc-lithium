<?php

use app\controllers\games\ClashRoyaleController;

$this->title('Clash Royale');

$self = $this;

?>
<div class="jumbotron">
    <h1>Clash Royale</h1>
</div>

<div class="page-icon pull-right">
    <i style="transform: rotate(5deg);" class="fa fa-games"></i>
</div>
<div id="clash-royale">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/clashroyale.png" alt="clashroyale.png" class="img-rounded img-responsive" style="width: 100%;" />
                </center>
                <?php 
                    $clans = array(

                        0 => array(
                            'id' => 'knights',
                            'name' => 'MPC Knights',
                        ),
                        1 => array(
                            'id' => 'skeletons',
                            'name' => 'MPC Skeletons',
                        ),
                        2 => array(
                            'id' => 'rabbits',
                            'name' => 'MPC Rabbits',
                        ),

                    );
                ?>
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <?php foreach($clans as $clan): ?>
                        <li role="presentation"><a href="#<?= $clan['id'] ?>" aria-controls="<?= $clan['id'] ?>" role="tab" data-toggle="tab"><?= $clan['name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div><!--panel-heading-->
            <div class="panel-body">                
                <div class="tab-content">
                    <?php foreach($clans as $clan): ?>
                    <div role="tabpanel" class="tab-pane fade in" id="<?= $clan['id'] ?>"><?= $clan['name'] ?></div>
                    <?php endforeach; ?>                    
                </div><!--tab-content-->
            </div><!--panel-body-->
        </div><!--panel-->
    </div><!--panel-group-->
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/clash_royale/shat360.png" alt="clashroyale.png" class="img-rounded img-responsive" style="width: 100%;" />
                </center>
            </div>
            <div class="panel-body text-center">
                 <div class="row">
                    <p>Visit Me @</p>
                    <p><a href="https://www.twitch.tv/shat360/profile" target="_blank">https://www.twitch.tv/shat360/profile</a></p>
                    <div class="col-md-6">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src='http://player.twitch.tv/?channel=shat360' scrolling='no' allowfullscreen='true' class='embed-responsive-item'></iframe>
                        </div>
                    </div><!--col-->
                    <div class="col-md-6">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src='http://twitch.tv/shat360/chat' scrolling='no' allowfullscreen='true' class='embed-responsive-item'></iframe>
                        </div>
                    </div><!--col-->
                </div><!--row-->                
            </div>
        </div><!--panel-->
    </div><!--panel-group-->
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/clash_royale/MrRolypoly_plays.png" alt="clashroyale.png" class="img-rounded img-responsive" style="width: 100%;" />
                </center>
            </div>
            <div class="panel-body text-center">
                <div class="row">
                    <p>Visit Me @</p>
                    <p><a href="https://www.twitch.tv/MrRolypoly_plays/profile" target="_blank">https://www.twitch.tv/MrRolypoly_plays/profile</a></p>
                    <div class="col-md-6">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src='http://player.twitch.tv/?channel=MrRolypoly_plays' scrolling='no' allowfullscreen='true' class='embed-responsive-item'></iframe>
                        </div>
                    </div><!--col-->
                    <div class="col-md-6">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src='http://twitch.tv/MrRolypoly_plays/chat' scrolling='no' allowfullscreen='true' class='embed-responsive-item'></iframe>
                        </div>
                    </div><!--col-->
                </div><!--row-->                
            </div>
        </div><!--panel-->
    </div><!--panel-group-->
    <h3>
        Official Website
        <small>Clash Royale</small>
    </h3>
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <center>
                    <img src="/img/clash_royale/official-website.png" alt="official-website.png" class="img-rounded img-responsive" style="width: 100%;" />
                </center>
            </div>
            <div class="panel-body text-center">
                <p><a href="https://clashroyale.com/" target="_blank">https://clashroyale.com/</a></p>
            </div><!--panel-body-->
        </div><!--panel-->
    </div><!--panel-group-->
</div><!--clash-royale-->