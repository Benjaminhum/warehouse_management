

<!-- Gives back the data from the items table-->

<?php
if(isset($_SESSION["user"]))
{
	
	 $names_search = $kapcsolat->query("select column_name from information_schema.columns where table_name = 'items'"); // gets the column names of the items table
	 
	 $table_names=array();	//creates an array in order to store the column names for the quick search category
	 
	//This while loop will get the column names from the received data from the SQL server and put them into table_names array
	 while($column=mysqli_fetch_array($names_search))
	 {
		array_push($table_names,$column["column_name"]);
	 }
	 
	 
	
	//if the user sent any key from the quick search form, and the category had been chosen then this statement will be performed
	if(isset($_POST["quick_search_text"]) and trim($_POST["quick_search_text"]) != "" and $_POST["quick_search_category"] != 0)
	{
	
			$answer=$kapcsolat->query("select * from items where ".$table_names[$_POST["quick_search_category"]]." like '%".$_POST["quick_search_text"]."%'");
		
	}
	
	//shows the items ordered by the column's name if "orderby" parameter had been received
	else if(isset($_GET["orderby"]))
	{
		$answer=$kapcsolat->query("select * from items order by ".$_GET["orderby"]); // Gets the data from the items table ordered
	}
	// shows the items selected according to the warehouse they are located in
	else if(isset($_GET["warehouse"]))
	{
		$statement=$kapcsolat->prepare("select * from items where warehouse=?");
		$statement->bind_param("s",$_GET["warehouse"]);
		$statement->execute();
		$answer=$statement->get_result();
	}
	//if nothing had been chosen then every row will be selected from the items table
	else
	{
		$answer = $kapcsolat->query("select * from items"); // Gets the data from the items table without order
	}
	
	
	

   $answer_2 = $kapcsolat->query("select column_name from information_schema.columns where table_name = 'items'"); // gets the column names of the items table
	

	// Create the table where the items will be shown
    echo("<table class='table table-hover'>");
    
		// Fetch and display column names
		echo("<thead><tr>");
		 while($column = mysqli_fetch_array($answer_2)) 
		 {
			 if($column["column_name"] != "id")
			 {
				echo("<th><a class='text-dark text-decoration-none' href='index.php?orderby=".$column["column_name"]."'>" . $column["column_name"] . "</a></th>");
			 }
		 }
		 echo("</tr></thead>");
		 
		 
		
		// Fetches and displays data rows from "$answer" variable
		echo("<tbody>");
		while($row=mysqli_fetch_array($answer))
		{
			echo("<tr>");
				echo("<td>".$row["number"]."</td>");
				echo("<td>".$row["name"]."</td>");
				$maker_names=$kapcsolat->query("select * from makers where id=".$row["maker"]);
				$maker_name=mysqli_fetch_array($maker_names);
				echo("<td>".$maker_name["name"]." (".$maker_name["id"].")</td>");
				echo("<td>".$row["quantity"]." pcs</td>");
				echo("<td>".$row["cost"]." $</td>");
				echo("<td>".$row["price"]." $</td>");
				$warehouse_names=$kapcsolat->query("select * from warehouses where id=".$row["warehouse"]);
				$warehouse_name=mysqli_fetch_array($warehouse_names);
				echo("<td>".$warehouse_name["name"]." (".$warehouse_name["id"].")</td>");
				echo("<td>".$row["location"]."</td>");
				
				if($_SESSION["user"]["modify_item"] == 1) //It checks whether the logged in user has the right to modify item
				{
					echo("<td><a href='index.php?action=modify.php&modifyid=".$row["id"]."' class='text-primary' title='Modify item'><i class='fas fa-edit'></i></a></td>");
				}
				
				if($_SESSION["user"]["delete_item"] == 1) //It checks whether the logged in user has the right to delete item
				{
					echo("<td><a onclick='return question_delete()' href='modules/delete.php?deleteid=".$row["id"]."' class='text-danger' title='Delete item'><i class='fa-solid fa-trash'></i></a></td>");
				}
				
			echo("</tr>");
		}
		echo("</tbody>");
    
    echo("</table>");
}
?>
	<!-- Pop up window with a confirmation request before the deletion of the selected item -->
	<script>
	
		function question_delete()
		{
		return confirm("Would you like to delete this item?");
		}
	
	</script> 