<div id="coc-streamerdiv">
    <?php
          //This is for creating additional casters sections with ease.
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
               
                 <div class="row">
                    <img src="/img/clash_of_clans/<?= $id ?>/description.png" alt="description.png" class="img-responsive img-rounded coc-img-center" id="<?= $id ?>-descriptionpng" />
                </div>
                <div class="row">
                    <small>Check out</small>
                    <ul class="list-group">
                        <a href="#" data-toggle="modal" data-target="#coc-<?= $id ?>-streammodal"><li class="list-group-item">Live Broadcast</li></a>
                        <a href="#"><li class="list-group-item">Casted Videos</li></a>
                    </ul>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" id="coc-<?= $id ?>-streammodal" aria-labelledby="coc-<?= $id ?>-streamlabel">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center"><?= $id ?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?= $id ?>"></iframe>
                            </div>                
                        </div>
                        <div class="collapse" id="casterchat-<?= $id ?>-collapse">
                            <div class="embed-responsive embed-responsive-4by3">
                                <iframe frameborder="0" scrolling="yes" src="http://twitch.tv/<?= $id ?>/chat?popout=">
                                </iframe>
                            </div>
                        </div>   
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-edit">Follow</button>
                        <button type="button" class="btn btn-edit" data-toggle="collapse" data-target="#casterchat-<?= $id ?>-collapse" aria-expanded="false" aria-controls="casterchat-<?= $id ?>-collapse">Chat</button>
                        <button type="button" class="btn btn-edit" data-dismiss="modal">Close</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
</div>