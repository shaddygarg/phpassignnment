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
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data" onsubmit="return checktext()">
		Branch: <input type="text" name="branch"  class="textbox1" onchange="checktext()" ><br>
		Interests: <input type="text" name="interests" class="textbox1" onchange="checktext()" ><br>
		Update Profile Picture: <input type="file" name="profilepic"  class="image" onchange="checkimg()" ><br>
		Update Cover Picture: <input type="file" name="coverpic" class="image" onchange="checkimg()" ><br>
		<input type="submit" name="submit">
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
			move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file);
			echo "The file ". basename( $_FILES["profilepic"]["name"]). " has been uploaded.";
			$sql = "update info set profilepic = '$target_file' where username = '$user'";
			$result = mysqli_query($conn,$sql); 
			$target_dira = "uploads/";
			$target_filea = $target_dira.basename($_FILES["coverpic"]["name"]);
			$uploadOka = 1;
			$imageFileTypea = pathinfo($target_filea,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["coverpic"]["tmp_name"], $target_filea);           
			echo "The file ". basename( $_FILES["coverpic"]["name"]). " has been uploaded.";            
			$sqla = "update info set coverpic = '$target_filea' where username = '$user'";
			$result = mysqli_query($conn,$sqla);
		}
		?>
	</form>
</body>
</html>
