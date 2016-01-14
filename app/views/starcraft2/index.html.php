<?php

$this->title('StarCraft II');

$self = $this;

?>
<h1><?=$this->title;?></h1>

<?php foreach($dir as $file): ?>
	<p><?= $file; ?></p>
<?php endforeach; ?>
<div id="starcraft-2-lotv">
    <div class="row">
        <img src="/img/sc2/head-banner.png" alt="head-banner.png" class="img-responsive img-rounded" id="sc2lotv-headbanner" />
        <img src="/img/mpc/mpcgaming-logo.png" alt="mpcgaming-logo.png" class="img-responsive img-rounded" id="sc2-mpc-logo"/>
    </div>
    <div class="row">
        <div class="panel">
            <div class="panel-body">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="..."></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
