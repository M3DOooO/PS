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
$now = $_SESSION['ps_user'];
 
     
			$Year = idate('Y'); 
			$date = date("Y-m-d h:i:s");
            $Hour = idate('H');
               
			   
			   $out = 'exp';
			   $value1=$_POST['ing_name']; 
			   $value2=$_POST['ing_qty']; 
			   $value3=$_POST['ing_price']; 
			   $value4=$_POST['ing_unit']; 
			   $value5=$_POST['total_paid']; 
 	  mysql_query("INSERT INTO `ingredients` ( `name`,`stock`,`price`,`unit`,`date`) VALUES ('$value1','$value2','$value3','$value4','$date');"); 
	  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`status`) VALUES ('$value1','$out','$value2','$value5','$Day','$Month','$Year','$current_shift','$now','$Hour','done');");			 

	  echo "<script>location='../../control_ingredients_add.php?success=added'</script>";

	  ?>