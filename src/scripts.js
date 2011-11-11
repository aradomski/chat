var refreshId = setInterval('refresh()', 10000);

function refresh() {
	//$('#chatarea').fadeOut("slow").load('chatArea.php').fadeIn("slow");
	//$('#chatusers').fadeOut("slow").load('recentActive.php').fadeIn("slow");
	$('#chatarea').load('chatArea.php');
	$('#chatusers').load('recentActive.php');
}
//var refreshId = setInterval(refresh(), 6000);
function showMessage(id) {
	refreshId = clearInterval(refreshId);
	/*refreshId = setInterval(function() {
    $('#chatarea').load('seeMessage.php?post_id='+id);
   }, 5000);*/
	$('#chatarea').load('seeMessage.php?post_id='+id);
}
function back(){
	$("#chatarea").load('chatArea.php');
      $('#chatusers').load('recentActive.php');
	  refreshId = setInterval(function() {
      $("#chatarea").load('chatArea.php');
      $('#chatusers').load('recentActive.php');
   }, 5000);
}

