<?php session_start();
 
include('../../includes/config.php');
  ?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php   
$u = $_GET['u'];
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
mysql_query("INSERT INTO `login` (`user`,`type`) VALUES ('$u','logout');"); 

session_unset(); 
					echo "<script>location='../../login.php'</script>";
 ?> 

