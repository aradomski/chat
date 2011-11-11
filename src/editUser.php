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

if($loggedin == false || $userStatus!=1){
	header("Refresh: 1; URL=chat.php");?>
Nie jestes zalogowany
<br />
<a href="chat.php">Powrot</a>


<?php
}else {
	$login = addslashes($_GET['login']);
	require_once 'connect.php';
	$db= connect();
	$sql = "SELECT * FROM users WHERE login='$login'";
	foreach ($db->query($sql) as $row) {
		$id = $row['user_id'];
		$email = $row['email'];
		$userStatus = $row['status'];
	}
	if(strlen(addslashes($_POST['submit']))==0){
		?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Chat!</title>
<link rel="stylesheet" href="styl.css" type="text/css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" language="JavaScript" src="scripts.js"></script>
</head>
<form action="editUser.php" method="post">
	Login: <input type="text" value="<?php echo $login; ?>" name="login" />
	Email: <input type="email" value="<?php echo $email; ?>" name="email" />
	Status: <select name="userStatus">
		<option value="0"<?php if($userStatus ==0){echo "selected='selected'";}?>>banned</option >
		<option value="1"<?php if($userStatus ==1){echo "selected='selected'";}?>>admin</option>
		<option value="2"<?php if($userStatus ==2){echo "selected='selected'";}?>>moderator</option>
		<option value="3"<?php if($userStatus ==3){echo "selected='selected'";}?>>user</option>
	</select> 
	<input type="hidden" value="<?php echo $id; ?>" name="id" />
	Reset password?: <input type="checkbox" name="reset"/>
	<input type="submit" value="uaktualnij" name="submit" />
</form>
<?php include 'footer.php'; ?>
</body>
</html>


<?php  
}else{
	 $login = addslashes($_POST['login']);
	 $email = addslashes($_POST['email']);
	 $userStatus = addslashes($_POST['userStatus']);
	 $id = addslashes($_POST['id']);
	 $reset = addslashes($_POST['reset']);
	 require_once 'connect.php';
	$db= connect();
	//$sql = "UPDATE books  SET title=?, author=?  WHERE id=?"; 
	if($reset != "on"){
	$sql = "UPDATE users SET login='$login', email='$email', status='$userStatus' WHERE user_id='$id'";
	}else{
		$password =md5("maslo");
		$sql = "UPDATE users SET login='$login', email='$email',olsah='$password',status='$userStatus' WHERE user_id='$id'";
	}
	
	 $result =$db->query($sql);
	
	 header("Refresh: 1; URL=chat.php");
	  echo"<h1>Zaktualizowano pomyślnie!</h1>";
	}
} ?>
