<?php include('connection.php'); ?>
<html>
<head>
<title>Complete Profile </title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
Branch: <input type="text" name="branch" required="required" class="textbox1" onchange="checktext()" ><br>
Interests: <input type="text" name="interests" required="required" class="textbox1" onchange="checktext()" ><br>
Update Profile Picture: <input type="file" name="profilepic" required="required" class="image" onchange="checkimg()" ><br>
Update Cover Picture: <input type="file" name="coverpic" required="required" class="image" onchange="checkimg()" ><br>
<input type="submit" name="submit">
<?php
$branch=$_POST["branch"];
$interests=$_POST["interests"];
$profilepic="testing";
$coverpic='testing';
$user='fromsessionvariables';

?>
</form>
</body>
</html>
