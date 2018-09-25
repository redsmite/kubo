<?php
	session_start();
	require_once'connection.php';
	include'functions.php';


    $email_to = "kymcarabeo@gmail.com";
    $email_subject = "Test mail";
    $email_body = "Hello! This is a simple email message.";


    if(mail($email_to, $email_subject, $email_body)){
        echo "The email($email_subject) was successfully sent.";
    } else {
        echo "The email($email_subject) was NOT sent.";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<title>Test</title>
</head>
<body>
</body>
</html>
<?php
	mysqli_close($conn);
?>