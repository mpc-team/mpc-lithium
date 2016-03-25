<?php

$this->title('Games');

$self = $this;

?>

<div class="jumbotron">
	<h1>GAMES</h1>
</div>

<section id="games">
    <div class="row">
		<?php foreach ($games as $game): ?>
            <div class="col-md-4">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <a class="btn" href="/games/<?= $game['realname'] ?>">
                            <img src="/img/games/<?= $game['realname']?>.png" alt="<?= $game['realname']?>.png" class="img-rounded img-responsive" style="margin: auto;" />
                        </a>
                    </div>
                </div>
            </div>
		<?php endforeach; ?>
    </div>
</section>