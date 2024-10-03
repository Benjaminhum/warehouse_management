

<!--Add New item FORM -->
<?php
	if(isset($_SESSION["user"]))
	{
?>
			<div class="text-center mt-5 p-3 text-secondary">
				<h1>Add new item</h1>
			</div>
			
			<div class="container mt-1">
				<div class="row">
					<div class="col-4 mx-auto p-5 border border-light-subtle rounded-4">
						<?php
							if(isset($_GET["error"]) and $_GET["error"] == "empty")
							{
								echo("<div class='mb-3 text-danger' style='font-weight:bold;'>Please fill all the required fields!</div>");
							}
						?>
						<form action="modules/new_item_save.php" method="POST">
							<div class="mb-3">
								<label for="new_number" class="form-label">Item number</label>
								<input type="text" name="new_number" class="form-control shadow-none" id="new_number">
							</div>
							<div class="mb-3">
								<label for="new_name" class="form-label">Item name</label>
								<input type="text"  name="new_name" class="form-control shadow-none" id="new_name">
							</div>
							<div class="mb-3">
								<div class="input-group-prepend">
									<label for="new_maker" class="form-label">Brand</label>
								</div>
								<select class="form-control shadow-none" name="new_maker" id="new_maker">
									<option value="0" selected>Choose...</option>
									<?php
									$options=$kapcsolat->query("select * from makers order by name");
									while($option_rows=mysqli_fetch_array($options))
										{
											echo("<option value='".$option_rows["id"]."'>".$option_rows["name"]."</option>");
										}
									
									?>
								</select>
							</div>
							<div class="mb-3">
								<label for="new_quantity" class="form-label">Quantity</label>
								<input type="number" name="new_quantity" class="form-control shadow-none" id="new_quantity">
							</div>
							<div class="mb-3">
								<label="new_cost" class="form-label">Cost (USD)</label>
								<input type="number" name="new_cost" class="form-control shadow-none" id="new_cost">
							</div>
							<div class="mb-3">
								<label="new_price" class="form-label">Price (USD)</label>
								<input type="number" name="new_price" class="form-control shadow-none" id="new_price">
							</div>
							<div class="mb-3">
								<div class="input-group-prepend">
									<label for="new_warehouse" class="form-label">Warehouse</label>
								</div>
								<select class="form-control shadow-none" name="new_warehouse" id="new_warehouse">
									<option value="0" selected>Choose...</option>
									<?php
									$options=$kapcsolat->query("select * from warehouses order by name");
									while($option_rows=mysqli_fetch_array($options))
										{
											echo("<option value='".$option_rows["id"]."'>".$option_rows["name"]."</option>");
										}
									
									?>
								</select>
							</div>
							<div class="mb-3">
								<label="new_location" class="form-label">Location</label>
								<input type="text" name="new_location" class="form-control shadow-none" id="new_location" placeholder="cabinet number-shelf number">
							</div>
							<button type="submit" class="btn btn-secondary">Add</button>
						</form>
					</div>
				</div>
			</div>
<?php
	}
?>