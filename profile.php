<?php include('connection.php'); 
session_start();
$username = "";
if(isset($_COOKIE['sessionid'])){
	$test=$_COOKIE['sessionid'];
	$sqlaa=$conn->query("SELECT username FROM cook WHERE value='$test'");
	$rowaa=$sqlaa->fetch_assoc();
	$username=$rowaa['username'];
	echo $username;
	if($username==''){
		$username=$_SESSION['username'];
	}
}
else{
	$username=$_SESSION['username'];
}
if($username==''){
	echo "Please Log in to continue"."<br>";
	header('location:login.php');
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data); 
	$data = htmlspecialchars($data);
	return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			margin: 0;
		}
		#cover{
			position: relative;
			width: 100%;
			z-index: 0;
			height: 400px;
		}
		#profile{
			position: absolute;
			left:0;
			width: 30%;
			height: 200px;
			z-index: 1;
			top:230px;
		}
	</style>
</head>
<body>
	<p style="display: inline-block;">Welcome <?php echo $username ?></p>
	<a href="completeprofile.php"><button style="margin-left: 800px; " class="btn btn-default">Update Profile</button></a>
	<a href="password.php"><button style="" class="btn btn-default">Update Password</button></a><br>
	<a href="logout.php"><button class="btn btn-default">Logout</button></a>
	<?php 
	$sql=$conn->query("SELECT * from signedup where username='$username'");
	$row = $sql->fetch_assoc();
	$sql1=$conn->query("SELECT * from info where username='$username'");
	$row1 = $sql1->fetch_assoc();
	
	?>
	<?php echo "<img src='".$row1['coverpic']."' id='cover' alt='Please update coverpic.'/>"; 
	echo "<img src='".$row1['profilepic']."' id='profile' alt='please update profilepic.'/>";
	?>
	<table id="tab">
		<tr><td>NAME :</td><td><?php echo $row['name']; ?></td></tr>
		<tr><td>PHONE :</td><td><?php echo $row['phone']; ?></td></tr>
		<tr><td>EMAIL :</td><td><?php echo $row['email']; ?></td></tr>
		<tr><td>GENDER :</td><td><?php echo $row['gender']; ?></td></tr>
		<tr><td>BRANCH :</td><td><?php echo $row1['branch']; ?></td></tr>
		<tr><td>INTERESTS :</td><td><?php echo $row1['interests']; ?></td></tr>
	</table>
	<form action="" method="post">
		POST:
		<input type="text" name="postss" class="form-control" style="width: 200px; display: inline-block;">
		<input type="submit" name="submit" class="btn btn-default"></input>
		<br>
		<p> 
			FEED
		</p>
	</form>
	<?php 
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$post=test_input($_POST['postss']);
		$date=date("Y-m-d H:i:s");
		$sql="INSERT INTO posts(username,post,postdate) VALUES ('$username','$post','$date')";
		if($conn->query($sql)){
			echo "";
		}
		else{
			echo "PROBLEM".$conn->error;
		}
	}
	?>
	<table>
		<?php
		$sql123=$conn->query("select * from info where username='$username'");
		$row123=$sql123->fetch_assoc();
		if($row123['branch']=='' or $row123['interests']=='' or $row123['profilepic']=='' or $row123['coverpic']=''){
			echo "PLEASE COMPLETE PROFILE TO SEE POSTS";
		}
		else{
			$sql = "SELECT * FROM posts";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "" . $row["username"]. " - " . $row["post"]. " <br>"."POSTED AT " . $row["postdate"]. "<br>";
				}
			} else {
				echo "0 results";
			}
		}
		?>
	</body>
	</html>
