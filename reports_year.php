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
if($Ryear > 1)
		{
  unset($Year);
  $Year	= 2017;
 		}	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title><?php echo $lang_256;?></title>
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
			<?php if($Ryear > 1)
		{
  unset($Year);
  $Year	= $Ryear;
 		}?>
			<div id="content" class="span10">
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="reports.php"><span>التقارير</span></a> / <span>تقارير سنة <?php echo $Year?></span> 
			</div>
			<!-- content starts -->
			<center><h2><?php echo $lang_277;?></h2><?php echo $lang_278;?> <?php echo $Year?></br></br>
						<form action="reports_year.php" method="GET">
			<?php echo $lang_257;?>: <input type = "text" name="se_year" value="<?php echo $Year;?>">
			<button type="submit" class="btn btn-success"><?php echo $lang_263;?></button><br></br>
</form></center>
<div class="row-fluid span" style="width:50%;">
				<a data-rel="tooltip" style="width:35%;" title="<?php echo $lang_272;?>" class="well span3 top-blockk" href="reports_year_receipts.php?year=<?php echo $Year;?>">
					<span><img src="img/app/reports/report.png" height="35" /></span>
					<div><?php echo $lang_264;?></div>
 					<span class="notification"><?php echo $lang_126;?></span>
				</a>
				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_265;?>" class="well span3 top-blockk" href="reports_year_takeaway.php?year=<?php echo $Year;?>">
					<span><img src="img/app/reports/report.png" height="35" /></span>
					<div><?php echo $lang_266;?></div>
 					<span class="notification"><?php echo $lang_126;?></span>
				</a>

				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_267;?>" class="well span3 top-blockk" href="reports_year_products.php?year=<?php echo $Year;?>">
					<span><img src="img/app/reports/report2.png" height="35" /></span>
					<div><?php echo $lang_268;?></div>
 					<span class="notification green"><?php echo $lang_126;?></span>
				</a>
								
				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_269;?>" class="well span3 top-blockk" href="reports_year_out.php?year=<?php echo $Year;?>">
					<span><img src="img/app/reports/out.png" height="35" /></span>
					<div><?php echo $lang_43;?></div>
 					<span class="notification red"><?php echo $lang_126;?></span>
				</a>

				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_105;?>" class="well span3 top-blockk" href="reports_year_discounts.php?year=<?php echo $Year;?>">
					<span><img src="img/app/reports/dis.png" height="35" /></span>
					<div><?php echo $lang_105;?></div>
 					<span class="notification red"><?php echo $lang_126;?></span>
				</a>
				<a data-rel="tooltip"  style="width:35%;" title="<?php echo $lang_273;?>" class="well span3 top-blockk" href="reports_year_in.php?year=<?php echo $Year;?>">
					<span><img src="img/app/reports/add_money.png" height="35" /></span>
					<div><?php echo $lang_103;?></div>
 					<span class="notification green"><?php echo $lang_126;?></span>
				</a>
	
				<a data-rel="tooltip" style="width:35%;" title="<?php echo $lang_46;?>" class="well span3 top-blockk" href="reports_year_casheer.php?year=<?php echo $Year;?>">
					<span><img src="img/app/reports/casheers.png" height="35" /></span>
					<div><?php echo $lang_46;?></div>
 					<span class="notification green"><?php echo $lang_126;?></span>
				</a>
				<a data-rel="tooltip" style="width:35%;" title="<?php echo $lang_270;?>" class="well span3 top-blockk" href="reports_year_shift.php?year=<?php echo $Year;?>">
					<span><img src="img/app/reports/ti.png" height="35" /></span>
					<div><?php echo $lang_271;?></div>
 					<span class="notification green"><?php echo $lang_126;?></span>
				</a>
				</div>
 <div class="sortable row-fluid">
 				 <?php 
								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");		 	
$query = "SELECT  SUM(money),SUM(tax),SUM(service) FROM reports where   year = $Year  AND status = 'done'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resulty)){
$one = $row['SUM(money)'];
$calc_serv = $row['SUM(tax)'];
$calc_tax = $row['SUM(service)'];
}
$query = "SELECT  SUM(discount2) FROM reports where   year = $Year AND status = 'done'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resulty)){
$ds2 = $row['SUM(discount2)'];
 } 
$query = "SELECT  SUM(discount_amount) FROM reports where   year = $Year AND status = 'done'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resulty)){
$ds3 = $row['SUM(discount_amount)'];
 } 
  $query = "SELECT  SUM(discount2) FROM reports2 where   year = $Year AND status = 'done'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resulty)){
$ds5 = $row['SUM(discount2)'];
 } 
								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
	
  
		 	
			$query = "SELECT  SUM(price) FROM ps_orders where   year = $Year AND status ='yes'"; 

 
$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){
      $two = $row['SUM(price)'];
	//echo "<h2>Today Income From PS Orders: <font color='green'>". $row['SUM(price)'];  
	 
	 
 }
 
								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
	
 
		 	
			$query = "SELECT  SUM(price) FROM reports2 where   year = $Year AND notes = 'order'  AND status = 'done'"; 

 
$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){
      $three = $row['SUM(price)'];
	//echo "<h2>Today Orders Income: <font color='green'>". $row['SUM(price)']; ?> 
	 
	<?php 
  }
 $query = "SELECT  SUM(price) FROM reports2 where   year = $Year AND catagory = 'exp' AND status ='done'"; 

 
