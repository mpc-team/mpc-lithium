<div id="ventrilo">
    <!--Anchor name values are stored on this page.-->
    <div class="row">
        <img class="img-responsive img-rounded" src="img/information_page/ventrilobanner.PNG" alt="ventrilobanner.PNG" id="ventrilobanner" />
        <h4 class="text-center">Use the buttons to find what you're looking for. Besure to (Click/Tap) on the green Text to reveal more about that topic.</h4>
    </div>
    <div class="well-sm">
        <div class="media-list" id="information-ventfirstparagraph">
            <?php
				include('../views/information/ventrilo_content/medialist.php');
            ?>
        </div>
        <div class="btn-group btn-group-justified" role="group" aria-label="ventrilotab-navbtngroup">
          <a type="button" class="btn btn-edit" href="#connectventrilo">Ventrilo Status</a>
          <a type="button" class="btn btn-edit" href="#downloadventrilo">Download Ventrilo</a>
          <a type="button" class="btn btn-edit" href="#documentventrilo">Ventrilo Documents</a>
          <a type="button" class="btn btn-edit" href="#videoventrilo">Ventrilo Video Tutorials</a>
        </div>
    </div>
    <a name="connectventrilo"></a>
    <div class="row" id="ventrilo-status">
        <h2>Current Ventrilo Status:</h2>
        <script type="text/javascript" src="//www.typefrag.com/Server-Status/script.aspx?id=eabda7e4-f526-42e0-aaed-8c113747ef5e"></script>
    </div>
    <a name="downloadventrilo"></a>
    <div class="row">
        <h2>Download Ventrilo:</h2>
        <div class="col-xs-5">
            <ul class="list-group">
                <?php foreach($vent_downloadsArray as $method => $downloadURL): ?>
                    <a href="<?= $downloadURL; ?>" target="_blank">
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-download">

                                <?= $method; ?>

                            </span>
                        </li>
                    </a>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-xs-7">
            <img src="img/information_page/ventrilologo.PNG" class="img-rounded img-responsive" alt="ventrilologo.PNG" id="ventrilologo-img" style="margin: auto;" />
        </div>
    </div>
    <a name="documentventrilo"></a>
    <div class="row">
        <h2>Ventrilo Setup Documents:</h2>
        <?php
			include('../views/information/ventrilo_content/vent_accordion.php');
        ?>
    </div>
    <a name="videoventrilo"></a>
    <div class="row">
        <h2>Ventrilo Setup Video:</h2>
        <div class="embed-responsive embed-responsive-16by9 vid-center">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/V7zzlbkk0wc"></iframe>
        </div>
    </div>
</div>
