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
//echo $_SESSION['uid'];
//echo  $_COOKIE['uid'];?>
<a href="/">Powrot</a>
<?php
}else {
$date = time();
	$przeszlosc=$date -60*20;
	$dni = date("Y-m-d", $przeszlosc);
	$godziny = date("H:i:s", $przeszlosc);
	//echo $doZapytania;
	require_once 'connect.php';
	$db= connect();
	//$sql ="SELECT * FORM `posts` WHERE date =='$dni' AND time>'$godziny'";
	//$sql ="SELECT * FROM `posts` WHERE user_id='$loggedin'";
	//$sql = "SELECT * FROM users INNER JOIN posts ON users.user_id = posts.user_id WHERE posts.user_id = '$loggedin'";
	$sql = "SELECT login FROM users INNER JOIN posts ON users.user_id = posts.user_id WHERE  posts.date='$dni' AND posts.time>'$godziny' GROUP BY users.login";
	$user_id = $_SESSION['uid'];
	$sql2 = "SELECT status FROM users WHERE user_id='$user_id'";
	foreach ($db->query($sql2) as $row) {
	$userStatus = $row['status'];
	}
	//echo $loggedin;
	?>

<?php
foreach ($db->query($sql) as $row) {
	?>
	<div class="users">
		<?php if($userStatus !=1){
		 echo $row['login']; }else{?>
		<a href="editUser.php?login=<?php echo $row['login'];?>" ><?php echo $row['login'];?></a><?php }?>
	</div>
	<?php
}
?>
<?php
} ?>
