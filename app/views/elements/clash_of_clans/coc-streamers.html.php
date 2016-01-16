<div id="coc-streamersdiv">
<?php
$arrayId = array
    (

        'lovetorub16',
        'marshall',
    );

    $idAccordion = 'coc-streamers-accordion';
?>
    <div class="row">
        <img src="/img/clash_of_clans/stream.png" alt="stream.png" class="img-responsive img-rounded coc-img-center" id="coc-streambanner" />
    </div>
    <div class="panel-group" id="<?= $idAccordion ?>" role="tablist" aria-multiselectable="true">
    <?php foreach($arrayId as $id): ?>
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="coc-<?= $id ?>-heading">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#<?= $idAccordion ?>" href="#coc-<?= $id ?>-collapse" aria-expanded="true" aria-controls="coc-<?= $id ?>-collapse">
              <?= $id ?>
            </a>
          </h4>
        </div>
        <div id="coc-<?= $id ?>-collapse" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="coc-<?= $id ?>-heading">
          <div class="panel-body">
                <?=
                    $this->view()->render(array
                        (
                            'element' => 'clash_of_clans/'. $id
                        )
                    );
                ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
</div>