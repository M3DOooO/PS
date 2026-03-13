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
$Year = idate('Y');
$today =  $shift_day;
$this_month =  $shift_month;
$Rcash = isset($_GET['cashier']) ? $_GET['cashier'] : $now;

$one = 0;
$two = 0;
$three = 0;
$four = 0;
$five = 0;
$ds2 = 0;
$ds3 = 0;
$ds5 = 0;

$resulty = mysql_query("SELECT SUM(money) AS total_money FROM reports WHERE day = '$today' AND month = '$this_month' AND year = '$Year' AND status = 'done' AND casheer = '$Rcash'") or die(mysql_error());
while($row = mysql_fetch_array($resulty)){$one = $row['total_money'];}

$resulty = mysql_query("SELECT SUM(discount2) AS total_discount FROM reports WHERE day = '$today' AND month = '$this_month' AND year = '$Year' AND status = 'done' AND casheer = '$Rcash'") or die(mysql_error());
while($row = mysql_fetch_array($resulty)){$ds2 = $row['total_discount'];}

$resulty = mysql_query("SELECT SUM(discount_amount) AS total_discount_amount FROM reports WHERE day = '$today' AND month = '$this_month' AND year = '$Year' AND status = 'done' AND casheer = '$Rcash'") or die(mysql_error());
while($row = mysql_fetch_array($resulty)){$ds3 = $row['total_discount_amount'];}

$resulty = mysql_query("SELECT SUM(discount2) AS total_reports_discount FROM reports2 WHERE day = '$today' AND month = '$this_month' AND year = '$Year' AND casheer = '$Rcash' AND status = 'done'") or die(mysql_error());
while($row = mysql_fetch_array($resulty)){$ds5 = $row['total_reports_discount'];}

$resulty = mysql_query("SELECT SUM(price) AS total_orders FROM ps_orders WHERE day = '$today' AND month = '$this_month' AND year = '$Year' AND casheer = '$Rcash' AND status ='yes'") or die(mysql_error());
while($row = mysql_fetch_array($resulty)){$two = $row['total_orders'];}

$resulty = mysql_query("SELECT SUM(price) AS total_takeaway FROM reports2 WHERE day = '$today' AND month = '$this_month' AND year = '$Year' AND notes = 'order' AND status = 'done' AND casheer = '$Rcash'") or die(mysql_error());
while($row = mysql_fetch_array($resulty)){$three = $row['total_takeaway'];}

$resulty = mysql_query("SELECT SUM(price) AS total_expenses FROM reports2 WHERE day = '$today' AND month = '$this_month' AND year = '$Year' AND catagory = 'exp' AND casheer = '$Rcash' AND status ='done'") or die(mysql_error());
while($row = mysql_fetch_array($resulty)){$four = $row['total_expenses'];}

$resulty = mysql_query("SELECT SUM(price) AS total_in FROM reports2 WHERE day = '$today' AND month = '$this_month' AND year = '$Year' AND catagory = 'in' AND casheer = '$Rcash' AND status ='done'") or die(mysql_error());
while($row = mysql_fetch_array($resulty)){$five = $row['total_in'];}

$all = (float)$one + (float)$two + (float)$three + (float)$five - (float)$four - (float)$ds2 - (float)$ds3 - (float)$ds5;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>تقرير الكاشير</title>
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
</head>
<body>
<?php include('includes/navbar.php');?>
<div class="container-fluid">
<div class="row-fluid">
<?php include('includes/menu.php');?>
<div id="content" class="span10">
	<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
		<span>تقرير الكاشير</span> / <span><?php echo $Rcash;?></span>
	</div>
	<div class="row-fluid" style="margin-top:20px;">
		<div class="box span6" style="float:none;margin:0 auto;">
			<div class="box-header well"><h2>حساب الكاشير الحالي</h2></div>
			<div class="box-content" style="text-align:center;">
				<h3><?php echo $lang_262;?> <?php echo $Year?>/<?php echo $this_month?>/<?php echo $today?></h3>
				<h1 style="color:green;"> <?php echo number_format($all,2);?> <?php echo $lang_100;?></h1>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</body>
</html>
