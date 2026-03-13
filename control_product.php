<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
 
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$now = $_SESSION['ps_user'];
$sql="SELECT * FROM users WHERE Username = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
}
 $id=$_GET['id'];			
			//  session_register("id");
              $_SESSION['id']="$id";
		$var1 = $_POST['quan'];
		$var2 = $_POST['new_name'];
		$var3 = $_POST['new_price'];
		if(isset($var1)||isset($var2)||isset($var3))
		{
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
   mysql_select_db("$db") or die(mysql_error()); 

 mysql_query("UPDATE `stock` set `we_have` = '$var1'  WHERE `id` = '$id';");  
 mysql_query("UPDATE `stock` set `name` = '$var2'  WHERE `id` = '$id';");  
 mysql_query("UPDATE `stock` set `price` = '$var3'  WHERE `id` = '$id';");   

		}
		$re = $_GET['re'];
		$rname = $_POST['r_name'];
		$rqty = $_POST['r_qty'];
	  mysql_connect("$host", "$user", "$pass")or die("cannot connect");
      mysql_select_db("$db")or die("cannot select DB");
      $result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `ingredients` WHERE name = '$rname'"); 
      while($row = mysql_fetch_array($result))
      {
		$ing_price = $row['price'];
		$ing_wehave = $row['SUM(stock)'] - $row['SUM(sold)'];
		// echo $ing_wehave;
	  }
 		$rcost = $rqty * $ing_price;
 		if(isset($re))
		{
	   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
       mysql_select_db("$db") or die(mysql_error()); 
   	   mysql_query("INSERT INTO `recipe` ( `item`,`ing_name`,`ing_qty`,`cost`,`ing_avl`) VALUES ('$re','$rname','$rqty','$rcost','$ing_wehave');"); 
	   }
	  mysql_connect("$host", "$user", "$pass")or die("cannot connect");
      mysql_select_db("$db")or die("cannot select DB");
      $result = mysql_query("SELECT * FROM `stock` WHERE id = '$id'"); 
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
	  
	  
		
		
 $delete_ing = $_GET['delete_ing'];
 	 if(isset($delete_ing))
	 {
	 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
     mysql_select_db("$db") or die(mysql_error()); 
     mysql_query("DELETE FROM recipe WHERE id = $delete_ing ");  
	 }
	 		$var1 = $_POST['quan'];
		$var2 = $_POST['new_name'];
		$var3 = $_POST['new_price'];
		$var4 = $_POST['iddd'];
		$var5 = $_POST['new_ps_name'];
		$var6 = $_POST['t_type'];
		$var7 = $_POST['new_multi_price'];
		$var9 = $_POST['new_multi6_price'];
		$var10 = $_POST['new_multi7_price'];
		$var11 = $_POST['idddd'];
		$var12 = $_POST['old'];
		$has = $_POST['has_ing'];
		$change_cost = $_POST['new_cost'];
 		if(isset($var1)||isset($var2)||isset($var3))
		{
		$var13 = $var1 + $var12;
		//$var14 = $var12 - $var1; 
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
   mysql_select_db("$db") or die(mysql_error()); 

 mysql_query("UPDATE `stock` set `we_have` = '$var13'  WHERE `id` = '$var4';");  
 //mysql_query("UPDATE `stock` set `stock` = '$var13'  WHERE `id` = '$var4';");  
 mysql_query("UPDATE `stock` set `name` = '$var2'  WHERE `id` = '$var4';");  
 mysql_query("UPDATE `stock` set `price` = '$var3'  WHERE `id` = '$var4';");   
 mysql_query("UPDATE `stock` set `ing` = '$has'  WHERE `id` = '$var4';");   
 mysql_query("UPDATE `stock` set `cost` = '$change_cost'  WHERE `id` = '$var4';");   

		}
 
 	  mysql_connect("$host", "$user", "$pass")or die("cannot connect");
      mysql_select_db("$db")or die("cannot select DB");
      $result = mysql_query("SELECT * FROM `stock` WHERE id = '$id' AND ing = 'yes'"); 
      while($row = mysql_fetch_array($result))
      {
		$stock_name = $row['name'];
		$stock_cost = $row['cost'];
	  }
 
 
        mysql_connect("$host", "$user", "$pass")or die("cannot connect");
        mysql_select_db("$db")or die("cannot select DB");
                $query = "SELECT  SUM(cost) FROM recipe where item = '$stock_name'"; 
                $resulty = mysql_query($query) or die(mysql_error());
                            while($row = mysql_fetch_array($resulty))
							{
                                           $total_cost = $row['SUM(cost)'];
                            }
							if($stock_cost != $total_cost)
							{
		                    mysql_query("UPDATE `stock` set `cost` = '$total_cost'  WHERE `id` = '$id';");   
	                        }
 
 
  
 								$id = $_GET['id'];
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `stock` Where id = '$id'");
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
 mysql_query("UPDATE `stock` set `we_have` = '$total_new_stock'  WHERE `id` = '$id';");  
 mysql_query("UPDATE `stock` set `stock` = '$total_new_stock'  WHERE `id` = '$id';");
 mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`) VALUES 
		  ('$ppname','exp','$add_new_quan','$add_new_cost','$shift_day','$shift_month','$Year','$current_shift','$now');"); 
}
		  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_233;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $lang_1;?>">
	<meta name="author" content="Mohamed Gad">

	<!-- The styles -->
			<?php  include 'includes/css.php';?>

		<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
	url,'popUpWindow','height=300,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
	popupWindow.focus();

}
</script>
<script type="text/javascript">
// Popup window code
function newPopup2(url) {
	popupWindow = window.open(
	url,'popUpWindow','height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
	popupWindow.focus();
}
</script>
</head>

<body>
		<!-- topbar starts -->
<?php include('includes/navbar.php');?>
<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
<!-- left menu starts -->
<?php include('includes/menu.php');?>
<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			 <?php 

	 
	 $result = mysql_query("SELECT *,MIN(cost),SUM(cost),SUM(stock),SUM(sold),AVG(cost) FROM `stock` Where name = '$ppname'");
	while($row = mysql_fetch_array($result))
  {
  			$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$item_name = $row['name'];
$ingg = $row['ing'];
$typex = $row['catagory'];
$cat = $row['sub_cat'];
    if($typex == 'drinks'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_drinks_cat.php"><span>فئات المشروبات</span></a> / <a href="control_drinks.php?cat=<?php echo $cat;?>"><span><?php echo $cat;?></span></a> / <span><?php echo $item_name;?></span>
			</div>
			<?php }else if($typex == 'food'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_food_cat.php"><span>فئات المأكولات</span></a> / <a href="control_food.php?cat=<?php echo $cat;?>"><span><?php echo $cat;?></span></a> / <span><?php echo $item_name;?></span>
			</div>
			<?php }else if($typex == 'general'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_gen.php"><span>الأصناف العامة</span></a> / <span><?php echo $item_name;?></span>
			</div>
			<?php }else if($typex == 'choc'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_choc.php"><span>الحلويات</span></a> / <span><?php echo $item_name;?></span>
			</div>
			<?php }?>
			<br/>
			<!-- content starts -->
			 
			 
			
 
  
			 
			 
			 <br/>
	<!--/span-->
  			 
<form action="control_product.php?id=<?php echo $id;?>" method="POST" class=" <?php if($row['ing'] == 'yes')
  {?>pull-left<?php }?>">
<input type ="hidden" name = "iddd" value="<?php  echo $id;?>" >
<input type ="hidden" name = "old" value="<?php  echo $row['stock'] ?>" >
   <h2><font color="red" ><?php echo $lang_234;?>: </font><?php  echo $row['name'] ?></h2>
		<h2><font color="Green" ><?php echo $lang_235;?>: </font><?php  echo $row['price']?> <?php echo $lang_100;?></h2>

  <?php if($row['ing'] == 'no')
  {
	 mysql_connect("$host", "$user", "$pass")or die("cannot connect");
     mysql_select_db("$db")or die("cannot select DB");
     $resultr = mysql_query("SELECT *,MIN(date) FROM `stock` Where name = '$ppname' AND (stock > sold)");
			 while($rowr = mysql_fetch_array($resultr))
  { 
      $ldate = $rowr['MIN(date)'];
     $resultrd = mysql_query("SELECT * FROM `stock` Where name = '$ppname' AND date = '$ldate'");
			 while($rowrd = mysql_fetch_array($resultrd))
  { 
                    $lastcost = $rowrd['cost'];
  }
  }
  ?>
        <h2><font color="Green" ><?php echo $lang_236;?>: </font><?php  echo $aaas?> </h2>
		<button data-toggle="modal" data-target="#myModal"><?php echo $lang_238;?></button>
        <h2><font color="blue" ><?php echo $lang_368;?>: </font><?php  echo $lastcost; ?> <?php echo $lang_100;?></h2>
 <?php  } else if($row['ing'] == 'yes')
 {
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$item_name'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];

   }
 ?>   
<h2>   <font color="Green" ><?php echo $lang_236;?>: </font><?php  echo $ingtotal?> </h2>
        <h2><font color="blue" ><?php echo $lang_368;?>: </font><?php  echo $row['cost']?> <?php echo $lang_100;?></h2>
 <?php }?>
 
   </br>
  </br>
 <h3><?php echo $lang_378;?></h3>
  </br>
  <?php echo $lang_379;?><br/>
<select name="has_ing">
<option value="<?php  echo $row['ing']?>"><?php echo $lang_382;?></option>
<option value="yes"><?php echo $lang_380;?></option>
<option value="no"><?php echo $lang_381;?></option>
</select>
  </br>
  <?php 	if($ingg == "no")
   {
   ?> 	  
  <?php //echo $lang_238;?><!--:<br><input type="text" name="quan" value="0"><br>-->
   <?php }echo $lang_239;?>:</br><input type="text" name="new_name" value="<?php  echo $row['name'] ?>"></br>
  <?php echo $lang_240;?>:</br><input  type="number" step="0.1" min="0" name="new_price" value="<?php  echo $row['price'] ?>"></br>
 						<?php 	if($ingg == "no")
   {
   ?> 	  
     <?php echo $lang_383;?>:</br><input type="number" name="new_cost" value="<?php  echo $row['AVG(cost)'] ?>" required></br>

   <?php  } ?>
								<center>
 								<button type="submit" class="btn btn-primary"><?php echo $lang_232;?></button>
</center>
</form>     			<?php  } ?>
					<?php    if($ingg == "yes")
   {?>
		
  <div class="box span6 pull-right">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $lang_365;?></h2>
						 
					</div>
			<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
								
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(ing_qty) FROM `recipe` Where item = '$item_name' AND ing_name != ' ' GROUP BY ing_name ORDER BY ing_name ");
 ?><thead>
<tr>
								  <th><?php echo $lang_21;?></th>
                                  <th><?php echo $lang_180;?></th>
								  <th><?php echo $lang_123;?></th>
								  <th><?php echo $lang_167;?></th>
								   
 

</tr>
</thead>  
						  <tbody>
						  <?php 
								
								
																while($row = mysql_fetch_array($result))
  {
  // $aaas = $row['SUM(stock)'] - $row['SUM(sold)'];
    $idid = $row['id'];
    $recing = $row['ing_name'];

  echo "<tr>";
  echo '<td><a class="btn btn-info" href="control_product.php?id='.$id.'">'.'<i class="icon-edit icon-white"></i>'.' '.$row['ing_name'].'</a></td>';
  echo "<td>" . $row['SUM(ing_qty)'] . "</td>";
  ?>   
 <td class="center">
 -									</td>   <td class="center">
																		  <span class="label label-important"><a  onclick="return confirm('<?php echo $lang_244;?>')" href="control_product.php?id=<?php echo $id; ?>&&delete_ing=<?php  echo $idid;?>" ><?php echo $lang_167;?></a></span>
									</td>        <?php 
  echo "</tr>";
  }?>
  <tr>

  <td>
  <form action = "control_product.php?id=<?php echo $id;?>&&re=<?php echo $item_name;?>" method = "post">
    <?php  mysql_connect("$host", "$user", "$pass")or die("cannot connect");
      mysql_select_db("$db")or die("cannot select DB");
      $result = mysql_query("SELECT * FROM `ingredients` WHERE name !='$recing' GROUP BY `name` ORDER BY `name`"); 
	  ?>
	  <div class="controls">
 <select name="r_name" id="choose_cat" data-rel="chosen"><?php 
      while($row = mysql_fetch_array($result))
      {
   ?>
      <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?> - <?php echo $row['unit'];?></option>
 
<?php  } 
?>
  </select>
  </div>
  </td>

  <td><input type="text" name="r_qty" style="width:50%;" /></td>
  <td><button class="btn .btn-group"><?php echo $lang_123;?></button></td>
  </form>
  <td> - </td>
  </tr>
						  </tbody>
					  </table>            
   </div> <?php  } ?>
				</div>
					<!-- content ends -->
			
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<h3>إضافة كمية جديدة</h3>
			</div>
			<div class="modal-body">
            <form action="actions/products/add_qty.php?id=<?php echo $id;?>" method="POST">
			<input type="hidden" name="old_stock" value="<?php echo $old_stock;?>">
			<label>الكمية الجديدة</label><input type="number" name="add_new_quan" required="required"/>
			<label>تكلفة الكمية</label><input type="number" name="add_new_cost"  required="required"/>
			
			</div>
			<div class="modal-footer">
							<button href="#" type="submit" class="btn btn-primary">حفظ</button>

				<a href="#" class="btn" data-dismiss="modal">إغلاق</a>
			</div>
			</form>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">PlayStation</a> <?php $Year = idate('Y');   echo $Year;?></p>
			
		</footer>
		
	</div><!--/.fluid-container-->
<?php  include 'includes/js.php';?>
	
		
</body>
</html>
