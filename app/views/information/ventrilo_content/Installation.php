<div id="vent-installation-content">
    <ul class="nav nav-pills nav-justified" role="tablist">
        <?php foreach($vent_installationArray as $installationItem => $vent_installationItemName): ?>
        <li role="presentation">
            <a href="#<?= $installationItem; ?>" aria-controls="<?= $installationItem; ?>" role="tab" data-toggle="tab">
                <?=  $vent_installationItemName; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!--Display Placeholder Tab - Panel First!-->
        <div role="tabpanel" class="tab-pane fade in active">
            <p class="text-center">Choose a Device...</p>
        </div>
        <!--For Each Loop Referencing a Global Array on index.html.php-->
        <?php foreach($vent_installationArray as $vent_installationItem => $vent_installationItemName): ?>
        <div role="tabpanel" class="tab-pane fade" id="<?= $vent_installationItem ?>">
            <?php
                  include('../views/information/ventrilo_content/installation_content/'. $vent_installationItem . '.php');
            ?>
        </div>
        <?php endforeach; ?>
    </div>      
</div>
