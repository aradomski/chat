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
$post_id = htmlspecialchars($_GET['post_id']);
require_once 'connect.php';
	$db= connect();
$sql ="SELECT * FROM `posts` WHERE  post_id='$post_id'";
$user_id = $_SESSION['uid'];
$sql2 = "SELECT status FROM users WHERE user_id='$user_id'";
	foreach ($db->query($sql2) as $row) {
	$userStatus = $row['status'];
	}


include 'replacer.php';

foreach ($db->query($sql) as $row) {
	$message = censor($row['tresc']);
	$message = emots($message);
	?>
	<div class="fullSizePost">
	<pre class="fullPost"><?php echo $message;?></pre>
	<button onclick="back()">Powrót</button>
	<?php if($userStatus ==1 || $userStatus ==2){
	?><a href="editPost.php?post_id=<?php echo $post_id; ?>">Edytuj</a><?php } ?>
	</div>
	<?php
}
}
?>

