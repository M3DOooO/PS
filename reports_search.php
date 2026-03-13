<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
 
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}$id = $_GET['id'];     $id=$_GET['id'];			
    $type=$_GET['type'];			
    $_SESSION['id']="$id";
    $cat = $_GET['cat']; 		
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_218;?></title>
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
			<a href="reports.php"><span>التقارير</span></a> / <span>البحث في الفواتير</span>
			</div>
			<!-- content starts -->
			 <center> 			 
			 <table border="1" width="50%">
			 <tr>
			 <td align='center'>
<form action="reports_search.php" method="POST" >
 		 <label class="control-label" for="focusedInput"><?php echo $lang_219;?></label>
								<div class="controls">			
  <?php echo $lang_149;?>:<br><input type="text" name="search_num" ><br>
	</div>
  <button type="submit" class="btn btn-primary"><?php echo $lang_220;?></button>
  </form> 
	</td>
	<td align='center'>
  <form action="reports_search.php" method="POST" >
 		 <label class="control-label" for="focusedInput"><?php echo $lang_221;?></label>
								<div class="controls">			
  <?php echo $lang_149;?>:<br><input type="text" name="search_num2" ><br>
	</div>
  <button type="submit" class="btn btn-primary"><?php echo $lang_220;?></button>
  </form>
</td>  
</tr> 
 </table>

      
	  <?php 
	  $search_num = $_POST['search_num'];
	  $search_num2 = $_POST['search_num2'];
	  if(isset($search_num))
	  {
		  ?>
		  <table  style="width:50%" class="table table-striped table-bordered bootstrap-datatable">
						  <?php 
								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");		
// To connect to the database
$result = mysql_query("SELECT *,SUM(money) FROM `reports` WHERE session_id = $search_num GROUP BY session_id"); 
?><thead>
<tr>
								  <th><?php echo $lang_149;?></th>
								  <th><?php echo $lang_62;?></th>
								  <th><?php echo $lang_159;?></th>
                                  <th><?php echo $lang_150;?></th>
                                  <th><?php echo $lang_77;?></th>
								  <th><?php echo $lang_160;?></th>
								  <th><?php echo $lang_161;?></th>
								  <th><?php echo $lang_162;?></th>
								  <th><?php echo $lang_151;?></th>
								  <th><?php echo $lang_152;?></th>
								  <th><?php echo $lang_105;?></th>
								  <th><?php echo $lang_106;?></th>
								  <th><?php echo $lang_154;?></th>
</tr>
</thead> 	  						   
<tbody>
		<?php 
while($row = mysql_fetch_array($result))
{
		$se_se = $row['session_id'];

$resultki = mysql_query("SELECT SUM(price) FROM `ps_orders` WHERE `session_id` = '$se_se'"); 
while($rowt = mysql_fetch_array($resultki))
{
	$sum_items = $rowt['SUM(price)'];
}
	$se_se = $row['session_id'];
$tom = $row['total'];
$hr = floor($tom / 3600)%24;
$mr = floor($tom / 60)%60;
$sr = ($tom % 60);
$shift_check = $row['shift'];
$discount = $row['discount2']+$row['discount_amount'];
$total = $row['SUM(money)'] + $sum_items - $discount;
// $hdiff =  $row['End_hour'] - $row['Start_hour'];
// $mdiff =  $row['End_minute'] - $row['Start_minute'];
// if($mdiff <0)
 // {
 // $mfiff = $mdiff + 60;
 // }
 if($shift_check == 'One'){$shift_check2= $lang_155;}else{$shift_check2 = $lang_156;}
   echo "<tr>";
   echo "<td>" . $row['session_id'] . "</td>";
   echo "<td>" . $row['name'] . "</td>";
   echo "<td>" . $row['type'] . "</td>";
   echo "<td>" . $shift_check2 . "</td>";
   echo "<td>" . $row['year'] ."/". $row['month'] . "/" . $row['day']. "</td>";
   echo "<td>" . $row['Start_hour'].":" .$row['Start_minute']."</td>";
   echo "<td>" . $row['End_hour'].":" .$row['End_minute']."</td>";
?><td><?php  echo $hr; ?>:<?php  echo $mr; ?>:<?php  echo $sr; ?></td><?php 
     echo "<td>" . $sum_items ." ".$lang_100. "</td>";
     echo "<td>" . $row['SUM(money)'] ." ".$lang_100. "</td>";
   echo "<td><font color='red'>" . $discount ." ".$lang_100. "</font></td>";
   echo "<td><b><font color='green'>" . $total ." ".$lang_100. "</font></b></td>";
   echo '<td><a class="btn btn-success" href="reports_ps_summary.php?s='.$row['session_id'].'">'.'<i class="icon-zoom-in icon-white"></i>'.$lang_107.'</a></td>';
    echo "</tr>";
  }?>
						  </tbody>
					  </table>
		  <?php 
	  }
	  else if(isset($search_num2))
	  {
		  ?>
		  
		  <table 
		  <table  style="width:50%" class="table table-striped table-bordered bootstrap-datatable">
						  <?php 
								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");		
 
// To connect to the database
$result = mysql_query("SELECT *,SUM(price) FROM `reports2` WHERE session_id = $search_num2 GROUP BY session_id"); 
?><thead>
<tr>
								  <th><?php echo $lang_149;?></th>
                                   <th><?php echo $lang_150;?></th>
                                  <th><?php echo $lang_77;?></th>
 								  <th><?php echo $lang_106;?></th>
								  <th><?php echo $lang_154;?></th>
</tr>
</thead> 	  						   
<tbody>
		<?php 
while($row = mysql_fetch_array($result))
{
		$se_se = $row['session_id'];

$resultki = mysql_query("SELECT SUM(price) FROM `ps_orders` WHERE `session_id` = '$se_se'"); 
while($rowt = mysql_fetch_array($resultki))
{
	$sum_items = $rowt['SUM(price)'];
}
	$se_se = $row['session_id'];
$tom = $row['total'];
$hr = floor($tom / 3600)%24;
$mr = floor($tom / 60)%60;
$sr = ($tom % 60);
$shift_check = $row['shift'];
$discount = $row['discount2']+$row['discount_amount'];
$total = $row['SUM(money)'] + $sum_items - $discount;
// $hdiff =  $row['End_hour'] - $row['Start_hour'];
// $mdiff =  $row['End_minute'] - $row['Start_minute'];
// if($mdiff <0)
 // {
 // $mfiff = $mdiff + 60;
 // }
 if($shift_check == 'One'){$shift_check2= $lang_155;}else{$shift_check2 = $lang_156;}
   echo "<tr>";
   echo "<td>" . $row['session_id'] . "</td>";
   echo "<td>" . $shift_check2 . "</td>";
   echo "<td>" . $row['year'] ."/". $row['month'] . "/" . $row['day']. "</td>";
     echo "<td><b><font color='green'>" . $row['SUM(price)'] ." ".$lang_100." </font></b></td>";
   echo '<td><a class="btn btn-success" href="reports_takeaway_summary.php?s='.$row['session_id'].'">'.'<i class="icon-zoom-in icon-white"></i>'.$lang_107.'</a></td>';
    echo "</tr>";
  }?>
						  </tbody>
					  </table></center>
		  
		  <?php 
	  }
	  ?>
	  
	  
	  
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
