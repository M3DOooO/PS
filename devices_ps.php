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

mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

function ceil_to_five($amount)
{
	if ($amount <= 0)
	{
		return 0;
	}
	return ceil($amount / 5) * 5;
}

if(isset($var1))
{
	$var2=$_POST['p_num'];
	$var3=$_POST['p_catagory'];
	$var4=$_POST['p_sub_cat'];
	$var5=$_POST['p_price'];
	$var6=$_POST['ps_id'];
	$var7=$_POST['ss'];

	
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

$result = mysql_query("SELECT *,MIN(date) FROM `stock` Where name = '$denden' AND ('stock' > 'sold')");
			 while($row = mysql_fetch_array($result))
  {
   $md = $row['MIN(date)'];
  }

	$result = mysql_query("SELECT * FROM `stock` Where `name` = '$denden' AND date ='$md'  ");
	while($row = mysql_fetch_array($result))
	{
		$hhh = $row['sold'];
	}
	$nono = $hhh - $dnu;
	mysql_query("UPDATE `stock` set `sold` = '$nono'  WHERE `name` = '$denden' AND date = '$md';"); 
	
		   
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
	mysql_query("UPDATE `reports` set `dis_reason` = ''  WHERE `session_id` = '$del_dsess';");
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
		<?php  include 'includes/css.php';?>

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
 
body .modal {
    /* new custom width */
    width: 750px;
    /* must be half of the width, minus scrollbar on the left (30px) */
    margin-left: -390px;
}
</style>
 
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
 
$sql="SELECT * FROM `devices` where `id` = $id";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{ $esmo=$row['Device Name'];$al3ab=$row['Paused'];}?>
<tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><h2><font color="#33b5e5"><?php echo $esmo;?></font></h2></th>
</tr>

<tr>
<td colspan="6"><?php echo $lang_415;?>: <font color="white"><?php echo $al3ab;?></font></td>
</tr>
<tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><h3><font color="#33b5e5"><?php echo $lang_332;?></font></h3></th>
</tr>
<tr>
<td colspan="6"><a class="btn-setting" href="#" data-toggle="modal" data-target="#myModalxx"><img style="margin-left:10px; float:left;" src="img/app/buttons/stop.png" title="<?php echo $lang_335;?>" data-rel="tooltip"/></a>
<a href="devices_ps.php?id=<?php echo $id;?>"><img style="margin:5px 10px 0 0; float:right;" src="img/app/devices/reload.png" width="45" height="45" title="<?php echo $lang_333;?>" data-rel="tooltip"></a></td>
</tr>

<tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><center><h3><font color="#33b5e5"><?php echo $lang_334;?></font></h3></center></th>
</tr>
<tr>
<th><center><?php echo $lang_21;?></center></th> 
<th><center><?php echo $lang_336;?></center></th>
<th><center><?php echo $lang_159;?></center></th>
<th><center><?php echo $lang_337;?></center></th>                                          
<th colspan="2"><center><?php echo $lang_305;?></center></th>                                          
</tr>
</thead> 
<tbody>
<?php 
$id= $_GET['id'];															

$sql="SELECT * FROM `devices` where `id` = $id";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{
	$dis=$row['discount'];
	$dis2=$row['discount2'];
	$timetype = $row['timetype']; 
	$pnote = $row['notes'];
	$thetype = $row['type'];
	if($timetype == 'unlimited')
	{			 
		$Hour = idate('H');
		$Minute = idate('i');
		$Second = idate('s');
		$gethour = $row['hour'];
		$getminute = $row['minute'];
		$getsecond = $row['second'];
		$single = $row['single'];
		$multi = $row['multi'];
		$multi6 = $row['multi6'];
		$multi7 = $row['multi7'];
		$sess = $row['session_id'];
		$dName = $row['Device Name']; 
			$start_day = $row['day'];
						$end_dayy = $row['end_day'];

			$tod_date = idate('d');
		if($Hour == '0'){$Hour = 24;} if($gethour == '0'){$gethour = 24;}
	    $hdiff = $Hour - $gethour;
			if(($hdiff < 0)  && ($start_day !=$tod_date) || ($hdiff < 0) && ($start_day !=$end_dayy))
			{
			$hdiff = $hdiff + 24;
		}
		$mdiff = $Minute - $getminute;
		$sdiff = $Second - $getsecond;
		$all = (($hdiff * 60*60)+($mdiff*60)+$sdiff);
		$noo3 = $row['type'];
		if ($noo3 == 'single')
		{
			$hour_price = $single;
		}
		elseif ($noo3 == 'multi')
		{
			$hour_price = $multi;
		}
		elseif ($noo3 == 'multi6')
		{
			$hour_price = $multi6;
		}
		elseif ($noo3 == 'multi7')
		{
			$hour_price = $multi7;
		}
		$min_price = $hour_price / 60;
		$sec_price = $min_price / 60;
		$total_price = $all * $sec_price;
		?>
		<tr>
		<td><center><?php  echo $row['Device Name']; ?></center></td>
		<td class="center"><center><?php  echo $row['hour']; ?>:<?php  echo $row['minute']; ?></center></td>
		<td><center><?php 
		
        switch($thetype)
		{
		CASE 'single':   echo $lang_3;	BREAK;		
		CASE 'multi':   echo $lang_4;	BREAK;		
		CASE 'multi6':   echo $lang_6;	BREAK;		
		CASE 'multi7':   echo $lang_7;	BREAK;		
		}
		  ?></center></td>
		<td class="center"><center>	<font color="red" size="6">			<span id='countdownn'><?php  echo $all;?></span></font></br>
		<td class="center" colspan="2"><center><h2><font color="green"><?php  echo ceil_to_five($total_price); ?> </font><?php echo $lang_100;?></h2></center></td></center>
		</td>
		</tr>
		<script type="text/javascript">   
		secs       =  parseInt(document.getElementById('countdownn').innerHTML,10);
		setTimeout("countdown('countdownn',"+secs+")", 1000);
		/**
	* Countdown function
	* Clock count downs to 0:00 then hides the element holding the clock
	* @param id Element ID of clock placeholder
	* @param timer Total seconds to display clock
	*/
		function countdown(id, timer){
			timer++;
			hourRemain = Math.floor(timer / 3600)%24;
			minRemain  = Math.floor(timer / 60 )%60;
			secsRemain = new String(timer %60);
			// Pad the string with leading 0 if less than 2 chars long
			if (secsRemain.length < 2) {
				secsRemain = '0' + secsRemain;
			}

			// String format the remaining time
			clock      = hourRemain + ":" + minRemain + ":" + secsRemain;
			document.getElementById(id).innerHTML = clock;
			if ( timer > 0 ) {
				// Time still remains, call this function again in 1 sec
				setTimeout("countdown('" + id + "'," + timer + ")", 1000);
			} else {
				document.getElementById(id).style.display = 'none';
			}			
		}
		$('input').spinner();
		</script>

		<?php  }
	else if($timetype == 'time')
	{
		$whatstatus = $row['Device Status'];

		if($whatstatus == 'finished')
		{
			?><script>
			var snda = new Audio("sounds/aa.mp3"); // buffers automatically when created
			snda.play();
			</script><?php 
			$Hour = idate('H');
			$Minute = idate('i');
			$Second = idate('s');
			$esth = $row['end_h'];
			$estm = $row['end_m'];
			$ests = $row['second'];
			$single = $row['single'];
			$multi = $row['multi'];
			$multi6 = $row['multi6'];
			$multi7 = $row['multi7'];
			$sess = $row['session_id'];
			$dName = $row['Device Name']; 
			$gethour = $row['hour'];
			$getminute = $row['minute'];
			$getsecond = $row['second'];

		  	$start_day = $row['day'];
			$tod_date = idate('d');
			$end_dayy = $row['end_day'];
  		    if($Hour == '0'){$Hour = 24;} if($gethour == '0'){$gethour = 24;}if($esth == '0'){$esth = 24;}
			$hdiff = $esth - $Hour;
			$moneyhdiff = $esth - $gethour;
			if(($moneyhdiff < 0)  && ($start_day !=$tod_date) || ($moneyhdiff < 0) && ($start_day !=$end_dayy))
			{
				$moneyhdiff = $moneyhdiff + 24;
			}		
			if(($hdiff < 0)  && ($start_day !=$tod_date) || ($hdiff < 0) && ($start_day !=$end_dayy))
			{
				$hdiff = $hdiff + 24;
			}
			$moneymdiff = $estm - $getminute;
			$moneysdiff = $ests - $getsecond;
			$all = (($moneyhdiff * 60*60)+($moneymdiff*60)+$moneysdiff);
			$mdiff = $estm - $Minute;
			$sdiff = $ests - $Second;
			$alll = (($hdiff * 60*60)+($mdiff*60)+$sdiff);
			$noo3 = $row['type'];
			if ($noo3 == 'single')
			{
				$hour_price = $single;
			}
			elseif ($noo3 == 'multi')
			{
				$hour_price = $multi;
			}
elseif ($noo3 == 'multi6')
			{
				$hour_price = $multi6;
			}
			elseif ($noo3 == 'multi7')
			{
				$hour_price = $multi7;
			}
			$min_price = $hour_price / 60;
			$sec_price = $min_price / 60;
			$total_price = $all * $sec_price;
			?>
			<tr>
			<td><?php  echo $row['Device Name']; ?></td>
			<td class="center"><?php  echo $row['hour']; ?>:<?php  echo $row['minute']; ?></td>
			<td><?php   switch($thetype)
		{
		CASE 'single':   echo $lang_3;	BREAK;		
		CASE 'multi':   echo $lang_4;	BREAK;		
		CASE 'multi6':   echo $lang_6;	BREAK;		
		CASE 'multi7':   echo $lang_7;	BREAK;		
		} ?></td>
			<td class="center">	<font color="red" size="6">			<span><?php  echo gmdate("H:i:s", $all);?></span></font></br>
			<td class="center"><h2><font color="green"><?php  echo ceil_to_five($total_price); ?> </font><?php echo $lang_100;?></h2></td>
			</td>
			</tr>
			<?php 				  
		}	
		else{		   
			$Hour = idate('H');
			$Minute = idate('i');
			$Second = idate('s');
			$esth = $row['end_h'];
			$estm = $row['end_m'];
			$ests = $row['second'];
			$single = $row['single'];
			$multi = $row['multi'];
			$multi6 = $row['multi6'];
			$multi7 = $row['multi7'];
			$sess = $row['session_id'];
			$dName = $row['Device Name']; 
			$gethour = $row['hour'];
			$getminute = $row['minute'];
			$getsecond = $row['second'];
			if($Hour == '0'){$Hour = 24;} if($gethour == '0'){$gethour = 24;}
			$plz = 'ok';
			$start_day = $row['day'];
			$tod_date = idate('d');
			$hdiff = $esth - $Hour;
			$moneyhdiff = $Hour - $gethour;
			$end_dayy = $row['end_day'];
			if(($hdiff < 0)  && ($start_day !=$tod_date) || ($hdiff < 0) && ($start_day !=$end_dayy))
			{
				$hdiff = $hdiff + 24;
			}
			if(($moneyhdiff < 0)  && ($start_day !=$tod_date) || ($moneyhdiff < 0) && ($start_day !=$end_dayy))
			{
				$moneyhdiff = $moneyhdiff + 24;
			}
			$moneymdiff = $Minute - $getminute;
			$moneysdiff = $Second - $getsecond;
 			$mdiff = $estm - $Minute;
			$sdiff = $ests - $Second;
			$allm = (($moneyhdiff * 60*60)+($moneymdiff*60)+$moneysdiff);
			$all = (($hdiff * 60*60)+($mdiff*60)+$sdiff);
 			$noo3 = $row['type'];
			if ($noo3 == 'single')
			{
				$hour_price = $single;
			}
			elseif ($noo3 == 'multi')
			{
				$hour_price = $multi;
			}
elseif ($noo3 == 'multi6')
			{
				$hour_price = $multi6;
			}
			elseif ($noo3 == 'multi7')
			{
				$hour_price = $multi7;
			}
			$min_price = $hour_price / 60;
			$sec_price = $min_price / 60;
			$total_price = $allm * $sec_price;
			?>
			<tr>
			<td><?php  echo $row['Device Name']; ?></td>
			<td class="center"><?php  echo $row['hour']; ?>:<?php  echo $row['minute']; ?></td>
			<td><?php   switch($thetype)
		{
		CASE 'single':   echo $lang_3;	BREAK;		
		CASE 'multi':   echo $lang_4;	BREAK;		
		CASE 'multi6':   echo $lang_6;	BREAK;		
		CASE 'multi7':   echo $lang_7;	BREAK;		
		} ?></td>
			<td class="center">	<font color="red" size="6">			<span id='countdownn2'><?php  echo $all;?></span></font></br>
			<td class="center" colspan="2"><h2><font color="green"><?php  echo ceil_to_five($total_price); ?> </font><?php echo $lang_100;?></h2></td>
			</td>
			</tr>
			<script type="text/javascript">   
			secs       =  parseInt(document.getElementById('countdownn2').innerHTML,10);
			setTimeout("countdown2('countdownn2',"+secs+")", 1000);
			/**
	* Countdown function
	* Clock count downs to 0:00 then hides the element holding the clock
	* @param id Element ID of clock placeholder
	* @param timer Total seconds to display clock
	*/
			function countdown2(id, timer){
				timer--;
				hourRemain = Math.floor(timer / 3600)%24;
				minRemain  = Math.floor(timer / 60 )%60;
				secsRemain = new String(timer %60);
				// Pad the string with leading 0 if less than 2 chars long
				if (secsRemain.length < 2) {
					secsRemain = '0' + secsRemain;
				}
				if (minRemain.length < 2) {
					minRemain = '0' + minRemain;
				}
				if (hourRemain.length < 2) {
					hourRemain = '0' + hourRemain;
				}

				// String format the remaining time
				clock      = hourRemain + ":" + minRemain + ":" + secsRemain;
				document.getElementById(id).innerHTML = clock;
				if ( timer > 0 ) {
					// Time still remains, call this function again in 1 sec
					setTimeout("countdown2('" + id + "'," + timer + ")", 1000);
				} else {
					document.getElementById(id).innerHTML = '0:00:00';
					//alert("Playstation Time Has ended Please Bill the Customers");
					window.location.href = "actions/ps/timerstop.php?id=" + id;
				}				
			}
			$('input').spinner();
			</script>		
			<?php  }
	} 
	

	$result = mysql_query("SELECT * FROM `reports` WHERE `session_id` = '$sess' AND `status` != 'done'");
	$counto=mysql_num_rows($result);
	if($counto>1){
		
		// mysql_connect("$host", "$user", "$pass")or die("cannot connect");
		// mysql_select_db("$db")or die("cannot select DB");
		// $result = mysql_query("SELECT * FROM `reports` WHERE session_id = '$sess'  AND status != 'done'");
		// while($row = mysql_fetch_array($result))
		// {

		// $moneyy = $row['money'];
		// }		 		 	
		$query = "SELECT  SUM(total) FROM `reports` where `session_id` = '$sess' AND `money` >0  "; 
		$resulty = mysql_query($query) or die(mysql_error());
		while($row = mysql_fetch_array($resulty)){
			if($plz=='ok'){$all = $allm;}
			$vvv = $row['SUM(total)'] + $all;
			$vvv1 = floor($vvv / 3600)%24;
			$vvv2 = floor($vvv / 60)%60;
			$vvv3 = ($vvv % 60);
		}?>				 
		<script type="text/javascript">   
		secs       =  parseInt(document.getElementById('countooo').innerHTML,10);
		setTimeout("countdown23('countooo',"+secs+")", 1000);
		/**
	* Countdown function
	* Clock count downs to 0:00 then hides the element holding the clock
	* @param id Element ID of clock placeholder
	* @param timer Total seconds to display clock
	*/
		function countdown23(id, timer){
			timer++;
			hourRemain = Math.floor(timer / 3600)%24;
			minRemain  = Math.floor(timer / 60 )%60;
			secsRemain = new String(timer %60);
			// Pad the string with leading 0 if less than 2 chars long
			if (secsRemain.length < 2) {
				secsRemain = '0' + secsRemain;
			}
			if (minRemain.length < 2) {
				minRemain = '0' + minRemain;
			}
			if (hourRemain.length < 2) {
				hourRemain = '0' + hourRemain;
			}

			// String format the remaining time
			clock      = hourRemain + ":" + minRemain + ":" + secsRemain;
			document.getElementById(id).innerHTML = clock;
			if ( timer > 0 ) {
				// Time still remains, call this function again in 1 sec
				setTimeout("countdown23('" + id + "'," + timer + ")", 1000);
			} else {
				document.getElementById(id).innerHTML = '0:00:00';
							}
		}
		$('input').spinner();
		</script>	
		<?php 
		
		// To connect to the database
		
		$result = mysql_query("SELECT * FROM `reports` WHERE `session_id` = '$sess'  AND `status` != 'done' ORDER BY Start_hour");
	?>
	<thead>
	<tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><h3><font color="#33b5e5"><?php echo $lang_338;?></font></h3></th>
</tr></thead>
<tr>
									<th><?php echo $lang_62;?></th> 
									<th><?php echo $lang_336;?></th> 
									<th><?php echo $lang_161;?></th>
									<th><?php echo $lang_339;?></th>
									<th><?php echo $lang_159;?></th>                                          
									<th><?php echo $lang_305;?></th>
</tr></thead>
 		<?php 
			while($row = mysql_fetch_array($result))
		{
			$tom = (isset($row['total']) && is_numeric($row['total'])) ? (int) $row['total'] : 0;
	$endh = $row['End_hour'] ?? '-';
	$moneyy = (isset($row['money']) && is_numeric($row['money'])) ? (float) $row['money'] : 0;

	if($endh != '-' )
	{
		$hr = floor($tom / 3600) % 24;
		$mr = floor($tom / 60) % 60;
		$sr = $tom % 60;

		$startHour = (isset($row['Start_hour']) && is_numeric($row['Start_hour'])) ? (int) $row['Start_hour'] : 0;
		$endHour = (isset($row['End_hour']) && is_numeric($row['End_hour'])) ? (int) $row['End_hour'] : 0;
		$startMinute = (isset($row['Start_minute']) && is_numeric($row['Start_minute'])) ? (int) $row['Start_minute'] : 0;
		$endMinute = (isset($row['End_minute']) && is_numeric($row['End_minute'])) ? (int) $row['End_minute'] : 0;
		$hdiff = $endHour - $startHour;
		$mdiff = $endMinute - $startMinute;
		if($mdiff < 0)
		{
			$mfiff = $mdiff + 60;
		}

		echo "<tr>";
		echo "<td><center>" . $row['name'] ."</center></td>";
		echo "<td><center>" . $row['Start_hour'].":" .$row['Start_minute']."</center></td>";
		echo "<td><center>" . $row['End_hour'].":" .$row['End_minute']."</center></td>";
		?><td><center><?php  echo $hr; ?>:<?php  echo $mr; ?>:<?php  echo $sr; ?></center></td><?php 
		echo "<td><center>" . $row['type'] ."</center></td>";
		if($moneyy > 0)
		{
			echo "<td><center>" . $row['money'] ." ".$lang_100. "</center></td>";
		}
		else	 {
			echo "<td><center>".$lang_340."</center></td>";
		}

		echo "</tr>";
	}
}		}  	


$sql="SELECT * FROM `ps_orders` where `ps_id` = '$id' AND `status` = 'no' AND session_id = '$sess'";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{
	$Itemmn = $row['order_id'];	 
	
}
if(isset($Itemmn))
{
 ?>
	 <thead><tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><center><h3><font color="#33b5e5"><?php echo $lang_341;?></font> <a href="JavaScript:newPopup('actions/print/view_orders.php?Receipt=<?php  echo $sess;?>&&id=<?php echo $id;?>');"><img src="img/app/devices/print.png" width="20" height="20"/></a></h3></center></th>
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


	$sql="SELECT *,SUM(num),SUM(price) FROM `ps_orders` where `ps_id` = '$id' AND `status` = 'no' AND session_id = '$sess' GROUP BY name";
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
			<a  onclick="return confirm('<?php echo $lang_244;?>')" style="color:#f1f1f1; font-size:8pt;text-decoration:none;" href="devices_ps.php?id=<?php  echo $id;?>&&Item=<?php  echo $Item;?>&&dename=<?php  echo $delete_name;?>&&nn=<?php  echo $denum; ?>&&sesss=<?php echo $sess?>" ><?php echo $lang_167;?></a>
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
<td colspan="3"><h1><font color="red" ><?php echo $vvv1;?>:<?php echo $vvv2;?>:<?php echo $vvv3;?><a href="devices_ps.php?id=<?php echo $id;?>"></font><img src="img/reload.png" width="25" height="25"></a></h1>
</td>
</tr>
<?php 
}
	$query = "SELECT  SUM(money) FROM `reports` where `session_id` = '$sess'"; 
		
		$resulty = mysql_query($query) or die(mysql_error());

		// Print out result
		while($row = mysql_fetch_array($resulty)){
			$hyyh = $row['SUM(money)'];
 		}}
			$query = "SELECT  SUM(price) FROM `ps_orders` where `ps_id` = '$id' AND `status` = 'no'  AND session_id = '$sess'"; 
	 
$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){
      $items = $row['SUM(price)'];
}	
 
		 
if($min_time == 'True'){
	if($all < 900)
	{
 	//$all = 900;
	// echo $thetype;
	if($thetype == 'single')
	{$total_price = $single / 4;}
	else if($thetype == 'multi')
	{$total_price = $multi / 4;}
	else if($thetype == 'multi6')
	{$total_price = $multi6 / 4;}
	else if($thetype == 'multi7')
	{$total_price = $multi7 / 4;}
	
	}
 ?>
<tr>
<td colspan="3">أقل وقت للعب(ربع ساعة)</td>
<td colspan="3"><h2><font color="red" ><?php  echo ceil_to_five($total_price);?></font> <?php echo $lang_100;?>
 </h2></td>
</tr>
<?php }?>	
<tr>
<td colspan="3"><?php echo $lang_181;?></td>
<td colspan="3"><h3><font color="yellow" ><?php  $tt = ceil_to_five($hyyh + $items + $total_price); 
echo $tt;
 $timme = ceil_to_five($total_price);?>
