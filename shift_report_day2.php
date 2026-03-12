<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
 
 $casheer = $_SESSION['ps_user'];

include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}
 
$id = $_GET['id'];  $id = $_GET['id']; 
 $date = $_GET['date']; 
 $sess = $_GET['session']; 
  
 $report_day =  idate('d');
 $report_month =  idate('m');
 
   $D = $_GET['day'];
   $M = $_GET['month'];
   $Y = $_GET['year'];
   mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$now = $_SESSION['ps_user'];
$sql="SELECT * FROM users WHERE Username = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
	$usershift = $row['shift'];
}
if($usern != 1 ){
	if($D != $shift_day){
	echo "<script>location='devices.php'</script>";
	}
	}
	 if($usershift == '1'){$selectshift = "One";}
else if($usershift == '2'){$selectshift = "Two";}
else if($usershift == '3'){}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title><?php echo $lang_271;?></title>
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
			<!-- content starts -->

<div class="row-fluid sortable">		
				<div class="box span10">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $lang_271;?> </h2>
						
					</div>
 					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$query = "SELECT  SUM(money) FROM reports where day = '$D' AND month = '$M' AND year = '$Y' AND status = 'done' AND shift = '$selectshift'"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
$money_1 = $row['SUM(money)'];
}
$query = "SELECT  SUM(price) FROM reports2 where day = '$D' AND month = '$M' AND year = '$Y' AND catagory !='exp' AND status = 'done' AND shift = '$selectshift'"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
$money_2 = $row['SUM(price)'];
}
$query = "SELECT  SUM(price) FROM ps_orders where day = '$D' AND month = '$M' AND year = '$Y' AND shift !=''  AND shift = '$selectshift'"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
$money_3 = $row['SUM(price)'];
}
$result33 = mysql_query("SELECT SUM(discount2) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y' AND shift = '$selectshift' AND status = 'done'");
while($row33 = mysql_fetch_array($result33))
{
$disdis = $row33['SUM(discount2)'];
}
$query = "SELECT  SUM(price) FROM reports2 where day = '$D' AND month = '$M' AND year = '$Y' AND catagory ='exp' AND shift = '$selectshift'"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
$money_4 = $row['SUM(price)'];
}
$query = "SELECT  SUM(discount2) FROM reports where day = '$D' AND month = '$M' AND year = '$Y' AND status = 'done' AND shift = '$selectshift'"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
$money_5 = $row['SUM(discount2)'];
}
$query = "SELECT  SUM(discount_amount) FROM reports where day = '$D' AND month = '$M' AND year = '$Y' AND status = 'done' AND shift = '$selectshift'"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
$money_6 = $row['SUM(discount_amount)'];
}
$money_all = $money_1 +$money_2 +$money_3 -$money_4 - $money_5 - $money_6;- $disdis 
?>

<h2><?php echo $lang_106;?> : <font color='green'><?php echo $money_all;?></font> <?php echo $lang_100;?> </h2> 
	
	
	
