<?php
function dbConnect()
{
	$db = null;
	$host = '127.0.0.1';
	$database = 'db_ikitas1';
	$charset = 'latin1';
	$user = 'root';
	$password = 'hafid203';
	$opt = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];
	
	try{
		$db = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=' . $charset, $user, $password, $opt);
	}catch(PDOException $ex){
		echo "Something error with connection: >> ";
		print_r($ex);
	}

	return $db;
}