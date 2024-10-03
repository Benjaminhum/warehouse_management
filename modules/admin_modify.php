


<!--Modify user FORM -->

<?php
	if(isset($_SESSION["user"]) and $_SESSION["user"]["role"] == 1)
	{
		$statement=$kapcsolat->prepare("select * from users where id=?");
		$statement->bind_param("d", $_GET["admin_modifyid"]);
		if($statement->execute())
		{
			$answer=$statement->get_result();
			$row=mysqli_fetch_array($answer);
		}
		
?>
			<div class="text-center mt-5 p-3 text-secondary">
				<h1>Modify user</h1>
			</div>
			
			<div class="container mt-1">
				<div class="row">
					<div class="col-4 mx-auto p-5 border border-light-subtle rounded-4">
						<?php
							if(isset($_GET["error"]) and $_GET["error"] == "empty")
							{
								echo("<div class='mb-3 text-danger' style='font-weight:bold;'>Please fill all the required fields properly!</div>");
							}
						?>
						<form action="modules/admin_modify_user_save.php" method="POST">
							<div class="mb-3">
								<label for="admin_modify_nickname" class="form-label">User nickname</label>
								<input type="text"  name="admin_modify_nickname" class="form-control shadow-none" id="admin_modify_nickname" value="<?php echo($row["nickname"]); ?>">
							</div>
							<div class="mb-3">
							<label for="admin_modify_email" class="form-label">Email address</label>
								<div class="input-group">
									<input type="text" name="admin_modify_email" class="form-control shadow-none" id="admin_modify_email" value="<?php echo substr($row["email"], 0, -9); ?>"> <!-- gives back the part before @ sign -->
									<span class="input-group-text">@ware.com</span>
								</div>
							</div>
							<div class="mb-3">
								<label="admin_modify_password" class="form-label">Password</label>
								<input type="password" name="admin_modify_password" class="form-control shadow-none" id="admin_modify_password" placeholder="Desired password must be typed in...">
							</div>
							<div class="mb-3">
								<div class="input-group-prepend">
									<label for="admin_modify_role" class="form-label">Role</label>
								</div>
								<select class="form-control shadow-none" name="admin_modify_role" id="admin_modify_role">
									<option value="0">Choose...</option>
									<?php
									$options=$kapcsolat->query("select * from roles order by name");
									while($option_rows=mysqli_fetch_array($options))
										{
											if($option_rows["role_id"] != 1)
											{
												if($row["role"] == $option_rows["role_id"])
												{
													echo("<option value='".$option_rows["role_id"]."' selected>".$option_rows["name"]."</option>");
												}
												else
												{
													echo("<option value='".$option_rows["role_id"]."'>".$option_rows["name"]."</option>");
												}
											}
										}
									?>
								</select>
							</div>
							<input type="hidden" name="admin_modify_id" value="<?php echo($_GET["admin_modifyid"]); ?>">
							<button type="submit" class="btn btn-secondary">Modify user</button>
						</form>
					</div>
				</div>
			</div>
<?php
	}
?>

<!-- Makes the part after the @ sign fixed in the form's field -->
<script>
    document.getElementById('new_email').addEventListener('input', function() {
        this.value = this.value.replace(/@.*/, ''); // Prevents typing '@' and anything after it
    });
</script>