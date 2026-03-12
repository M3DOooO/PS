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
			$Year = idate('Y'); 
			 $Day = $shift_day;
			$Month = $shift_month;
			
						   $out = 'exp';
$now = $_SESSION['ps_user'];

			   $choose_cat=$_POST['choose_cat']; 
			   $choose_cat2=$_POST['choose_cat2']; 
			   $choose_cat3=$_POST['choose_cat3']; 
			   $choose_cat4=$_POST['choose_cat4']; 
			   $choose_cat5=$_POST['choose_cat5']; 
			   
			   $choose_sub=$_POST['choose_sub']; 
			   $choose_sub2=$_POST['choose_sub2']; 
			   $choose_sub3=$_POST['choose_sub3']; 
			   $choose_sub4=$_POST['choose_sub4']; 
			   $choose_sub5=$_POST['choose_sub5']; 
			   
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
			   
			   $choose_price=$_POST['choose_price']; 
			   $choose_price2=$_POST['choose_price2']; 
			   $choose_price3=$_POST['choose_price3']; 
			   $choose_price4=$_POST['choose_price4']; 
			   $choose_price5=$_POST['choose_price5']; 
			   
			   $choose_ing='no'; 
			   $choose_ing2='no';
			   $choose_ing3='no';
			   $choose_ing4='no';
			   $choose_ing5='no'; 
			   
			   //echo $choose_ing;
			   $date = date("Y-m-d h:i:s");
			    $Hour = idate('H');
               if(!EMPTY($choose_name))
			   {
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat','$choose_sub','$choose_name','$total_cost','$choose_qty','$choose_price','$choose_ing','$choose_cost','$date');"); 
	           mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`status`) VALUES 
		  ('$choose_name','$out','$choose_qty','$choose_cost','$Day','$Month','$Year','$current_shift','$now','$Hour','done');"); }
               if(!EMPTY($choose_name2))
			   {
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat2','$choose_sub2','$choose_name2','$total_cost2','$choose_qty2','$choose_price2','$choose_ing2','$choose_cost2','$date','$Hour');"); 
			   			   		  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`status`) VALUES 
		  ('$choose_name2','$out','$choose_qty2','$choose_cost2','$Day','$Month','$Year','$current_shift','$now','$Hour','done');"); 
			   }
               if(!EMPTY($choose_name3))
			   {
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat3','$choose_sub3','$choose_name3','$total_cost3','$choose_qty3','$choose_price3','$choose_ing3','$choose_cost3','$date');"); 
			  			   		  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`status`) VALUES 
		  ('$choose_name3','$out','$choose_qty3','$choose_cost3','$Day','$Month','$Year','$current_shift','$now','$Hour','done');"); 
			  }
               if(!EMPTY($choose_name4))
			   {
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat4','$choose_sub4','$choose_name4','$total_cost4','$choose_qty4','$choose_price4','$choose_ing4','$choose_cost4','$date');"); 
			   			   		  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`status`) VALUES 
		  ('$choose_name4','$out','$choose_qty4','$choose_cost4','$Day','$Month','$Year','$current_shift','$now','$Hour','done');"); 
			   }
               if(!EMPTY($choose_name5))
			   {
			   mysql_query("INSERT INTO `stock` ( `catagory`,`sub_cat`,`name`,`cost`,`stock`,`price`,`ing`,`total_cost`,`date`) VALUES
			   ('$choose_cat5','$choose_sub5','$choose_name5','$total_cost5','$choose_qty5','$choose_price5','$choose_ing5','$choose_cost5','$date');"); 
 			    			   		  mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`status`) VALUES 
		  ('$choose_name5','$out','$choose_qty5','$choose_cost5','$Day','$Month','$Year','$current_shift','$now','$Hour','done');"); 
			   }

			  
			  
			 header('Location: ../../control_product_add_bulk.php?success=added');

			  ?> 