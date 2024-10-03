
<!-- It deletes the chosen item from items table-->

<?php
session_start();
if(isset($_SESSION["user"]))
{
	
	if(isset($_GET["deleteid"]))
	{
		
		include("../connect.php");
		$statement=$kapcsolat->prepare("delete from items where id=?");
		$statement->bind_param("d", $_GET["deleteid"]);
		
		if($statement->execute())
		{
			header("location:../index.php");
		}
		else
		{
			echo("Error during the deletion of the item!");
		}
	}
}

?>