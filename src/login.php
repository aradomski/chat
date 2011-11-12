<?php
$login = htmlspecialchars($_POST['login']);
//$pass = md5(htmlspecialchars($_POST['pass']));
$pass = htmlspecialchars($_POST['pass']);
if(strlen($login)==0 || strlen(htmlspecialchars($_POST['pass'])) ==0){
	include 'redirect.php';
	echo "Nie wypelniles wszystkich pol!";
}else{
	$logged=false;
	$permlog = $_POST['permlog'];
	require_once 'connect.php';
	$db = connect();
	if($db !== false){
		//echo $login." ".$pass." ".$permlog."<br />";
		$sql = "SELECT user_id, login, olsah FROM users WHERE login='$login' && olsah = '$pass'";
		//echo $pass;
		foreach ($db->query($sql) as $row) {
			if($row['user_id']>0){
				$logged=true;
				$user_id = $row['user_id'];
				//echo $row['olsah'];
			}
			// 			echo $row['login'];
			// 			echo $row['user_id'];
			// 			echo $row['olsah'];
		}
		if($logged ===true){
			session_start();
			$_SESSION['uid'] = $user_id;
			//echo $user_id;
			if($permlog =="on" && setcookie('uid',$user_id, time()+3600)){
				echo "<script type='text/javascript'>window.location = 'chat.php'</script>";
				echo"zalogowano z Cookie";
			}
			echo "<script type='text/javascript'>window.location = 'chat.php'</script>";
		}else{
			include 'redirect.php';
			echo"zly login lub haslo";
		}

	}
}
?>
