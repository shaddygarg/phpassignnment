<?php include_once("signup_validation.php")	?>
<!DOCTYPE html>
<html>
<head>
	<title>signup</title>
	<script type="text/javascript">
		/*var a = 0;
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
		}*/
	</script>
</head>
<body>
	<form action="" method="post" onsubmit="return check()">
		Name: <input type="text" name="name" required="required" id="signup_name" value="<?php echo (isset($_POST['name']))?$_POST['name']:'';?>"onchange="checkname()">
		<?php
		if($name!="") echo $err2 ?>
		<br>
		Username:<input type="text" name="username" required="required" id="signup_username" value="<?php echo (isset($_POST['username']))?$_POST['username']:'';?>"onchange="checkusername()" >
		<?php 
		if($username!="")echo $err1 ?>
		<br>
		Password: <input type="Password" name="password" required="required" id="signup_password" value="<?php echo (isset($_POST['password']))?$_POST['password']:'';?>"onchange="checkpsswd()" ><br>
		Confirm Password: <input type="Password" name="confirmpassword" value="<?php echo (isset($_POST['confirmpassword']))?$_POST['confirmpassword']:'';?>" id="cnfmpass" onchange="checkcnfmpsswd()"><?php if($cnfmpassword!="")echo $err4 ?><br>
		Phone No.: <input type="text" name="phone" required="required" id="no1" value="<?php echo (isset($_POST['phone']))?$_POST['phone']:'';?>"onchange="checkphn()" >
		<?php if($phone!="")echo $err5 ?><br>
		Email: <input type="text" name="email" required="required" id="email" value="<?php echo (isset($_POST['email']))?$_POST['email']:'';?>"onchange="checkemail()" >
		<?php if($email!="")echo $err3 ?> <br>
		Gender: <br>
		<input type="radio" name="gender" value="male" checked> Male<br>
		<input type="radio" name="gender" value="female"> Female<br>
		<button type="reset" value="reset" id="reset" class="buttons">Reset</button>
		<button id="submit" type="submit" class="buttons">Submit</button>
	</form>
</body>
</html>	
