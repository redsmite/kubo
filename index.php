<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<?php
	session_start();
	include'functions.php';
	require_once'connection.php';
	addSidebar();
	addLogin();
	setupCookie();
	updateStatus();
	chattab();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  	<link rel="icon" href="favicon.ico" type="image/ico">
	<title><?php companytitle()?></title>
</head>
<body onscroll="scrollOpacity()">
	<div class="main-container">
	<!-- Header -->
	<?php
		addheader();
	?>
		<div class="about-header">
			<h1>BAHAY KUBO NI MANG CELSO</h1>
			<p>Home</p>
		</div>
	<!-- Main Search -->
		<div class="main-search">
			<div id="browse-category" onclick="showCategory()">Browse Category
			</div>
			<div id="category-modal" onclick="hideCategory()"></div>
			<div id="category-slide">
				<h2 class="close-heading" onclick="hideCategory()">All Categories <i style="float:right; padding-right:10px" class="fas fa-times"></i></h2>
<?php
	$sql = "SELECT categoryid,category FROM tblcategory WHERE status =1 ORDER BY category";
	$result = $conn->query($sql);
	while($row = $result->fetch_object()){
		$category = $row->category;
		$id = $row->categoryid;

		echo '<p value="'.$id.'" onclick="browseCategory(this)">'.$category.'</p>';
	}
?>
			</div>
			<!-- Marquee -->
			<marquee><div class="marquee"><span>W</span><span>E</span><span>L</span><span>C</span><span>O</span><span>M</span><span>E</span><span> </span><span>T</span><span>O</span><span> </span><span>B</span><span>A</span><span>H</span><span>A</span><span>Y</span><span> </span><span>K</span><span>U</span><span>B</span><span>O</span><span> </span><span>n</span><span>i</span><span> </span><span>M</span><span>A</span><span>N</span><span>G</span><span> </span><span>C</span><span>E</span><span>L</span><span>S</span><span>O</span></div></marquee>
		</div>
	<!-- Content -->
	<div class="main-content">
	<div class="main-tab-div">
		<div class="main-tab-control" id="main-tab1" onclick="mainTab1()">What's Hot</div>
		<div class="main-tab-control" id="main-tab2" onclick="mainTab2()">What's New</div>
		<div class="main-tab-control" id="main-tab3" onclick="mainTab3()">How to Order</div>
	</div>
	<!-- Featured Products -->
		<div class="featured-product-grid">
			<h2 class="cream" style="color:black;"><i class="fas fa-leaf"></i> Cream of the Crop<br>
				<small>What's Hot</small></h2>
