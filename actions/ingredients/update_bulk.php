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
<?php    $Day = $shift_day;
			$Month = $shift_month;
			$Year = idate('Y');
			 $Hour = idate('H');
			   $choose_name=$_POST['choose_name']; 
			   $choose_name2=$_POST['choose_name2']; 
			   $choose_name3=$_POST['choose_name3']; 
			   $choose_name4=$_POST['choose_name4']; 
			   $choose_name5=$_POST['choose_name5']; 
			   
			   $choose_qty=$_POST['choose_qty']; 
			   $choose_qty2=$_POST['choose_qty2']; 
			   $choose_qty3=$_POST['choose_qty3']; 
			   $choose_qty4=$_POST['choose_qty4']; 
			   $choose_qty5=$_POST['choose_qty5']; 
			   
			   $choose_cost=$_POST['choose_cost']; 
			   $choose_cost2=$_POST['choose_cost2']; 
			   $choose_cost3=$_POST['choose_cost3']; 
			   $choose_cost4=$_POST['choose_cost4']; 
			   $choose_cost5=$_POST['choose_cost5']; 
			   
			   $total_cost=$_POST['total_cost']; 
			   $total_cost2=$_POST['total_cost2']; 
			   $total_cost3=$_POST['total_cost3']; 
			   $total_cost4=$_POST['total_cost4']; 
			   $total_cost5=$_POST['total_cost5']; 
			   
			   // $choose_price=$_POST['choose_price']; 
			   // $choose_price2=$_POST['choose_price2']; 
			   // $choose_price3=$_POST['choose_price3']; 
			   // $choose_price4=$_POST['choose_price4']; 
			   // $choose_price5=$_POST['choose_price5']; 
			   
			   // $choose_ing=$_POST['choose_ing']; 
			   // $choose_ing2=$_POST['choose_ing2']; 
			   // $choose_ing3=$_POST['choose_ing3']; 
			   // $choose_ing4=$_POST['choose_ing4']; 
			   // $choose_ing5=$_POST['choose_ing5']; 
			   $out = 'exp';
 
			   //echo $choose_ing;
			   $date = date("Y-m-d h:i:s");
			   
               if($choose_name != 'no')
			   {
               $sql="SELECT * FROM ingredients WHERE name = '$choose_name'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat = $row['type'];
			   $choose_unit = $row['unit'];
 			   $choose_price = $row['price']; 
                }
			   mysql_query("INSERT INTO `ingredients` ( `type`,`unit`,`name`,`price`,`stock`,`date`) VALUES
			   ('$choose_cat','$choose_unit','$choose_name','$choose_price','$choose_qty','$date');"); 
	  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`) VALUES
	  ('$choose_name','$out','$choose_qty','$choose_cost','$Day','$Month','$Year','$Hour');");
			 }
			  mysql_query("UPDATE `recipe` set `ing_avl` = `ing_avl` + $choose_qty   WHERE `ing_name` = '$choose_name';"); 
               if($choose_name2 != 'no')
			   {
			                  $sql="SELECT * FROM stock WHERE name = '$choose_name2'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat2 = $row['type'];
			   $choose_unit2 = $row['unit'];
 			   $choose_price2 = $row['price']; 
               }
			   mysql_query("INSERT INTO `ingredients` ( `type`,`unit`,`name`,`price`,`stock`,`date`) VALUES
			   ('$choose_cat2','$choose_unit2','$choose_name2','$choose_price2','$choose_qty2','$date');"); 
	  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`) VALUES
	  ('$choose_name2','$out','$choose_qty2','$choose_cost2','$Day','$Month','$Year','$Hour');");
			   }
               if($choose_name3 != 'no')
			   {
			                  $sql="SELECT * FROM stock WHERE name = '$choose_name3'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat3 = $row['type'];
			   $choose_unit3 = $row['unit'];
 			   $choose_price3 = $row['price']; 		   
			  }
			   mysql_query("INSERT INTO `ingredients` ( `type`,`unit`,`name`,`price`,`stock`,`date`) VALUES
			   ('$choose_cat3','$choose_unit3','$choose_name3','$choose_price3','$choose_qty3','$date');"); 
	  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`) VALUES
	  ('$choose_name3','$out','$choose_qty3','$choose_cost3','$Day','$Month','$Year','$Hour');"); 
			   }
               if($choose_name4 != 'no')
			   {
			                  $sql="SELECT * FROM stock WHERE name = '$choose_name4'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat4 = $row['type'];
			   $choose_unit4 = $row['unit'];
 			   $choose_price4 = $row['price']; 
               }
			   mysql_query("INSERT INTO `ingredients` ( `type`,`unit`,`name`,`price`,`stock`,`date`) VALUES
			   ('$choose_cat4','$choose_unit4','$choose_name4','$choose_price4','$choose_qty4','$date');"); 
	  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`) VALUES
	  ('$choose_name4','$out','$choose_qty4','$choose_cost4','$Day','$Month','$Year','$Hour');"); 
			   }
               if($choose_name5 != 'no')
			   {
			                  $sql="SELECT * FROM stock WHERE name = '$choose_name5'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat5 = $row['type'];
			   $choose_unit5 = $row['unit'];
 			   $choose_price5 = $row['price']; 
			   }
			   mysql_query("INSERT INTO `ingredients` ( `type`,`unit`,`name`,`price`,`stock`,`date`) VALUES
			   ('$choose_cat5','$choose_unit5','$choose_name5','$choose_price5','$choose_qty5','$date');"); 
	  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`) VALUES
	  ('$choose_name5','$out','$choose_qty5','$choose_cost5','$Day','$Month','$Year','$Hour');");
			   }

			  
			  
		  echo "<script>location='../../control_ingredients_update_bulk.php?success=updated'</script>";

			  ?> 