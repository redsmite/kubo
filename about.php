<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<?php
	session_start();
	include'functions.php';
	include'connection.php';
	updateStatus();
	addSidebar();
	setupCookie();
	addLogin();
	chattab();

// select admin
	$sql = "SELECT userid FROM tbluser WHERE usertypeid = 4";
	$result = $conn->query($sql);
	$fetch = $result->fetch_object();
	$admin = $fetch->userid;

// select farm
	$sql = "SELECT farmname FROM tblfarm WHERE status = 1";
	$result = $conn->query($sql);

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
	<div class="about-page">
		<div class="about-header">
			<h1>BAHAY KUBO NI MANG CELSO</h1>
			<p>About</p>
		</div>
		<section class="about-section-grid">
			<div class="company-desc">
				<h1>Bahay Kubo ni Mang Celso</h1>
				<p>The prospective company is called Bahay Kubo ni Mang Celso, owned by Miss Lynn Gutierrez. It is located at Babu Pangulo, Porac, Pampanga. The company specializes in retail for agricultural products. The company is run by Miss Gutierrez, who performs all tasks within the company, from administration to advertising, to day-to-day operations.  The company offers some special and interesting services. Farmer for a Day Experience, Pick and Pay, and the popular Farm-to-Table Restaurant.</p>
			</div>
			<div class="mission">
				<h2>Mission</h2>
				<p>Mission is to spark an interest to our youth regarding the rewards of farming. That it will not just enrich your soul, it will enrich your bank accounts too. Let’s destroy the cruel image of a poor farmer. Instead let’s replace that with a farmer that can stand along our country’s finest. </p>
			</div>
			<div class="vision">
				<h2>Vision</h2>
				<p>Vision is to contribute to a heathier Philippines. Not just for its people, for its economy as well. Let us bring back our country’s golden age. Wherein our produce is the envy of many. Turning farming in to a career not just a devotion. </p>
			</div>
		</section>
		<section class="map">
			<h1>Map</h1>
			<div class="map-img"></div>
		</section>
		<section class="activities">
			<h1>Activities</h1>
			<div class="act1" title="pruning and planting"></div>
			<div class="act2" title="transplanting"></div>
			<div class="act3" title="tilling the soil"></div>
			<div class="act4" title="tree planting"></div>
			<div class="act5" title="feeding livestocks"></div>
			<div class="act6" title="sowing the seeds"></div>
			<div class="act7" title="farmer for a day experience"></div>
			<div class="act8" title="follow us on..."></div>
		</section>
		<section class="farm-section">
			<h2>Farm Location and Produce</h2>
<?php
$sql = "SELECT farmid, farmname, address FROM tblfarm WHERE status=1";
$result = $conn->query($sql);
while($row = $result->fetch_object()){
$farmid = $row->farmid;
$farmname = $row->farmname;
$desc = $row->address;
echo '<div class="farm-div"><h1>'.$farmname.'</h1><p>'.$desc.'</p>
	<a href="searchfarm.php?id='.$farmid.'"><div class="see-more">See More</div></a>
</div>';
}
?>
		</section>
		<section class="parallax-img">
			<h1>How to Order?</h1>
		</section>
	</div>
	<!-- Footer -->

		<?php
			addfooter();
		?>
	<!-- End of Container -->
	</div>
	<script src="js/main.js"></script>
	<script>
		modal();
		ajaxLogin();
	</script>
</body>
</html>