</font> <?php echo $lang_100;?></h3>
</td>
</tr>
<?php 
if($dis>0){?>
<tr>
<td colspan="3"> <?php echo $lang_182;?></td>
<td colspan="3"><h2><font color="red" ><?php  echo $dis;?></font> % <?php  $after_discount = $tt - ($tt * ($dis / 100)) ?> ... (<font color="yellow" ><?php 
	$exact_discount = $tt-$after_discount;
	echo ceil($exact_discount);?> </font><?php echo $lang_100;?>)<a href="devices_ps.php?id=<?php echo $id?>&del_dis=yes&del_dsess=<?php echo $sess?>" onclick="return confirm('<?php echo $lang_244;?>')"><span class="btn-danger" style="font-size:12px;"><?php  echo $lang_167;?></span></a></h2>
</td>
</tr>
<?php }else{?>
<tr>
<td colspan="3"><?php echo $lang_182;?></td>
<td colspan="3"><h2><font color="red" ><?php  echo $dis2;?></font> <?php echo $lang_100;?> <?php  $after_discount = $tt - $dis2 ?><a href="devices_ps.php?id=<?php echo $id?>&del_dis=yes&del_dsess=<?php echo $sess?>" onclick="return confirm('<?php echo $lang_244;?>')"><button class="btn btn-danger" style="margin:7px 0 0 0;padding:0px;"><?php  echo $lang_167;?></button></a></h2></td>
</tr>
<?php }?>
<?php  $after_fees = $after_discount;
$calc_tax = 0;
$calc_serv = 0;
 ?>
