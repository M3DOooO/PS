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
               
			   $id = $_POST['id'];
			   $var1= $_POST['re_name']; 
			   $var2= $_POST['re_mobile']; 
			   $var3= $_POST['re_type']; 
			   $var4= $_POST['re_money']; 
			   $var5= $_POST['re_date']; 
			   $var6= $_POST['re_time']; 
                 mysql_query("UPDATE `reservation` set `name` = '$var1' WHERE id = $id;");  
                 mysql_query("UPDATE `reservation` set `mobile` = '$var2' WHERE id = $id;");  
                 mysql_query("UPDATE `reservation` set `type` = '$var3' WHERE id = $id;");  
                 mysql_query("UPDATE `reservation` set `date` = '$var5' WHERE id = $id;");  
                 mysql_query("UPDATE `reservation` set `time` = '$var6' WHERE id = $id;");  
                 mysql_query("UPDATE `reservation` set `money` = '$var4' WHERE id = $id;");  

				 
				 echo "<script>location='../../control_reservations.php?success=edited'</script>";
				 die();

 
 
			  ?> 