<?php  
 if($money_1 > 0)
{
 ?><thead>
<tr>
                                  <th><?php echo $lang_150;?></th>
								  <th><?php echo $lang_99;?></th>
								  <th><?php echo $lang_101;?></th>
								  <th><?php echo $lang_102;?></th>
								  <th><?php echo $lang_103;?></th>
								  <th><?php echo $lang_104;?></th>
								  <th><?php echo $lang_105;?></th>
								  <th><?php echo $lang_106;?></th>
								  <th><?php echo $lang_107;?></th>
</tr>
</thead> 	  				   
						<tbody>
						<?php 	
// الوقت
$result = mysql_query("SELECT *,SUM(money) FROM `reports` WHERE day = '$D' AND month = '$M'  AND year = '$Y' AND End_hour != '-' AND status = 'done'  AND shift = '$selectshift' GROUP BY shift");						
while($row = mysql_fetch_array($result))
{
	
	$money1 = $row['SUM(money)'];
	$shift = $row['shift'];

	 // المصاريف
$result2 = mysql_query("SELECT *,SUM(price) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND catagory ='exp'  AND shift = '$selectshift'");
while($row2 = mysql_fetch_array($result2))
{
$money4 = $row2['SUM(price)'];
}	
     //المشتروات غير المصاريف
$result3 = mysql_query("SELECT *,SUM(price) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND catagory !='exp' AND catagory !='in'  AND shift = '$selectshift' AND status = 'done'");
while($row3 = mysql_fetch_array($result3))
{
$money2 = $row3['SUM(price)'];
}
$result33 = mysql_query("SELECT SUM(discount2) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y' AND shift = '$selectshift' AND status = 'done'");
while($row33 = mysql_fetch_array($result33))
{
$disdis = $row33['SUM(discount2)'];
}
     //الأوردرات
$result4 = mysql_query("SELECT *,SUM(price) FROM `ps_orders` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND shift = '$selectshift'");
while($row4 = mysql_fetch_array($result4))
{
$money3 = $row4['SUM(price)'];
}
     //الخصم
$result5 = mysql_query("SELECT SUM(discount2) FROM `reports` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND shift = '$selectshift' AND status = 'done'");	
while($row5 = mysql_fetch_array($result5))
{
$money5 = $row5['SUM(discount2)'];
} 
     //الخصم 2
$result6 = mysql_query("SELECT SUM(discount_amount) FROM `reports` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND shift = '$selectshift' AND status = 'done'");
while($row6 = mysql_fetch_array($result6))
{
$money6 = $row6['SUM(discount_amount)'];
}
     //المشتروات غير المصاريف
$result7 = mysql_query("SELECT SUM(price) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y'   AND catagory ='in'  AND shift = '$selectshift' AND status = 'done'");
while($row7 = mysql_fetch_array($result7))
{
$money7 = $row7['SUM(price)'];
}
 $shift_check = $row['shift'];
 
  
 		
  echo "<tr>";
 if($shift_check == 'One'){$shift_check2= $lang_155;}else{$shift_check2 = $lang_156;}

   echo "<td><h3>" . $shift_check2 . "</h3></td>";

                  $moneyall = $money1 + $money2 + $money3 - $money4 - $money5 - $money6 + $money7- $disdis;
	              
?>
<td><h3><font color="green"><?php echo $money1;?></font></h3></td>
<td><h3><font color="green"><?php echo $money3;?></font></h3></td>
<td><h3><font color="green"><?php echo $money2;?></font></h3></td>
<td><h3><font color="green"><?php echo $money7;?></font></h3></td>
<td><h3><font color="red"><?php echo $money4;?></font></h3></td>
<td><h3><font color="red"><?php echo $money5+$money6+$disdis;?></font></h3></td>
<td><h2><?php echo $moneyall;?></h2></td>
<td><a href="reports_day_shift_all.php?se_day=<?php echo $D;?>&se_month=<?php echo $M;?>&se_year=<?php echo $Y;?>&se_shift=<?php echo $shift_check;?>"><img src="img/app/buttons/info.png"></a></td>
<?php 
      echo "</tr>";
  ?>
						  </tbody>
<?php  }} else{
?><thead>
<tr>
                                  <th><?php echo $lang_150;?>yy</th>
								  <th><?php echo $lang_99;?></th>
								  <th><?php echo $lang_101;?></th>
								  <th><?php echo $lang_102;?></th>
								  <th><?php echo $lang_103;?></th>
								  <th><?php echo $lang_104;?></th>
								  <th><?php echo $lang_105;?></th>
								  <th><?php echo $lang_106;?></th>
								  <th><?php echo $lang_107;?></th>
</tr>
</thead> 	  				   
						<tbody>
						<?php 	
// الوقت
$result = mysql_query("SELECT *,SUM(money) FROM `reports` WHERE day = '$D' AND month = '$M'  AND year = '$Y' AND End_hour != '-' AND status = 'done'  AND shift = '$selectshift' GROUP BY shift");		
$result = mysql_query("SELECT *,SUM(price) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND catagory !='exp' AND catagory !='in'  AND status = 'done'  AND shift = '$selectshift' GROUP BY shift");
				
while($row = mysql_fetch_array($result))
{
	$money1 = 0;
	$shift = $row['shift'];
	 // المصاريف
$result2 = mysql_query("SELECT *,SUM(price) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND catagory ='exp'  AND shift = '$selectshift'");
while($row2 = mysql_fetch_array($result2))
{
$money4 = $row2['SUM(price)'];
}	
     //المشتروات غير المصاريف
$result3 = mysql_query("SELECT *,SUM(price) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND catagory !='exp' AND catagory !='in'  AND shift = '$selectshift' AND status = 'done'");
while($row3 = mysql_fetch_array($result3))
{
$money2 = $row3['SUM(price)'];
}
$result33 = mysql_query("SELECT SUM(discount2) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y' AND shift = '$selectshift' AND status = 'done'");
while($row33 = mysql_fetch_array($result33))
{
$disdis = $row33['SUM(discount2)'];
}
     //الأوردرات
$result4 = mysql_query("SELECT *,SUM(price) FROM `ps_orders` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND shift = '$selectshift'");
while($row4 = mysql_fetch_array($result4))
{
$money3 = 0;
}
     //الخصم
$result5 = mysql_query("SELECT SUM(discount2) FROM `reports` WHERE day = '$D' AND month = '$M'  AND year = '$Y'  AND shift = '$selectshift' AND status = 'done'");	
while($row5 = mysql_fetch_array($result5))
{
$money5 = $row5['SUM(discount2)'];
} 
     //الخصم 2
$result6 = mysql_query("SELECT SUM(discount_amount) FROM `reports` WHERE day = '$D' AND month = '$M'  AND year = '$Y' AND shift = '$selectshift' AND status = 'done'");
while($row6 = mysql_fetch_array($result6))
{
$money6 = 0;
}
     //المشتروات غير المصاريف
$result7 = mysql_query("SELECT SUM(price) FROM `reports2` WHERE day = '$D' AND month = '$M'  AND year = '$Y'   AND catagory ='in' AND shift = '$selectshift'");
while($row7 = mysql_fetch_array($result7))
{
$money7 = $row7['SUM(price)'];
}
 $shift_check = $row['shift'];
 	 
  echo "<tr>";
 if($shift_check == 'One'){$shift_check2= $lang_155;}else{$shift_check2 = $lang_156;}

   echo "<td><h3>" . $shift_check2 . "</h3></td>";

                  $moneyall = $money1 + $money2 + $money3 - $money4 - $money5 - $money6 + $money7- $disdis;
	              
?>
<td><h3><font color="green"><?php echo $money1;?></font></h3></td>
<td><h3><font color="green"><?php echo $money3;?></font></h3></td>
<td><h3><font color="green"><?php echo $money2;?></font></h3></td>
<td><h3><font color="green"><?php echo $money7;?></font></h3></td>
<td><h3><font color="red"><?php echo $money4;?></font></h3></td>
<td><h3><font color="red"><?php echo $money5+$money6+$disdis;?></font></h3></td>
<td><h2><?php echo $moneyall;?></h2></td>
<td><a href="reports_day_shift_all.php?se_day=<?php echo $D;?>&se_month=<?php echo $M;?>&se_year=<?php echo $Y;?>&se_shift=<?php echo $shift_check;?>"><img src="img/app/buttons/info.png"></a></td><?php 
      echo "</tr>";
	}?>
						  </tbody>
<?php }?>
						  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">Gesture For Playstation</a> <?php $Year = idate('Y');   echo $Year;?></p>
			
		</footer>
		
	</div><!--/.fluid-container-->

	<?php  include 'includes/js.php';?>
</body>
</html>
