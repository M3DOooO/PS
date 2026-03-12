<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	echo "<script>location='../../devices.php'</script>";
	    die();
}
 
include('../../includes/config.php');
if($lang == 'en'){include('../../languages/en.php');}else if($lang == 'ar'){include('../../languages/ar.php');}
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
 ?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php  
$now = $_SESSION['ps_user'];
$sql="SELECT * FROM users WHERE Username = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
}
if($usern != 1 ){echo "<script>location='../../devices.php'</script>";}
?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="img/closing.gif">
</center>
</body>
</html>
<?php 
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
               
			   $reg_name=$_POST['ps_reg_user']; 
			   $reg_pass=$_POST['ps_reg_pass']; 
			   $reg_repass=$_POST['ps_reg_repass']; 
			   if($reg_pass !== $reg_repass)
			   {
 echo "<script>location='../../add_user.php?error=password'</script>";
	    die();						
			   }
 mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `users` WHERE `Username` = '$reg_name'");
while($row = mysql_fetch_array($result))
{
	$check_user = $row['Username'];
}
			   if(isset($check_user))
			   {
 				echo "<script>location='../../users_add.php?error=already'</script>";

	    die();	   
			   }
			   
			   $enc = md5($reg_pass);
			   $reg_mail=$_POST['ps_reg_mail']; 
			   $reg_type=$_POST['ps_reg_type']; 
			   $reg_shift=$_POST['ps_reg_shift']; 
  
			     mysql_query("INSERT INTO `users` (`Username`,`Password`,`Email`,`type`,`shift`) VALUES ('$reg_name','$enc','$reg_mail','$reg_type','$reg_shift');"); 
		 
		 echo "<script>location='../../control_users_add.php?success=added'</script>";

			  ?> 