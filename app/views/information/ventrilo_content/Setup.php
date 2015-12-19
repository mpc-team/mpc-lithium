<div id="vent-setup-content">
    <ul class="nav nav-pills nav-justified" role="tablist">
        <?php foreach($vent_setupArray as $setupItem => $itemName): ?>
        <li role="presentation">
            <a href="#<?= $setupItem; ?>" aria-controls="<?= $setupItem; ?>" role="tab" data-toggle="tab">
                <?= $itemName; ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content">
        <!--Display Placeholder Tab - Panel First!-->
        <div role="tabpanel" class="tab-pane fade in active">
            <p class="text-center">Choose a Device...</p>
        </div>
        <!--For Each Loop Referencing a Global Array on index.html.php-->
        <?php foreach($vent_setupArray as $setupItem => $itemName): ?>
        <div role="tabpanel" class="tab-pane fade" id="<?= $setupItem ?>">
            <?php
                include('../views/information/ventrilo_content/setup_content/'. $setupItem . '.php');
            ?>
        </div>
        <?php endforeach; ?>
    </div>        
</div>