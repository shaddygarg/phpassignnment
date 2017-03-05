<?php include_once("connection.php"); $err=$err1=""?>
<?php 
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username=$_POST["username"];
		$password=$_POST["password"];
		$sql = "select * from signedup where (username='$username' or email='$username')";
		$sql1 = $conn->query($sql);
		$row = $sql1->fetch_assoc();
		if(strcmp($row['username'],"")){
		$sql = "select * from signedup where (username='$username' or email='$username') and password='$password'";
		$sql1 = $conn->query($sql);
		$row = $sql1->fetch_assoc();
		if(strcmp($row['username'],"")){

		}
		else{
			$err1="Password is wrong";
		}
	}
	else{
		$err="User doesn't exist. Please sign up.";
	}
	}
?>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form action="" method="post">
		Username/Email : <input type="text" name="username"></input><?php echo $err ?><br>
		Password : <input type="Password" name="password"></input><?php echo $err1 ?><br>
		<input type="checkbox" name="remember"></input>Remember me
		<input type="submit" name="submit"></input>
	</form>
	
</body>
</html>