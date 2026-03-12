<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	echo "<script>location='../../devices.php'</script>";
	    die();
}
 
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
$lang_ch = $_GET['ch'];
if(isset($lang_ch))
{
	if($lang_ch == 'ar')
	{
	
	mysql_query("UPDATE `config` set `lang` = 'ar';"); 
 	}
	else if($lang_ch == 'en')
	{
 	mysql_query("UPDATE `config` set `lang` = 'en';"); 		
 	}
}
echo "<script>location='../../devices.php'</script>";

?>
