<?php

$this->title('Information');

$self = $this;

?>
<div id="informationindex">
	<div class="navbar-information">
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<ul class="breadcrumb">
				<li class="active">
					<a href="/information">
						<div class="breadcrumb-text">
							<span class="glyphicon glyphicon-exclamation-sign">
							</span>
								Information
						</div>
					</a>
				</li>
			</ul>
		</nav>
	</div>
	<div class="row">
		<ul class="list-group infoindexlistmar">
			<h3>Here you will find:</h3>
			<li class="presentation">Setting Ventrilo to communicate with MPC.</li>
			<li class="presentation">Watching MPC, or Community Members with live video broadcasting.</li>
			<li class="presentation">Posting Messages on our website through our forums.</li>
			<li class="presentation">Learn more about, and how to play PC Games with the dojo.</li>
			<li class="presentation">Connect with Gaming Service Providers (GSP).</li>
			<li class="presentation">Learn more about the Top Game Developers.</li>
			<li class="presentation">See the list of Games.</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-xs-4">
		</div>
		<div class="col-xs-4">
			<div id="infoindex-carousel" class="carousel slide text-center" data-ride="carousel">
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<a href="/information/ventrilolive">
							<img src="/img/captureventrilo.PNG" alt="captureventrilo.PNG" class="img-responsive img-rounded infoindeximgstyle"  />
						</a>
					</div>
					<div class="item">
						<img src="/img/twitchlogo.jpg" alt="twitchlogo.jpg" class="img-responsive img-rounded infoindeximgstyle"  />
					</div>
				</div>
				<a class="left carousel-control" href="#infoindex-carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left glyphicon-chevron-left-green" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#infoindex-carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right glyphicon-chevron-right-green" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<div class="col-xs-4">
		</div>
	</div>
	<div class="row infoindexbtnbottom">
		<ul class="nav nav-pills">
				<li role="presentation" class="disabled">
				<a href="#">
					<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
						MPCGaming:Information
				</a>
				</li>
				<li role="presentation">
					<a href="/information/ventrilolive">
					<span class="glyphicon glyphicon-headphones" aria-hidden="true"></span>
						Ventrilo
					</a>
				</li>
				<li role="presentation">
					<a href="/information/mpcstream">
						<span class="glyphicon glyphicon-film" aria-hidden="true"></span>
						Streaming
					</a>
				</li>
				<li role="presentation">
					<a href="../forum/index">
						<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
						Forum
					</a>
				</li>
				<li role="presentation">
					<a href="/information/gamelist">
						<span class="glyphicon glyphicon-play" aria-hidden="true"></span>
						PC Games
					</a>
				</li>
				<li role="presentation">
					<a href="/information/gamingservice">
						<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
						GSP
					</a>
				</li>
				<li role="presentation">
					<a href="/information/gamedevelopers"> 
						<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
						Game Developers
					</a>
				</li>
				<li role="presentation">
					<a href="/information/dojo">
						<span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
						The Dojo
					</a>
				</li>
			</ul>
	</div>
</div>