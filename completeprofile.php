<?php include('connection.php');
session_start(); 
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data); 
	$data = htmlspecialchars($data);
	return $data;
}
?>
<html>
<head>
	<title>Complete Profile </title>
	<script>
		function checktext()  
		{  
			var letterNumber = /^[0-9a-zA-Z]+$/;  
			if((document.getElementsByClass('textbox1').value.match(letterNumber))   
			{  
				return true;  
			}  
			else  
			{   
				alert("Enter alphanumeric text");   
				return false;   
			}  
		}
	</script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			margin: 10px;
		}
		.form-control{
			width:200px;
		}
	</style>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data" onsubmit="return checktext()">
		Branch: <input type="text" name="branch"  class="form-control" onchange="checktext()" ><br>
		Interests: <input type="text" name="interests" class="form-control" onchange="checktext()" ><br>
		Update Profile Picture: <input type="file" name="profilepic"  class="btn btn-default" onchange="checkimg()" ><br>
		Update Cover Picture: <input type="file" name="coverpic" class="btn btn-default" onchange="checkimg()" ><br>
		<input type="submit" name="submit" class="btn btn-default">
		<?php
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$branch=test_input($_POST["branch"]);
			$interests=test_input($_POST["interests"]);
			$profilepic="testing";
			$coverpic='testing';
			$user=$_SESSION['username'];
			$sql12=$conn->query("SELECT username FROM info where username='$user'");
			$row12=$sql12->fetch_assoc();
			if($row12['username']==""){
				$sql="INSERT INTO info(username) VALUES ('$user')";
				if ($conn->query($sql) === TRUE) {
					echo "Record updated successfully";
				} else {	
					echo "Error updating record: " . $conn->error;
				}
			} else{}
			if(preg_match("/^[a-zA-Z]+$/",$branch)){
				$sql="UPDATE info SET branch='$branch' where username='$user'";
				if ($conn->query($sql) === TRUE) {
					echo "Record updated successfully";
				} else {	
					echo "Error updating record: " . $conn->error;
				}
			}
			else{
				$flag=1;
				$err1="Branch must consist of alphabets";
			}
			if(preg_match("/^[a-zA-Z]+$/",$interests)){
				$sql="UPDATE info SET interests='$interests' where username='$user'";
				if ($conn->query($sql) === TRUE) {
					echo "Record updated successfully";
				} else {	
					echo "Error updating record: " . $conn->error;
				}
			}
			else{
				$flag=1;
				$err2="Interests must consist of alphabets";
			}
			$target_dir = "uploads/";
			$target_file = $target_dir.basename($_FILES["profilepic"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				echo "Profile Picture not changed .";
			$uploadOk = 0;
		}
// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Profile pic not changed.";
// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file)) {
				$sql = "update info set profilepic = '$target_file' where username = '$user'";
				$result = mysqli_query($conn,$sql);
				echo "The file ". basename( $_FILES["profilepic"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		} 
		$target_dira = "uploads/";
		$target_filea = $target_dira.basename($_FILES["coverpic"]["name"]);
		$uploadOka = 1;
		$imageFileTypea = pathinfo($target_filea,PATHINFO_EXTENSION);
// Allow certain file formats
		if($imageFileTypea != "jpg" && $imageFileTypea != "png" && $imageFileTypea != "jpeg"
			&& $imageFileType != "gif" ) {
		$uploadOka = 0;
	}
// Check if $uploadOk is set to 0 by an error
	if ($uploadOka == 0) {
		echo "Cover photo not changed.";
// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["coverpic"]["tmp_name"], $target_filea)) {
			echo "The file ". basename( $_FILES["coverpic"]["name"]). " has been uploaded.";            
			$sqla = "update info set coverpic = '$target_filea' where username = '$user'";
			$result = mysqli_query($conn,$sqla);
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>
</form>
<a href="profile.php"><button class="btn btn-default">Profile</button></a>
</body>
</html>
