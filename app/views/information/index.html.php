<?php

$this->title('Information');

$self = $this;
/*
 *information/index.html.php 
 */
//array to operate the (information -1- indexexs) row collapsible.
$info1Indexes = array
    (
        'aboutus',
        'communication',
    );


?>
<div id="mpc-information">
    <div class="row">
        <!--Only 2 tiles in the first index array. 3rd is static.-->
        <?php foreach($info1Indexes as $infoIndex):?>
        <div class="col-md-4">
            <a role="button" data-toggle="collapse" data-parent="#info-accordion" href="#info-<?= $infoIndex ?>-collapse" aria-expanded="true" aria-controls="info-<?= $infoIndex ?>-collapse">
                <div class="well">
                    <img src="/img/information/<?= $infoIndex ?>-banner.png" alt="<?= $infoIndex ?>-banner.png" class="img-responsive img-rounded" id="info-<?= $infoIndex ?>-banner" />
                </div>
            </a>
        </div>
        <?php endforeach; ?>
        <!--static link to our members section.-->
        <div class="col-md-4">
            <a role="button" href="http://mpcgaming.com/members">
                <div class="well">
                    <img src="/img/information/members-banner.png" alt="members-banner.png" class="img-responsive img-rounded" id="info-members-banner" />
                </div>
            </a>
        </div>
    </div>
    <!--Panels to go with what is selected above. You will need to copy/paste this code and rename $info1indexes to info2indexes in order to create the next set of tiles to be working with the panels.-->
    <div class="panel-group" id="info-accordion" role="tablist" aria-multiselectable="true">
        <div class="panel">
            <?php foreach($info1Indexes as $infoIndex):?>
                <div id="info-<?= $infoIndex ?>-collapse" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="info-<?= $infoIndex ?>-collapseheading">
                    <div class="well well-glow">
                        <?= $this->view()->render(
                            array('element' => 'information/' . $infoIndex)
                        ); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>
    //For index.html.php
    //When the collapse fades to a new div...
    //it will close and open respectively.
    $('#mpc-information .panel').css('display','none');
    $('#mpc-information .collapse.in').on('hidden.bs.collapse', function () {
    $('#mpc-information .panel').css('display', 'none');
    });
    $('#mpc-information .collapse').on('show.bs.collapse', function () {
        $('#mpc-information .panel').css('display', 'initial');
    });
    //For aboutus.html.php
    //When the modal closes, or user exits...
    //then the video in the iframe will stop playing.
    $('.mpcintro-modal, .micro-modal').on('hidden.bs.modal', function (e) {
        $('iframe').attr('src', $('iframe').attr('src'));
    });
</script>

