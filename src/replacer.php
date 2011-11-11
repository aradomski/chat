<?php
function emots($text){
	if(!($fd = fopen("emots.txt","r"))){
		return $text;
	}
	while(!feof($fd)){
		$linia = fgetcsv($fd , 1000, ";");
		 $szukane = trim($linia[0]);
		 $zamiennik = trim($linia[1]);
		//echo $szukane;
		// echo $zamiennik."<br />";
		$text = str_replace($szukane,$zamiennik,$text);
		//echo "---".$text."----<br/>";
	}
	return $text;
}

function censor($text){
	if(!($fd = fopen("cenzura.txt","r"))){
		return $text;
	}
	while(!feof($fd)){
		$linia = fgetcsv($fd , 1000, ";");
		 $szukane = trim($linia[0]);
		 $zamiennik = trim($linia[1]);
		//echo $szukane;
		// echo $zamiennik."<br />";
		$text = str_replace($szukane,$zamiennik,$text);
		//echo "---".$text."----<br/>";
	}
	return $text;
}

//$message = ":P Siema :sciana: maslo kupa :P Siema :sciana: maslo kupa:P Siema :sciana: maslo kupa:P Siema :sciana: maslo kupa";
//$message =censor($message);
//echo $message;
?>
