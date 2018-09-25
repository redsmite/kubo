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
	if(isset($_SESSION['id'])){
		$uid = $_SESSION['id'];
	}
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
	<div class="other-content">
		<div class="about-header">
			<h1>BAHAY KUBO NI MANG CELSO</h1>
			<p>Announcement</p>
		</div>
<?php
$sql="SELECT announceid,title,content,t1.datecreated,username,userid FROM tblannouncement AS t1
LEFT JOIN tbluser
	ON userid = author
ORDER BY announceid DESC
LIMIT 1";
$result= $conn->query($sql);
$row=$result->fetch_object();

$id = $row->announceid;
$title = $row->title;
$content = $row->content;
$date = date('D, F j Y g:i A',strtotime($row->datecreated));
$author = $row->username;
$userid = $row->userid;

echo '<h2 style="color:white" id="announcement-title">'.$title.'</h2>
<p style="color:white">Posted on: '.$date.' by: <a class="white" href="profile.php?id='.$userid.'">'.$author.'</a></p>
<div class="announce-content">'.nl2br($content);

echo'</div>
<br><hr>';

$sql = "SELECT commentannid FROM tblcommentann WHERE announceid = '$id'";
$result= $conn->query($sql);
$comments = $result->num_rows;
echo'<p style="color:white">Comments ('.number_format($comments).')</p>
';
if(isset($_SESSION['id'])){
echo'<form id="comment-form">
	<center><textarea id="announcement-text" required></textarea></center>
	<br>
	<input type="hidden" value="'.$_SESSION['id'].'" id="user-id">
	<input type="hidden" value="'.$id.'" id="announce-id">
	<input class="announcement-comment-submit" type="submit" value="submit">
</form>
';
}else{
	echo'<form id="comment-form">
	<textarea id="announcement-text" required></textarea>
	<br>
	<input type="hidden" id="user-id">
	<input type="hidden" id="announce-id">
	<input type="submit" class="announcement-comment-submit" value="submit">
</form>
';
}

// Display Comments
echo '<div id="announcement-comments">';
$sql = "SELECT commentannid,comment,t1.userid,username,imgpath,dateposted FROM tblcommentann AS t1
	LEFT JOIN tbluser AS t2
		ON t1.userid = t2.userid
	WHERE announceid = '$id'
	ORDER BY dateposted DESC";
$result = $conn->query($sql);
while($row = $result->fetch_object()){
	$thisid = $row->commentannid;
	$comment = $row->comment;
	$user = $row->username;
	$userid = $row->userid;
	$img = $row->imgpath;
	if(!$img){
		$img="img/default.png";
	}
	$date = $row->dateposted;
	echo'<div class="comment-box">
<div class="comment-header">
<a class="cm-user" href="profile.php?id='.$userid.'">
<div class="comment-tn">
<img src="'.$img.'">
</div>
'.$user.'</a>
<small>'.time_elapsed_string($date).'</small>
</div>
<div class="comment-body">
<div class="com-container"><p class="comment-cm">'.nl2br($comment).'</p></div></div>';
if(isset($_SESSION['id'])){
	if($_SESSION['id']==$userid){
		echo'<p class="button-control" id="'.$id.'" value="'.$thisid.'" onclick="deleteComment(this)">Delete</p>';
	}
}
echo'</div>
';
}
?>
	</div>
	<!-- Footer -->
		<?php
			addfooter();
		?>
	<!-- End of Container -->
	</div>
	<script src="js/main.js"></script>
	<script>
		addAnnounceComment();
		modal();
		ajaxLogin();
	</script>
</body>
</html>