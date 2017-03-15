<?php include('connection.php'); 
session_start();
$username=$_SESSION['username'];?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
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
			top:250px;
		}
	</style>
</head>
<body>
	<p style="display: inline-block;">Welcome <?php echo $_SESSION['username']; ?></p>
	<a href="completeprofile.php"><button style="margin-left: 800px; ">Update Profile</button></a>
	<a href="password.php"><button style="">Update Password</button></a><br>
	<?php 
	$sql=$conn->query("SELECT * from signedup where username='$username'");
	$row = $sql->fetch_assoc();
	$sql1=$conn->query("SELECT * from info where username='$username'");
	$row1 = $sql1->fetch_assoc();
	
	?>
    <?php echo "<img src='".$row1['coverpic']."' id='cover' />"; 
    	  echo "<img src='".$row1['profilepic']."' id='profile' />";
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
		<input type="text" name="postss">
		<input type="submit" name="submit"></input>
		<br>
		<p> 
			FEED
		</p>
	</form>
	<?php 
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username=$_SESSION['username'];
		$post=$_POST['postss'];
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
		if($row123['branch']=='' or $row123['interests']==''){
			echo "PLEASE UPDATE PROFILE TO SEE POSTS";
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
