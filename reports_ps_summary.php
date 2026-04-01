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
if($usern != 1 ){echo "<script>location='devices.php'</script>";}
$id = isset($_GET['id']) ? $_GET['id'] : '';
$sess = isset($_GET['session']) ? $_GET['session'] : '';
$session_id = isset($_GET['s']) ? $_GET['s'] : $sess;
$check_orders = 0;
$Items = 0;
$timing = 0;
$discount = 0;
$service = 0;
$tax = 0;
$discount_reason = '';
$cash_u = '';
$shift_check2 = '';
$y = '';
$m = '';
$d = '';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title><?php echo $lang_302;?></title>
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
<h2><span class="btn-primary">&nbsp;&nbsp;<?php echo $lang_303;?>: <?php  echo $session_id;?>&nbsp;&nbsp;</span></h2><br/>
<div class="row-fluid sortable">		
				<div class="box span10">
				 
					<div class="box-content">
						<table class="table table-striped table-bordered span6">
					<thead> <tr><td colspan = "6" align="center"><center><b><font color="blue"><?php echo $lang_78;?></font></b></center></td></tr>

						<?php 
								$session_id = isset($_GET['s']) ? $_GET['s'] : $session_id;
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `reports` WHERE session_id = '$session_id'");
if(mysql_num_rows($result) == 0 && $session_id_int > 0)
{
	$result_id = mysql_query("SELECT session_id FROM `reports` WHERE id = '$session_id_int' LIMIT 1");
	$row_id = mysql_fetch_array($result_id);
	if(isset($row_id['session_id']) && $row_id['session_id'] != '')
	{
		$session_id = $row_id['session_id'];
		$result = mysql_query("SELECT * FROM `reports` WHERE session_id = '$session_id'");
	}
}
$takeaway_rows = 0;
if(mysql_num_rows($result) == 0)
{
	$takeaway_result = mysql_query("SELECT * FROM `reports2` WHERE session_id = '$session_id'");
	$takeaway_rows = mysql_num_rows($takeaway_result);
	if($takeaway_rows > 0)
	{
		$takeaway_first = mysql_fetch_array($takeaway_result);
		$cash_u = $takeaway_first['casheer'];
		$d = $takeaway_first['day'];
		$m = $takeaway_first['month'];
		$y = $takeaway_first['year'];
		$shift_check = $takeaway_first['shift'];
		if($shift_check == 'One'){$shift_check2= $lang_155;}else{$shift_check2 = $lang_156;}
	}
}

?>
<tr>
                                   <th><?php echo $lang_304;?></th>
                                   <th><?php echo $lang_159;?></th>
 								   <th><?php echo $lang_160;?></th>
								   <th><?php echo $lang_161;?></th>
								   <th><?php echo $lang_162;?></th>
 								   <th><?php echo $lang_305;?></th>
							
</tr>
</thead> 	  			   
						  <tbody>
						  <?php 
while($row = mysql_fetch_array($result))
{
	$ps_id = $row['pc_id'];
	   $service = $row['service'];
	   $tax = $row['tax'];
$tom = $row['total'];
$hr = floor($tom / 3600)%24;
$mr = floor($tom / 60)%60;
$sr = ($tom % 60);
$shift_check = $row['shift'];
$discount = $row['discount2']+$row['discount_amount'];
$discount_reason = $row['dis_reason'];
$cash_u = $row['casheer'];
$d = $row['day'];
$m = $row['month'];
$y = $row['year'];

 if($shift_check == 'One'){$shift_check2= $lang_155;}else{$shift_check2 = $lang_156;}
   echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
?>
   <td>
   <?php 
$thetype = $row['type'];
 switch($thetype)
		{
		CASE 'single':   echo $lang_3;	BREAK;		
		CASE 'multi':   echo $lang_4;	BREAK;		
		CASE 'multi6':   echo $lang_6;	BREAK;		
		CASE 'multi7':   echo $lang_7;	BREAK;		
		} 
   ?>
   </td><?php     echo "<td>" . $row['Start_hour'].":" .$row['Start_minute']."</td>";
   echo "<td>" . $row['End_hour'].":" .$row['End_minute']."</td>";
   ?><td><?php  echo $hr; ?>:<?php  echo $mr; ?>:<?php  echo $sr; ?></td><?php 
     echo "<td><font color='green'>" . $row['money'] ."</font> ".$lang_100. "</td>";
	 echo "</tr>";
 
  }
if(mysql_num_rows($result) == 0)
{
	echo "<tr><td colspan='6' align='center'>لا توجد تفاصيل مسجلة لهذه الفاتورة</td></tr>";
}
  $resultb = mysql_query("SELECT SUM(money) FROM `reports` WHERE session_id = '$session_id'");
while($rowb = mysql_fetch_array($resultb))
{
	   $timing = $rowb['SUM(money)'];
	   $total = $timing - $discount;

}
  ?>
