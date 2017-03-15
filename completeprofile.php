<?php include('connection.php');
session_start(); ?>
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
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data" onsubmit="return checktext()">
		Branch: <input type="text" name="branch"  class="textbox1" onchange="checktext()" ><br>
		Interests: <input type="text" name="interests" class="textbox1" onchange="checktext()" ><br>
		Update Profile Picture: <input type="file" name="profilepic"  class="image" onchange="checkimg()" ><br>
		Update Cover Picture: <input type="file" name="coverpic" class="image" onchange="checkimg()" ><br>
		<input type="submit" name="submit">
		<?php
		$branch=$_POST["branch"];
		$interests=$_POST["interests"];
		$profilepic="testing";
		$coverpic='testing';
		$user=$_SESSION['username'];
		/*$sql="INSERT INTO info(username) VALUES ('$user')";
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {	
			echo "Error updating record: " . $conn->error;
		}*/
		if(isset($_POST['submit'])){
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
			$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$target_dira = "uploads/";
			$target_filea = $target_dira.basename($_FILES["fileToUploa"]["name"]);
			$uploadOka = 1;
			$imageFileTypea = pathinfo($target_filea,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$checka = getimagesize($_FILES["fileToUploa"]["name"]);
				$uploadOka = 1;
			}
// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0 and $uploadOka == 0 or $flag == 0) {
				echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) or move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_filea)) {
					if($uploadOk == 1) {             echo "The file ". basename( $_FILES["fileToUploa"]["name"]). " has been uploaded.";
					echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					$sql = "update info set profilepic = '$target_file' where username = '$name'";
					$result = mysqli_query($conn,$sql);
				}
				if($uploadOka == 1) {             $sqla = "update info set coverpic = '$target_filea' where username = '$name'";
				$result = mysqli_query($conn,$sqla);
			}         
			echo "<script> window.location.assign('profile.php') </script>";
		}
		else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>
</form>
</body>
</html>
