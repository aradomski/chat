<?php
session_start();
function logincheck(){
	if(isSet($_SESSION['uid'])){
		return $_SESSION['uid'];
	}else{
		if(isSet($_COOKIE['uid'])){
			$_SESSION['uid'] = $_COOKIE['uid'];
			return $_COOKIE['uid'];
		}else{
			echo $_SESSION['uid'];
			echo  $_COOKIE['uid'];
			return false;
		}
	}
}
?>