$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){
      $four = $row['SUM(price)'];
	//echo "<h2>Today Expenses: <font color='green'>". $row['SUM(price)'];   
	 
	 $query = "SELECT  SUM(price) FROM reports2 where   year = $Year AND catagory = 'in' AND status ='done'"; 

 
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
			<div class="row-fluid sortable">
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
						
						
						<script type="text/javascript" src="js/amcharts.js"></script>
		<script type="text/javascript" src="js/serial.js"></script>
		<script type="text/javascript" src="js/dark.js"></script>
		

		<!-- amCharts javascript code -->
		<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "serial",
					"categoryField": "category",
					"startDuration": 1,
					"theme": "dark",
					"categoryAxis": {
						"gridPosition": "start"
					},
					"trendLines": [],
					"graphs": [
						{
							"balloonColor": "#008000",
			"balloonText": "[[title]] [[value]] جنية",
							"bullet": "round",
							"color": "#008000",
							"customMarker": "",
							"fillColors": "#008000",
							"id": "AmGraph-1",
							"lineColor": "#008000",
							"title": "الأرباح",
							"type": "column",
							"valueField": "arba7"
						},
						{
							"balloonColor": "#FF0000",
			"balloonText": "[[title]] [[value]] جنية",
							"bullet": "square",
							"color": "#FF0000",
							"customMarker": "",
							"fillColors": "#FF0000",
							"id": "AmGraph-2",
							"lineColor": "#FF0000",
							"title": "المصاريف",
							"valueField": "5asayer"
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"stackType": "regular",
							"title": "المبلغ"
						}
					],
					"allLabels": [],
					"balloon": {},
					"legend": {
						"enabled": true,
						"useGraphSettings": true
					},
					"titles": [
						{
							"id": "Title-1",
							"size": 15,
							"text": "تقرير السنة"
						}
					],
					 "dataProvider": <?php 	 // Connect to MySQL
$link = mysql_connect("$host", "$user", "$pass");
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( "$db", $link );
if ( !$db ) {
  die ( 'Error selecting database \'test\' : ' . mysql_error() );
}

// Fetch the data
$query = "SELECT * FROM reports where year = $Year  AND status = 'done' GROUP BY month ORDER BY month";
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows
$prefix = '';
echo "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
		$getmonth = $row['month'];
		
		  $sqla="SELECT SUM(money) FROM reports WHERE month = '$getmonth' AND year = $Year AND status = 'done'";
 $resulta=mysql_query($sqla);
 while($rowa = mysql_fetch_array($resulta))
	 {
		 $get_amount = $rowa['SUM(money)'];
	 }
 $queryb5 = "SELECT  SUM(price) FROM ps_orders where month = '$getmonth' AND year = $Year"; 
$resultb5 = mysql_query($queryb5) or die(mysql_error());
// Print out result
while($rowb5 = mysql_fetch_array($resultb5)){
      $twob5 = $rowb5['SUM(price)'];	 
 }
 $queryb6 = "SELECT  SUM(price) FROM reports2 where month = '$getmonth' AND year = $Year AND notes = 'order' AND status = 'done'"; 
$resultb6 = mysql_query($queryb6) or die(mysql_error());
while($rowb6 = mysql_fetch_array($resultb6)){
      $threeb6 = $rowb6['SUM(price)'];
	 }
 $queryb7 = "SELECT  SUM(price) FROM reports2 where month = '$getmonth' AND year = $Year AND catagory = 'in'"; 
$resultb7 = mysql_query($queryb7) or die(mysql_error());
while($rowb7 = mysql_fetch_array($resultb7)){
      $fiveb7 = $rowb7['SUM(price)'];
  }
 $calc_in = $get_amount + $twob5 + $threeb6 + $fiveb7;
 
$queryb1 = "SELECT SUM(discount2) FROM reports WHERE month = '$getmonth' AND year = $Year AND status = 'done'"; 
$resultb1 = mysql_query($queryb1) or die(mysql_error());
// Print out result
while($rowb1 = mysql_fetch_array($resultb1)){
$ds2a = $rowb1['SUM(discount2)'];
 } 
$queryb2 = "SELECT  SUM(discount_amount) FROM reports WHERE month = '$getmonth' AND year = $Year AND status = 'done'"; 
$resultb2 = mysql_query($queryb2) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resultb2)){
$ds3a = $rowb2['SUM(discount_amount)'];
 }
 $queryb3 = "SELECT  SUM(price) FROM reports2 where month = '$getmonth' AND year = $Year AND catagory = 'exp'"; 
$resultb3 = mysql_query($queryb3) or die(mysql_error());
while($rowb3 = mysql_fetch_array($resultb3)){
      $fourb3 = $rowb3['SUM(price)'];
 }	
 
$calc_out = $ds3a + $ds2a + $fourb3;

 
  echo $prefix . " {\n";
  echo '  "category": "شهر ' . $getmonth . '",' . "\n";
  echo '  "5asayer": "' . $calc_out . '",' . "\n";
   echo '  "arba7": ' . $calc_in. '' . "\n";
   echo " }";
  $prefix = ",\n";
  
}
echo "\n]";

// Close the connection
mysql_close($link);
?>
				}
			);
		</script>
 	
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #16191c;" ></div>


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
