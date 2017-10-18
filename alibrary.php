<!--Bootstrap sidebar-->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Library</title>

  <style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
.title{
	font-size:1.6em;
}
</style>

<!--End of Javascript-->
</head>


        <!-- Sidebar -->
       
<head>
	<meta charset="utf-8" />
	<title>Library</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!--End of bootstrap sidebar-->

<?php


$id=0;
$bid=0;
$bname="";
$fine=0;
$error=""; 

$valid=true;
//establishing MySql connection.

		$link=mysqli_connect('localhost','sahitya','babahelp','ct');
		session_start();
		if(!isset($_SESSION['current_user']))
		{
				header('Location: http://localhost/ct/spammer.html');
				exit();
		}
		else
		{
			if($link)
			{	
				//echo $_SESSION['current_user'];	
				$id=$_SESSION['current_user'];
				
			}	
			else
			{ 	header("Location: http://localhost/ct/serverdown.html");
				exit();
			}
		}
		
?>
<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{

	$bname=mysqli_real_escape_string($link,$_POST["bname"]);
	
	
	$id=$_POST["sid"];
	$bid=$_POST["bid"];
	$fine=$_POST["fine"];
	
	$sql="insert into library(id,bid,bname,finepaid) values($id,$bid,'$bname',$fine)";
	if($valid==true){
	$result=mysqli_query($link,$sql);
		if($result==true){
			$error= "Thanks for your entry!";
			//$id=0;
			$bid=0;
			$bname="";

			$sql="update user_personal set balance=balance-$fine where id=$id";
			$result=mysqli_query($link,$sql);
			$fine=0;
			$id=0;
			//$error=""; 
		}
		
	
		else		
			$error="Unable to make entry";
	}
}	

?>
	
<body class="blurBg-false" style="background-color:#EBEBEB">

        <ul>
<li><a href="http://localhost/ct/ahome.php">Home</a></li>
<li><a href="http://localhost/ct/alibrary.php">Library</a></li>
<li><a href="http://localhost/ct/acafe.php">Cafeteria</a></li>
<li><a href="http://localhost/ct/astores.php">Stores</a></li>
<li><a href="http://localhost/ct/index.html">Logout</a></li>

</ul>
<br><br>
<!-- Start Formoid form-->
<link rel="stylesheet" href="user-personal_files/formoid1/formoid-solid-orange.css" type="text/css" />
<script type="text/javascript" src="user-personal_files/formoid1/jquery.min.js"></script>
<form class="formoid-solid-orange" style="background-color:#ffffff;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:480px;min-width:150px" method="post"><div class="title"><h2>Library Entry</h2></div>
<?php echo $error ?>	
<div class="element-number"><label class="title">Enter Student ID</label><div class="item-cont"><input id="no_chldren" class="large" type="number" min="0" max="100" name="sid" placeholder="ID" value="<?php echo $sid?>" /><span class="icon-place"></span></div></div>
<div class="element-number"><label class="title">Enter Book ID</label><div class="item-cont"><input id="no_chldren" class="large" type="number" min="0" max="100" name="bid" placeholder="Book ID" value="<?php echo $bid?>" /><span class="icon-place"></span></div></div>

<div class="element-input"><label class="title">Book Name</label><div class="item-cont"><input class="large" type="text" name="bname" placeholder="Book Name" value="<?php echo $bname?>" /><span class="icon-place"></span>
<div class="element-number"><label class="title">Enter Fine if payable</label><div class="item-cont"><input id="no_chldren" class="large" type="number" min="0" max="100" name="fine" placeholder="Fine Amount" value="<?php echo $fine?>" /><span class="icon-place"></span></div></div>

<div class="submit"><input type="submit" value="Update"/></div></form><script type="text/javascript" src="user-personal_files/formoid1/formoid-solid-orange.js"></script>
</div>
</div>
</form>
<!-- Stop Formoid form-->
</body>

</html>
