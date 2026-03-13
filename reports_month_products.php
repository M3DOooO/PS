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
$id = $_GET['id'];  $id = $_GET['id']; 
 $sess = $_GET['session']; 
  $report_day =  idate('d');
 $report_month =  idate('m');

 $D = $_GET['day'];
 $M = $_GET['month'];
 $Y = $_GET['year'];
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_313;?></title>
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
			<a href="reports.php"><span>التقارير</span></a> / <a href="reports_month.php?month=<?php echo $M;?>&year=<?php echo $Y;?>"><span>تقارير شهر <?php echo $Y?>-<?php echo $M?></span></a> / <span>تقارير الأصناف</span>
			</div>
			<!-- content starts -->

<div class="row-fluid">		
				<div class="box span11">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> تقرير الأصناف بالشهر </h2>
						 
					</div>
 					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
								
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
// $result = mysql_query("SELECT *,SUM(num),SUM(price) FROM `ps_orders` WHERE month = $M AND year = $Y group by name");
$result = mysql_query("SELECT * FROM `stock` WHERE name != '' group by name");
?><thead>
<tr>
								  <th><?php echo $lang_49;?></th>
								  <th>الكمية المباعة</th>
								  <th>الكمية المدخلة</th>
								  <th>الكمية الحالية</th>
								  <th>إجمالي المبيعات</th>
  								  <th><?php echo $lang_306;?></th>
</tr>
</thead>  
						   
						  <tbody>
						  <?php 
								
								
																while($row = mysql_fetch_array($result))
{
	  $thename = $row['name'];

	  $result4 = mysql_query("SELECT *,SUM(num),SUM(price) FROM `ps_orders` WHERE `month` = $M AND `year` = $Y AND `name` = '$thename'");
	  	while($roww4 = mysql_fetch_array($result4))
{
	$sum4 = $roww4['SUM(num)'];
	$price4 = $roww4['SUM(price)'];
}	

	$result2 = mysql_query("SELECT *,SUM(num),SUM(price) FROM `reports2` WHERE month = $M AND year = $Y AND `catagory` != 'in' AND `catagory` != 'exp' AND `name` = '$thename'");
	  	while($roww = mysql_fetch_array($result2))
{
	$sum2 = $roww['SUM(num)'];
	$price2 = $roww['SUM(price)'];
}
	  // $result3 = mysql_query("SELECT SUM(notes),SUM(price) FROM `reports2` WHERE month = '$M' AND year = '$Y' AND `catagory` = 'exp' AND `name` = '$thename'");
	  
	  // $result3 = mysql_query("SELECT SUM(notes) FROM `reports2` WHERE `name` = '$thename' AND month = '$M' AND year = '$Y' AND `catagory` = 'exp'");
	  $result3 = mysql_query("SELECT SUM(notes) FROM `reports2` WHERE `name` = '$thename' AND `year` = '$Y' AND `catagory` = 'exp' AND `month` = '$M'");
	  	while($roww2 = mysql_fetch_array($result3))
{
	$sum3 = $roww2['SUM(notes)'];
	$price3 = $roww2['SUM(price)'];
}
	  $result7 = mysql_query("SELECT SUM(stock),SUM(sold) FROM `stock` WHERE `name` = '$thename'");
	  	while($roww7 = mysql_fetch_array($result7))
{
	$sum5 = $roww7['SUM(stock)']; 
	$sum6 = $roww7['SUM(sold)']; 
	$sum7 = $sum5 - $sum6; 
}
   echo "<tr>";
   $xxx = $sum4+ $sum2;
   $yyy = $price4+ $price2;
  ?>  <td><?php echo $thename;?></a></td>
<td><a target="_blank" href='reports_month_items_out.php?name=<?php echo $row['name'];?>&&month=<?php echo $M;?>&&year=<?php echo $Y;?>'><?php echo $xxx;?></a></td>
<td><a target="_blank" href="reports_month_items_in.php?name=<?php echo $row['name'];?>&&month=<?php echo $M;?>&&year=<?php echo $Y;?>"><?php echo $sum3;?></a></td>
<td><a target="_blank" href="control_product.php?id=<?php echo $row['id'];?>"><?php echo $sum7;?></a></td>

<?php 
   echo "<td>" . $yyy ." ".$lang_100. "</td>";
     echo "<td>" . $row['sub_cat'] . "</td>";
     echo "</tr>";
  }?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

			 
			 <!--/row-->

			 
			
			
			

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