<?php if($service_ch == 'True'){ 
$calc_serv = ($after_fees * $service)/100;
?>
<tr>
<td colspan="3">الخدمة (<?php echo $service;?>)%</td>
<td colspan="3"><h2><font color="red" ><?php  echo $calc_serv;?></font> <?php echo $lang_100;?> <?php  $after_discount = $tt - $dis2 ?> </h2></td>
</tr>
<?php }
if($tax_ch == 'True'){
$calc_tax = ($after_fees * $tax)/100;
	?>
<tr>
<td colspan="3">الضريبة (<?php echo $tax;?>)%</td>
<td colspan="3"><h2><font color="red" ><?php  echo $calc_tax;?></font> <?php echo $lang_100;?> <?php  $after_discount = $tt - $dis2 ?> </h2></td>
</tr>
<?php 
}
$echo_fees = $after_fees + $calc_serv + $calc_tax;
$final_total = ceil_to_five($echo_fees);
?>
<tr>
<td colspan="3"><?php echo $lang_106;?></td>
<td colspan="3"><h2><font color="yellow" size="10" ><?php  echo $final_total;?></font> <?php echo $lang_100;?></h2></td>
</tr>
 	</tbody>
	</table> 


			 
<table class="table table-bordered table-striped table-condensed span6" >
<thead>
<tr>
<th colspan="6" style="border-top:1px solid #33b5e5;border-bottom:1px solid #808080;" ><center><h3><font color="#33b5e5"><?php echo $lang_142;?></font></h3></center></th>
</tr>
</thead>

