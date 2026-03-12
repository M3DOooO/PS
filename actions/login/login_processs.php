<?php session_start();
include('../../includes/config.php');
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
$p_spass = $_POST['p_spass'];
$s_passp = md5($p_spass);
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error()); 
$sql="SELECT * FROM config";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$lic = $row['lic2'];
 }
  if($lic == $s_passp)
 {
	  ob_start();  
	system('ipconfig /all');  
	$mycom=ob_get_contents(); 
	ob_clean();  
	$findme = "Physical";
	$pmac = strpos($mycom, $findme); 
	$mac=substr($mycom,($pmac+36),17); 
    $s = md5($mac);	
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("UPDATE `config` set `lic` = '$s';"); 
	mysql_query("UPDATE `config` set `lic2` = 'b4798535a4f054bdf2ae072746398a36';"); 
  				 echo "<script>location='../../devices.php'</script>";
 }
 else
 {
  				 echo "<script>location='../../login.php'</script>";
 die();

 }
 ?>
