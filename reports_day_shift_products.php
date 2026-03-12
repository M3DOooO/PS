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
$rshift = $_GET['shift'];
 		if($rshift == 'One')
		{
		$eeshift = $lang_17;	
		}
   else if($rshift == 'Two')
        {
	    $eeshift = $lang_16;
        } ?>
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
			<!-- content starts -->
<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="reports.php"><span>التقارير</span></a> / <a href="reports_day.php?day=<?php echo $D;?>&month=<?php echo $M;?>&year=<?php echo $Y;?>"><span>تقارير يوم <?php echo $Y?>-<?php echo $M?>-<?php echo $D?></span></a> / <a href="reports_day_shift.php?day=<?php echo $D;?>&month=<?php echo $M;?>&year=<?php echo $Y;?>"><span>تقارير الشفت</span></a> / <a href="reports_day_shift_all.php?day=<?php echo $D;?>&month=<?php echo $M;?>&year=<?php echo $Y;?>&se_shift=<?php echo $rshift;?>"><span>الشفت <?php echo $eeshift;?> </span></a> / <span>تقارير الأصناف</span>
			</div>
<div class="row-fluid">		
				<div class="box span11">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $lang_314;?> </h2>
						 
					</div>
 					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
								
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(num),SUM(price) FROM `ps_orders` WHERE day = $D AND month = $M AND year = $Y  AND `shift` = '$rshift' group by name");
?><thead>
<tr>
								  <th><?php echo $lang_49;?></th>
								  <th><?php echo $lang_180;?></th>
								  <th><?php echo $lang_23;?></th>
 								  <th><?php echo $lang_77;?></th>
 								  <th><?php echo $lang_306;?></th>
</tr>
</thead>
 <tbody>
						  <?php 
								
								
																while($row = mysql_fetch_array($result))
{
      $hdiff =  $row['End_hour'] - $row['Start_hour'];
      $mdiff =  $row['End_minute'] - $row['Start_minute'];
	  if($mdiff <0)
	  {
	  $mfiff = $mdiff + 60;
	  }
   echo "<tr>";
   echo "<td>" . $row['name'] . "</td>";
   echo "<td>" . $row['SUM(num)'] . "</td>";
   echo "<td>" . $row['SUM(price)'] ." ".$lang_100. "</td>";
    echo "<td>" . $row['day'] ."-". $row['month'] ."-". $row['year'] . "</td>";
    echo "<td>" . $row['sub_cat'] . "</td>";
     echo "</tr>";
  }?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

			<hr/>
			<hr/>
			<div class="row-fluid sortable">		
				<div class="box span10">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $lang_315;?> </h2>
						 
					</div>
 					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
								
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(num),SUM(price) FROM `reports2` WHERE day = $D AND month = $M AND year = $Y  AND `shift` = '$rshift'  AND `catagory` != 'in' AND `catagory` != 'exp' group by name");
?><thead>
<tr>
								  <th><?php echo $lang_49;?></th>
								  <th><?php echo $lang_180;?></th>
								  <th><?php echo $lang_23;?></th>
 								  <th><?php echo $lang_77;?></th>
 								  <th><?php echo $lang_306;?></th>
</tr>
</thead> 
<tbody>
						  <?php 
while($row = mysql_fetch_array($result))
{
      $hdiff =  $row['End_hour'] - $row['Start_hour'];
      $mdiff =  $row['End_minute'] - $row['Start_minute'];
	  if($mdiff <0)
	  {
	  $mfiff = $mdiff + 60;
	  }
   echo "<tr>";
      echo "<td>" . $row['name'] . "</td>";
	     echo "<td>" . $row['SUM(num)'] . "</td>";
   echo "<td>" . $row['SUM(price)'] ." ".$lang_100. "</td>";
    echo "<td>" . $row['day'] ."-". $row['month'] ."-". $row['year'] . "</td>";
    echo "<td>" . $row['sub_cat'] . "</td>";
     echo "</tr>";
  }?>
						  </tbody>
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
