<?php 
if(empty($_POST))
{
	header('Location: /');
}

session_start();

require_once('./inc/include.php');
require_once("./inc/get-journey-info.php");

	$name=htmlspecialchars($_POST['Name']);
	$addr=htmlspecialchars($_POST['Address']);
	if(isset($_POST['comment'])) {
		$comment=htmlspecialchars($_POST['comment']);
	}
	if(isset($_POST['handbags']))
	{
		$handbags=htmlspecialchars($_POST['handbags']);
	}
	if(isset($_POST['sportbag']))
	{
		$sportsbags=htmlspecialchars($_POST['sportbag']);
	}
	if(isset($_POST['travelbag']))
	{
		$travelbags=htmlspecialchars($_POST['travelbag']);
	}
	if(isset($_POST['nobags']))
	{
		$nobags='Yes';
	}
	if(isset($_POST['Phone']))
	{
		$phone=htmlspecialchars($_POST['Phone']);
	}

$result_status="";
$result_message="";

if(isset($_SESSION['loggedIn'])) $logged=true;
		else $logged=false;

if($_POST['code']!==$_SESSION['captcha']['code'])
{
	$result_status="error";
	$result_message="Tu ievadīji nepareizu kodu no attēla! Lūdzu mēģini vēlreiz.";
}
else 
{
	$result_status="success";
	$result_message="Tavs pieteikums braucienam ir reģistrēts! Es sazināšos ar tevi (pa tavu norādīto tālruņa numuru -> ".$phone.") pēc iespējas īsākā laika posmā!";
}

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
				<?php } else { ?>
							<h1>Šoreiz brauciens nav pieteikts</h1>
							<p>Ja jums ir īpašs piedāvājums - sazinieties ar mani personīgi!</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<?php 
				if ($result_status == "success") { ?>
				<div class="panel panel-success">
				    <div class="panel-heading">
				    	<h4>Gatavs!</h4>
				    </div>
				    <div class="panel-body">
				    <p><?php echo $result_message ?></p>
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
				    <?php if(isset($comment)) echo "<h4>Tavs komentārs: ".$comment."</h4>"; ?>

				    <?php
				    	if(!isset($handbags)) $handbags=0;
				    	if(!isset($sportsbags)) $sportsbags=0;
				    	if(!isset($travelbags)) $travelbags=0;
				    	if(!isset($nobags)) $nobags='No';
				    	if(!isset($comment)) $comment=urlencode('Bez komentāra');
				    ?>

				    <?php echo "<a class='btn btn-link' href='./info.php?name=".urlencode($name)."&address=".urlencode($addr)."&phone=".urlencode($phone)."&handbag_count=".$handbags."&sportsbag_count=".$sportsbags."&travelbag_count=".$travelbags."&nobags=".$nobags."&comment=".urlencode($comment).">'Links uz informāciju</a>"; ?>                              							
				    <hr/>
				    </div>
			</div>
			<?php } elseif ($result_status == "error") {?>
			<div class="panel panel-warning">
			    <div class="panel-heading">
			    	<h4>Ir gadījusies kļūda!</h4>
			    </div>
			    <div class="panel-body">
				<p><?php echo $result_message ?></p>
				<a href="/">Doties atpakaļ!</a>
			    </div>
			    
			</div>
		<?php } ?>
		</div>

		<div class="row">
			<hr/>
			<p class="pull-left">Izstrādāja: <strong>Aleksandrs Gusevs</strong> &copy; 2013</p>
		</div>

	</div>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script language="javascript" src="js/getmap.js" type="text/javascript"></script>
<script language="javascript" src="js/checkval.js" type="text/javascript"></script>

<?php 

		if(isset($name) && isset($addr) && isset($phone)) {
		//insert values into database
			if(!isset($handbag_count)) $handbag_count=0;
			if(!isset($sportsbag_count)) $sportsbag_count=0;
			if(!isset($travelbag_count)) $travelbag_count=0;
			if(!isset($nobags)) $nobags='No';
			if(!isset($comment)) $comment='No comment';

		$query = "SELECT COUNT(*) AS total FROM passenger_info WHERE pers_name ='".$name."' 
												 AND from_where='".$addr."' 
												 AND phone='".$phone."'
												 AND handbag_count='".$handbags."'
												 AND sportsbag_count='".$sportsbags."'
												 AND travelbag_count='".$travelbags."'
												 AND nobags='".$nobags."'
												 AND comment='".$comment."'";
		$result=mysqli_query($con,$query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$total = $row['total'];

			if($total==0 && $_POST['code']==$_SESSION['captcha']['code']) 
			{
				$query="INSERT INTO passenger_info (journey_id, pers_name, from_where, phone, handbag_count, sportsbag_count, travelbag_count, nobags, comment)
						VALUES (1,'".$name."','".$addr."','".$phone."','".$handbags."',
								'".$sportsbags."','".$travelbags."','".$nobags."','".$comment."')";
				$result = mysqli_query($con, $query);
			}
			else header('Location: /');
		}
else {
	header('Location: /');
}
?>
</body>
</html>