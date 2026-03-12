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

$id = $_GET['id']; 
 $casheer = $_SESSION['ps_user'];
 include('../../includes/config.php');
    $Hour = idate('H');
      $add_item  = $_POST['add_item'];     
      $session  = $_POST['s'];     
      $ps_id    = $_POST['ps_id']; 
	 $the_time = date('H:i:s');
	 for ($i = 0; $i < sizeof($_POST['item']); $i++ )
	 {
		$item_id  = $_POST['item'][$i]['id'];
		$qty      = $_POST['item'][$i]['num'];
		$itemName = $_POST['item'][$i]['name'];
		$itemNamee = $_POST['item'][$i]['namee'];
		 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
     mysql_select_db("$db") or die(mysql_error()); 
    $result = mysql_query("SELECT MIN(date) FROM `stock` Where name = '$itemNamee' AND (stock - sold) >= $qty");
 
			 while($row = mysql_fetch_array($result))
                    {
					$mindate = $row['MIN(date)'];
 					}
					$has_ing    = ($_POST['item'][$i]['has_ing'] =='yes')? "" : "AND date = '$mindate'"; 
// echo "SELECT * FROM `stock` Where id = '$item_id'". $has_ing;	
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
if (isset ($itemName) )
{
	$qty = 1;
$result = mysql_query("SELECT * FROM `stock` Where name = '$itemName' AND date = '$mindate'");	
}
else
{
$result = mysql_query("SELECT * FROM `stock` Where name = '$itemNamee'". $has_ing);	

 
}
while($row = mysql_fetch_array($result))
  {

     $catagory = $row['catagory'];
     $sub_cat = $row['sub_cat']; 
     $name = $row['name'];
 	 $price = $row['price'];
	 $we_have = $row['sold'];
	 $itcosth = $row['cost'];
  } 
    $itcost = $itcosth * $qty;
    $new = $we_have + $qty;
 	$total = ($qty * $price);
  	$Year = idate('Y');
 
    mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
    mysql_select_db("$db") or die(mysql_error()); 
	if ($qty > 0)
	{
		$result = mysql_query("SELECT *,SUM(discount),SUM(discount2) FROM `reports2` Where session_id = '$session'");
while($row = mysql_fetch_array($result))
{
	$gdis = $row['SUM(discount)'];
	$gdis2 = $row['SUM(discount2)'];
	$gdis_r = $row['dis_reason'];
}

//Removing Old Discounts
mysql_query("UPDATE `reports2` set `discount` = '0'   WHERE `session_id` = '$session';");   
mysql_query("UPDATE `reports2` set `discount2` = '0'  WHERE `session_id` = '$session';");   

 
    mysql_query("INSERT INTO `orders` (`catagory`, `sub_cat`,`name`, `price`, `num`,`day`,`month`,`year`,`session_id`,`ornum` ) VALUES ('$catagory', '$sub_cat', '$name','$total','$qty','$shift_day','$shift_month','$Year','$session','$add_item');"); 
    mysql_query("UPDATE `stock` set `sold` = '$new'  WHERE `name` = '$name' AND date = '$mindate';"); 
    
	//saving it into reports
mysql_query("INSERT INTO `reports2` (`catagory`, `sub_cat`,`name`, `price`, `num`,`day`,`month`,`year`,`notes`,`shift`,`casheer` ,`session_id`,`ornum`,`hour`,`discount`,`discount2`,`dis_reason`,`the_time`) VALUES ('$catagory', '$sub_cat', '$name','$total','$qty','$shift_day','$shift_month','$Year','order','$current_shift','$casheer','$session','$add_item','$Hour','$gdis','$gdis2','$gdis_r','$the_time');"); 

 mysql_connect("$host", "$user", "$pass")or die("cannot connect");
    mysql_select_db("$db")or die("cannot select DB");
    $result = mysql_query("SELECT * FROM `recipe` Where item = '$name'");
			 while($row = mysql_fetch_array($result))
                    {
                           $s_ing = $row['ing_name'];
						  $xxx = $row['ing_qty'] * $qty;
						 
            $resultg = mysql_query("SELECT MIN(date) FROM `ingredients` Where name = '$s_ing' AND (stock - sold) >= $xxx");
			 while($rowg = mysql_fetch_array($resultg))
                    {
					$mindatei = $rowg['MIN(date)'];
 					}
			  $resultt = mysql_query("SELECT * FROM `ingredients` Where name = '$s_ing' AND date = '$mindatei'");
			  while($roww = mysql_fetch_array($resultt))
                    {
						$o_out = $roww['sold']; 
						$o_in = $roww['stock']; 
						$o_total = $o_in - $o_out;
					}
				        $s_qty = ($row['ing_qty'] * $qty)+$o_out;

				  mysql_query("UPDATE `ingredients` set `sold` = '$s_qty'  WHERE `name` = '$s_ing' AND date = '$mindatei';"); 
				        $s_avl = $row['ing_avl'];
						$s_last = $s_avl - ($row['ing_qty'] * $qty);
				  mysql_query("UPDATE `recipe` set `ing_avl` = '$s_last'  WHERE `ing_name` = '$s_ing';"); 
                    }
	
	
	      $result = mysql_query("SELECT * FROM `stock` WHERE id = '$item_id'"); 
      while($row = mysql_fetch_array($result))
      {
	  $update_name= $row['name'];
	  }
	  $result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `ingredients` WHERE name = '$update_name'"); 
      while($row = mysql_fetch_array($result))
      {
	        $uping = $row['ing_name'];
	  		$ing_wehavee = $row['SUM(stock)']-$row['SUM(sold)'];
			  mysql_query("UPDATE `recipe` set `ing_avl` = '$ing_wehavee'  WHERE `ing_name` = '$uping';"); 

	  }
	
	
	}
//setting new qty to stock
//mysql_query("UPDATE `stock` set `we_have` = '$new'  WHERE `name` = '$value1';"); 
// mysql_query("UPDATE `stock` set `sold` = '$out2'  WHERE `name` = '$value1';");   
	// header("location:devices_ps.php?id=$ps_id");
	}
echo "<script>location='../../devices_takeaway.php?ta=$add_item'</script>";
	
     
 ?>