<?php 
	define('MYSQL_USER', 'admin');
	define('MYSQL_PASSWORD', 'admin12345');
	define('MYSQL_HOST', 'localhost');
	define('MYSQL_DATABASE', 'ap_shopping');

	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	);

	$pdo = new PDO(
		'mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DATABASE,MYSQL_USER,MYSQL_PASSWORD,$options
	);
 ?>