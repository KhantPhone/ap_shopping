<?php 

require_once '../config/config.php';
  
	$stmt = $pdo ->prepare ("DELETE FROM users where id = " .$_GET['id']);
	$result = $stmt->execute();

	if ($result) {
		echo "<script>alert('Successfully Deleted');window.location.href='users.php';</script>";
	}


 ?>