<?php
include 'logincheck.php';
$loggedin = logincheck();
if($loggedin == false){
	include 'redirect.php';?>
Nie jestes zalogowany
<br />
<?php
//echo $_SESSION['uid'];
//echo  $_COOKIE['uid'];?>
<a href="/">Powrot</a>
<?php
}else {
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Chat!</title>
<link rel="stylesheet" href="styl.css" type="text/css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" language="JavaScript" src="scripts.js"></script>
</head>
<div class="chatbox">
	<div class="chatarea" id="chatarea">
	<?php include 'chatArea.php';?></div>
	<div class="chatusers" id="chatusers"><?php include 'recentActive.php';?></div>
	<div class="inputarea">
		<form action="sendMessage.php" method="post" class="createmessage">
			<textarea id="message" name="message" rows="2" cols="40"  onKeyPress="submit()"></textarea>
			<!-- input type="text" id="message" name="message"value="Tu wpisz wiadomosc" / --> 	
				<input type="submit" name="submit" value="Wyslij!" />
		</form>
		<form class="refresh">
			<button name="refresh" value="refresh" onclick="refresh()">Refresh</button>
		</form>
	</div>
</div>
<center>
	<a href="logout.php">Wyloguj mnie!</a>
</center>
 <?php include 'footer.php'; ?>
</body>
</html>
<?php
}
?>
