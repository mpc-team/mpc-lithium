<?php

$this->title('Information');

$self = $this;

?>
<div class="well">
    <div class="btn-group btn-group-justified" role="group" aria-label="information-navbar">
        <a type="button" class="btn btn-edit" href="#about">About Us</a>
        <a type="button" class="btn btn-edit" href="#communicate">Communication</a>
    </div>
</div>
<h2>
    <span class="glyphicon glyphicon-info-sign"></span>
    MPC Gaming Apparatuses
</h2>
<a name="about"></a>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php

            //foreach Communication Tab on this document.
			$tabIDs = array(

				'KIK' => 'kikAria',
				'Forums' => 'forumAria',
				'Ventrilo' => 'ventriloAria'

			);
            //foreach ventrilo.html.php 
			$vent_downloadsArray = array(
				'Andriod Phones (Google Play Store).' => 'https://play.google.com/store/apps/details?id=com.jtxdriggers.android.ventriloid&hl=en',
				//Iphone
				'iPhones (MAC Apps).' => 'https://itunes.apple.com/us/app/ventrilode/id486115720?ls=1&mt=8',
				//Windows PC
				'Windows PC 32bit(XP, Vista, Windows 7)' => 'http://www.ventrilo.com/dlprod.php?id=1',
				'Windows PC 64bit(All 64bit platforms)' => 'http://www.ventrilo.com/dlprod.php?id=4',
				'Windows PC(9x/2000 95/98/ME and Windows 2000)' => 'http://www.ventrilo.com/dlprod.php?id=5',
				//Mac OS
				'Apple MAC(OSX10.4 or Higher(32bit)' => 'http://www.ventrilo.com/dlprod.php?id=2'

			);
            //foreach vent_instllation.html.php 
            $vent_installationArray = array(
            'vent-installation-android' => 'Android',
            'vent-installation-iphone' => 'iPhone',
            'vent-installation-pc' => 'Windows PC',
            'vent-installation-mac' => 'Mac',
            'vent-installation-linux' => 'Linux'
        );
            //foreach vent_setup.html.php 
            $vent_setupArray = array(
            'vent-setup-android' => 'Android',
            'vent-setup-iphone' => 'iPhone',
            'vent-setup-pc' => 'Windows PC',
            'vent-setup-mac' => 'Mac',
            'vent-setup-linux' => 'Linux'
        );
            //foreach vent_accordion.html.php
             $vent_accParentID = 'ventrilo-information-accordion';
             $vent_accArray = array(
            'Installation' => 'vent-installation-heading',
            'Setup' => 'vent-setup-heading',
            'Adv-Setup' => 'vent-advsetup-heading',
            'Trouble-Shooting' => 'vent-troubleshooting-heading',
            'General-Tips' => 'vent-generaltips-heading'
            );
            //foreach ventrilo.html.php
             $vent_resourceArray = array(
            'Live-feed' => 'vent-livefeed-collapse',
            'Downloads' => 'vent-downloads-collapse',
            'Documents' => 'vent-documents-collapse',
            'Videos' => 'vent-videos-collapse'

            );

        ?>
    </div>
    <div class="panel-body">
        <a name="communicate"></a>
        <div class="row">
            <h2>What MPC is About</h2>
            <p>MPC purpose is to join together a community based clan, in respect to gaming, and providing aid to helping others improve their game.</p>
        </div>
        <div class="row">
            <h2>Methods to Communicate</h2>
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach($tabIDs as $tabID => $tabAria): ?>
                <li role="presentation">
                    <a href="#<?= $tabID; ?>" aria-controls="<?= $tabAria; ?>" role="tab" data-toggle="tab">
                        <?= $tabID; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="firstview">
                    <div class="well">
                        <small>MPC's Form of Clan Communication is based on the follow selections above. Use these methods to get in contact with MPC members outside of the games you play, and during your gaming experience...</small>
                    </div>
                </div>
                <?php foreach($tabIDs as $tabID => $tabAria): ?>
                <div role="tabpanel" class="tab-pane fade in" id="<?= $tabID; ?>">
                    <div class="well">
                        <?php
                             include('../views/information/' . $tabID . '.html.php');
                        ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-edit" id="closetabs">Close Tabs</button>
        </div>
    </div>
</div>
<div class="well" style="margin-top: 70px;">
    <div class="btn-group btn-group-justified" role="group" aria-label="information-navbar">
        <a type="button" class="btn btn-edit" href="#about">About Us</a>
        <a type="button" class="btn btn-edit" href="#communicate">Communication</a>
    </div>
</div>

