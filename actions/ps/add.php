<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	echo "<script>location='../../devices.php'</script>";
	    die();
}
 
include('../../includes/config.php');
if($lang == 'en'){include('../../languages/en.php');}else if($lang == 'ar'){include('../../languages/ar.php');}
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$now = $_SESSION['ps_user'];
$sql="SELECT * FROM users WHERE Username = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
}
if($usern != 1 ){echo "<script>location='../../devices.php'</script>";die();}
?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php  
               
			$value1=$_POST['new_ps_name']; 
			$value55=$_POST['new_ps_type']; 
			$single=$_POST['new_single_price']; 
			$mul=$_POST['new_multi_price']; 
			$mul6=$_POST['new_multi6_price']; 
			$mul7=$_POST['new_multi7_price']; 
			$al3aboo = $_POST['al3ab'];


			     mysql_query("INSERT INTO `devices` (`Device Name`,`Device Status`,`single`,`multi`,`multi5`,`multi6`,`multi7`,`ps_version`,`Paused`) VALUES ('$value1','Off','$single','$mul','0','$mul6','$mul7','$value55','$al3aboo');"); 
				 	 
					 echo "<script>location='../../control_ps_add.php?success=added'</script>";

?>