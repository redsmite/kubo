<?php
	session_start();
	unset($_SESSION['cart']);
	unset($_SESSION['trans']);
	unset($_SESSION['total']);
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
		<div id="thanks-message">
			<h1><i class="far fa-check-circle"></i>Thanks for ordering!</h1>
			<p>You have successfully place your order.</p>
			<p>The product will be delivered within 1-4 days upon approval.</p>
			<p>This page will be redirected shortly.</p>
			<a href="#" id='redirectlink'>Click here to redirect</a>
		</div>
	</div>
	<script src="js/main.js"></script>
	<script>
		redirectOrder();
	</script>
</body>
</html>