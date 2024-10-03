
<!--Add New user FORM -->
<?php
	if(isset($_SESSION["user"]) and $_SESSION["user"]["role"] == 1)
	{
?>
			<div class="text-center mt-5 p-3 text-secondary">
				<h1>Add new user</h1>
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
						<form action="modules/admin_new_user_save.php" method="POST">
							<div class="mb-3">
								<label for="new_nickname" class="form-label">User nickname</label>
								<input type="text"  name="new_nickname" class="form-control shadow-none" id="new_nickname">
							</div>
							<div class="mb-3">
							<label for="new_email" class="form-label">Email address</label>
								<div class="input-group">
									<input type="text" name="new_email" class="form-control shadow-none" id="new_email">
									<span class="input-group-text">@ware.com</span>
								</div>
							</div>
							<div class="mb-3">
								<label="new_password" class="form-label">Password</label>
								<input type="password" name="new_password" class="form-control shadow-none" id="new_password">
							</div>
							<div class="mb-3">
								<div class="input-group-prepend">
									<label for="new_role" class="form-label">Role</label>
								</div>
								<select class="form-control shadow-none" name="new_role" id="new_role">
									<option value="0" selected>Choose...</option>
									<?php
									$options=$kapcsolat->query("select * from roles order by name");
									while($option_rows=mysqli_fetch_array($options))
										{
											if($option_rows["role_id"] != 1)
											{
												echo("<option value='".$option_rows["role_id"]."'>".$option_rows["name"]."</option>");
											}
										}
									?>
								</select>
							</div>
							<button type="submit" class="btn btn-secondary">Add user</button>
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