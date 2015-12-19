<div class="vent-accordion">
    <div class="panel-group" id="<?= $vent_accParentID; ?>" role="tablist" aria-multiselectable="true">
        <?php foreach($vent_accArray as $vent_item => $vent_accHeading): ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="<?= $vent_accHeading; ?>">
                <h3 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#<?= $vent_accParentID; ?>" href="#<?= $vent_item; ?>" aria-expanded="true" aria-controls="<?= $vent_item; ?>">
                        <span class="glyphicon glyphicon-asterisk"></span>
                        <?= $vent_item; ?>
                    </a>
                </h3>
            </div>            
            <div id="<?= $vent_item; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?= $vent_accHeading; ?>">
                <div class="panel-body">

                    <?php
                        include('../views/information/ventrilo_content/' . $vent_item . '.php');
                    ?>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>    
</div>
