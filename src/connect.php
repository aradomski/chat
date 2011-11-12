<?php
function connect(){
	try {
		//$db = new PDO("pgsql:dbname=aradomski;host=localhost", "aradomski", "" );
		$db = new PDO ("mysql:dbname=Zad2;host=localhost","root","");
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "PDO connection object created <br />";
		return $db;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		include 'redirect.php';
		echo "blad bazy danych";
		return false;
	}
}
/*
 *PSQL
 *
CREATE TABLE users (
user_id       serial Primary Key,
login         varchar(30),
olsah         varchar(35),
email		varchar(30),
registrationdate  date,
status            int
);
* 	MYSLQ
*
CREATE TABLE users (
user_id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(user_id),
login         varchar(30),
olsah         varchar(35),
email		varchar(30),
last_active_date date, 
last_active_time time,
registrationdate  date,
status            int
);
*
*CREATE TABLE posts
(post_id integer AUTO_INCREMENT, 
date date, 
time time,
user_id integer, 
tresc text,
Primary Key (post_id), 
Foreign Key (user_id) references users(user_id));
*/
?>
