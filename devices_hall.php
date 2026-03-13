<?php session_start();
if( !isset($_SESSION['ps_user']) )
{
	include('login.php');
	die();
}
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}$id = $_GET['id']; $id=$_GET['id'];			
$var1=$_POST['p_name']; 
$Year = idate('Y');
$Hour = idate('H');
$Minute = idate('i');
$Second = idate('s'); 
$H = $Hour;
if(isset($var1))
{
	$var2=$_POST['p_num'];
	$var3=$_POST['p_catagory'];
	$var4=$_POST['p_sub_cat'];
	$var5=$_POST['p_price'];
	$var6=$_POST['ps_id'];
	$var7=$_POST['ss'];
	mysql_connect("$host", "$user", "$pass")or die("cannot connect");
	mysql_select_db("$db")or die("cannot select DB");
	$result = mysql_query("SELECT * FROM `stock` Where `name` = '$var1'");
	while($row = mysql_fetch_array($result))
	{
		$we_have = $row['sold'];
	}
	$new = $we_have + $var2;
	$total = ($var2 * $var5);
 	$Year = idate('Y');
	$Hour = idate('H');
	$H = $Hour;
	if($H < 0)
	{
		$H = 23;
	}
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("INSERT INTO `ps_orders` (`catagory`, `sub_cat`,`name`, `price`, `num` , `ps_id` ,`session_id`,`day`,`month`,`year`,`shift`,`hour` ) VALUES ('$var3', '$var4', '$var1','$total','$var2','$var6','$var7','$shift_day','$shift_month','$Year','$current_shift','$Hour');"); 
	mysql_query("UPDATE `stock` set `sold` = '$new'  WHERE `name` = '$var1';"); 
} 
$Item = $_GET['Item'];
$sesssss = $_GET['sesss'];
if(isset($Item))
{
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("DELETE FROM ps_orders WHERE ps_id = $id AND name = '$Item' AND session_id = '$sesssss'");  
	$denden = $_GET['dename'];
	$dnu = $_GET['nn'];
	 $var2 = $_GET['nn'];
	mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,MIN(date) FROM `stock` Where name = '$denden' AND ('stock' > 'sold')");
			 while($row = mysql_fetch_array($result))
  {
   $md = $row['MIN(date)'];
  }
	mysql_connect("$host", "$user", "$pass")or die("cannot connect");
	mysql_select_db("$db")or die("cannot select DB");
	$result = mysql_query("SELECT * FROM `stock` Where `name` = '$denden' AND date ='$md'  ");
	while($row = mysql_fetch_array($result))
	{
		$hhh = $row['sold'];
	}
	$nono = $hhh - $dnu;
	mysql_query("UPDATE `stock` set `sold` = '$nono'  WHERE `name` = '$denden' AND date = '$md';"); 
		   mysql_connect("$host", "$user", "$pass")or die("cannot connect");
    mysql_select_db("$db")or die("cannot select DB");
    $result = mysql_query("SELECT * FROM `recipe` Where item = '$denden'");
			 while($row = mysql_fetch_array($result))
                    {
                           $s_ing = $row['ing_name'];
			  $resultt = mysql_query("SELECT MIN(date) FROM `ingredients` Where name = '$s_ing' AND ('stock' > 'sold')");
			  while($roww = mysql_fetch_array($resultt))
                    {
					$mmd = $roww['MIN(date)'];
                    }
					$resultt = mysql_query("SELECT * FROM `ingredients` Where name = '$s_ing' AND date = '$mmd'");
			  while($roww = mysql_fetch_array($resultt))
                    {
						$o_out = $roww['sold']; 
						$o_in = $roww['stock']; 
						$o_total = $o_in - $o_out;
					}
				        $s_qty = $o_out - ($row['ing_qty'] * $var2);
				  mysql_query("UPDATE `ingredients` set `sold` = '$s_qty'  WHERE `name` = '$s_ing' AND `date` = '$mmd';"); 
				        $s_avl = $row['ing_avl'];
						$s_last = $s_avl + ($row['ing_qty'] * $var2);
				  mysql_query("UPDATE `recipe` set `ing_avl` = '$s_last'  WHERE `ing_name` = '$s_ing';"); 
                    }
    }
