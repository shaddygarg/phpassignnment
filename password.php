<?php 
include('connection.php');
session_start();
$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
</head>
<body>
	<form action="" method="post">
		Current Password : <input type="Password" name="curr" required="required">
		New Password : <input type="Password" name="new1" required="required">
		Again : <input type="Password" name="new2" required="required">
		<input type="submit" name="submit">
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
	<a href="profile.php"><button>Profile Page</button></a>
	</body>
	</html>