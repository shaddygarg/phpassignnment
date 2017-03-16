<?php include_once("signup_validation.php");?>
<!DOCTYPE html>
<html>
<head>
	<title>signup</title>
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
	<script type="text/javascript">
		var a = 0;
		function checkusername(){
			if(document.getElementById('signup_username').value.replace(' ','').match(/^[a-zA-Z0-9]+$/)){
				document.getElementById('signup_username').style.borderColor="green";
				if(a==-1){}
					else{a=1;}
			}
			else{
				document.getElementById('signup_username').style.borderColor="red";
				a=-1;
			}
			if(document.getElementById('signup_username').value==""){
				document.getElementById('signup_username').style.borderColor="black";			
			}
			str=document.getElementById('signup_username').value;
			console.log(str);
			if (str == "") {
				document.getElementById("aj").innerHTML = "";
				return;
			} else { 
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("aj").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET","getuser.php?q="+str,true);
				xmlhttp.send();
			}
		}


		function checkname(){
			if(document.getElementById('signup_name').value.replace(' ','').search(/[^a-zA-Z]+/) != -1){
				document.getElementById('signup_name').style.borderColor="red";
				a=-1;
			}
			else{
				document.getElementById('signup_name').style.borderColor="green";
				if(a==-1){}
					else{a=1;}
			}
			if(document.getElementById('signup_name').value==""){
				document.getElementById('signup_name').style.borderColor="black";			
			}
		}
		function checkemail(){
			var dot = document.getElementById('email').value.lastIndexOf('.');
			var att = document.getElementById('email').value.indexOf('@');
			var len = document.getElementById('email').value.length;
			if(att<1 || dot<att+2 || len<dot+2){
				document.getElementById('email').style.borderColor="red";				
				a=-1;
			}
			else{
				document.getElementById('email').style.borderColor="green";
				if(a==-1){}
					else{a=1;}
			}
			if(document.getElementById('email').value==""){
				document.getElementById('email').style.borderColor="black";			
			}
		}
		function checkpsswd(){
			document.getElementById('signup_password').style.borderColor="green";				
		}
		function checkcnfmpsswd(){
			if(document.getElementById('signup_password').value != document.getElementById('cnfmpass').value){
				document.getElementById('cnfmpass').style.borderColor="red";				
				a=-1;
			}
			else{
				document.getElementById('cnfmpass').style.borderColor="green";
				if(a==-1){}
					else{a=1;}
			}
			if(document.getElementById('cnfmpass').value==""){
				document.getElementById('cnfmpass').style.borderColor="black";			
			}
		}
		function checkphn(){
			if(document.getElementById('no1').value.match(/^(\+[\d]{1,5}|0)?[7-9]\d{9}$/)){
				document.getElementById('no1').style.borderColor="green";
				if(a==-1){}
					else{a=1;}
			}
			else {
				document.getElementById('no1').style.borderColor="red";
				a=-1;
			}
			if(document.getElementById('no1').value==""){
				document.getElementById('no1').style.borderColor="black";			
			}
		}
		function check(){
			a = 0;
			checkusername();
			checkemail();
			checkphn();
			checkpsswd();
			checkcnfmpsswd();
			checkname();
			if(a==-1){
				return false;
			}
			if(a==1){
				return true;
			}
		}
	</script>
</head>
<body>
	<form action="" method="post" onsubmit="return check()">
		Name: <input type="text" name="name" required="required" id="signup_name" class="form-control" value="<?php echo (isset($_POST['name']))?$_POST['name']:'';?>"onchange="checkname()">
		<?php
		if($name!="") echo $err2 ?>
		<br>
		Username:<input type="text" name="username" required="required" id="signup_username" class="form-control" value="<?php echo (isset($_POST['username']))?$_POST['username']:'';?>"onchange="checkusername()" >
		<?php 
		if($username!=""){echo $err1; 
		}?>
		<span id="aj"></span><br>
		Password: <input type="Password" name="password" required="required" id="signup_password" class="form-control" value="<?php echo (isset($_POST['password']))?$_POST['password']:'';?>"onchange="checkpsswd()" ><br>
		Confirm Password: <input type="Password" name="confirmpassword" class="form-control" value="<?php echo (isset($_POST['confirmpassword']))?$_POST['confirmpassword']:'';?>" id="cnfmpass" onchange="checkcnfmpsswd()"><?php if($cnfmpassword!="")echo $err4 ?><br>
		Phone No.: <input type="text" name="phone" required="required" id="no1" class="form-control" value="<?php echo (isset($_POST['phone']))?$_POST['phone']:'';?>"onchange="checkphn()" >
		<?php if($phone!="")echo $err5 ?><br>
		Email: <input type="text" name="email" required="required" id="email" class="form-control" value="<?php echo (isset($_POST['email']))?$_POST['email']:'';?>"onchange="checkemail()" >
		<?php if($email!="")echo $err3 ?> <br>
		Gender: <br>
		<input type="radio" name="gender" value="male" checked> Male<br>
		<input type="radio" name="gender" value="female"> Female<br>
		<button type="reset" value="reset" id="reset" class="btn btn-default">Reset</button>
		<button id="submit" type="submit" class="btn btn-default">Submit</button>
	</form>

</body>
</html>	