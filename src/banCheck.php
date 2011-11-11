<?
function isBanned($user_id){
require_once 'connect.php';
$db= connect();
$sql = "SELECT status FROM users WHERE user_id='$user_id'";
foreach ($db->query($sql) as $row) {
	$userStatus = $row['status'];
}
if($userStatus ==0){
	return true;
}else {
	return false;
}
}
?>