$finishedid = $_GET['finishedid'];
if(isset($finishedid))
{
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("UPDATE `devices` set `Device Status` = 'finished'  WHERE `id` = '$finishedid';"); 
 }
$disdis =$_GET['dis'];
$dis_n =$_POST['discount_value'];
$dis_n2 =$_POST['discount_value2'];
$dis_r =$_POST['discount_reason'];
$dis_s =$_POST['diss_sess'];
if(isset($disdis))
{
	if($dis_n > 0){
		$dis_x = $dis_n;
		mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
		mysql_select_db("$db") or die(mysql_error()); 
		mysql_query("UPDATE `devices` set `discount` = '$dis_x'  WHERE `id` = '$id';"); 
		mysql_query("UPDATE `reports` set `discount` = '$dis_x'  WHERE `session_id` = '$dis_s';"); 
		mysql_query("UPDATE `reports` set `dis_reason` = '$dis_r'  WHERE `session_id` = '$dis_s';"); 
	}
	else if($dis_n2> 0){$dis_x = $dis_n2;
		mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
		mysql_select_db("$db") or die(mysql_error()); 
		mysql_query("UPDATE `devices` set `discount2` = '$dis_x'  WHERE `id` = '$id';"); 
		mysql_query("UPDATE `reports` set `discount2` = '$dis_x'  WHERE `session_id` = '$dis_s';"); 
		mysql_query("UPDATE `reports` set `dis_reason` = '$dis_r'  WHERE `session_id` = '$dis_s';"); 
	}
    }
$change_time_type = isset($_POST['change_type']) ? $_POST['change_type'] : '';
$set_ho = isset($_POST['set_ho']) ? (int) $_POST['set_ho'] : 0;
$set_mi = isset($_POST['set_mi']) ? (int) $_POST['set_mi'] : 0;
$start_h = isset($_POST['start_hour']) ? (int) $_POST['start_hour'] : 0;
$start_m = isset($_POST['start_minute']) ? (int) $_POST['start_minute'] : 0;
$new_h = $start_h + $set_ho;
$new_m = $start_m + $set_mi;

while ($new_m >= 60)
{
	$new_m -= 60;
	$new_h += 1;
}

while ($new_h >= 24)
{
	$new_h -= 24;
}

if ($change_time_type == 'totime' || $change_time_type == 'toun')
{
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 

	if ($change_time_type == 'totime')
	{
		mysql_query("UPDATE `devices` SET `timetype` = 'time', `end_h` = '" . (int)$new_h . "', `end_m` = '" . (int)$new_m . "', `Device Status` = 'On' WHERE `ID` = '" . (int)$id . "';");
	}
	else
	{
		mysql_query("UPDATE `devices` SET `timetype` = 'unlimited', `Device Status` = 'On' WHERE `ID` = '" . (int)$id . "';");
	}
}
$del_dis = $_GET['del_dis'];
$del_dsess = $_GET['del_dsess'];
if($del_dis == 'yes')
{
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("UPDATE `devices` set `discount` = '0'  WHERE `ID` = '$id';");
	mysql_query("UPDATE `devices` set `discount2` = '0'  WHERE `ID` = '$id';");
	mysql_query("UPDATE `reports` set `dis_reason` = '0'  WHERE `session_id` = '$del_dsess';");
	mysql_query("UPDATE `reports` set `discount` = '0'  WHERE `session_id` = '$del_dsess';");
	mysql_query("UPDATE `reports` set `discount2` = '0'  WHERE `session_id` = '$del_dsess';");
	mysql_query("UPDATE `reports` set `discount_amount` = '0'  WHERE `session_id` = '$del_dsess';");
}
$assign = $_POST['assign'];
$unassign = $_GET['unassign'];
 // echo $assign;
