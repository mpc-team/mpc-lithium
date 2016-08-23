<?php

$this->title('Streams');

$self = $this;


?>
<div class="jumbotron">
    <h1>Streams</h1>    
</div>
<div class="page-icon lower smaller pull-right">    
    <i style="transform: rotate(13deg);" class="fa fa-video-camera"></i>
</div>
<div class="row">
    <div class="well text-center">
        <p style="color: #fff;">Members who've already connected their Twitch Accounts. For more Information on MPC's rules and Policy, or on how to add your own Twitch Account, then visit the <a href="/connect">Connect Page</a>.</p>
    </div>
</div>
<div class="row" id="twitch-casters">
    <div class="panel-group">
        <div class="panel">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                      <h1>
                        <span class="fa fa-2x fa-twitch"></span>
                            Twitch Casters
                      </h1>
                      <small>Registered on MPCgaming: <span id="twitch-caster-count"></span></small>  
                    </div><!--col-->
                    <div class="col-md-6">
                        <div class="btn-group pull-right">
                            <a href="/connect#twitch">
                                <button type="button" class="btn btn-default">Connect Twitch</button>
                            </a>
                        </div><!--btn-group-->
                    </div><!--col-->
                </div><!--row-->                                
            </div><!--panel-heading-->
            <div class="panel-body">
                <table class="table">
                    <tbody id="twitch-casters-table">                    
                    </tbody>
                </table>
            </div><!--parent panel-body-->
        </div><!--panel panel-->
    </div><!--parent panel-group-->
</div><!--Twitch-->        
<div id="twitch-casters-modal">
</div><!--caster-modal-->
<div class="row">
    <div class="well text-center">
        <p>Casting Gaming on:</p>
        <?php foreach($data['games'] as $item): ?>
        <?= '| '. $item['name'] . ' |' ?>
    <?php endforeach; ?>
    </div><!--well-->    
</div>