<?php
	$sql = "SELECT t1.productid,img, productname, farmname FROM tblsales AS t1
	RIGHT JOIN tblproduct AS t2
		ON t1.productid = t2.productid
	LEFT JOIN tblfarm AS t3
		ON t2.farmid = t3.farmid
	WHERE is_available = 1 AND is_approved = 1
	GROUP BY t1.productid
	ORDER BY SUM(sales) DESC
	LIMIT 5";
	$result = $conn->query($sql);
	$salescount = $result->num_rows;
	if($salescount ==5){
	$count = 1;
	while($row = $result->fetch_object()){
		if($count==1){
			$productid1 = $row->productid;
			$product1 = $row->productname;
			$farm1 = $row->farmname;
			$img1=$row->img;
		}else if($count==2){
			$productid2 = $row->productid;
			$product2 = $row->productname;
			$farm2 = $row->farmname;
			$img2=$row->img;
		}else if($count==3){
			$productid3 = $row->productid;
			$product3= $row->productname;
			$farm3 = $row->farmname;
			$img3=$row->img;
		}else if($count==4){
			$productid4 = $row->productid;
			$product4= $row->productname;
			$farm4 = $row->farmname;
			$img4=$row->img;
		}else if($count==5){
			$productid5 = $row->productid;
			$product5= $row->productname;
			$farm5 = $row->farmname;
			$img5=$row->img;
		}
		$count++;
	}
	echo'<div id="showcase">
		<a id="showcase-link" href="product.php?id='.$productid1.'">
			<div>
				<div class="featured-img-wrap">	
					<img id="showcase-img" class="featured-img" src="'.$img1.'">
				</div>
				<div class="featured-desc">
					<h2 id="showcase-name">'.$product1.'</h2>
					<p>Best Seller</p>
					<p id="showcase-farm">'.$farm1.'</p>
				</div>
			</div></a>
		</div>
		<div id="top1">
			<a href="product.php?id='.$productid1.'">
			<div>
				<div class="featured-img-wrap">	
					<img class="featured-img" src="'.$img1.'">
				</div>
				<div class="featured-desc">
				<h3>'.$product1.'</h3>
					<p>'.$farm1.'</p>
				</div>
			</div>
			</a>
		</div>
		<div id="top2">
		<a href="product.php?id='.$productid2.'">
			<div>
				<div class="featured-img-wrap">	
					<img class="featured-img" src="'.$img2.'">
				</div>
				<div class="featured-desc">
					<h3>'.$product2.'</h3>
					<p>'.$farm2.'</p>
				</div>
			</div>
		</a>
		</div>
		<div id="top3">
		<a href="product.php?id='.$productid3.'">
			<div>
			<div class="featured-img-wrap">	
				<img class="featured-img" src="'.$img3.'">
			</div>
			<div class="featured-desc">
				<h3>'.$product3.'</h3>
				<p>'.$farm3.'</p>
			</div>
		</div>
		</a>
		</div>
		<div id="top4">
		<a href="product.php?id='.$productid4.'">
			<div>
			<div class="featured-img-wrap">	
				<img class="featured-img" src="'.$img4.'">
			</div>
			<div class="featured-desc">
				<h3>'.$product4.'</h3>
				<p>'.$farm4.'</p>
			</div>
		</div>
		</a>
		</div>
		<div id="top5">
		<a href="product.php?id='.$productid5.'">
			<div>
			<div class="featured-img-wrap">	
				<img class="featured-img" src="'.$img5.'">
			</div>
			<div class="featured-desc">
				<h3>'.$product5.'</h3>
				<p>'.$farm5.'</p>
			</div>
		</div>
		</a>
		</div>';
	}
?>
		</div>
			<div class="content-body">
				<h2 style="color:black;"><i class="fas fa-leaf"></i> Freshly Picked<br>
				<small style="color:black;">What's New</small></h2>
<?php
$string = 'WHERE is_approved = 1 AND is_available = 1
ORDER BY dateposted DESC
LIMIT 16';
showProduct($string);
?>
			</div>
	        <div id="how-to-order">
    			<h1 class="how-to">How to Order</h1>
    			<p class="how-to-right">Ordering here is pretty easy, all you need to do is click an item, add to the cart and checkout and enter your billing information like email, phone and address. If these steps are unclear, please refer to the following steps.</p>
    			<p class="how-to"><span><i class="fas fa-search"></i> Search for the product you want.</span></p>
    			<p class="how-to-right">There are plenty of ways to <strong>Search</strong> for the items you want like searching for keywords, browse categories, browse farms and you can sort by price.</p>
    			<p class="how-to"><span><i class="fas fa-shopping-cart"></i> Click the add-to-cart button</span></p>
    			<p class="how-to-right"> Click that green button with a <strong>Shopping Cart Icon</strong>. The item will be added on your shopping cart.</p>
    			<p class="how-to"><span><i class="fas fa-cart-arrow-down"></i> Checkout your order.</span></p>
    			<p class="how-to-right"> Click for the icon located at the top-right corner of the screen. The shopping cart will pop-out at the right of the screen. Choose the <strong>Unit</strong> for the product in kilograms. Click the green <strong>Shopping Cart Button</strong> then 
<?php
// Show Login Modal
if(isset($_SESSION['id'])){
echo '<strong><a class="black cathover">login</a></strong>';
}else{
echo'<strong onclick="showLogin()"><a class="black cathover">login</a></strong>';
}
?>
    			, or <strong><a class="black" href="register.php" target="_blank">register</a></strong> if you doesn't have an account yet.</p>
    			<p class="how-to"><span><i class="fas fa-clipboard"></i> Enter your payment info</span></p>
    			<p class="how-to-right"><strong>Cash-on-delivery</strong> - enter your billing address, email.</p>
    			<p class="how-to"><span><i class="far fa-clock"></i> Wait for the delivery</span></p>
    			<p class="how-to-right"><span>Wait for at least one to four days for the delivery. We don't deliver at places <strong>outside of Manila</strong>. You <strong>cannot cancel</strong> your order after 4pm.</span></p>
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
		mainTab1();
		sliderChange();
		modal();
		ajaxLogin();
	</script>
</body>
</html>