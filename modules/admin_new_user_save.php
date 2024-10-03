
<!-- It saves the posted new user's data into the database-->


<?php
session_start();

// only works if the user is logged-in
if(isset($_SESSION["user"]) and isset($_POST["new_nickname"]) and $_SESSION["user"]["role"] == 1)
{
	
	//check that if the user filled all the fields
	if(trim($_POST["new_nickname"]) != "" and trim($_POST["new_email"]) != "" and trim($_POST["new_password"]) != "" and trim($_POST["new_role"]) != 0)
	{
		
		// the new item can be added
		include("../connect.php");
		
		$statement=$kapcsolat->prepare("insert into users(nickname,email,password,role) values(?,?,?,?)");
		$email=$_POST["new_email"]."@ware.com"; // add the posted email + @ware.com part together and stores it in the $email variable
		$password=md5($_POST["new_password"]);
		$statement->bind_param("sssd", $_POST["new_nickname"], $email, $password, $_POST["new_role"]);
		
		if($statement->execute()) // if the saving has been successful
		{
			header("location:../index.php?action=admin.php");
		}
		else // if the saving hasn't been successful
		{
			echo("Error occured during the saving!");
		}
	}
	else
	{
		echo("Please fill all the required fields!");
		header("location:../index.php?action=admin_new_user.php&error=empty");
	}
}
?>