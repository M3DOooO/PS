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
$id = $_GET['id']; 
$today =  $shift_day;
$this_month =  $shift_month;
$Month = $shift_month;
$Day = $shift_day;	
$Year = idate('Y');

$Rday = $_GET['se_day'];
$Rmonth = $_GET['se_month'];
$Ryear = $_GET['se_year'];
if(isset($Rday)||isset($Rmonth)||isset($Ryear))
		{
  $today =  $Rday;
  $this_month =  $Rmonth;
  $Year	= 	$Ryear;
		}	
		$Rcash = $_GET['se_cash'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title><?php echo $lang_254;?></title>
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
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="reports.php"><span>التقارير</span></a> / <a href="reports_month.php?month=<?php echo $this_month;?>&year=<?php echo $Year;?>"><span>تقارير شهر <?php echo $Year?>-<?php echo $this_month?></span></a> / <a href="reports_month_casheer.php?month=<?php echo $this_month;?>&year=<?php echo $Year;?>"><span>تقارير الكاشير</span></a> / <span><?php echo $Rcash;?> </span>
			</div>
			<!-- content starts -->
			<center><h2><?php echo $Rcash;?></h2><?php echo $lang_276;?> <?php echo $Year?>/<?php echo $this_month?></br></br>
						<form action="reports_month_casheer.php" method="GET">
			 <?php echo $lang_176;?>: <input type = "text" name="se_month" value="<?php echo $Month;?>"> <?php echo $lang_257;?>: <input type = "text" name="se_year" value="<?php echo $Year;?>">
			<button type="submit" class="btn btn-success"><?php echo $lang_263;?></button><br></br>
</form></center>
<div class=" row-fluid span" style="width:50%;">
				<a data-rel="tooltip" style="width:35%;" title="<?php echo $lang_272;?>" class="well span3 top-blockk" href="reports_month_casheer_receipts.php?month=<?php echo $this_month ?>&&year=<?php echo $Year;?>&&casheer=<?php echo $Rcash?>">
					<span><img src="img/app/reports/report.png" height="35" /></span>
					<div><?php echo $lang_264;?></div>
 					<span class="notification"><?php echo $lang_126;?></span>
				</a>
				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_265;?>" class="well span3 top-blockk" href="reports_month_casheer_takeaway.php?month=<?php echo $this_month ?>&&year=<?php echo $Year;?>&&casheer=<?php echo $Rcash?>">
					<span><img src="img/app/reports/report.png" height="35" /></span>
					<div><?php echo $lang_266;?></div>
 					<span class="notification"><?php echo $lang_126;?></span>
				</a>
		         <br/>
		         <br/>
		         <br/>
		         <br/>
				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_267;?>" class="well span3 top-blockk" href="reports_month_casheer_products.php?month=<?php echo $this_month ?>&&year=<?php echo $Year;?>&&casheer=<?php echo $Rcash?>">
					<span><img src="img/app/reports/report2.png" height="35" /></span>
					<div><?php echo $lang_268;?></div>
 					<span class="notification green"><?php echo $lang_126;?></span>
				</a>
								
				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_269;?>" class="well span3 top-blockk" href="reports_month_casheer_out.php?month=<?php echo $this_month ?>&&year=<?php echo $Year;?>&&casheer=<?php echo $Rcash?>">
					<span><img src="img/app/reports/out.png" height="35" /></span>
					<div><?php echo $lang_43;?></div>
 					<span class="notification red"><?php echo $lang_126;?></span>
				</a>
		 		         <br/>
		         <br/>
		         <br/>
		         <br/>

				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_105;?>" class="well span3 top-blockk" href="reports_month_casheer_discounts.php?month=<?php echo $this_month ?>&&year=<?php echo $Year;?>&&casheer=<?php echo $Rcash?>">
					<span><img src="img/app/reports/dis.png" height="35" /></span>
					<div><?php echo $lang_105;?></div>
 					<span class="notification red"><?php echo $lang_126;?></span>
				</a>
				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_273;?>" class="well span3 top-blockk" href="reports_month_casheer_in.php?month=<?php echo $this_month ?>&&year=<?php echo $Year;?>&&casheer=<?php echo $Rcash?>">
					<span><img src="img/app/reports/add_money.png" height="35" /></span>
					<div><?php echo $lang_103;?></div>
 					<span class="notification green"><?php echo $lang_126;?></span>
				</a>
			 		   

				
				</div>
 <div class=" row-fluid">
 				 <?php 
								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");		 	
$query = "SELECT  SUM(money),SUM(tax),SUM(service) FROM reports where  month = $this_month AND year = $Year AND casheer = '$Rcash' AND status = 'done'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resulty)){
$one = $row['SUM(money)'];
$calc_serv = $row['SUM(tax)'];
$calc_tax = $row['SUM(service)'];
}
$query = "SELECT  SUM(discount2) FROM reports where  month = $this_month AND year = $Year AND casheer = '$Rcash' AND status = 'done'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resulty)){
$ds2 = $row['SUM(discount2)'];
 } 
