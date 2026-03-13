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

 $M = $_GET['month'];
 $Y = $_GET['year'];
 $getname = $_GET['name'];
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
			<!-- content starts -->

<div class="row-fluid sortable">		
				<div class="box span10">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $lang_426;?> (<?php echo $getname;?>) </h2>
						 
					</div>
 					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
						
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `ps_orders` WHERE month = $M AND year = $Y AND name = '$getname'");
?><thead>
<tr>
								  <th>نوع الفاتورة</th>
								  <th><?php echo $lang_49;?></th>
								  <th><?php echo $lang_180;?></th>
								  <th><?php echo $lang_106;?></th>
 								  <th><?php echo $lang_427;?></th>
  								  <th><?php echo $lang_150;?></th>
 								  <th><?php echo $lang_166;?></th>
 								  <th><?php echo $lang_149;?></th>
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
   ?>
   <td><font color="red">(طلبات أجهزة)</font></td>
   <?php 
    echo "<td>" . $row['name'] . "</td>";
   echo "<td>" . $row['num'] . "</td>";
   echo "<td>" . $row['price'] ." ".$lang_100. "</td>";
    echo "<td>" . $row['day'] ."-". $row['month'] ."-". $row['year'] . "</td>";
 	if($row['shift'] == 'One'){
    echo "<td>" . $lang_155 . "</td>";
	}else{
    echo "<td>" . $lang_156 . "</td>";
	}
	    echo "<td>" . $row['casheer'] . "</td>";
	    echo "<td><a target = 'blank' href='reports_ps_summary.php?s=".$row['session_id']."'>" . $row['session_id'] . "</td>";

  echo "</tr>";
  }
  	$result2 = mysql_query("SELECT * FROM `reports2` WHERE month = $M AND year = $Y AND `catagory` != 'in' AND `catagory` != 'exp' AND `name` = '$getname'");
	  	while($roww = mysql_fetch_array($result2))
{
   ?>					 
   <tr>
      <td><font color="green">(طلبات خارحية)</font></td>

   <?php  echo "<td>" . $roww['name'] . "</td>";
   echo "<td>" . $roww['num'] . "</td>";
   echo "<td>" . $roww['price'] ." ".$lang_100. "</td>";
    echo "<td>" . $roww['day'] ."-". $roww['month'] ."-". $roww['year'] . "</td>";
 	if($roww['shift'] == 'One'){
    echo "<td>" . $lang_155 . "</td>";
	}else{
    echo "<td>" . $lang_156 . "</td>";
	}
	    echo "<td>" . $roww['casheer'] . "</td>";
	    echo "<td><a target = 'blank' href='reports_takeaway_summary.php?s=".$roww['session_id']."'>" . $roww['session_id'] . "</td>";
?>
   
   
   </tr>
<?php }?>
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
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">PlayStation</a> <?php $Year = idate('Y');   echo $Year;?></p>
		</footer>
	</div><!--/.fluid-container-->
	<?php  include 'includes/js.php';?>

</body>
</html>