<?php 
if($plz=='ok'){$all = $allm;}

$add_note = $_POST['add_note'];
$ssaa = $_POST['ssaa'];
if(isset($add_note))
{
	if($add_note != $pnote)
	{
		mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
		mysql_select_db("$db") or die(mysql_error()); 
		mysql_query("UPDATE `devices` set `notes` = '$add_note'  WHERE `id` = '$id';"); 
		mysql_query("UPDATE `reports` set `cnote` = '$add_note'  WHERE `session_id` = '$ssaa';"); 
}}
$sql="SELECT * FROM `devices` where `id` = $id";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{
$pnotea = $row['notes'];
$Cu_Cu = $row['Current Price'];
}
?>
<tr>
<td colspan="6">
<form action="devices_ps.php?id=<?php echo $id;?>" method="POST">
<textarea name="add_note" style="width:80%;" placeholder="<?php echo $lang_406;?>"><?php echo $pnotea;?></textarea>
<input type="hidden" name="ssaa" value="<?php echo $sess;?>">
<button class="btn-primary" style="padding: 13px 10px 13px 10px;"><?php echo $lang_395;?></button>
</form>
</td>
</tr>
<?php 

if($Cu_Cu != ''){
	
	?>
<tr>
 <td> <?php echo $lang_424;?> </td>
<td>
<?php  
$sql="SELECT * FROM `members` where `id` = $Cu_Cu";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{
$Vmember_name = $row['name'];	
$Vmember_Points = $row['points'];	
}
?>
<h3><?php echo $lang_21;?>: <?php echo $Vmember_name;?><h3>
<h3><?php echo $lang_39;?>: <?php echo $Vmember_Points?><h3>
</td>
<td><a href="devices_ps.php?id=<?php echo $id;?>&&unassign=true" class="btn btn-danger"><?php echo $lang_425;?></a></td>
</tr>
<?php }else{?>
<tr>
<form method="POST" action="devices_ps.php?id=<?php echo $id;?>" id="changer8" onsubmit="document.getElementById('change_btn8').disabled = true;"> 
<td> <?php echo $lang_422;?> </td>
<td> <input type = "text" name="assign"  placeholder = "<?php echo $lang_192;?>" required="" /></td>
<td><button class="btn btn-primary" id="change_btn8" ><?php echo $lang_423;?></button></td>
 </form></tr>
 <tr>
<?php }?>
<form method="POST" action="actions/ps/barcode.php?ps_id=<?php echo $id;?>&&session=<?php echo $sess;?>" id="changer7" onsubmit="document.getElementById('change_btn7').disabled = true;"> 
<td> <?php echo $lang_344;?><img src="img/app/devices/bar.png" height="39" width="70"></td>
<td> <input type = "text" name="Search_bar"  placeholder = "<?php echo $lang_345;?>" required="" /></td>
<td><button class="btn btn-success" id="change_btn7" ><?php echo $lang_32;?></button></td>
 </form></tr>

