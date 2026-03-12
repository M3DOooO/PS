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
               
			   $var1= $_POST['re_name']; 
			   $var2= $_POST['re_mobile']; 
			   $var3= $_POST['re_type']; 
			   $var4= $_POST['re_money']; 
			   $var5= $_POST['re_date']; 
			   $var6= $_POST['re_time']; 
			   $var7= $_POST['re_time2']; 
			   $var8= $var6 . ":" .$var7; 
 $sess = rand();
			     mysql_query("INSERT INTO `reservation` ( `name`,`mobile`,`type`,`money`,`session`,`date`,`time`) VALUES ('$var1','$var2','$var3','$var4','$sess','$var5','$var8');"); 

				 echo "<script>location='../../control_reservations_add.php?success=added'</script>";
				 
			  ?> 