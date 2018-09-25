<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<?php
	session_start();
	include'functions.php';
	user_access();
	updateStatus();
	//Get Profile Info
	require_once'connection.php';
	
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
		$sql="SELECT imgpath FROM tbluser WHERE userid='$id'";
		
		$result=$conn->query($sql);

		if($result->num_rows == 0){
			die('<div id="thanks-message"><p>This username doesn\'t exist.</p></div>');
		}

		$rows=$result->fetch_object();
		
		$image=$rows->imgpath;
	}
	//End of Get Profile Info
	addSidebar();
	addLogin();
	setupCookie();
	chattab();
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
	<!-- Main Content -->
		<div class="other-content">
			<h1><i class="fas fa-camera"></i> Profile Picture</h1>
			<div class="edit-form">
				<center>
							<p>*Please don't post nudes or offensive pictures</p> 
					<div class="profile-pic-wrap">
						<?php
							if($image){
								$fimage= '<img src="'.$image.'"/>';
							}else if(!$image){
								$fimage='<img src="img/default.png" />';
							}
							echo $fimage;
						?>
					</div>

					<form id="profile-pic-form"
					method="POST" enctype="multipart/form-data">
					<progress id="progressBar"></progress>
					<h3 id="status"></h3>
					<p id="loaded_n_total"></p>
						<div>Select Picture:
							<br>
							<input type="file" id="img" value="Choose Image" name="img"/>
						</div>
						<div>
							<button type="submit" name="submit">
								<i class="fas fa-upload"></i> Upload
							</button><br><br> 

							<button type="
							submit" name="remove" onclick="removePhoto()">
								<i class="fas fa-trash-alt"></i> Remove
							</button>
						</div>
						<div id="error-message2"></div>
<?php


//upload photo
if(isset($_POST['submit'])){
	$error='';
	
	if(!$_FILES['img']['tmp_name']){
		echo'<div id="error-message2"><i class="fas fa-exclamation-circle"></i>File is empty. Select an image to upload.</div>';
	}else{

	$filetemp=$_FILES['img']['tmp_name'];
	$filename=$_FILES['img']['name'];
	$filetype=$_FILES['img']['type'];
	$filepath="upload/".$filename;
	if($filetype != "image/jpg" && $filetype != "image/png" && $filetype != "image/jpeg"
	&& $filetype != "image/gif") {
	     echo'<div id="error-message2"><i class="fas fa-exclamation-circle"></i>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
	 	$error=1;
	}

	if (filesize($filetemp) > 500000) {
	    echo'<div id="error-message2"><i class="fas fa-exclamation-circle"></i>Sorry, your file is too large. <strong>Maximum: 500kb.</strong></div>';
	    $error=1;
	}


	if($error==''){
		move_uploaded_file($filetemp, $filepath);
		$filepath=$conn->real_escape_string($filepath);
		$sql="UPDATE tbluser SET imgpath='$filepath' WHERE userid='$id'";
		$result=$conn->query($sql) or die($conn->error());

		if($result){
			echo("<script>window.location.href = 'profile.php?id=".$_SESSION['id']."';</script>");
		}
	}
	}
}
?>
						<div id="error-message2">
							</div>
					</form>
				</center>
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
	</script>
</body>
</html>