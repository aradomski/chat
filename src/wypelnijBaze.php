<?php 
require_once 'connect.php';
	$db= connect();
	$date = time();
	$dni = date("Y-m-d", $date);
	$godziny = date("H:i:s", $date);
	$message = "Wiadomość testowa:)";
	$password= md5("password");
	$sql = "INSERT INTO users (login,email,olsah,registrationdate,status)VALUES ('admin','admin@admin.pl','$password','2011-11-11',1)";
	$result =$db->query($sql);
	$sql = "INSERT INTO users (login,email,olsah,registrationdate,status)VALUES ('mod','mod@mod.pl','$password','2011-11-11',2)";
	$result =$db->query($sql);
	$sql = "INSERT INTO users (login,email,olsah,registrationdate,status)VALUES ('user','user@user.pl','$password','2011-11-11',3)";
	$result =$db->query($sql);
	$sql = "INSERT INTO users (login,email,olsah,registrationdate,status)VALUES ('banned','banned@banned.pl','$password','2011-11-11',0)";
	$result =$db->query($sql);
	for ($i =0;$i<4;$i++){
	$sql = "INSERT INTO posts(date,time,user_id,tresc) VALUES ('$dni','$godziny','$i','$message')";
	$result =$db->query($sql);
	}
?>