<form method="POST" action="actions/ps/order_add.php" id="changer6" onsubmit="document.getElementById('change_btn6').disabled = true;"> 
 <?php 

$result = mysql_query("SELECT * FROM `stock` WHERE name!='' GROUP BY name having SUM(stock)-SUM(sold) >0");
?>
<td> <?php echo $lang_405;?></td>
<td> <input list="ttt" name="item[0][namee]"  placeholder = "<?php echo $lang_405;?>" required="" autocomplete="off"/>
<input type="number" name="gqty" style="width:70px" placeholder="البحث عن أصناف" value="1"/>
</td>
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<input type="hidden" name="s" value="<?php echo $sess;?>">
<input type="hidden" name="search" value="yes">
<datalist id="ttt">
<?php while($row = mysql_fetch_array($result))
  {?>
<option value="<?php echo $row['name'];?>">
 <?php }?></datalist>
<td><button class="btn btn-success" id="change_btn6" ><?php echo $lang_32;?></button></td>
  </form></tr>
<?php 


// To connect to the database

$now = $_SESSION['ps_user'];
$sql="SELECT * FROM `users` WHERE `Username` = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
}
if($usern   >=0 )
{

	if($dis ==0&&$dis2==0)
	{
		?>
		<tr>
		<form method="POST" id="changer5" onsubmit="document.getElementById('change_btn5').disabled = true;" action="devices_ps.php?id=<?php echo $id;?>&dis=true"> 
		<td><?php echo $lang_182;?>: </td>
		<td>
			<div class="controls">
				<div class="input-append">
				{
					<input id="appendedInput" size="12" type="number"  name="discount_value" max="100" min="1" placeholder="<?php echo $lang_364;?>"><span class="add-on">%</span>
					<?php echo $lang_347;?>
					<input id="appendedInput" size="12" type="number" placeholder="<?php echo $lang_23;?>" name="discount_value2" min="1" max="<?php echo $after_fees;?>"><span class="add-on"><?php echo $lang_100;?></span>
				}	
					<input type="text"   placeholder="<?php echo $lang_153;?>" name="discount_reason" required />
				</div> 
			</div>
		
		 
<td><button class="btn btn-success" id="change_btn5"  ><?php echo $lang_348;?></button></td>
		 
		<input name="diss_sess" value="<?php echo $sess;?>" type="hidden"></form></tr>
		<?php  }}?>
