<div id="welcome-msg">
    <?php
    $coc_downloadlinks = array
    (
        'Andriod' => 'https://play.google.com/store/apps/details?id=com.supercell.clashofclans&referrer=mat_click_id%3D1678fecef0e6e0f0d57d59617638424f-20160101-1681',
        'iPhone' => 'https://itunes.apple.com/app/clash-of-clans/id529479190?mt=8',
        'BlueStacks(Andriod Emulator)' => 'http://www.bluestacks.com/',
    );    
    ?>
    <div class="row">
        <img src="/img/clash_of_clans/overview-banner.png" alt="overview-banner.png" class="img-responsive img-rounded coc-img-center"/>
        <p>MPC Assassins is a professional Clash of Clans group, part of MPC organization - a developing gaming clan.</p>
        <p>We are a dedicated and passionate clan; everything we do is to win our wars.</p>
        <p>To try out the game, gain some familiar experiences, see if you'll enjoy it, and have some fun; you must download the game.</p>
        <a class="btn btn-edit" role="button" data-toggle="collapse" href="#download-clash-of-clans" aria-expanded="false" aria-controls="download-clash-of-clans">
            Download Clash of Clans
        </a>
    </div>
    <div class="collapse" id="download-clash-of-clans">
      <div class="well">
        <ul class="list-group">
            <?php foreach($coc_downloadlinks as $coc_title => $coc_downLoadUrl): ?>
                <a href="<?= $coc_downLoadUrl ?>" target="_blank">
                    <li role="presentation" class="list-group-item">
                        <?= $coc_title ?>
                    </li>
                </a>
            <?php endforeach; ?>
        </ul>
      </div>
   </div>
</div>
