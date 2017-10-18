<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>



<?php
	session_start();
   if(isset($_SESSION['current_user'])){
   	unset($_SESSION['current_user']);
   	//echo "Session unset";
   }

   $db = mysqli_connect('localhost','sahitya','babahelp','ct');
   /* if(!$db){
   		header('Location: http://localhost:7080/serverdown.html');
   		exit();
   }*/
	$myemail=$mypassword=$error=$myusername="";
   ?>

   <?php
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myid = mysqli_real_escape_string($db,$_POST['id']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $sql="select * from users where id='$myid' and pwd='$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count=mysqli_num_rows($result);
      if($count!=1){
		 $error = "Your ID or Password is invalid!!";
		 
	  } 
	  else if($count == 1) {
         //$_SESSION['
         $_SESSION['current_user'] = $row['id'];
		 header('Location: http://localhost/ct/home.php');
			exit();
		 }
	 
   }
   
?> 




<body class="blurBg-false" style="background-color:#EBEBEB">



<!-- Start Formoid form-->
<link rel="stylesheet" href="login_files/formoid1/formoid-solid-dark.css" type="text/css" />
<script type="text/javascript" src="login_files/formoid1/jquery.min.js"></script>
<form class="formoid-solid-dark" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:480px;min-width:150px" method="post"><div class="title"><h2>Login User</h2></div>
	<div class="element-input"><label class="title">ID Number<span class="required">*</span></label><div class="item-cont"><input class="large" type="number" name="id" value="<?php echo $myid?>" required="required" placeholder="Username"/><span class="icon-place"></span></div></div>
	<div class="element-password"><label class="title">Password<span class="required">*</span></label><div class="item-cont"><input class="large" type="password" name="password" value="<?php echo $mypassword?>" required="required" placeholder="Password"/><span class="icon-place"><?php echo $error?></span></div></div>
<div class="submit"><input type="submit" value="Submit"/></div></form><script type="text/javascript" src="login_files/formoid1/formoid-solid-dark.js"></script>
<!-- Stop Formoid form-->



</body>
</html>
