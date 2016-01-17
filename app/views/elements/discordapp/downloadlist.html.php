<div class="modal fade" id="downloaddiscord-modalbtn" tabindex="-1" role="dialog" aria-labelledby="downloaddiscord-modallabelby">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Install Discord On...</h4>
      </div>
      <div class="modal-body">        
        <div class="row">

            <div class="col-md-7">                
                <?= 
                    $this->view()->render(array('element' => 'discordapp/downmenu/part1'));        
                ?>
            </div>
            <div class="col-md-5" style="margin-top: 6px;">
                <?=
                    $this->view()->render(array('element' => 'discordapp/downmenu/part2'));
                ?>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-edit" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>