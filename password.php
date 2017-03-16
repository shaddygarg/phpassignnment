<?php 
include('connection.php');
session_start();
$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	.form-control{
		width:200px;
	}
</style>
</head>
<body>
	<form action="" method="post">
		Current Password : <input type="Password" name="curr" required="required" class="form-control"><br>
		New Password : <input type="Password" name="new1" required="required" class="form-control"><br>
		Again : <input type="Password" name="new2" required="required" class="form-control"><br>
		<input type="submit" name="submit" class="btn btn-default"><br>
	</form>
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$curr=sha1($_POST['curr']);
		$new1=sha1($_POST['new1']);
		$new2=sha1($_POST['new2']);
		$sql=$conn->query("SELECT password from signedup where username='$username'");
		$row = $sql->fetch_assoc();
		if($curr==$row['password'] and $new1==$new2){
			$sql="UPDATE signedup SET password='$new1' where username='$username'";
			if($conn->query($sql)==TRUE){
				echo "PASSWORD RESET SUCCESSFULLY."."<br>";
			}
			else{
				echo $conn->error;
			}
		}
		else{
			echo "Passwords don't match"."<br>";
		}
	}
	?>
	<a href="profile.php"><button class="btn btn-default">Profile Page</button></a>
	</body>
	</html>