<?php if($has_reports == 0){ ?>
<tr><td colspan="6" align="center"><b style="color:#ff6b6b">لا توجد تفاصيل لعب مسجلة لهذه الفاتورة.</b></td></tr>
<?php
$alt_count = 0;
$sql_alt = "SELECT COUNT(*) AS c FROM `reports2` WHERE `session_id` = '$session_id_safe'";
$alt_result = mysql_query($sql_alt);
if($alt_result === false){ ps_summary_log_error('PS-SUM-REP-ALT-001', $sql_alt); }
else{
	$alt_row = mysql_fetch_array($alt_result);
	$alt_count = (int)$alt_row['c'];
}
if($alt_count > 0){
?>
<tr><td colspan="6" align="center"><a class="btn btn-warning" href="reports_takeaway_summary.php?s=<?php echo $session_id_safe; ?>">الفاتورة دي متسجلة كتقرير طلبات (Takeaway) - افتح التفاصيل من هنا</a></td></tr>
<?php } ?>
<?php if($debug_mode){ ?><tr><td colspan="6" align="center"><code>PS-SUM-NODATA-REPORTS | session=<?php echo $session_id_safe; ?></code></td></tr><?php } ?>
<?php } ?>
						  
						 
					 </tbody>
					</table>
					<?php
  // To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `ps_orders` WHERE session_id = '$session_id'");
$check_orders = mysql_num_rows($result);
if($check_orders > 0) 
{
?>
					<table class="table table-striped table-bordered span6">
					<thead>
					<tr><td colspan = "6" align="center"><center><b><font color="blue"><?php echo $lang_154;?></font></b></center></td></tr>
					<tr>
								  <th colspan = '2'><?php echo $lang_49;?></th>
                                  <th><?php echo $lang_306;?></th>
								  <th><?php echo $lang_307;?></th>
								  <th colspan = '2'><?php echo $lang_23;?></th>
					</tr>
					</thead> 
					<tbody>
					<?php while($row = mysql_fetch_array($result))
{
  echo "<tr colspan = '2'>";
  echo "<td align='center' colspan = '2'>" . $row['name'] . "</td>";
  echo "<td align='center'>" . $row['sub_cat'] . "</td>";
  echo "<td align='center' >" . $row['num']." ".$lang_308."</td>";
  echo "<td align='center'  colspan = '2' ><font color='green'>" . $row['price'] ."</font> ".$lang_100. "</td>";
  echo "</tr>";
}?>
					</tbody>
					</table>
					<?php } ?>
<?php
					$query = "SELECT  SUM(price) FROM ps_orders WHERE session_id = '$session_id'";
	 
$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){
      $Items = $row['SUM(price)'];
  }?> 
					<table border="1" span="6" width="40%" style="margin-right:10px">
					
					<tr><th align='center'><h3><?php echo $lang_77;?></h3></th> <th colspan="2" align='center'><h3><font color="#008080"><?php  echo $y;?>/<?php echo $m;?>/<?php echo $d;?></font></h3></th></tr>
					<tr><th align='center'><h3><?php echo $lang_166;?></h3></th> <th colspan="2" align='center'><h3><font color="#008080"><?php  echo $cash_u;?></font></h3></th></tr>
					<tr><th align='center'><h3><?php echo $lang_150;?></h3></th> <th colspan="2" align='center'><h3><font color="#008080"><?php  echo $shift_check2;?></font></h3></th></tr>
					 
					
					<?php if($discount > 0){?>
					<tr><td align='center'><h2><?php echo $lang_106;?></h2></td> <td align='center'><h2><font color="green"><?php  echo $Items + $timing;?></font></h2></td><td align='center'><h2> <?php echo $lang_100;?></h2></td></tr>
					
					<tr><td align='center'><h2><?php echo $lang_105;?></h2></td> <td align='center'><h2><font color="red"><?php  echo $discount;?></font></h2></td><td align='center'><h2> <?php echo $lang_100;?></h2></td></tr>					
					
					<tr><td align='center'><h2><?php echo $lang_153;?></h2></td> <td colspan ="2" align='center'><h2><font color="orange"><?php  echo $discount_reason;?></font></h2></td> </tr>					
					<?php }?>
					<?php if($tax > 0){?>
					<tr><td align='center'><h3><font color="orange">الضريبة</font></h3></td> <td align='center'><h3><font color="green"><?php  echo $tax;?></font></h2></td><td align='center'><h3> <?php echo $lang_100;?></h3></td></tr><?php }else{$tax = 0;}?>
					<?php if($service > 0){?>
					<tr><td align='center'><h3><font color="orange">الخدمة</font></h3></td> <td align='center'><h3><font color="green"><?php  echo $service;?></font></h3></td><td align='center'><h3> <?php echo $lang_100;?></h3></td></tr><?php }else{$service = 0;}?>
					
					<tr><td align='center'><h2><?php echo $lang_309;?></h2></td> <td align='center'><h1><font color="green"><?php  echo $Items + $timing - $discount + $service + $tax;?></font></h1></td><td align='center'><h2> <?php echo $lang_100;?></h2></td></tr>

					</table>
					 </div>
<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}
</script>
		<br/>	
		<br/>	
			<a class="btn btn-primary pull-right" href = "JavaScript:newPopup('actions/print/ps.php?Session=<?php  echo $session_id; ?>&&id=<?php  echo $ps_id; ?>')"><span class="icon32 icon-print"></span><?php echo $lang_310;?></a>

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
