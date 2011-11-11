<?php
session_start();
if(isSet($_SESSION['uid'])){
	$_SESSION['uid'] = null;
	session_destroy();
}
if(isSet($_COOKIE['uid'])){
	setcookie('uid', "", time()-3600);
}
include 'redirect.php';
?>
