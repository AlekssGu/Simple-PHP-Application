<?php
if($_SESSION['loggedIn']!==true) header('Location:/');

require_once('../inc/include.php');
$id=$_GET['id'];

$query="DELETE FROM passenger_info WHERE id='".$id."'";
$result=mysqli_query($con,$query);

header('Location:./page.php');

?>
