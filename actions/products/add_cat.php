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
              
			  mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
               mysql_select_db("$db") or die(mysql_error()); 
			   $value1=$_POST['ca_name']; 
 			   $value3=$_POST['ca_type']; 
               $_SESSION['ca_name']="$value1";
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`new`) VALUES ('$value3','$value1','new');"); 
	  echo "<script>location='../../control_cat_img.php?success=added&type=$value3&cat=$value1'</script>";

			  ?>
