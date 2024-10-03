<!-- Form for the modification of the selected item's data -->

<?php

if(isset($_SESSION["user"]))
{
	
	$statement=$kapcsolat->prepare("select * from items where id=?");
	$statement->bind_param("d", $_GET["modifyid"]);
	if($statement->execute())
	{
		$valasz=$statement->get_result();
		$sor=mysqli_fetch_array($valasz);
	}
?>
	<div class="text-center mt-5 p-3 text-secondary">
		<h1>Modify item</h1>
	</div>
	
	<div class="container mt-1">
		<div class="row">
			<div class="col-4 mx-auto p-5 border border-light-subtle rounded-4">
				<?php
					if(isset($_GET["error"]) and $_GET["error"] == "empty")
					{
						echo("<div class='mb-3 text-danger' style='font-weight:bold;'>Please do not leave the required fields empty!</div>");
					}
				?>
				
				<form action="modules/modified_item_save.php" method="POST">
				
					<div class="mb-3">
						<label for="modify_number" class="form-label">Item number</label>
						<input type="text" name="modify_number" class="form-control shadow-none" id="modify_number" value="<?php echo($sor["number"]); ?>">
					</div>
					
					<div class="mb-3">
						<label for="modify_name" class="form_label">Item name</label>
						<input type="text" name="modify_name" class="form-control shadow-none" id="modify_name" value="<?php echo($sor["name"]); ?>">
					</div>
					
					<div class="mb-3">
						<div class="input-group-prepend">
							<label for="modify_maker" class="form-label">Brand</label>
						</div>
						<select class="form-control shadow-none" name="modify_maker" id="modify_maker">
							<option value="0">Choose...</option>
							<?php
								$options=$kapcsolat->query("select * from makers order by name");
								while($option_rows=mysqli_fetch_array($options))
								{
									if($sor["maker"] == $option_rows["id"])
									{
										echo("<option value='".$option_rows["id"]."' selected>".$option_rows["name"]."</option>");
									}
									else
									{
										echo("<option value='".$option_rows["id"]."'>".$option_rows["name"]."</option>");
									}
								}
							?>			
						</select>
					</div>
					
					<div class="mb-3">
						<label for="modify_quantity" class="form-label">Quantity</label>
						<input type="number" name="modify_quantity" class="form-control shadow-none" id="modify_quantity" value="<?php echo($sor["quantity"]); ?>">
					</div>
					
					<div class="mb-3">
						<label for="modify_cost" class="form-label">Cost</label>
						<input type="number" name="modify_cost" class="form-control shadow-none" id="modify_cost" value="<?php echo($sor["cost"]); ?>">
					</div>
					
					<div class="mb-3">
						<label for="modify_price" class="form-label">Price</label>
						<input type="number" name="modify_price" class="form-control shadow-none" id="modify_price" value="<?php echo($sor["price"]); ?>">
					</div>
					
					<div class="mb-3">
						<div class="input-group-prepend">
							<label for="modify_warehouse" class="form-label">Warehouse</label>
						</div>
						<select class="form-control shadow-none" name="modify_warehouse" id="modify_warehouse">
							<option value="0">Choose...</option>
							<?php
								$options=$kapcsolat->query("select * from warehouses order by name");
								while($option_rows=mysqli_fetch_array($options))
								{
									if($sor["warehouse"] == $option_rows["id"])
									{
										echo("<option value='".$option_rows["id"]."' selected>".$option_rows["name"]."</option>");
									}
									else
									{
										echo("<option value='".$option_rows["id"]."'>".$option_rows["name"]."</option>");
									}
								}
							?>
						</select>
					</div>
					
					<div class="mb-3">
						<label for="modify_location" class="form-label">Location</label>
						<input type="text" name="modify_location" class="form-control shadow-none" id="modify_location" placeholder="cabinet number-shelf number" value="<?php echo($sor["location"]); ?>">
					</div>
					
					<input type="hidden" name="modify_id" value="<?php echo($_GET["modifyid"]); ?>">
						
					<button type="submit" class="btn btn-secondary">Modify</button>
				</form>
			</div>
		</div>
	</div>
<?php	
}
?>