if($assign > 0)
{
		mysql_query("UPDATE `devices` set `Current Price` = '$assign'  WHERE `ID` = '$id';"); 

}
if($unassign =='true')
{
		mysql_query("UPDATE `devices` set `Current Price` = ''  WHERE `ID` = '$id';"); 

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $lang_331;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $lang_1;?>">
<meta name="author" content="Mohamed Gad">
<!-- The styles -->
<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
<style> 
input[type=number] {
    height: 30px;
    line-height: 30px;
    font-size: 16px;
    padding: 0 8px;
}
input[type=number]::-webkit-inner-spin-button { 
     cursor:pointer;
    display:block;
    width:8px;
    color: #333;
    text-align:center;
    position:relative;
	opacity: 1;
	
}
input[type=number]:hover::-webkit-inner-spin-button { 
    background: #eee url('img/arrows.png') no-repeat 50% 50%;  
    width: 14px;
    height: 14px;
    padding: 4px;
    position: relative;
    right: 4px;
    border-radius: 28px;
}
</style>
<style type="text/css">
body {
	padding-bottom: 40px;
}
.sidebar-nav {
padding: 9px 0;
}
body .modal {
    /* new custom width */
    width: 750px;
    /* must be half of the width, minus scrollbar on the left (30px) */
    margin-left: -390px;
}
</style>
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/charisma-app.css" rel="stylesheet">
<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
<link href='css/fullcalendar.css' rel='stylesheet'>
<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
<link href='css/chosen.css' rel='stylesheet'>
<link href='css/uniform.default.css' rel='stylesheet'>
<link href='css/colorbox.css' rel='stylesheet'>
<link href='css/jquery.cleditor.css' rel='stylesheet'>
<link href='css/jquery.noty.css' rel='stylesheet'>
<link href='css/noty_theme_default.css' rel='stylesheet'>
<link href='css/elfinder.min.css' rel='stylesheet'>
<link href='css/elfinder.theme.css' rel='stylesheet'>
<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
<link href='css/opa-icons.css' rel='stylesheet'>
<link href='css/uploadify.css' rel='stylesheet'>
<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- The fav icon -->
<link rel="shortcut icon" href="img/favicon.ico">
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
<!-- content starts -->
<div class="row-fluid sortable">
<div class="box span11">
<div class="sortable row-fluid span12">
<div class="box-content">
<table class="table table-bordered table-striped table-condensed span6">
<thead><?php 
$id= $_GET['id'];															
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$sql="SELECT * FROM `halls` where `id` = $id";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{
	$esmo=$row['hallname'];
	$session=$row['session'];
	$sess=$row['session'];
  }
 $sql="SELECT * FROM `reservation` WHERE `session` = '$session'";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{
	$esmo=$row['hallname'];
	$nname=$row['name'];
	$type=$row['type'];
	$num=$row['num'];
	$rmon=$row['money'];
 }
?>
<tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><h2><font color="#33b5e5"><?php echo $esmo;?></font></h2></th>
</tr>
<tr>
<td colspan="6">عدد الحضور: <font color="white"><?php echo $num;?> </font></td>
</tr>
 

 
<tr>
<th><center>-</center></th> 
<th><center>-</center></th>
<th><center>-</center></th>
<th><center>-</center></th>                                          
<th colspan="2"><center>-</center></th>                                          
</tr>
</thead> 
<tbody><?php 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

$sql="SELECT * FROM `ps_orders` where `ps_id` = '$id' AND `status` = 'no' AND `session_id` = '$sess'";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{
	  $Itemmn = $row['order_id'];	 
	  
} 
if($Itemmn >0)
{
 ?>
	 <thead><tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><center><h3><font color="#33b5e5"><?php echo $lang_341;?></font>  </h3></center></th>
</tr>
<tr>
	<th colspan="2"><center><?php echo $lang_49;?></center></th>
 	<th><center><?php echo $lang_306;?></center></th>
	<th><center><?php echo $lang_180;?></center></th>                                          
	<th><center><?php echo $lang_51;?></center></th>                                          
	<th><center><?php echo $lang_167;?></center></th>                                          
	</tr></thead>
 	<?php 
	// To connect to the database
	mysql_connect("$host", "$user", "$pass")or die("cannot connect");
	mysql_select_db("$db")or die("cannot select DB");
    $sql="SELECT *,SUM(num),SUM(price) FROM `ps_orders` where `ps_id` = '$id' AND `status` = 'no' AND `session_id` = '$sess' GROUP BY name";
	$resulty=mysql_query($sql);
	while($row = mysql_fetch_array($resulty))
	{
		$Item = $row['name'];	 
		$delete_name = $row['name'];	 
		$denum = $row['SUM(num)'];	 
		?>
		<tr>
		<td colspan="2"><center><?php  echo $row['name']; ?></center></td>
 		<td class="center"><center><?php  echo $row['sub_cat']; ?></center></td>
		<td class="center"><center><?php  echo $row['SUM(num)']; ?></center></td>
		<td class="center"><center><?php  echo $row['SUM(price)']; ?> <?php echo $lang_100;?></center></td>
		<td class="center">
		<button class=" btn btn-danger" style="margin:0px;padding:0px;">
			<a  onclick="return confirm('<?php echo $lang_244;?>')" style="color:#f1f1f1; font-size:8pt;text-decoration:none;" href="devices_hall.php?id=<?php  echo $id;?>&&Item=<?php  echo $Item;?>&&dename=<?php  echo $delete_name;?>&&nn=<?php  echo $denum; ?>&&sesss=<?php echo $sess?>" ><?php echo $lang_167;?></a>
		</button>
		</td>                                       
		</tr>
<?php }}?>
<thead>
<tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><center><h3><font color="#33b5e5"><?php echo $lang_342;?></font></h3></center></th>
</tr></thead>
<?php if($counto>1)
{	
?>
<tr>
<td colspan="3"><?php echo $lang_343;?></td>
<td colspan="3"><h1><font color="red" ><?php echo $vvv1;?>:<?php echo $vvv2;?>:<?php echo $vvv3;?><a href="devices_hall.php?id=<?php echo $id;?>"></font><img src="img/app/devices/reload.png" width="25" height="25"></a></h1>
</td>
</tr>
<?php 
}
	$query = "SELECT  * FROM `reservation_type` where `type` = '$type'"; 	
		$resulty = mysql_query($query) or die(mysql_error());
		// Print out result
		while($row = mysql_fetch_array($resulty)){
			$hyyh = $row['money'];
 		}
			$query = "SELECT  SUM(price) FROM `ps_orders` where `ps_id` = '$id' AND `status` = 'no' AND `session_id` = '$sess'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Pint out result
while($row = mysql_fetch_array($resulty)){
      $items = $row['SUM(price)'];
}	  
		?>  	
<tr>
<td colspan="3">سعر القاعة</td>
<td colspan="3"><h3><font color="yellow" ><?php echo $hyyh;?></font> <?php echo $lang_100;?></h3>
</td>
</tr>
<tr>
<td colspan="3">مبلغ الحجز</td>
<td colspan="3"><h3><font color="red" ><?php echo $rmon;?></font> <?php echo $lang_100;?></h3>
</td>
</tr> 
<tr>
<td colspan="3">الطلبات</td>
<td colspan="3"><h3><font color="green" ><?php echo $items;?></font> <?php echo $lang_100;?></h3>
</td>
</tr> 
<?php  $after_fees = $hyyh + $items - $rmon;  
  $after_fees2 = $hyyh + $items;  
$calc_tax = 0;
$calc_serv = 0;
 ?>
<?php if($service_ch == 'True'){ 
$calc_serv = ($after_fees2 * $service)/100;
?>
<tr>
<td colspan="3">الخدمة (<?php echo $service;?>)%</td>
<td colspan="3"><h2><font color="red" ><?php  echo $calc_serv;?></font> <?php echo $lang_100;?>  </h2></td>
</tr>
<?php }?>
<?php if($tax_ch == 'True'){
$calc_tax = ($after_fees2 * $tax)/100;
	?>
<tr>
<td colspan="3">الضريبة (<?php echo $tax;?>)%</td>
<td colspan="3"><h2><font color="red" ><?php  echo $calc_tax;?></font> <?php echo $lang_100;?>  </h2></td>
</tr>
<?php }
$echo_fees = $after_fees + $calc_serv + $calc_tax;
?>
<tr>
<td colspan="3">المبلغ المتبقي</td>
<td colspan="3"><h2><font color="yellow" size="10" ><?php  echo $echo_fees;?></font> <?php echo $lang_100;?></h2></td>
</tr>
 	</tbody>
	</table> 					 					 
<!--بدايـــــــــة  التحــــــــــــــكم -->				 
<table class="table table-bordered table-striped table-condensed span6" >
<thead>
<tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><center><h3><font color="#33b5e5">البيانات</font></h3></center></th>
</tr>
</thead>
<?php 
if($plz=='ok'){$all = $allm;}
$add_note = $_POST['add_note'];
$ssaa = $_POST['ssaa'];
 ?>
<tr>
<form method="POST" action="devices_hall.php?id=<?php echo $id;?>"> 
<td> رقم الحجز </td>
<td><h2> <?php echo $session;?> </h2></td>
</form></tr>
<tr>
<form method="POST" action="hall_add.php"> 
<?php 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `stock` WHERE name!='' GROUP BY name having SUM(stock)-SUM(sold) >0");
?>
<td> <?php echo $lang_405;?></td>
<td> <input list="ttt" name="item[0][namee]"  placeholder = "<?php echo $lang_405;?>" required="" autocomplete="off"/></td>
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<input type="hidden" name="s" value="<?php echo $sess;?>">
<input type="hidden" name="search" value="yes">
<datalist id="ttt">
<?php while($row = mysql_fetch_array($result))
{?>
<option value="<?php echo $row['name'];?>">
<?php }?></datalist>
<td><button class="btn btn-success"><?php echo $lang_32;?></button></td>
</form></tr>
<tr>
<center>
<td colspan="6"><a class="btn-setting" href="#" data-toggle="modal" data-target="#myModalxx"><img style= "" src="img/app/buttons/stop.png" title="<?php echo $lang_335;?>" data-rel="tooltip"/></a></center>
 </td>
</tr>
 
</table> 
<!-- نهايـــــــــة التحــــــــــــــكم -->				 
</div>
</div>
<!-- add items boxs starts  -------------------------------------------------------------->	
 	<a href="#"  data-rel="tooltip" title="<?php echo $lang_317;?>"  class="well span3 top-blockk" data-toggle="modal" data-target="#or_drinks">
		<span><img src="img/app/control/drinks.png" height="35" /></span>
		<div><?php echo $lang_316;?></div>
		<span class="notification">
			<?php
			$link = mysql_connect("$host", "$user", "$pass");
			mysql_select_db("$db", $link);
			$result = mysql_query("SELECT * FROM `ps_orders` WHERE `catagory` = 'drinks' AND `ps_id` = '$id' AND status = 'no' AND `session_id` = '$sess'", $link);
			$num_rows = mysql_num_rows($result);
			echo $num_rows;?> <?php echo $lang_318;?><?php 
			?>
		</span>
	</a>
	<a href="#" data-rel="tooltip" title="<?php echo $lang_319;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or_food">
		<span><img src="img/app/control/food.png" height="35" /></span>
		<div><?php echo $lang_320;?></div>
		<span class="notification yellow">
			<?php
			$link = mysql_connect("$host", "$user", "$pass");
			mysql_select_db("$db", $link);
			$result = mysql_query("SELECT * FROM `ps_orders` WHERE `catagory` = 'food'  AND `ps_id` = '$id' AND `status` = 'no' AND `session_id` = '$sess'", $link);
			$num_rows = mysql_num_rows($result);
			echo $num_rows;?> <?php echo $lang_318;?><?php 
			?>
		</span>
	</a>	
	<a href="#" data-rel="tooltip" title="<?php echo $lang_321;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or_choc">
		<span><img src="img/app/control/choc.png" height="35" /></span>
		<div><?php echo $lang_322;?></div>
		<span class="notification red">
			<?php
			$link = mysql_connect("$host", "$user", "$pass");
			mysql_select_db("$db", $link);
			$result = mysql_query("SELECT * FROM `ps_orders` WHERE `catagory` = 'choc'  AND `ps_id` = '$id' AND `status` = 'no' AND `session_id` = '$sess'", $link);
			$num_rows = mysql_num_rows($result);
			echo $num_rows;?> <?php echo $lang_318;?><?php 
			?>
		</span>
	</a>
	<a href="#" data-rel="tooltip" title="<?php echo $lang_323;?>"  class="well span3 top-blockk" data-toggle="modal" data-target="#or_gen">
		<span><img src="img/app/control/gen.png" height="35" /></span>
		<div><?php echo $lang_324;?></div>
		<span class="notification red">
			<?php
			$link = mysql_connect("$host", "$user", "$pass");
			mysql_select_db("$db", $link);
			$result = mysql_query("SELECT * FROM `ps_orders` WHERE `catagory` = 'general'  AND `ps_id` = '$id' AND `status` = 'no' AND `session_id` = '$sess'", $link);
			$num_rows = mysql_num_rows($result);
			echo $num_rows;?> <?php echo $lang_318;?><?php 
			?>
		</span>
	</a> 
<!-- add items boxs ends  -------------------------------------------------------------->	
</div><!--/span-->
</div><!--/row-->  
<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->
<hr>
<div class="modal hide fade" id="myModalxx">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3>انهاء</h3>
</div>
<div class="modal-body">
<p><?php echo $lang_353;?></p>
<center>
<h3><?php echo $lang_354;?></h3>
<a href="devices_halls.php?action=close&&endid=<?php  echo $id;?>&&endsess=<?php  echo $sess; ?>&&endmon=<?php echo $after_fees?>&&endn=<?php echo $nname?>&&serv=<?php echo $calc_serv;?>&&tax=<?php echo $calc_tax;?>"><img src="img/app/buttons/stop.png" /></a>
 
 </center>
</div>
</div>
<div class="modal hide fade" id="or_drinks">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_325;?></h3>
</div>
<div class="modal-body">
 <center>
<h3><?php echo $lang_131;?></h3>
<br/>
 <div class="sortable row-fluid">
<?php 
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error());  
$sql="SELECT  * FROM `stock` WHERE `catagory` = 'drinks' GROUP BY sub_cat";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{ 
$sc = $row['sub_cat'];
$scimg = $row['img'];
?>  
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_hall.php?id=<?php echo $id;?>&&add_item=true&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
<span><img src="img/<?php echo $scimg;?>" height="35" /></span>
<div><?php  echo $row['sub_cat'];?></div>
<span class="notification"><?php echo $lang_123;?></span>
</a>				
<?php }?>
</div>
</center>
</div>
</div>
<?php 
$add_item = $_GET['add_item'];
$acat = $_GET['acat'];
$asub_cat = $_GET['asub_cat'];
if($add_item =='true')
{?>
<script type="text/javascript">
    $(window).load(function(){
  $('#or_item').modal('show');
    });
</script>
<?php }?>
<div class="modal hide fade" id="or_item">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $asub_cat;
 //bootstrap-datatable datatable
 ?></h3>
 <br/>
    <table class="table table-striped table-bordered ">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE catagory = '$acat' AND sub_cat = '$asub_cat' AND name !=' ' GROUP BY name ORDER BY name ASC");
 ?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
 </tr>
