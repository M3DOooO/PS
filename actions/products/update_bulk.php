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
             $Day = $shift_day;
			$Month = $shift_month;
			$Year = idate('Y');
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
  $Hour = idate('H');
			   //echo $choose_ing;
			   $date = date("Y-m-d h:i:s");
			   
               if($choose_name != 'no')
			   {
               $sql="SELECT * FROM stock WHERE name = '$choose_name'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat = $row['catagory'];
			   $choose_sub = $row['sub_cat'];
			   $choose_ing = $row['ing']; 
			   $choose_price = $row['price']; 
                }
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat','$choose_sub','$choose_name','$total_cost','$choose_qty','$choose_price','$choose_ing','$choose_cost','$date');"); 
		  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`,`status`) VALUES 
		  ('$choose_name','$out','$choose_qty','$choose_cost','$Day','$Month','$Year','$Hour','done');"); 
			 }
               if($choose_name2 != 'no')
			   {
			                  $sql="SELECT * FROM stock WHERE name = '$choose_name2'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat2 = $row['catagory'];
			   $choose_sub2 = $row['sub_cat'];
			   $choose_ing2=$row['ing']; 
			   $choose_price2 = $row['price']; 
               }
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat2','$choose_sub2','$choose_name2','$total_cost2','$choose_qty2','$choose_price2','$choose_ing2','$choose_cost2','$date');"); 
			   		  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`,`status`) VALUES 
		  ('$choose_name2','$out','$choose_qty2','$choose_cost2','$Day','$Month','$Year','$Hour','done');"); 
			   }
               if($choose_name3 != 'no')
			   {
			                  $sql="SELECT * FROM stock WHERE name = '$choose_name3'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat3 = $row['catagory'];
			   $choose_sub3 = $row['sub_cat'];
			   $choose_ing3=$row['ing'];  
			   $choose_price3 = $row['price']; 			   
			  }
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat3','$choose_sub3','$choose_name3','$total_cost3','$choose_qty3','$choose_price3','$choose_ing3','$choose_cost3','$date');"); 
			   		  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`,`status`) VALUES 
		  ('$choose_name3','$out','$choose_qty3','$choose_cost3','$Day','$Month','$Year','$Hour','done');"); 
			   }
               if($choose_name4 != 'no')
			   {
			                  $sql="SELECT * FROM stock WHERE name = '$choose_name4'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat4 = $row['catagory'];
			   $choose_sub4 = $row['sub_cat'];
			   $choose_ing4=$row['ing']; 
			    $choose_price4 = $row['price']; 
               }
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat4','$choose_sub4','$choose_name4','$total_cost4','$choose_qty4','$choose_price4','$choose_ing4','$choose_cost4','$date');"); 
			   		  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`,`status`) VALUES 
		  ('$choose_name4','$out','$choose_qty4','$choose_cost4','$Day','$Month','$Year','$Hour','done');"); 
			   }
               if($choose_name5 != 'no')
			   {
			                  $sql="SELECT * FROM stock WHERE name = '$choose_name5'";
               $result=mysql_query($sql);
               while($row = mysql_fetch_array($result))
               {
			   $choose_cat5 = $row['catagory'];
			   $choose_sub5 = $row['sub_cat'];
               $choose_ing5 = $row['ing']; 
			   $choose_price5 = $row['price']; 
			   }
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat5','$choose_sub5','$choose_name5','$total_cost5','$choose_qty5','$choose_price5','$choose_ing5','$choose_cost5','$date');"); 
 			   		  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`hour`,`status`) VALUES 
		  ('$choose_name5','$out','$choose_qty5','$choose_cost5','$Day','$Month','$Year','$Hour','done');"); 
			   }

			  
		  echo "<script>location='../../control_product_update_bulk.php?success=updated'</script>";

 
			  ?> 