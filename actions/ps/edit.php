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
if($usern != 1 ){echo "<script>location='../../devices.php'</script>"; die();}
?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php 
 
               
		$var5 = $_POST['new_ps_name'];
		$var55 = $_POST['new_ps_type'];
		$var6 = $_POST['new_single_price'];
		$var7 = $_POST['new_multi_price'];
		$var9 = $_POST['new_multi6_price'];
		$var10 = $_POST['new_multi7_price'];
		$var11 = $_POST['idddd'];
		$ip = $_POST['ip'];
		$port = $_POST['port'];
		$openw = $_POST['open'];
		$closew = $_POST['close'];
		$al3aboo = $_POST['al3ab'];
		$ps_order = $_POST['ps_order'];

 		if(isset($var5)||isset($var6)||isset($var7)||isset($var9)||isset($var10))
		{
   

 mysql_query("UPDATE `devices` set `Device Name` = '$var5'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `ps_version` = '$var55'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `single` = '$var6'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `multi` = '$var7'  WHERE `ID` = '$var11';");  
  mysql_query("UPDATE `devices` set `multi6` = '$var9'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `multi7` = '$var10'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `orderby` = '$ps_order'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `Paused` = '$al3aboo'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `ip` = '$ip'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `port` = '$port'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `openword` = '$openw'  WHERE `ID` = '$var11';");  
 mysql_query("UPDATE `devices` set `closeword` = '$closew'  WHERE `ID` = '$var11';");  
		}
				 	 
					 echo "<script>location='../../control_ps_edit.php?id=$var11&success=edited'</script>";

?>