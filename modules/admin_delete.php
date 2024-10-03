<!-- It deletes the chosen user from users table-->

<?php
session_start();

if(isset($_SESSION["user"]) and $_SESSION["user"]["role"] == 1 and $_SESSION["user"]["id"] != $_GET["admin_deleteid"])
{
	
	if(isset($_GET["admin_deleteid"]))
	{
		
		include("../connect.php");
		$statement=$kapcsolat->prepare("delete from users where id=?");
		$statement->bind_param("d", $_GET["admin_deleteid"]);
		
		if($statement->execute())
		{
			header("location:../index.php?action=admin.php");
		}
		else
		{
			echo("Error during the deletion of the user!");
			header("location:../index.php?action=admin.php");
		}
	}
}
else
{
	echo("<div style='font-weight:bold;color:red;'>The current user cannot be deleted! <br><a style='text-decoration:none;color:blue;' href='../index.php?action=admin.php'>Return</a></div>");
}
?>