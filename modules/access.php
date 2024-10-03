<?php
session_start();

include("../connect.php");

$statement=$kapcsolat->prepare("select * from users inner join roles on users.role=roles.role_id where users.email=? and users.password=?");

//$password_code=md5($_POST["login_password"]);

$password=md5($_POST["login_password"]);
$statement->bind_param("ss",$_POST["login_email"],$password);

$statement->execute();

$valasz=$statement->get_result();

if(mysqli_num_rows($valasz) == 1)
{
	
	$sor=mysqli_fetch_assoc($valasz);
	
	$_SESSION["user"] = $sor;
	
	header("location:../index.php");
}
else
{
	header("location:../index.php?login=error");
}


?>