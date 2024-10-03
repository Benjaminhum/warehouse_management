
<!-- Saves the modified data of the user into the SQL database -->

<?php
session_start();
if(isset($_SESSION["user"]) and $_SESSION["user"]["role"] == 1 and isset($_POST["admin_modify_id"]))
{
	if(trim($_POST["admin_modify_nickname"]) != "" and trim($_POST["admin_modify_email"]) != "" and $_POST["admin_modify_role"] != 0 and trim($_POST["admin_modify_password"]) != "")
	{
		//the modified data can be saved to the server
		include("../connect.php");
		
		$statement=$kapcsolat->prepare("update users set nickname=?, email=?, password=?, role=? where id=".$_POST["admin_modify_id"]);
		$email=$_POST["admin_modify_email"]."@ware.com"; // add the posted part before @ sign and attach the @ware.com to it, and the data will be stored in the $email variable
		$password=md5($_POST["admin_modify_password"]);
		$statement->bind_param("sssd", $_POST["admin_modify_nickname"], $email, $password, $_POST["admin_modify_role"]);
		
		if($statement->execute())
		{
			header("location:../index.php?action=admin.php");
		}
		else
		{
			echo("Error during the saving of the modified item's data!");
		}
	}
	else
	{
		// redirects to the modification form and gives back the id of the user which will help the system to get the data of the user from the server furthermore gives back the error variable to inform the user
		header("location:../index.php?action=admin_modify.php&admin_modifyid=".$_POST["admin_modify_id"]."&error=empty");  
	}
	
}
?>