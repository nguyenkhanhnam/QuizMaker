<?php
$dsn = 'mysql:host=localhost;dbname=assignment';
$username = 'root';
$password = '';
$options = [];

try{
	$connection = new PDO($dsn, $username, $password, $options);
	/*echo 'connection successful';*/
} catch(PDOException $e){
	
}
