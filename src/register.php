<?php
$login = htmlspecialchars($_POST['login']);
$email = htmlspecialchars($_POST['email']);
if(strlen($_POST['password'])>0 && strlen($_POST['password2'])>0){
	//$password = md5(htmlspecialchars($_POST['password']));
	//$password2 =md5(htmlspecialchars($_POST['password2']));
	$password = htmlspecialchars($_POST['password']);
	$password2 =htmlspecialchars($_POST['password2']);
}
$submit = htmlspecialchars($_POST['submit']);
//echo strlen($login);echo strlen($email); echo strlen($password); echo strlen($password2);
$i =0;
$j=0;
if(strlen($login)>0 || strlen($email)>0){
	require_once 'connect.php';
	$db = connect();
	$sql = "SELECT login, email FROM users WHERE login='$login' || email='$email'";
	foreach ($db->query($sql) as $row) {
		if($login==$row['login']){
			$i++;
		}
		if($email==$row['email']){
			$j++;
		}
		// 		echo $i;	echo $row['email'];echo $row['login'];
	}
	//echo "i =".$i;echo "j =".$j;
}
if(strlen($login) ==0 || strlen($email)==0  ||  strlen($password)==0 || strlen($password2)==0 || $password!=$password2 || $i>0 || $j >0){
	session_start();
	//echo "i=".$i;
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="styl.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Zarejestruj sie!</title>
</head>
<body>
	<form action="register.php" method="post">
		<ul><?php if(strlen($login)==0 && strlen($submit)>0 || $i>0){
			if(strlen($login)==0){
				echo "<li>Login:<input type='text' name='login' class='registerFormError'/><b>Uzupełnij pole!</b></li>";
			}if($i>0){
				echo "<li>Login:<input type='text' name='login' class='registerFormError'/><b>Login w użyciu</b></li>";
			}
		}else{?>
			<li>Login:<input type='text' name='login'
				value="<?php if(strlen($login)>0){echo $login; }?>" />
			</li><?php
		}?>
			<?php if(strlen($email)==0 && strlen($submit)>0 || $j>0){
			if(strlen($email)==0){
				echo "<li>Email:<input type='text' name='email' class='registerFormError'/><b>Uzupełnij pole!</b></li>";
			}if($j>0){
				echo "<li>Email:<input type='text' name='email' class='registerFormError'/><b>Email w użyciu</b></li>";
			}
		}else{?>
			<li>Email:<input type='text' name='email'
				value="<?php if(strlen($email)>0){echo $email; }?>" />
			</li>
<?php
		}?>
			<?php if($password === $password2 && strlen(htmlspecialchars($_POST['password']))<6 && strlen($submit)==0){?>
			<li>Password:<input type="password" name="password" />
			</li>
			<li>Retype password:<input type="password" name="password2" />
			</li><?php }else{?>
			<li>Password:<input type="password" name="password" class='registerFormError'/>
			</li>
			<li>Retype password:<input type="password" name="password2" class='registerFormError'/> <b>Blad hasel! Musza mieć wiecej niż 6 znaków!</b>
			</li>
			<?php }?>
		</ul>
		<input type="submit" name="submit" value="wyslij!" />
	</form>
 <?php include 'footer.php'; ?>
</body>
</html>


<?php
}else {
	// 	$sql = "SELECT login, email FROM users WHERE login='$login' || email='$email'";
	$time = time();
	$date = date("Y-m-d",$time);
	// 	echo $date;
	$sql = "INSERT INTO users (login,olsah,email,registrationdate,status) VALUES ('$login','$password','$email','$date',3)";
	$result =$db->query($sql);
	include 'redirect.php';
	echo "<h1>Zarejestrowano pomyslnie</h1>";
}?>