<tr><form action="actions/ps/type.php" id="changer4" onsubmit="document.getElementById('change_btn4').disabled = true;" method="POST" >	<div class="controls">	
<input type="hidden" name="change_id" value="<?php  echo $id;?>"	/>	
<input type="hidden" name="change" value="true"	/>	
<input type="hidden" name="sess_change" value="<?php  echo $sess;?>"	/>	
<input type="hidden" name="noo3_change" value="<?php  echo $timetype;?>"	/>	
<input type="hidden" name="name_change" value="<?php  echo $dName;?>"	/>	
<input type="hidden" name="time_change" value="<?php  echo $timme;?>"	/>	
<input type="hidden" name="seconds" value="<?php  echo $all;?>"	/>	
<td><center><?php echo $lang_349;?></center></td>
<td valign="middle"><center>
<select   name="type_change"  required=""/>
		<option value="single"><?php echo $lang_3;?></option>
		<option value="multi"><?php echo $lang_4;?></option>
		<option value="multi6"><?php echo $lang_6;?></option>
		<option value="multi7"><?php echo $lang_7;?></option> 

</select></center> </td>
<td  valign="center"><center><button class="btn btn-warning" id="change_btn4" ><?php echo $lang_200;?></button></td>
  </center> 
</div>
</form> 
</tr>
<?php  

$sql="SELECT * FROM `devices` WHERE `ID` = '$id'";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{ 
	$whattype =	$row['timetype'];							 
	$whathour =	$row['hour'];							 
	$whatminute=$row['minute'];							 
} 
if($whattype =='unlimited' ){
	?>
	<form action="devices_ps.php?id=<?php echo $id;?>" id="changer3" onsubmit="document.getElementById('change_btn3').disabled = true;" method="POST"><tr>
	<td><?php echo $lang_350;?></td>
	<input type="hidden" name="change_type" value="totime">
	<input type="hidden" name="start_hour" id="start_hour" value="<?php echo $whathour;?>">
	<input type="hidden" name="start_minute" id="start_minute" value="<?php echo $whatminute;?>">
	<td><input type="number" name="set_ho" placeholder="<?php echo $lang_10;?>" min="0" max="10" required=""/>
	<input type="number" name="set_mi" Placeholder="<?php echo $lang_11;?>" min="0" max="59" step="1" required=""/></td>
	<td ><button class="btn btn-warning" id="change_btn3" ><?php echo $lang_200;?></button></td>	
	</tr></form><?php }
else if($whattype =='time' ){
	?>
	<form action="devices_ps.php?id=<?php echo $id;?>" onsubmit="document.getElementById('change_btn2').disabled = true;" method="POST"><tr>
	<input type="hidden" name="change_type" value="toun">
	<td><?php echo $lang_350;?></td>
	<td> <input name="set_un" type="text" value="unlimited" readonly></td>
<td  valign="center"><center><button class="btn btn-warning" id="change_btn2"><?php echo $lang_194;?></button></td>
	</tr></form>
	<?php }?>
 
