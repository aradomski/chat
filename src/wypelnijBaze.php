<?php 
require_once 'connect.php';
	$db= connect();
	$password= md5("password");
	$sql = "INSERT INTO users (login,email,olsah,registrationdate,status)VALUES ('admin','admin@admin.pl','$password','2011-11-11',1)";
	$result =$db->query($sql);
	$sql = "INSERT INTO users (login,email,olsah,registrationdate,status)VALUES ('mod','mod@mod.pl','$password','2011-11-11',2)";
	$result =$db->query($sql);
	$sql = "INSERT INTO users (login,email,olsah,registrationdate,status)VALUES ('user','user@user.pl','$password','2011-11-11',3)";
	$result =$db->query($sql);
?>
