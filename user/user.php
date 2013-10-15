<!DOCTYPE html>
<?php 	
		session_start();
		
		if(isset($_SESSION['loggedIn'])) $logged=true;
		else $logged=false;
		if($logged==false) header('Location:/');
		require_once("../inc/include.php");
		require_once("../inc/get-journey-info.php");

?>
<head>
	<title>AG | Aleksandrs Gusevs</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<meta charset='utf-8'>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/bootstrap.min.js"></script>
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
			<img src="../img/auto.png" class="pull-left hidden-xm hidden-xs img-rounded img-responsive small"/>
			<div class="pull-right">
				<h1>Lietotāja informācija</h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="well">
				<h2>Tava lietotāja informācija:</h2>
				<h3>Tavs lietotāja vārds: <?php echo $_SESSION['username']?></h3>
				<h3>Tavs e-pasts: <?php echo $_SESSION['user_email']; ?></h3>
				<h3>Reģistrācijas datums: <?php echo $_SESSION['member_since']; ?></h3>
			</div>

		<div class="row">
			<hr/>
			<p class="pull-left">Izstrādāja: <strong>Aleksandrs Gusevs</strong> &copy; 2013</p>

		<?php if($logged==true) { ?>
			<p class="pull-right"><a href="./logout.php" class="text-muted">Atslēgties</a></p>
		<?php } else { ?>
			<p class="pull-right"><a data-toggle="modal" href="#login-modal" class="text-muted">Pieslēgties sistēmai</a></p>
		<?php } ?>

		</div>
	</div>
</div>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
</body>
</html>