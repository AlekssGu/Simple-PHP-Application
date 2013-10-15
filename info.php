<?php
session_start();
require_once('./inc/include.php');
require_once('./inc/get-journey-info.php');

$name=urldecode($_GET['name']);
$addr=$_GET['address'];
//$phone=urldecode($_GET['phone']);
$handbag_count=urldecode($_GET['handbag_count']);
$sportsbag_count=urldecode($_GET['sportsbag_count']);
$travelbag_count=urldecode($_GET['travelbag_count']);
$nobags=urldecode($_GET['nobags']);
$comment=urldecode($_GET['comment']);

/*$query="SELECT * FROM passenger_info 
		WHERE 	pers_name='".$name."',
				from_where='".$addr."', 
				phone='".$phone."',
				handbag_count='".$handbag_count."', 
				sportsbag_count='".$sportsbag_count."',
				travelbag_count='".$travelbag_count."', 
				nobags='".$nobags."', 
				comment='".$comment."'";
//var_dump($query);
//var_dump($result);
//$result = mysqli_query($con, $query);
//$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
/*
$name=$row['pers_name'];
$addr=$row['from_where'];
$phone=$row['phone'];
$handbag_count=$row['handbag_count'];
$sportsbag_count=$row['sportsbag_count'];
$travelbag_count=$row['travelbag_count'];
$nobags=$row['nobags'];
$comment=$row['comment'];
*/
?>

<!DOCTYPE html>
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
	    <p class="navbar-text navbar-right">Līdzbraucēju informācijas iegūšanas palīgs</p>

	    <?php 
	    if($_SESSION['loggedIn']==true) { ?>
	    	<ul class="nav navbar-nav navbar-right">
		      <li><a href="./user/page.php">Pārvaldnieks</a></li>
		    </ul>
	    	<p class='navbar-text navbar-right'>Pieslēdzies kā: <a href="./user/user.php"><?php echo $_SESSION['username']; ?></a></p>
		<?php } ?>
	    	
	  </div><!-- /.navbar-collapse -->
	</nav>

	<div class="container">
		<div class="row">
				<div class="panel panel-success">
				    <div class="panel-heading">
				    	<h4>Tava informācija</h4>
				    </div>
				    <div class="panel-body">
				    <hr/>
				    <h4>Vārds: <?php echo $name; ?></h4>
					<h4>Tikšanās vieta: <?php echo $addr; ?></h4>
					<h4>Maršruts: <?php echo $from_point . '-' .$to_point; ?></h4>
					<h4>Izbraukšanas datums: <?php echo $date_when; ?></h4>
					<h4>Izbraukšanas laiks: <?php echo $dep_time; ?></h4>
				    <h4>Maksa par braucienu: <?php echo $price_person; ?> Ls</h4>
				    <?php if(isset($handbags)&& $handbags!=='0') echo "<h4>Rokas somu skaits: " . $handbags . "</h4>"; ?>
				    <?php if(isset($sportsbags)&& $sportsbags!=='0') echo "<h4>Sporta somu skaits: " . $sportsbags . "</h4>"; ?>
				    <?php if(isset($travelbags)&& $travelbags!=='0') echo "<h4>Ceļojuma koferu skaits: " . $travelbags . "</h4>"; ?>
				    <?php if(isset($nobags) && $nobags=='Yes') echo "<h4>Somu skaits: 0</h4>"; ?>
				    <?php if(isset($comment) && !empty($comment)) echo "<h4>Tavs komentārs: ".$comment."</h4>"; ?>

				    <hr/>
				    </div>
				</div>  
			</div>
		<div class="row">
			<hr/>
			<p class="pull-left">Izstrādāja: <strong>Aleksandrs Gusevs</strong> &copy; 2013</p>
		</div>
	</div>
</div>
</body>
</html>