<?php

$this->title('Information');

$self = $this;

?>
<div id="mpc-information">
    <div class="row">
        <?php foreach($info1Indexes as $infoIndex):?>
        <div class="col-md-4">
            <a role="button" data-toggle="collapse" data-parent="#info-accordion" href="#info-<?= $infoIndex ?>-collapse" aria-expanded="true" aria-controls="info-<?= $infoIndex ?>-collapse">
                <div class="well">
                    <img src="/img/information/<?= $infoIndex ?>-banner.png" alt="<?= $infoIndex ?>-banner.png" class="img-responsive img-rounded" id="info-<?= $infoIndex ?>-banner" />
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="panel-group" id="info-accordion" role="tablist" aria-multiselectable="true">
        <div class="panel">
            <?php foreach($info1Indexes as $infoIndex):?>

            <div id="info-<?= $infoIndex ?>-collapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="info-<?= $infoIndex ?>-collapseheading">
                <div class="well">
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

    $('#info-aboutus-collapse').on('hidden.bs.collapse', function () {
        $('#mpc-information .panel').css('opacity', '.1');
    });
    $('#info-aboutus-collapse').on('show.bs.collapse', function () {
        $('#mpc-information .panel').css('opacity', '.9');
    });
    $('#info-communication-collapse').on('hidden.bs.collapse', function () {
        $('#mpc-information .panel').css('opacity', '.1');
    });
    $('#info-communication-collapse').on('show.bs.collapse', function () {
        $('#mpc-information .panel').css('opacity', '.9');
    });
    $('#info-members-collapse').on('hidden.bs.collapse', function () {
        $('#mpc-information .panel').css('opacity', '.1');
    });
    $('#info-members-collapse').on('show.bs.collapse', function () {
        $('#mpc-information .panel').css('opacity', '.9');
    });

</script>