</thead>
<tbody>
<form action="hall_add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<input type="hidden" name="s" value="<?php echo $sess;?>">
<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];
?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
<?php 
 if($row['ing'] == 'no')
  {
?>
<input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
<td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }
}
else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">
<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  
 $cc++;
}?>
<tr>
<td><button class="btn btn-success"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>
<div class="modal hide fade" id="or_food">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_325;?></h3>
</div>
<div class="modal-body">
 <center>
<h3><?php echo $lang_133;?></h3>
<br/>
 <div class="sortable row-fluid">
<?php 
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error());  
$sql="SELECT  * FROM `stock` WHERE `catagory` = 'food' GROUP BY sub_cat";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{ 
$sc = $row['sub_cat'];
$scimg = $row['img'];
?>  
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_hall.php?id=<?php echo $id;?>&&add_item=true&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
<span><img src="img/<?php echo $scimg;?>" height="35" /></span>
<div><?php  echo $row['sub_cat'];?></div>
<span class="notification"><?php echo $lang_123;?></span>
</a>				
<?php }?>
</div>
</center>
</div>
</div>
<div class="modal hide fade" id="or_gen">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $lang_111;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE `catagory` = 'general' AND `name` !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>							   
</tr></thead><tbody>
<form action="hall_add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<input type="hidden" name="s" value="<?php echo $sess;?>">
<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];
?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 
 if($row['ing'] == 'no')
  {	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}
