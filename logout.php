<?php
	include('connection.php');
	session_start();
	session_unset();
	session_destroy();
	$testing=$_COOKIE['sessionid'];
	$sql=$conn->query("DELETE FROM cook WHERE value='$testing'");
	setcookie("sessionid",time() - (86400 * 30));
	echo "YOU HAVE SUCCESSFULLY LOGOUT";
	?>