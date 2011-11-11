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
	//$sql ="SELECT * FROM `posts` WHERE  posts.date='$dni' AND posts.time>'$godziny' ORDER BY  posts.date, posts.time";
	$sql ="SELECT login,date,time,post_id,tresc FROM `posts` INNER JOIN users ON users.user_id = posts.user_id WHERE  posts.date='$dni' AND posts.time>'$godziny' ORDER BY  posts.date, posts.time";
	?>

<?php
include 'replacer.php';

foreach ($db->query($sql) as $row) {
	$row['tresc'] = censor($row['tresc']);
	?>
	<div class="post">
		<div class="postAuthor"><?php echo $row['login']; ?>: </div>
		<div class="postMessage"><?php if(strlen($row['tresc']) >90){echo substr($row['tresc'],0,90)."...";}else {echo $row['tresc'];}?></div>
		<div class="postOther"><p class="postOtherText">
			<button onclick="showMessage(<?php echo $row['post_id']; ?>)" type="button" class="noteLink"><?php echo $row['post_id']; ?></button>
		<?php echo  $row['date']; ?>
		<?php echo  $row['time']; ?></p>
		</div>
</div>
	<?php
}
?>
<?php
} ?>
