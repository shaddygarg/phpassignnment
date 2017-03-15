<?php 
include('connection.php');
$q='';
if($_SERVER["REQUEST_METHOD"] == "GET") {
	$q=(string)$_GET['q'];
	$sql=$conn->query("SELECT username from signedup where username='$q'");
	$row = $sql->fetch_assoc();
	if($row['username']==""){
		echo "USERNAME IS AVALIABLE";
		$message="USERNAME IS AVALIABLE";
	}
	else{
		echo "USERNAME ALREADY TAKEN";
		$message="USERNAME ALREADY TAKEN";
	}
}
?>
