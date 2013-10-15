<!DOCTYPE html>
<?php 	
		session_start();
		
		if(isset($_SESSION['loggedIn'])) $logged=true;
		else $logged=false;

		require_once("./inc/simple-php-captcha.php");
		require_once("./inc/include.php");
		require_once("./inc/get-journey-info.php");

		$_SESSION['captcha'] = simple_php_captcha();
?>
<head>
	<title>AG | Aleksandrs Gusevs</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<meta charset='utf-8'>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-default" role="navigation">
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">
	    <a class="navbar-brand" href="http://alekss.webatu.com">Aleksandrs Gusevs</a>
	  </div>
	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="http://alekss.webatu.com">Sākums</a></li>
	    </ul>

	    <?php 
	    if($logged==true) { ?>
	    	<ul class="nav navbar-nav navbar-right">
		      <li><a href="./user/page.php">Pārvaldnieks</a></li>
		    </ul>
	    	<p class='navbar-text navbar-right'>Pieslēdzies kā: <a href="./user/user.php"><?php echo $_SESSION['username']; ?></a></p>
		<?php } ?>
	    	
	  </div><!-- /.navbar-collapse -->
	</nav>






	<div class="jumbotron">
		<div class="container">
			<img src="img/auto.png" class="pull-left hidden-xm hidden-xs img-rounded img-responsive small"/>
			<div class="pull-right">
				<?php if(isset($to_point) && isset($from_point)) { ?>
							<h1><?php echo $from_point?> - <?php echo $to_point?></h1>
							<p>Pieteikšanās un sīkāka informācija zemāk</p>
				<?php } else { ?>
							<h1>Šoreiz brauciens nav pieteikts</h1>
							<p>Ja jums ir īpašs piedāvājums - sazinieties ar mani personīgi!</p>
				<?php } ?>
			</div>
		</div>
	</div>

<div class="container">
<?php if(isset($to_point) && isset($from_point)) { ?>
		<div class="row">
			<div class="well">
				<h2>Izbraukšanas datums: <?php echo $date_when; ?></h2>
				<h2>Izbraukšanas laiks: <?php echo $dep_time; ?></h2>
			    <h2>Pieejamās vietas automašīnā: <?php echo $available_seats; ?></h2>
			    <h2>Maksa par braucienu: <?php echo $price_person ?> Ls</h2>
			</div>

			<div class="well">

				<?php if($available_seats>0) { ?>
						<form class="form-signin" id="ride" method="POST" action="view.php">
							<h3 id="getRide" class="form-signin-heading">Pieteikties braucienam:</h3>
								<div class="row">
									<div class="col-md-6">
										<div class="hidden value-error alert alert-danger"><p>Lūdzu aizpildi prasītos lauciņus!</p></div>
										<hr>
										<div class="form-group">
											<label for="name">Tavs vārds</label>
											<input type="text" name="Name" id="name"  class="form-control" placeholder="Ieraksti savu vārdu" autofocus>
										</div>
										<div class="form-group">
											<label for="address">Vieta, no kurienes brauksi</label>
											<input type="text" name="Address" id="address" class="form-control" placeholder="Kur tevi savākt?"/>
										</div>
										<div class="form-group">
											<label for="telephone">Tālrunis</label>
											<input type="text" name="Phone" id="telephone" class="form-control" placeholder="+371 12345678"/>
										</div>
										<div class="form-group">

											<h3>Somas</h3>

											<div id="bagError" class="hidden alert alert-danger"><p>Tev ir jāatzīmē somu skaits, lai turpinātu! (Ja tu brauc bez somām, tad ieķeksē attiecīgo ķeksīti!)</p></div>

											<label for="handbags">Rokassoma</label>
											<div class="input-group">
												<input readonly type="text" class="bags form-control" name="handbags" id="handbags" value="0"/>
												<span class="minusBtn input-group-addon glyphicon-minus btn btn-default"></span>
												<span class="plusBtn input-group-addon glyphicon-plus btn btn-default"></span>
											</div>

											<label for="bags sportbag">Sporta soma</label>
											<div class="input-group">
												<input readonly type="text" class="bags form-control" name="sportbag" id="sportbag" value="0"/>
												<span class="minusBtn input-group-addon glyphicon-minus btn btn-default"></span>
												<span class="plusBtn input-group-addon glyphicon-plus btn btn-default"></span>
											</div>

											<label for="bags travelbag">Ceļojuma koferis</label>
											<div class="input-group">
												<input readonly type="text" class="bags form-control" name="travelbag" id="travelbag" value="0"/>
												<span class="minusBtn input-group-addon glyphicon-minus btn btn-default"></span>
												<span class="plusBtn input-group-addon glyphicon-plus btn btn-default"></span>
											</div>
											<div class="checkbox">
											    <label>
											      <input id="nobags" name="nobags" type="checkbox"> Es braucu bez somām
											    </label>
											</div>
										</div>
										<div class="form-group">
											<label for="comment">Komentārs</label>
											<textarea type="text" name="comment" id="comment" class="form-control" placeholder="Varbūt ir kaut kas īpašs, kas man jāzina, vedot tevi?"></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div id="map"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
										  	<span class="input-group-addon">
											  	<?php
									    			echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA">';
									    		?>
								    		</span>
										  <textarea rows="4" id="code" name="code" type="text" class="captchacode form-control" placeholder="Ievadi kodu no attēla"></textarea>
										</div>
										<hr/>
										<button id="getlocation" type="submit" class="btn btn-lg btn-primary btn-block">Pieteikties</button>
									</div>
								</div>
						</form>
					<?php } else { ?>
					<h1>Diemžēl visas vietas jau ir aizņemtas!</h1>
					<p>Veiksmīgu atlikušo dienu!</p>
					<?php } ?>
			</div>

		</div>
<?php } //close if isset topoint and frompoint ?>
		<div class="modal fade" id="login-modal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Pieslēgties sistēmai</h4>
		      </div>
		      <div class="modal-body">
		        <p>Pieslēgties šai sistēmai var tikai reģistrētie lietotāji, taču reģistrācija šobrīd ir slēgta.</p>
		        <p>Jautājumu gadījumā sazināties ar  <a id="contactadmin" href="#">administratoru</a>.</p>
		        	<form id="login" role="form" method="POST" action="./user/login.php">
					  <div class="form-group">
					    <label for="username">Lietotājvārds</label>
					    <input type="text" name="username" class="form-control" id="username" placeholder="Ievadi savu lietotājvārdu">
					  </div>
					  <div class="form-group">
					    <label for="password">Parole</label>
					    <input type="password" name="password" class="form-control" id="password" placeholder="Ievadi savu paroli">
					  </div>
					  <button type="submit" class="btn btn-default">Pieslēgties</button>
					</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Aizvērt</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="row">
			<hr/>
			<p class="pull-left">Izstrādāja: <strong>Aleksandrs Gusevs</strong> &copy; 2013</p>

		<?php if($logged==true) { ?>
			<p class="pull-right"><a href="./user/logout.php" class="text-muted">Atslēgties</a></p>
		<?php } else { ?>
			<p class="pull-right"><a data-toggle="modal" href="#login-modal" class="text-muted">Pieslēgties sistēmai</a></p>
		<?php } ?>

		</div>
	</div>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script language="javascript" src="js/getmap.js" type="text/javascript"></script>
<script language="javascript" src="js/checkval.js" type="text/javascript"></script>
</body>
</html>