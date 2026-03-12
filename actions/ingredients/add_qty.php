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
$id = $_GET['id'];
 // To connect to the database
 
$result = mysql_query("SELECT * FROM `ingredients` Where id = '$id'");
			 while($row = mysql_fetch_array($result))
  {
	  $ppname= $row['name'];
	  $old_stock = $row['stock'];
  }
			  
$Year = idate('Y');
$now = $_SESSION['ps_user'];
$get_old_stock = $_POST['old_stock'];
$add_new_quan = $_POST['add_new_quan'];
$add_new_cost = $_POST['add_new_cost'];
if($add_new_quan > 0){
$total_new_stock = $get_old_stock + $add_new_quan;
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
   mysql_select_db("$db") or die(mysql_error()); 
 mysql_query("UPDATE `ingredients` set `stock` = '$total_new_stock'  WHERE `id` = '$id';");  



 mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`) VALUES 
		  ('$ppname','exp','$add_new_quan','$add_new_cost','$shift_day','$shift_month','$Year','$current_shift','$now');"); 
}

	  echo "<script>location='../../control_ingredients_view.php?id=$id&success=edited'</script>";

		  ?>
