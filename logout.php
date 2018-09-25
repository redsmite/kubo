<?php
	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	unset($_SESSION['type']);
	unset($_SESSION['admin']);
	unset($_SESSION['updateProduct']);
	include'functions.php';
	destroyCookie();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="https://fontawesome.com/how-to-use/on-the-web/setup/getting-started?using=web-fonts-with-css">
	<title>Reloading...</title>
</head>
<body>
	<div class="main-container">
		<div class="thanks-page">
			<div id="thanks-message">
				<h1><i class="far fa-check-circle"></i>See you again!</h1>
				<p>You have successfully logout.</p>
				<p>This page will be redirected shortly.</p>
				<a href="#" id='redirectlink'>Click here to redirect</a>
			</div>
		</div>
	</div>
	<script src="js/main.js"></script>
	<script>
		redirectPage();
	</script>
</body>
</html>