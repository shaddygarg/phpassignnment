<?php
include('connection.php');
$name = $email = $username = $password = $phone =$gender=$cnfmpassword="";
$err1=$err2=$err3=$err4=$err5="";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$name=$_POST["name"];
	$email=$_POST["email"];
	$username=$_POST["username"];
	$password=$_POST["password"];
	$phone=$_POST["phone"];
	$gender=$_POST["gender"];
	$cnfmpassword=$_POST["confirmpassword"];
	$flag=0;
	if(preg_match("/^[a-zA-Z0-9]+$/",$username)){
		$sql=$conn->query("SELECT username from signedup where username='$username'");
		$row = $sql->fetch_assoc();
	if (strcmp($row["username"],"")) {
		$err1="Username already taken";
		$flag=1;
		} 
	}
	else{
		$err1="Please enter username which is alphanumeric";
	}
	if(preg_match("/^[a-zA-Z]+$/",$name)){
	}
	else{
		$flag=1;
		$err2="Name must consist of alphabets";
	}	
	if(preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",$email)){
	}
	else{
		$flag=1;
		$err3="Enter valid email address";
	}	
	if(isset($password)){
		if(strcmp($password,$cnfmpassword)==0){
			$password=sha1($password);
		}
		else{
			$flag=1;
			$err4="Password and Confirm password doesn't match";
		}
	}
	else{
		$err4="Password cannot be empty";
	}
	if(preg_match("/^(\+[\d]{1,5}|0)?[7-9]\d{9}$/", $phone)){
	}
	else{
		$flag=1;
		$err5="Enter a valid indian phone number";
	}
	if($flag==0){
		//header("Location:login.html");
		$sql="INSERT INTO signedup(name,username,password,phone,email,gender) VALUES ('$name','$username','$password','$phone','$email','$gender')";
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {	
			echo "Error updating record: " . $conn->error;
		}
	}
}
?>
