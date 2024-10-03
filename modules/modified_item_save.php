<!-- Saves the modified data of the item into the SQL database -->

<?php
session_start();
if(isset($_SESSION["user"]) and isset($_POST["modify_id"]))
{
	if(trim($_POST["modify_number"]) != "" and trim($_POST["modify_name"]) != "" and trim($_POST["modify_maker"]) != 0 and trim($_POST["modify_quantity"]) != "" and trim($_POST["modify_cost"]) != "" and trim($_POST["modify_price"]) != "" and trim($_POST["modify_warehouse"]) != 0 and trim($_POST["modify_location"]) != "" )
	{
		//the modified data can be saved to the server
		include("../connect.php");
		
		$statement=$kapcsolat->prepare("update items set number=?, name=?, maker=?, quantity=?, cost=?, price=?, warehouse=?, location=? where id=".$_POST["modify_id"]);
		$statement->bind_param("ssddddds", $_POST["modify_number"], $_POST["modify_name"], $_POST["modify_maker"], $_POST["modify_quantity"], $_POST["modify_cost"], $_POST["modify_price"], $_POST["modify_warehouse"], $_POST["modify_location"]);
		
		if($statement->execute())
		{
			header("location:../index.php");
		}
		else
		{
			echo("Error during the saving of the modified item's data!");
		}
	}
	else
	{
		// redirects to the modification form and gives back the id of the item which will help the system to get the data of the item from the server furthermore gives back the error variable to inform the user
		header("location:../index.php?action=modify.php&modifyid=".$_POST["modify_id"]."&error=empty");  
	}
	
}
?>