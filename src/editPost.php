<?php
if(!function_exists('logincheck')) {
	include 'logincheck.php';
}
$loggedin = logincheck();
require_once 'connect.php';
$db= connect();
$user_id = $_SESSION['uid'];
$sql2 = "SELECT status FROM users WHERE user_id='$user_id'";
foreach ($db->query($sql2) as $row) {
	$userStatus = $row['status'];
}
//echo $userStatus;

if($loggedin == false || ($userStatus==0 || $userStatus==3)){
	header("Refresh: 1; URL=chat.php");?>
Nie jestes zalogowany
<br />
<a href="chat.php">Powrot</a>
<?php
}else {if(strlen(addslashes($_POST['submit']))==0){
	$post_id = addslashes($_GET['post_id']);
	$sql2 = "SELECT tresc FROM posts WHERE post_id='$post_id'";
	foreach ($db->query($sql2) as $row) {
		$tresc = $row['tresc'];
	}?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Chat!</title>
<link rel="stylesheet" href="styl.css" type="text/css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" language="JavaScript" src="scripts.js"></script>
</head>
<form action="editPost.php" method="post">
	<textarea rows="30" cols="70" name="tresc"><?php echo $tresc; ?></textarea>
	<br /> <input type="hidden" name="post_id"	value="<?php echo $post_id; ?>" /> 
	A może usunąć? <input type="checkbox" name="delete" />
		<input type="submit" value="uaktualnij" name="submit" />
</form>
</body>
<?php include 'footer.php'; ?>
</html>
<?php
}else{
	$date = time();
	$dni = date("Y-m-d", $date);
	$godziny = date("H:i:s", $date);
	
	 $tresc = addslashes($_POST['tresc']);
	 $delete = addslashes($_POST['delete']);
	 $post_id = addslashes($_POST['post_id']);
	 if($delete =="on"){
		 $sql = "DELETE FROM posts WHERE post_id='$post_id'";
	 }else{
	$sql = "UPDATE posts SET tresc='$tresc', date='$dni', time='$godziny' WHERE post_id='$post_id'";
	}
	require_once 'connect.php';
	$db= connect();
	$result =$db->query($sql);
	header("Refresh: 1; URL=chat.php");
	echo"<h1>Zaktualizowano pomyślnie!</h1>";
}
} ?>
