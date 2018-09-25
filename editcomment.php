<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<?php
session_start();
include'connection.php';
include'functions.php';
user_access();
updateStatus();

if($_GET['this']!=$_SESSION['id']){
	die('This page doesn\'t exist');
}
addSidebar();
addLogin();
setupCookie();
chattab();
	
$cid= $_GET['cid'];
$pid= $_GET['pid'];

$sql="SELECT comment FROM tblcomment WHERE commentid='$cid'";
if($result=$conn->query($sql)){
$row=$result->fetch_object();
$comment=$row->comment;
mysqli_close($conn);
}else{	
	die('This page doesn\'t exist');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php companytitle()?></title>
<body onscroll="scrollOpacity()">
	<div class="main-container">
	<!-- Header -->
	<?php
		addheader();
	?>
	<!-- Edit Form -->
		<div class="other-content">
			<h1>Edit Comment</h1>
			<div class="container">
				<div class="editcmt-form">
					<p>Edit Comment</p>
					<center>
						<form action="commentprocess.php" method="POST">
							<textarea id="cmt-val" name="comment"><?php echo nl2br($comment); ?></textarea>
							<br>
							<input type="hidden" name="hidden" <?php echo 'value="'.$cid.'"'?> />

							<input type="hidden" name="hidden2" <?php echo 'value="'.$pid.'"'?> />
							
							<input type="submit" value="Ok" name="submit"> <input type="submit" value="Cancel" name="back">
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
</body>
</html>