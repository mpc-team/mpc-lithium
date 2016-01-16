<div id="coc-marshall-div">
    <div class="row">
        <img src="/img/clash_of_clans/marshall/description.png" alt="description.png" class="img-responsive img-rounded coc-img-center" id="marshall-descriptionpng" />
    </div>
    <div class="row">
        <small>Check out</small>
            <ul class="list-group">
                <a href="#" data-toggle="modal" data-target="#coc-marshall-streammodal"><li class="list-group-item">Live Broadcast</li></a>
                <a href="#"><li class="list-group-item">Casted Videos</li></a>
            </ul>
    </div>
   <?= $this->view()->render(array('element' => '/clash_of_clans/marshall-modal')); ?>
</div>