else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">
<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  
 $cc++;
}?>
<tr>
<td><button class="btn btn-success"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>
<div class="modal hide fade" id="or_choc">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $lang_328;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE `catagory` = 'choc' AND `name` !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								  <th><?php echo $lang_113;?></th>
</tr></thead><tbody>
<form action="hall_add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<input type="hidden" name="s" value="<?php echo $sess;?>">
<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];
?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 
 if($row['ing'] == 'no')
  {	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }
}
else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">
<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  
 $cc++;
}?>
<tr>
<td><button class="btn btn-success"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>
<footer>
<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">Gesture For Playstation</a> <?php $Year = idate('Y');   echo $Year;?></p>
</footer>
</div><!--/.fluid-container-->
<!-- external javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- jQuery -->
<script src="js/jquery-1.7.2.min.js"></script>
<!-- jQuery UI -->
<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
<!-- transition / effect library -->
<script src="js/bootstrap-transition.js"></script>
<!-- alert enhancer library -->
<script src="js/bootstrap-alert.js"></script>
<!-- modal / dialog library -->
<script src="js/bootstrap-modal.js"></script>
<!-- custom dropdown library -->
<script src="js/bootstrap-dropdown.js"></script>
<!-- scrolspy library -->
<script src="js/bootstrap-scrollspy.js"></script>
<!-- library for creating tabs -->
<script src="js/bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="js/bootstrap-tooltip.js"></script>
<!-- popover effect library -->
<script src="js/bootstrap-popover.js"></script>
<!-- button enhancer library -->
<script src="js/bootstrap-button.js"></script>
<!-- accordion library (optional, not used in demo) -->
<script src="js/bootstrap-collapse.js"></script>
<!-- carousel slideshow library (optional, not used in demo) -->
<script src="js/bootstrap-carousel.js"></script>
<!-- autocomplete library -->
<script src="js/bootstrap-typeahead.js"></script>
<!-- tour library -->
<script src="js/bootstrap-tour.js"></script>
<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calander plugin -->
<script src='js/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>
<!-- chart libraries start -->
<script src="js/excanvas.js"></script>
<script src="js/jquery.flot.min.js"></script>
<script src="js/jquery.flot.pie.min.js"></script>
<script src="js/jquery.flot.stack.js"></script>
<script src="js/jquery.flot.resize.min.js"></script>
<!-- chart libraries end -->
<!-- select or dropdown enhancer -->
<script src="js/jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<script src="js/jquery.uniform.min.js"></script>
<!-- plugin for gallery image view -->
<script src="js/jquery.colorbox.min.js"></script>
<!-- rich text editor library -->
<script src="js/jquery.cleditor.min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- file manager library -->
<script src="js/jquery.elfinder.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>
</body>
</html>
