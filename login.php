<?php include_once("connection.php"); $err=$err1=""?>
<?php 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username=$_POST["username"];
	$password=sha1($_POST["password"]);
	$sql = "select * from signedup where (username='$username' or email='$username')";
	$sql1 = $conn->query($sql);
	$row = $sql1->fetch_assoc();
	if(strcmp($row['username'],"")){
		$sql = "select * from signedup where (username='$username' or email='$username') and password='$password'";
		$sql1 = $conn->query($sql);
		$row = $sql1->fetch_assoc();
		if(strcmp($row['username'],"")){
			$_SESSION["username"]=$username;
			if(isset($_POST['remember'])){
				$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
				setcookie("username",$username,time() + (86400 * 30),$domain,false);
				setcookie("psswd",sha1($password),time()+(86400*30),$domain,false);
				$sessionid=rand(10,10000);
				$_SESSION['id']=$sessionid;
				setcookie("sessionid",md5($sessionid),time() + (86400 * 30),$domain,false);
			}
			$sql2=$conn->query("select * from info where username='$username'");
			$row2=$sql2->fetch_assoc();
			if($row2['branch']=="" or $row2['interests']==""){
				header('Location:completeprofile.php');
			}
			else{
				header('Location:profile.php');
			}
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
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
		.form-control{
			width: 200px;
		}
		body{
			margin: 10px;
		}
		.forms{
			margin-top: 200px;
			margin-left: 500px;
		}
	</style>

</head>
<body>
<div class="forms">
	<form action="" method="POST">
		<div class="form-group">
			<label for="email">Username:</label>
			<input type="text" class="form-control" id="email" name="username"><?php echo $err ?>
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="pwd" name="password"><?php echo $err1 ?>
		</div>
		<div class="checkbox">
			<label><input type="checkbox" name="remember"> Remember me</label>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
	</div>
	
</body>
</html>