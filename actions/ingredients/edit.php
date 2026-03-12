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
?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php  
 
               
			 	$var1 = $_POST['quan'];
		$var2 = $_POST['new_name'];
		$var3 = $_POST['new_price'];
		$var4 = $_POST['iddd'];
		$var5 = $_POST['new_ps_name'];
		$var6 = $_POST['t_type'];
		$var7 = $_POST['new_multi_price'];
		$var9 = $_POST['new_multi6_price'];
		$var10 = $_POST['new_multi7_price'];
		$var11 = $_POST['idddd'];
		$var12 = $_POST['old'];
		$new_unit = $_POST['new_unit'];
		
		if(isset($var1)||isset($var2)||isset($var3))
		{
		$var13 = $var1 + $var12;
		//$var14 = $var12 - $var1; 
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
   mysql_select_db("$db") or die(mysql_error()); 

 mysql_query("UPDATE `ingredients` set `we_have` = '$var13'  WHERE `id` = '$var4';");  
 mysql_query("UPDATE `ingredients` set `stock` = '$var13'  WHERE `id` = '$var4';");  
 //mysql_query("UPDATE `stock` set `sold` = '$var1'  WHERE `id` = '$var4';");  
 mysql_query("UPDATE `ingredients` set `name` = '$var2'  WHERE `id` = '$var4';");  
 mysql_query("UPDATE `ingredients` set `price` = '$var3'  WHERE `id` = '$var4';");   
 mysql_query("UPDATE `ingredients` set `unit` = '$new_unit'  WHERE `id` = '$var4';");   

		}

	  echo "<script>location='../../control_ingredients_view.php?id=$var4&success=edited'</script>";

	  ?>