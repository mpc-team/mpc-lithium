<?php
    $vent_faqArray = array(
          'Question' => 'Answer',  
    );    
?>
<a name="vent-trouble-shooting"></a>
<div id="vent-troubleshoot-content">
    <h3>Trouble Shooting Ventrilo's Client</h3>
    <div class="row">
        <?php foreach($vent_faqArray as $vent_Question => $vent_Answer): ?>
            <div class="well">
                <h4><?= $vent_Question; ?></h4>
                <p><?= $vent_Answer; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>