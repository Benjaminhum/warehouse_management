<?php
	session_start();
	
	include("connect.php");
	
	if(isset($_GET["logout"]) and $_GET["logout"] == "true")
	{
		unset($_SESSION["user"]);
	}
?>



<!doctype html> <!-- Informs the web browser about the document type -->
<html lang="en">	<!-- Set the name of the website -->
	<head>
		<meta charset="utf-8">	<!-- Set the character encoding method-->
		<title>Warehouse Management Application</title>		<!-- Set the title of the website -->
		<meta name="viewport" content="width=device-width, initial-scale=1">	<!-- Makes the website's design responsive -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> <!-- Includes Bootstrap's css file -->
		<script src="https://kit.fontawesome.com/0c4ac12445.js" crossorigin="anonymous"></script>	<!-- Includes font awesome js file-->
		
		<!-- id of the desired form component, it will change the border color when the user clicked into the area of the component -->
		<style> 
		#login_email:focus {
        border-color: #aaaaaa;
		}
		#login_password:focus {
        border-color: #aaaaaa;
		}
		#new_number:focus {
        border-color: #aaaaaa;
		}
		#new_name:focus {
        border-color: #aaaaaa;
		}
		#new_maker:focus {
        border-color: #aaaaaa;
		}
		#new_quantity:focus {
        border-color: #aaaaaa;
		}
		#new_cost:focus {
        border-color: #aaaaaa;
		}
		#new_price:focus {
        border-color: #aaaaaa;
		}
		#new_warehouse:focus {
        border-color: #aaaaaa;
		}
		#new_location:focus {
        border-color: #aaaaaa;
		}
		</style>
		
	</head>
	
	<body>
	
	<?php
		if(isset($_SESSION["user"]))
		{
				include("modules/application.php");
		}
		else
		{
	?>
			<div class="text-center mt-5 p-3 text-secondary">
				<h1>Warehouse Management Application</h1>
			</div>
		
			<div class="container mt-5">
				<div class="row">
					<div class="col-4 mx-auto p-5 border border-light-subtle rounded-4">
						<form action="modules/access.php" method="POST">
							<?php
							if(isset($_GET["login"]) and $_GET["login"] == "error")
							{
								echo("<div class='mb-3 text-danger'>");
									echo("Incorrect email address or password!");
								echo("</div>");
							}
							?>
							<div class="mb-3">
								<label for="login_email" class="form-label">Email address</label>
								<input type="email" name="login_email" class="form-control shadow-none" id="login_email" aria-describedby="email_help">
								<div id="email_help" class="form-text">Login with your registered email address.</div>
							</div>
							<div class="mb-3">
								<label for="login_password" class="form-label">Password</label>
								<input type="password"  name="login_password" class="form-control shadow-none" id="login_password"> <!-- focus-ring focus-ring-secondary -->
							</div>
							<button type="submit" class="btn btn-secondary">Login</button>
						</form>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	
	<!-- Includes Bootstrap's js file -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
	</body>
</html>