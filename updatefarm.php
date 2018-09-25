<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<?php
session_start();
include'functions.php';
require_once'connection.php';
if(isset($_GET['id'])){
$id = $_GET['id'];
}else{
	die('This page doesn\'t exist.');
}

$sql = "SELECT farmid,farmname,address,status FROM tblfarm WHERE farmid='$id'";
$result = $conn->query($sql);
$row=$result->fetch_object();
if(!$row){
	die('This page doesn\'t exist.');
}else{
	$id = $row->farmid;
	$name = $row->farmname;
	$address = $row->address;
	$status = $row->status;
}
addSidebar();
addLogin();
setupCookie();
updateStatus();
adminpanelAccess();
chattab();

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
	<div class="other-content">
		<a class="btp" href="adminpanel.php">Back to Admin Panel</a>
		<h1>Update <?php echo $name ?></h1>
		<div class="edit-form">
			<form id="update-farm-form">
				<div>
					<p>Farm Name</p>
					<input type="text" value="<?php echo $name?>" id="farm-name">
				</div>
				<div>
					<p>Address</p>
					<textarea id="farm-address"><?php echo $address ?></textarea>
				</div>
				<div>
					<p>Status</p>
					<?php
						if($status==1){
					echo'<input checked type="checkbox" id="status">;';
					}else{
					echo'<input type="checkbox" id="status">';
					}
					?>
				</div>
				<input type="hidden" value="<?php echo $id ?>" id="farm-id">
				<div>
					<br>
					<button>Submit</button>
				</div>
				<div id="error-message2"></div>
			</form>
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
		updateFarm();
	</script>
</body>
</html>