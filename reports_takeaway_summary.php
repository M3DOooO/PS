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
<h2><span class="btn-primary">&nbsp;&nbsp;<?php echo $lang_303;?>: <?php  $session_id = $_GET['s']; echo $session_id;?>&nbsp;&nbsp;</span></h2><br/>
<div class="row-fluid sortable">		
				<div class="box span10">
				 
					<div class="box-content"style="float:none;">
						<table class="table table-striped table-bordered span6" >
					<thead> <tr><td colspan = "5" align="center"><center><b><font color="blue"><?php echo $lang_154;?></font></b></center></td></tr>

						<?php 
								$session_id = $_GET['s'];
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(num),SUM(price),SUM(discount2) FROM `reports2` WHERE session_id = '$session_id' GROUP BY name");
?>
<tr>
                                   <th><?php echo $lang_49;?></th>
 								  <th><?php echo $lang_307;?></th>
  								  <th><?php echo $lang_23;?></th>
							
</tr>
</thead> 	  			   
						  <tbody>
						  <?php 
while($row = mysql_fetch_array($result))
{
$tom = $row['total'];
$hr = floor($tom / 3600)%24;
$mr = floor($tom / 60)%60;
$sr = ($tom % 60);
$shift_check = $row['shift'];
$discount = $row['SUM(discount2)'];
$discount_reason = $row['dis_reason'];
$cash_u = $row['casheer'];
$d = $row['day'];
$m = $row['month'];
$y = $row['year'];

 if($shift_check == 'One'){$shift_check2= $lang_155;}else{$shift_check2 = $lang_156;}
   echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['SUM(num)'] . "</td>";
      echo "<td><font color='green'>" . $row['SUM(price)'] ."</font> ".$lang_100. "</td>";
   // echo "<td><font color='red'>" . $discount ."</font></td>";
   // echo "<td><font color='green'>" . $total ."</font></td>";     echo "</tr>";
  }
  $resultb = mysql_query("SELECT SUM(price) FROM `reports2` WHERE session_id = '$session_id'");
while($rowb = mysql_fetch_array($resultb))
{
	   $timing = $rowb['SUM(price)'];
 
}
  ?>
						  
					 
	 
						  </tbody>
					  </table>            
					</div>
					

					 
					<table border="1" span="6" width="30%" style="margin-right:10px">
					
					<tr><th align='center'><h3><?php echo $lang_77;?></h3></th> <th align='center'><h3><font color="#008080"><?php  echo $y;?>/<?php echo $m;?>/<?php echo $d;?></font></h3></th></tr>
					<tr><th align='center'><h3><?php echo $lang_166;?></h3></th> <th align='center'><h3><font color="#008080"><?php  echo $cash_u;?></font></h3></th></tr>
					<tr><th align='center'><h3><?php echo $lang_150;?></h3></th> <th align='center'><h3><font color="#008080"><?php  echo $shift_check2;?></font></h3></th></tr>
					
					<?php if($discount > 0){?>
					<tr><td align='center'><h2><?php echo $lang_106;?></h2></td> <td align='center'><h2><font color="green"><?php  echo $Items + $timing;?></font></h2></td><td align='center'><h2> <?php echo $lang_100;?></h2></td></tr>
					
					<tr><td align='center'><h2><?php echo $lang_105;?></h2></td> <td align='center'><h2><font color="red"><?php  echo $discount;?></font></h2></td><td align='center'><h2> <?php echo $lang_100;?></h2></td></tr>					
					
					<tr><td align='center'><h2><?php echo $lang_153;?></h2></td> <td colspan ="2" align='center'><h2><font color="orange"><?php  echo $discount_reason;?></font></h2></td> </tr>
					<?php }?>
					</table>
					
					<table border="1" span="6"  style="margin-right:10px">
					 
					<tr><td align='center'><h2><?php echo $lang_309;?></h2></td> <td align='center'><h1><font color="green"><?php  echo $timing-$discount;?></font></h1></td><td align='center'><h2> <?php echo $lang_100;?></h2></td></tr>
					</table>
					 
<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}
</script>
		<br/>	
		<br/>	
				

			<a class="btn btn-primary pull-right" href = "JavaScript:newPopup('actions/print/takeaway.php?Receipt=<?php  echo $session_id; ?>')"><span class="icon32 icon-print"></span><?php echo $lang_310;?></a>
			
			
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
