<?php

// Admin content

if($_SESSION["user"]["role"] == 1)
{
	 $admin_names_search=$kapcsolat->query("select column_name from information_schema.columns where table_name = 'users'"); // gets the column names from the users table
	$admin_answer=$kapcsolat->query("select * from users"); //gets all the users from the users table
	
	
	
	
	
	// Create the table where the items will be shown
    echo("<table class='table table-hover'>");
    
		// Fetch and display column names
		echo("<thead><tr>");
		 while($admin_column=mysqli_fetch_array($admin_names_search)) 
		 {
			 if($admin_column["column_name"] == "nickname" or $admin_column["column_name"] == "email" or $admin_column["column_name"] == "password" or $admin_column["column_name"] == "role")
			 {
				echo("<th><a class='text-dark text-decoration-none'>".$admin_column["column_name"]."</a></th>");
			 }
		 }
		 echo("</tr></thead>");
		 
		 
		
		// Fetches and displays data rows from "$answer" variable
		echo("<tbody>");
		while($row=mysqli_fetch_array($admin_answer))
		{
			echo("<tr>");
				echo("<td>".$row["nickname"]."</td>");
				echo("<td>".$row["email"]."</td>");
				echo("<td>".$row["password"]."</td>");
				$role_names=$kapcsolat->query("select * from roles where role_id=".$row["role"]);
				$role_name=mysqli_fetch_array($role_names);
				echo("<td>".$role_name["name"]." (".$role_name["role_id"].")</td>");
				echo("<td><a href='index.php?action=admin_modify.php&admin_modifyid=".$row["id"]."' class='text-primary' title='Modify user'><i class='fas fa-edit'></i></a></td>");
				if($row["role"] != 1)
				{
					echo("<td><a onclick='return question_delete()' href='modules/admin_delete.php?admin_deleteid=".$row["id"]."' class='text-danger' title='Delete user'><i class='fa-solid fa-trash'></i></a></td>");
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
	return confirm("Would you like to delete this user?");
	}	
</script> 







