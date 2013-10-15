<?php 
session_start();

require_once('../inc/include.php');
$username=$_POST['username'];
$password=md5($_POST['password']);

$query="SELECT username FROM users WHERE username='".$username."'";
$result = mysqli_query($con, $query);
$adminusername=mysqli_fetch_array($result, MYSQLI_ASSOC);
echo $adminusername['username'];

$query="SELECT password FROM users WHERE password='".$password."'";
$result = mysqli_query($con, $query);
$adminpassword=mysqli_fetch_array($result, MYSQLI_ASSOC);
echo $adminpassword['password'];

if($username==$adminusername['username'] && $password==$adminpassword['password'])
	{
		$query="SELECT user_email,member_since FROM users WHERE username='".$username."'";
		$result = mysqli_query($con, $query);
		$data=mysqli_fetch_array($result, MYSQLI_ASSOC);
		$_SESSION['user_email']=$data['user_email'];

		$pieces=explode('-', $data['member_since']);
		$_SESSION['member_since']=implode('/',array_reverse($pieces));
		$_SESSION['loggedIn'] = true;
		$_SESSION['username']=$username;
		header('Location:/rigaliep');
	}
else{
	header('Location:/rigaliep');
} 

?>