

<!-- It saves the posted new item's data into the database-->


<?php
session_start();

// only works if the user is logged-in
if(isset($_SESSION["user"]) and isset($_POST["new_number"]))
{
	
	//check that if the user filled all the fields
	if(trim($_POST["new_number"]) != "" and trim($_POST["new_name"]) != "" and trim($_POST["new_maker"]) != 0 and trim($_POST["new_quantity"]) != "" and trim($_POST["new_cost"]) != "" and trim($_POST["new_price"]) != "" and trim($_POST["new_warehouse"]) != 0 and trim($_POST["new_location"]) != "")
	{
		
		// the new item can be added
		include("../connect.php");
		
		$statement=$kapcsolat->prepare("insert into items(number,name,maker,quantity,cost,price,warehouse,location) values(?,?,?,?,?,?,?,?)");
		$statement->bind_param("ssddddds", $_POST["new_number"], $_POST["new_name"], $_POST["new_maker"], $_POST["new_quantity"], $_POST["new_cost"], $_POST["new_price"], $_POST["new_warehouse"], $_POST["new_location"]);
		
		if($statement->execute()) // if the saving has been successful
		{
			header("location:../index.php");
		}
		else // if the saving hasn't been successful
		{
			echo("Error occured during the saving!");
		}
	}
	else
	{
		echo("Please fill all the required fields!");
		header("location:../index.php?action=new_item.php&error=empty");
	}
}
?>