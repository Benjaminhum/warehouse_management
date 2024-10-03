<?php
	if(isset($_SESSION["user"]))
	{
?>

	<!-- Header -->
	
	  <div class="container sticky-top bg-light rounded-3 shadow">
		<header class="d-flex flex-wrap justify-content-center py-3 mb-3">
		  <a href="http://127.0.0.1/warehouse_management/index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
			<svg class="bi me-2" width="40" height="32"></svg>
			<span class="fs-4 text-secondary">Warehouse Management Application</span>
		  </a>

		  <ul class="nav nav-underline">
			<?php
			if($_SESSION["user"]["role"] == 1)
			{
			?>
				<li class="nav-item"><a href="index.php?action=admin.php" class="nav-link text-success">Admin</a></li>
			<?php
			}
			?>
			
			<li class="nav-item"><a href="#" class="nav-link text-secondary">Hi <?php include("modules/current_user.php"); ?></a></li>
			<li class="nav-item"><a href="index.php?logout=true" class="nav-link text-secondary">Logout</a></li>
		  </ul>
		</header>
	  </div>
  <!-- End of header -->
  
  <!-- Main container with flex display -->
  <div class="d-flex">
  
	<!--Side bar -->
	
	<!-- Gives back the names of the warehouses and stores the data in an array which will be used to show the names on the display -->
	<?php
		$answer_warehouses=$kapcsolat->query("select * from warehouses order by name");
		$warehouses_array=array();
		$warehouse_id_array=array();
		while($warehouse=mysqli_fetch_array($answer_warehouses))
		{
			array_push($warehouses_array,$warehouse["name"]);
			array_push($warehouse_id_array,$warehouse["id"]);
		}
	?>
	
  <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-light rounded-3 shadow me-3" style="width: 280px; height:300px;">
    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-4">Warehouses</span>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="index.php?warehouse=<?php echo($warehouse_id_array[0]); ?>" class="nav-link text-dark" aria-current="page">
         <svg class="bi pe-none me-2" width="16" height="16"></svg>
          <?php
			echo($warehouses_array[0]);
		  ?>
        </a>
      </li>
      <li>
        <a href="index.php?warehouse=<?php echo($warehouse_id_array[1]); ?>" class="nav-link text-dark">
          <svg class="bi pe-none me-2" width="16" height="16"></svg>
          <?php
			echo($warehouses_array[1]);
		  ?>
        </a>
      </li>
      <li>
        <a href="index.php?warehouse=<?php echo($warehouse_id_array[2]); ?>" class="nav-link text-dark">
          <svg class="bi pe-none me-2" width="16" height="16"></svg>
          <?php
			echo($warehouses_array[2]);
		  ?>
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <strong><?php include("modules/current_user.php"); ?></strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-light text-small shadow">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="index.php?logout=true">Sign out</a></li>
      </ul>
    </div>
  </div>
  <!-- End of side bar-->
  
  
  <!-- Content -->
  <div class="container-fluid me-3 p-4 rounded-3 shadow" style="min-height:1000px;">
	<?php
		if(!isset($_GET["action"]) or $_GET["action"] != "admin.php")
		{
	?>
		<div class="row">
			<div class="col-1"> <!--Add new item button-->
				<?php
				if($_SESSION["user"]["add_new_item"] == 1) //It checks whether the logged in user has the right to add new item
				{
				?>
						<div class="d-flex justify-content-start"><a href="index.php?action=new_item.php" title="Add new item"><button class="btn btn-outline-secondary"><i class="fa fa-plus"></i></button></a></div>
						
				<?php 
				} 
				?> 
			</div>
			
			<div class="col">
					<!-- Form for quick search, a category and random text can be set by the user which will be posted to index.php except maker and warehouse because they must be searched as numbers -->
					<form action="index.php" method="POST" class="d-flex">
					<select class="form-control shadow-none w-25" name="quick_search_category">
						<option value="0" selected>Choose where you want to search</option>
						<?php
							$options=$kapcsolat->query("select column_name from information_schema.columns where table_name = 'items'");
							$count_category=0;
							while($option_rows=mysqli_fetch_array($options))
							{
								if($option_rows["column_name"] != "id")
								{
									if($option_rows["column_name"] == "maker")
									{
										echo("<option value='".$count_category."'>".$option_rows["column_name"]." (use number for search)</option>");
									}
									else if($option_rows["column_name"] == "warehouse")
									{
										echo("<option value='".$count_category."'>".$option_rows["column_name"]." (use number for search)</option>");
									}
									else
									{
									echo("<option value='".$count_category."'>".$option_rows["column_name"]."</option>");
									}
								}
								$count_category++;
							}
						?>
					</select>
					<input type="text" class="form-control shadow-none w-25" style="margin-left:10px;" name="quick_search_text" placeholder="What are you looking for?">
					<button class="btn btn-secondary" style="margin-left:10px;" type="submit"><i class="fa fa-search"></i></button>
					</form>
					<!-- End of the form -->
			</div>
		</div>
		<?php
		}
		if(isset($_GET["action"]) and $_SESSION["user"]["role"] == 1 and $_GET["action"] == "admin.php")
		{
		?>
			<div class="row">
				<div class="col-1">
					<div class="d-flex justify-content-start"><a href="index.php?action=admin_new_user.php" title="Add new user"><button class="btn btn-outline-secondary"><i class="fa fa-plus"></i></button></a></div> <!--Add new item button ADMIN-->
				</div>
			</div>
		<?php
		}
		?>
		<div class="row mt-3"> <!-- Include the content which is based on the user's actions -->
				<div class="col">
					<?php
						if(isset($_GET["action"]))
						{
							include("modules/".$_GET["action"]);
						}
						else
						{
							include("modules/all_items.php");
						}
					?>
				</div>
		</div>
	</div>
	<!-- End of content -->
	</div>
	<!-- End of main container -->
	
<?php
	}
?>