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
			   $value1=$_POST['ex_name']; 
			   $notes=$_POST['ex_notes']; 
			   $price=$_POST['ex_price']; 
 			   $out = 'exp';
 
           
			$Year = idate('Y');
			$Hour = idate('H');
			$H = $Hour;
 
			     mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`session_id`,`hour`,`status`) VALUES ('$value1','$out','$notes','$price','$shift_day','$shift_month','$Year','$current_shift','$casheer','0','$Hour','done');"); 
			 
				 echo "<script>location='../../control_add_out.php?success=added'</script>";

			 ?> 