<tr>
<td><?php echo $lang_351;?></td>
<td>
<form action="actions/ps/transfer.php" id="changer" method="POST" >	<div class="controls">	
<input type="hidden" name="old_id" value="<?php  echo $id;?>"	/>	
<input type="hidden" name="barca" value="<?php  echo $all;?>"	/>	
<input type="hidden" name="old_timetype" value="<?php  echo $timetype;?>"	/>	
<input type="hidden" name="mon" value="<?php  echo $timme;?>"	/>	
<?php 	 

$sql="SELECT * FROM `devices` WHERE `Device Status` = 'Off'";
 $result=mysql_query($sql);

  $numx=mysql_num_rows($result);
	if(empty($numx)){
$disa = 'disabled';}
	?>
<select name="new_id" <?php echo $disa;?> required>

<?php 	 

$sql="SELECT * FROM `devices` WHERE `Device Status` = 'Off'";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{?>
	<option value='<?php echo $row['ID'];?>'><?php  echo $row['Device Name']; ?></option>
	<?php  } ?>
</select>
</div>
</td>

<td  valign="middle"><center><button id="change_btn" onclick="document.getElementById('change_btn').disabled = true;document.getElementById('changer').submit();" class="btn btn-warning" <?php echo $dis;?>><?php echo $lang_200;?></button></td>
</form>
</tr>
</table> 




 
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
			$result = mysql_query("SELECT * FROM `ps_orders` WHERE `catagory` = 'drinks' AND `ps_id` = '$id' AND status = 'no'", $link);
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
			$result = mysql_query("SELECT * FROM `ps_orders` WHERE `catagory` = 'food'  AND `ps_id` = '$id' AND `status` = 'no'", $link);
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
			$result = mysql_query("SELECT * FROM `ps_orders` WHERE `catagory` = 'choc'  AND `ps_id` = '$id' AND `status` = 'no'", $link);
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
			$result = mysql_query("SELECT * FROM `ps_orders` WHERE `catagory` = 'general'  AND `ps_id` = '$id' AND `status` = 'no'", $link);
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
<button type="button" class="close" data-dismiss="modal">x</button>
<h3><?php echo $lang_352;?></h3>
</div>
<div class="modal-body" style="    max-height: 528px;">
<p><?php //echo $lang_353;?></p>

<h3><?php echo $lang_354;?></h3>
<script type="text/javascript">
 function discount(x)
{
   var discount = document.getElementById("discount");
   if(isNaN(discount.value))
   discount.value = 0;
   discount.value = (discount.value * 10)+x;
}
 function discount2(x)
{
   var discount2 = document.getElementById("discount2");
   if(isNaN(discount2.value))
   discount2.value = 0;
   discount2.value = (discount2.value * 10)+x;
}
 function number_write(x)
{
  var text_box = document.getElementById("number");
  var change = document.getElementById("change");
   if(x>=0 && x<=9)
  {
    if(isNaN(text_box.value))
   text_box.value = 0;
    if(isNaN(change.value))
   change.value = 0;
   text_box.value = (text_box.value * 10)+x;
   change.value = text_box.value - <?php echo $after_discount;?>;
     $("#change").text(change.value);
     $("#number2").text(text_box.value);

   }
}
function number_clear()
{
  document.getElementById("number").value = 0;
     $("#change").text(0);
 }
function number_c()
{
  var text_box = document.getElementById("number");
  var num = text_box.value;
  var num1 = num%10;
  num -= num1;
  num /= 10;
  text_box.value = num;
   $("#change").text(text_box.value - <?php echo $after_discount;?>);

}

</script>
<style type="text/css">
.main_panel
{
    width: 200px;
    height: 350px;
background-color:#33b5e5;
border-top-right-radius:7px;
border-top-left-radius:7px;
border-bottom-right-radius:7px;
border-bottom-left-radius:7px;
border: #b7b7b7 solid 10px;
padding:10px;
}
.number_button
{
width:50px;
height:50px;
margin:10px 5px 5px 5px;
float:left;
 background-color:#d6d6d6;
border-top-right-radius:50%;
border-top-left-radius:50%;
border-bottom-right-radius:50%;
border-bottom-left-radius:50%;
font-size:29px;
text-align:center;
line-height:45px;
}
.number_button:hover
{
background-color:#b6b6b6;
    cursor:pointer;

}
.text_box
{
width:180px; 
height:35px;
font-size:25px;
border:none;
text-align:right;
margin-bottom:15px;
}
</style>
<table style="margin-left:0px;float:left;">
									 
									
<?php 
if($min_time == 'True'){
	if($all < 900)
	{
 	//$all = 900;
	echo $thetype;
	if($thetype == 'single')
	{$total_price = $single / 4;}
	else if($thetype == 'multi')
	{$total_price = $multi / 4;}
	else if($thetype == 'multi6')
	{$total_price = $multi6 / 4;}
	else if($thetype == 'multi7')
	{$total_price = $multi7 / 4;}
	
	}
 ?>
<tr>
<td colspan="3">أقل وقت للعب(ربع ساعة)</td>
<td colspan="3"><h2><font color="red" ><?php  echo ceil_to_five($total_price);?></font> <?php echo $lang_100;?>
 </h2></td>
</tr>
<?php }		?>							
	<tr>