$query = "SELECT  SUM(discount_amount) FROM reports where  month = $this_month AND year = $Year AND casheer = '$Rcash' AND status = 'done'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resulty)){
$ds3 = $row['SUM(discount_amount)'];
 } 
  $query = "SELECT  SUM(discount2) FROM reports2 where  month = $this_month AND year = $Year AND casheer = '$Rcash' AND status = 'done'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resulty)){
$ds5 = $row['SUM(discount2)'];
 } 
								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
	
  
		 	
			$query = "SELECT  SUM(price) FROM ps_orders where  month = $this_month AND year = $Year AND status = 'yes' AND casheer = '$Rcash'"; 

 
$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){
      $two = $row['SUM(price)'];
	//echo "<h2>Today Income From PS Orders: <font color='green'>". $row['SUM(price)'];  
	 
	 
 }
 
								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
	
 
		 	
			$query = "SELECT  SUM(price) FROM reports2 where  month = $this_month AND year = $Year AND notes = 'order'  AND casheer = '$Rcash' AND status = 'done'"; 

 
$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){
      $three = $row['SUM(price)'];
	//echo "<h2>Today Orders Income: <font color='green'>". $row['SUM(price)']; ?> 
	 
	<?php 
  }
 $query = "SELECT  SUM(price) FROM reports2 where  month = $this_month AND year = $Year AND catagory = 'exp'  AND casheer = '$Rcash' AND status = 'done'"; 

 
$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){
      $four = $row['SUM(price)'];
	//echo "<h2>Today Expenses: <font color='green'>". $row['SUM(price)'];   
	 
	 $query = "SELECT  SUM(price) FROM reports2 where  month = $this_month AND year = $Year AND catagory = 'in'  AND casheer = '$Rcash' AND status = 'done'"; 

 
$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){
      $five = $row['SUM(price)'];
	//echo "<h2>Today Expenses: <font color='green'>". $row['SUM(price)'];<?php 
  }
	
 }
 $all = $one + $two + $three + $five - $four -$ds2-$ds3-$ds5;
?>
<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}
</script>
			
			<!--<a href = "JavaScript:newPopup('rep_sh.php?a=<?php //echo $one; ?>&&b=<?php //echo $two; ?>&&c=<?php //echo $three; ?>&&d=<?php //echo $four; ?>&&e=<?php //echo $all; ?>')"><img id="soora" src="img/print.png" width="100" /></a>
-->
			<div class="row-fluid">
				<div class="box span4">
					 
					<div class="box-content">
						<ul class="dashboard-list">
							<li>
								<a href="#">
									<i class="icon-arrow-up"></i>                               
									<span class="green"><?php echo $one; ?> <?php echo $lang_100;?></span>
									<?php echo $lang_99;?>                                    
								</a>
							</li>	
							<li>
								<a href="#">
									<i class="icon-arrow-down"></i>                               
									<span class="red"><?php echo $ds2+$ds3+$ds5; ?> <?php echo $lang_100;?></span>
									<?php echo $lang_105;?>                                    
								</a>
							</li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-up"></i>
							  <span class="green"><?php echo $two; ?> <?php echo $lang_100;?></span>
							  <?php echo $lang_101;?>
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon icon-cart"></i>
							  <span class="blue"><?php echo $three; ?> <?php echo $lang_100;?></span>
							  <?php echo $lang_102;?>                                    
							</a>
						  </li>
						  <li>
							<a href="#">
									<i class="icon-arrow-down"></i>                               
							  <span class="red"><?php echo $four; ?> <?php echo $lang_100;?></span>
							  <?php echo $lang_104;?>                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-up"></i>                               
							  <span class="Green"><?php echo $five; ?> <?php echo $lang_100;?></span>
							  <?php echo $lang_103;?>                                    
							</a>
						  </li>
						   <?php 
						  if($service_ch == 'True'){
						  ?>
						   <li>
							<a href="#">
							  <i class="icon-arrow-up"></i>                               
							  <span><font color="orange"><?php echo $calc_serv; ?> <?php echo $lang_100;?></font></span>
							  الخدمة                                   
							</a>
						  </li>
						  <?php }else{$calc_serv = 0;}?>
						  <?php 
						  if($tax_ch == 'True'){
						  ?>
						   <li>
							<a href="#">
							  <i class="icon-arrow-up"></i>                               
							  <span><font color="orange"><?php echo $calc_tax; ?> <?php echo $lang_100;?></font></span>
							  الضريبة                                   
							</a>
						  </li>
						  <?php }else{$calc_tax = 0;}?>
						  <li>
							<a href="#">
							  <i class="icon-arrow-up"></i>                               
							  <span class="green"><?php echo $all+ $calc_serv + $calc_tax; ?> <?php echo $lang_100;?></span>
							 <?php echo $lang_274;?>                                    
							</a>
						  </li>
						  
						  
						</ul>
					</div>
				</div><!--/span-->
						
		  				</div>

					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">׼/button>
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
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">PlayStation</a> <?php $Year = idate('Y');   echo $Year;?></p>
			
		</footer>
		
	</div><!--/.fluid-container-->

<?php  include 'includes/js.php';?>

		
</body>
</html>
