 <div class="row">
<!--Public Content-->
        <h2>What is MPCgaming</h2>
        <div class="btn-group btn-group-justified" role="tablist" aria-label="infoaboutus-label">
            <?php foreach($aboutUs_styles as $type):?>
                <a href="#infoaboutus-<?= $type ?>" aria-controls="infoaboutus-<?= $type ?>" class="btn btn-edit" role="tab" data-toggle="tab">
                    <?= $type ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="tab-content">
            <?php foreach($aboutUs_styles as $type):?>
                <div role="tabpanel" class="tab-pane fade" id="infoaboutus-<?= $type ?>">
                    <?= 
                        $this->view()->render(
                        array('element' => 'information/' . $type )
                    ); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>