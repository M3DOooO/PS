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
if($usern != 1 ){echo "<script>location='../../devices.php'</script>";}
?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php 
$id = $_GET['id']; 
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
               								$id = $_GET['id'];

			   $value1=$_POST['ps_name']; 
  mysql_query("DELETE FROM devices WHERE ID = $id");  
echo "<script>location='../../control_ps.php?success=deleted'</script>";
 			  ?> 