<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<?php
	session_start();
	include'functions.php';
	user_nonAccess();
	addSidebar();
	addLogin();
	setupCookie();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php companytitle()?></title>
</head>
<body onscroll="scrollOpacity()">
	<div class="main-container">
	<!-- Header -->
	<?php
		addheader();
	?>
	<!-- Contact Form -->
		<div class="other-content">
			<h1>Register</h1>
			<div class="container">
				<h2><span id="highlight-text">Create</span> an Account</h2>
				<div class="form">
					<center>
					<div class="notice"><h3><i class="fas fa-exclamation-circle"></i> Notice: We don't deliver goods outside Manila</h3></div>
					<form action="registerprocess.php" id="reg-form" method="post">
						<div class="grid-register">
							<div>
								<label for="">Username</label><br>
								<small><i>*Must not exceed 20 characters.</i></small><br>
								<input type="text" required id="reg-name" placeholder="Enter Username...">
							</div>
							<div>
								<label for="">Email</label><br>
								<input type="email" required id="reg-email" placeholder="Enter Email...">
							</div>
							<div>
								<label for="">Password</label><br>
								<small><i>*Must be atleast 8 character or longer.</i></small>
								<input type="password" required id="reg-password" placeholder="Enter Password...">
							</div>
							<div>
								<label for="">Confirm Password</label><br>
								<input type="password" required id="reg-retype" placeholder="Retype Password...">
							</div>
							<div>
								<button type="submit" name="contact-button" id="contact-button">Submit</button>
							</div>
							<div id="error-message2"></div>
						</div>	
					</form>
					</center>
				</div>
			</div>
		</div>
	<!-- Footer -->
		<?php
			addfooter();
		?>
	<!-- End of Container -->
	</div>
	<script src="js/main.js"></script>
	<script>
		let input = document.getElementById('reg-name');
		input.focus();
		modal();
		ajaxRegister();
		ajaxLogin();
	</script>
</body>
</html>