<td colspan="3"><?php echo $lang_181;?></td>
<td colspan="3"><h3><font color="yellow" ><?php  $tt = ceil_to_five($hyyh + $items + $total_price); echo $tt; $timme = ceil_to_five($total_price);?></font> <?php echo $lang_100;?></h3>
</td>
</tr>
<?php 
if($dis>0){?>
<tr>
<td colspan="3"> <?php echo $lang_182;?></td>
<td colspan="3"><h2><font color="red" ><?php  echo $dis;?></font> % <?php  $after_discount = $tt - ($tt * ($dis / 100)) ?> ... (<font color="yellow" ><?php 
	$exact_discount = $tt-$after_discount;
	echo ceil($exact_discount);?> </font><?php echo $lang_100;?>)<a href="devices_ps.php?id=<?php echo $id?>&del_dis=yes&del_dsess=<?php echo $sess?>" onclick="return confirm('<?php echo $lang_244;?>')"><span class="btn-danger" style="font-size:12px;"><?php  echo $lang_167;?></span></a></h2>
</td>
</tr>
<?php }else{?>
<tr>
<td colspan="3"><?php echo $lang_182;?></td>
<td colspan="3"><h2><font color="red" ><?php  echo $dis2;?></font> <?php echo $lang_100;?> <?php  $after_discount = $tt - $dis2 ?><a href="devices_ps.php?id=<?php echo $id?>&del_dis=yes&del_dsess=<?php echo $sess?>" onclick="return confirm('<?php echo $lang_244;?>')"><button class="btn btn-danger" style="margin:7px 0 0 0;padding:0px;"><?php  echo $lang_167;?></button></a></h2></td>
</tr>
<?php }?>
<?php  $after_fees = $after_discount;
$calc_tax = 0;
$calc_serv = 0;
 ?>
<?php if($service_ch == 'True'){ 
$calc_serv = ($after_fees * $service)/100;
?>
<tr>
<td colspan="3">الخدمة (<?php echo $service;?>)%</td>
<td colspan="3"><h2><font color="red" ><?php  echo $calc_serv;?></font> <?php echo $lang_100;?> <?php  $after_discount = $tt - $dis2 ?> </h2></td>
</tr>
<?php }
if($tax_ch == 'True'){
$calc_tax = ($after_fees * $tax)/100;
	?>
<tr>
<td colspan="3">الضريبة (<?php echo $tax;?>)%</td>
<td colspan="3"><h2><font color="red" ><?php  echo $calc_tax;?></font> <?php echo $lang_100;?> <?php  $after_discount = $tt - $dis2 ?> </h2></td>
</tr>
<?php 
}
$echo_fees = $after_fees + $calc_serv + $calc_tax;
$final_total = ceil_to_five($echo_fees);
?>
<tr>
<td colspan="3"><?php echo $lang_106;?></td>
<td colspan="3"><h2><font color="yellow" size="10" ><?php  echo $final_total;?></font> <?php echo $lang_100;?></h2></td>
</tr>	
<tr>
<td><h3>المدفوع: </h3></td>
<td><h3 ><font color="red"><span id="number2">0</span></font> <?php echo $lang_100;?></h3></td>
</tr>
<tr>
<td><h3>الباقي: </h3></td>
<td><h3 ><font color="red"><span id="change">0</span></font> <?php echo $lang_100;?></h3></td>
</tr>
 

<tr>
<td colspan="2">
 <form action="actions/ps/close.php" method="POST">
<input type="hidden" name="action" value="close"/>
<input type="hidden" name="id" value="<?php  echo $id;?>"/>
<input type="hidden" name="session" value="<?php  echo $sess; ?>"/>
<input type="hidden" name="wanted" value="<?php  echo $timme; ?>"/>
<input type="hidden" name="name" value="<?php  echo $dName; ?>"/>
<input type="hidden" name="seconds" value="<?php  echo $all;?>"/>
<input type="hidden" name="tdis" value="<?php echo $dis;?>"/>
<input type="hidden" name="exact_discount" value="<?php echo $exact_discount;?>"/>
<input type="hidden" name="calc_serv" value="<?php echo $calc_serv;?>"/>
<input type="hidden" name="calc_tax" value="<?php echo $calc_tax;?>"/>
<button style=" background: none;
    color: inherit;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    outline: inherit;" ><img src="img/app/buttons/stop.png" /></button>
	<p>(يمكنك الإنهاء بدون تحديد المدفوع)</p>
</form>
</td>
</tr>
							
									</table>

 <div class="main_panel">
<br /> 
<center><input style="background-color:#fff;    font-size: 5.2em;
    height: 55px;" class="text_box" type="text" id="number" name="num" autocomplete="off" readonly /></center>
 <div class="number_button" onclick="number_write(1);">1</div>
<div class="number_button" onclick="number_write(2);">2</div>
<div class="number_button" onclick="number_write(3);">3</div>
<div class="number_button" onclick="number_write(4);">4</div>
<div class="number_button" onclick="number_write(5);">5</div>
<div class="number_button" onclick="number_write(6);">6</div>
<div class="number_button" onclick="number_write(7);">7</div>
<div class="number_button" onclick="number_write(8);">8</div>
<div class="number_button" onclick="number_write(9);">9</div>
<div class="number_button" onclick="number_clear();">C</div>
<div class="number_button" onclick="number_write(0);">0</div>
<div class="number_button" onclick="number_c();">&larr;</div>
</div>

		 
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
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_ps.php?id=<?php echo $id;?>&&add_item=true&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
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
 
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE catagory = '$acat' AND sub_cat = '$asub_cat' AND name !=' ' GROUP BY name ORDER BY name ASC");
 ?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								  <!--<th><?php // $lang_113;?></th>-->
</tr>
</thead>
<tbody>
<form action="actions/ps/order_add.php" method="POST">
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
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_ps.php?id=<?php echo $id;?>&&add_item=true&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
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
 
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE `catagory` = 'general' AND `name` !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								   
</tr></thead><tbody>
<form action="actions/ps/order_add.php" method="POST">
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
 
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE `catagory` = 'choc' AND `name` !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								  <th><?php echo $lang_113;?></th>
</tr></thead><tbody>
<form action="actions/ps/order_add.php" method="POST">
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
 <script>

$(document).ready(function() {
 
});


 </script>
<?php  include 'includes/js.php';?>
<script>
 
</script>

</body>
</html>
