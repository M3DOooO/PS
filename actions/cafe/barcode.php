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

$id = $_GET['id'];  
 $ps = $_GET['ps_id']; 
 $sess = $_GET['session']; 
 $bar=$_POST['Search_bar']; 
 if(strlen($bar) > 0 )
 {
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `stock` Where barcode = '$bar'");
			 while($row = mysql_fetch_array($result))
  {
      $var1=$row['name'];
      $var3=$row['catagory'];
      $var4=$row['sub_cat'];
      $var5=$row['price'];
  }
  

$var2=1;

 $var6=$ps ;
 $var7=$sess;

mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `stock` Where name = '$var1'");
			 while($row = mysql_fetch_array($result))
  {
  $we_have = $row['sold'];
  }
  $new = $we_have + $var2;





 			$total = ($var2 * $var5);
            $Day = idate('d');
			$Month = idate('m');
			$Year = idate('Y');
			$Hour = idate('H');
 
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 

  if($var1 != '')
  {
   mysql_query("INSERT INTO `ps_orders` (`catagory`, `sub_cat`,`name`, `price`, `num` , `ps_id` ,`session_id`,`day`,`month`,`year`,`shift`,`casheer` ) VALUES ('$var3', '$var4', '$var1','$total','$var2','$var6','$var7','$Day','$Month','$Year','$current_shift','$casheer');"); 
     mysql_query("UPDATE `stock` set `sold` = '$new'  WHERE `name` = '$var1';"); 
 }}
 

 header('Location: ../../devices_cafe.php?id='.$ps);
 ?>