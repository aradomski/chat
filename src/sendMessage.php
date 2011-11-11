<?php
if(!function_exists('logincheck')) {
	include 'logincheck.php';
}
$loggedin = logincheck();
if($loggedin == false){
	include 'redirect.php';?>
Nie jestes zalogowany
<br />



<?php
echo $_SESSION['uid'];
echo  $_COOKIE['uid'];?>
<a href="/">Powrot</a>



<?php
}else {
	$message = addslashes($_POST['message']);
	//include 'replacer.php';
	//echo $message;
	//$message = censor($message);
	//echo $message;
	if(strlen($message)>0){
		$date = time();
		$dni = date("Y-m-d", $date);
		$godziny = date("H:i:s", $date);

		require_once 'connect.php';
		$db=connect();
		$sql = "INSERT INTO posts(date,time,user_id,tresc) VALUES ('$dni','$godziny','$loggedin','$message')";
		//$sql2 = "INSERT INTO users (last_active_date,last_active_time) VALUES ('$dni','$godziny') WHERE user_id=$loggedin";
		$wynik =$db->exec($sql);
	//	$wynik= $db->exec($sql2);
	header("Refresh: 0; URL=chat.php");
	}else{
		header("Refresh: 0; URL=chat.php");
	}
}?>
