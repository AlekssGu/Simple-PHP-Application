<!DOCTYPE html>
<?php 	
		session_start();
		require_once("../inc/include.php");
		require_once("../inc/get-journey-info.php");
		if($_SESSION['loggedIn']!==true) header('Location:/');
?>
<head>
	<title>Admin area | Aleksandrs Gusevs</title>
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
	    <p class="navbar-text navbar-right">Līdzbraucēju informācijas iegūšanas palīgs</p>
	    <p class='navbar-text navbar-right'>Pieslēdzies kā: <a href="./user/user.php"><?php echo $_SESSION['username']; ?></a></p>
	  </div><!-- /.navbar-collapse -->
	</nav>

	<div class="jumbotron">
		<div class="container">
			<img src="../img/auto.png" class="pull-left hidden-xm hidden-xs img-rounded img-responsive small"/>
			<div class="pull-right">
				<h1>Sistēmas pārvaldnieks</h1>
			</div>
		</div>
	</div>

<?php 

$query="SELECT * FROM passenger_info WHERE journey_id='".$id."'";
$result=mysqli_query($con,$query);

?>

				<table class="table table-striped">
				    <tr>
					    <th>Nr.p.k.</th>
					    <th>Vārds</th>
					    <th>Savākt</th>
					    <th>Tālrunis</th>
					    <th>Rokas somas</th>
						<th>Sporta somas</th>
						<th>Ceļojuma somas</th>
						<th>Bez somām</th>
						<th>Komentārs</th>
						<th>Dzēst</th>
				  	</tr>
				<?php while($person=mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?> 
				  <tr>
				    <td><?php echo $person['id']; ?></td>
				    <td><?php echo $person['pers_name']; ?></td>
				    <td><?php echo $person['from_where']; ?></td>
				    <td><?php echo $person['phone']; ?></td>
				    <td><?php echo $person['handbag_count']; ?></td>
				    <td><?php echo $person['sportsbag_count']; ?></td>
				    <td><?php echo $person['travelbag_count']; ?></td>
				    <td><?php echo $person['nobags']; ?></td>
				    <td><?php echo $person['comment']; ?></td>
				    <?php echo "<td><a href='delete.php?id=".$person['id']."'class='btn btn-default btn-sm'>Dzēst</button></td>"; ?>
				  </tr>
				<?php } ?>
				</table>

<div class="container">
		<div class="row">
			<hr/>
			<p class="pull-left">Izstrādāja: <strong>Aleksandrs Gusevs</strong> &copy; 2013</p>
			<p class="pull-right"><a class="text-muted" href="./logout.php">Atslēgties no sistēmas</a></p>
		</div>
	</div>
</body>
</html>