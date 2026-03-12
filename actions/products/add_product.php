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
$now = $_SESSION['ps_user'];
$sql="SELECT * FROM users WHERE Username = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
}
if($usern != 1 ){echo "<script>location='../../devices.php'</script>";}
               
  $Hour = idate('H');
			$Year = idate('Y');
			   $value1=$_POST['sub_name']; 
			   $in=$_POST['sub_num']; 
			   $price=$_POST['sub_price']; 
			   $ing=$_POST['sub_ing']; 
			   $cost=$_POST['sub_cost']; 
               $type=$_POST['thetype'];			
               $cat=$_POST['cat'];			
 if($type == 'choc')
 {
 $cat = 'choc';
 }
 						   $out = 'exp';
						   			   $date = date("Y-m-d h:i:s");
									   $now = $_SESSION['ps_user'];

if($ing == 'yes')
{

			     mysql_query("INSERT INTO `stock` ( `name`,`catagory`,`sub_cat`,`stock`,`price`,`ing`,`cost`,`total_cost`,`date`) VALUES ('$value1','$type','$cat','$in' , '$price','$ing','$total_cost','$cost','$date');"); 
	           mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`status`) VALUES 
		  ('$value1','$out','$in','$total_cost','$Day','$Month','$Year','$current_shift','$now','$Hour','done');"); 			 
}
else if($ing == 'no')
{
 $total_cost = $cost / $in;

  mysql_query("INSERT INTO `stock` ( `name`,`catagory`,`sub_cat`,`stock`,`price`,`ing`,`cost`,`total_cost`,`date`) VALUES 
  ('$value1','$type','$cat','$in' , '$price','$ing','$total_cost','$cost','$date');"); 
	           mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`status`) VALUES 
		  ('$value1','$out','$in','$cost','$Day','$Month','$Year','$current_shift','$now','$Hour','done');"); 		
		 
}
				 echo "<script>location='../../control_product_add.php?success=added&type=$type&cat=$cat'</script>";


		  ?> 