<?php
session_start();
require_once'connection.php';
include'functions.php';
user_access();

//encapsulate sending message
function sendmessage($sender,$Rid,$message){

    $conn = new mysqli('localhost','bahaykub_user','8Sh+8SKur9B-u4','bahaykub_db_kubo');

	$receiver=$Rid;
	$message=$conn->real_escape_string($message);
    $datenow = date("Y-m-d H:i:s");
	
	$sql="INSERT INTO tblpm (senderid,receiverid,message,pmdate) VALUES('$sender','$receiver','$message','$datenow')";
	$result=$conn->query($sql);



	//Reset Inbox

$sql="SELECT senderid,username,imgpath,message,pmdate FROM tblpm
LEFT JOIN tbluser
	ON senderid=userid
WHERE (receiverid='$sender' and senderid='$Rid') or (senderid='$sender' and receiverid='$Rid')
";

$data='';
$result=$conn->query($sql);
while($row=$result->fetch_object()){
	$Sid=$row->senderid;
	$Sname=$row->username;
	$message=$row->message;
	$imgpath=$row->imgpath;
	$date=$row->pmdate;
	if($imgpath==''){
		$imgpath='img/default.png';
	}

	if($Sid==$_SESSION['id']){
	$data.= '<div class="chat-me">
	<a class="sender" href="profile.php?id='.$Sid.'">
		<div class="comment-tn">
			<img src="'.$imgpath.'">
		</div>'.$Sname.'</a><span class="inbox-date">'.time_elapsed_string_chat($date).'</span><br>
	<div class="chat-div"> 
		<p class="inbxmsg">'.createlink(nl2br($message)).'</p>
	</div>
	</div>';
	}else{
	$data.= '<div class="chat-notme">
	<a class="sender" href="profile.php?id='.$Sid.'">
		<div class="comment-tn">
			<img src="'.$imgpath.'">
		</div>'.$Sname.'</a><span class="inbox-date">'.time_elapsed_string_chat($date).'</span><br>
	<div class="chat-div"> 
		<p class="inbxmsg">'.createlink(nl2br($message)).'</p>
	</div>
	</div>';
	}

}
		$data.='</div>
	</div>';


	echo $data;
}

//User sends message

if(isset($_POST['message'])){

	$sender=$_SESSION['id'];
	$name=$_POST['name'];
	$message=$_POST['message'];

	sendmessage($sender,$name,$message);	
}

//TuturuBot Replies

if(isset($_POST['hellobot'])){

	$name=$_SESSION['id'];
	$message='Hello '.$_SESSION['name'].', I hope you\'re having a nice day.';

	sendmessage(71,$name,$message);
	
}

if(isset($_POST['time'])){
	$name=$_SESSION['name'];
	$message='The time is ' . date("h:i:s A") . ' '. $_SESSION['name'];

	sendmessage(71,$name,$message);
}

if(isset($_POST['thanks'])){
	$name=$_SESSION['id'];
	$message='You\'re welcome '. $_SESSION['name']. '!';

	sendmessage(71,$name,$message);
}

if(isset($_POST['bye'])){
	$name=$_SESSION['id'];
	$message='Goodbye '. $_SESSION['name']. ' see you later!';

	sendmessage(71,$name,$message);
}


// send to all users a message through bot

if(isset($_POST['sendall'])){
	$message=$conn->real_escape_string($_POST['sendall']);
	$datenow = date("Y-m-d H:i:s");

	$sql = "SELECT userid FROM tbluser";
	$result=$conn->query($sql);
	$count = $result->num_rows;
	$values = '';
	for ($i = 0; $i <= $count; $i++) {
		$values .="('71','$i','$message','$datenow'),";
	}
	$values = rtrim($values,',');

	$send="INSERT INTO tblpm (senderid,receiverid,message,pmdate) VALUES $values";
	$result=$conn->query($send);
	echo 'oke-oke-okay';
}

//reset div every time

if(isset($_POST['load'])){

$id=$_SESSION['id'];
$Rid=$_POST['name'];

$sql="SELECT senderid,username,imgpath,message,pmdate FROM tblpm
LEFT JOIN tbluser
	ON senderid=userid
WHERE (receiverid='$id' and senderid='$Rid') or (senderid='$id' and receiverid='$Rid')
";

$data='';
$result=$conn->query($sql);
while($row=$result->fetch_object()){
	$Sid=$row->senderid;
	$Sname=$row->username;
	$message=$row->message;
	$imgpath=$row->imgpath;
	$date=$row->pmdate;
	if($imgpath==''){
		$imgpath='img/default.png';
	}

	if($Sname==$_SESSION['name']){
	$data.= '<div class="chat-me">
	<a class="sender" href="profile.php?id='.$Sid.'">
		<div class="comment-tn">
			<img src="'.$imgpath.'">
		</div>'.$Sname.'</a><span class="inbox-date">'.time_elapsed_string_chat($date).'</span><br>
	<div class="chat-div"> 
		<p class="inbxmsg">'.createlink(nl2br($message)).'</p>
	</div>
	</div>';
	}else{
	$data.= '<div class="chat-notme">
	<a class="sender" href="profile.php?id='.$Sid.'">
		<div class="comment-tn">
			<img src="'.$imgpath.'">
		</div>'.$Sname.'</a><span class="inbox-date">'.time_elapsed_string_chat($date).'</span><br>
	<div class="chat-div"> 
		<p class="inbxmsg">'.createlink(nl2br($message)).'</p>
	</div>
	</div>';
	}

}
		$data.='</div>
	</div>';


	echo $data;
}

?>