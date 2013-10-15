<?php

require_once('include.php');

mysqli_query($con,"set names utf8");
mysqli_query($con,"set charset set utf8"); 

$id=1;//used get the right journey and its info
$query="SELECT * FROM journey_info WHERE id='".$id."'";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);

$pieces=explode('-', $row['date_when']);
$date=implode('/', array_reverse($pieces));

$query="SELECT COUNT(*) AS id FROM passenger_info WHERE journey_id='".$id."'";
$result=mysqli_query($con,$query);
$seats=mysqli_fetch_array($result,MYSQLI_ASSOC);
$seats_filled=$seats['id'];//check if any seats are free

$from_point = $row['from_point'];
$to_point = $row['to_point'];
$date_when = $date;

$available_seats = $row['available_seats']-$seats_filled;
if($available_seats<0) $available_seats=0;

$price_person = $row['price_person'];
$dep_time = $row['dep_time'];
$handbags_available = $row['handbags_available'];
$sportsbags_available = $row['sportsbags_available'];
$travelbags_available = $row['travelbags_available'];

?>
