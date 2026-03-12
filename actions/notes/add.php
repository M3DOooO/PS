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
			   $x_note=$_POST['x_note']; 
  			   $Year = idate('Y');
 			   $Hour = idate('H');
			   $Month = $shift_month;
			   $Day = $shift_day;
			   
 		  mysql_query("INSERT INTO `notes` ( `note`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`seen`) VALUES ('$x_note','$shift_day','$shift_month','$Year','$current_shift','$casheer','$Hour','no');"); 
			
	echo "<script>location='../../devices.php'</script>";

			?>