<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
} 
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}$id = $_GET['id']; if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}$id = $_GET['id']; 

$id = $_GET['id']; 
$date = $_GET['date']; 
$sess = $_GET['session'];   
$delete = $_GET['delete'];
$rmonth = $_GET['month'];

$gps3 = $_POST['ps3'];
$gps3n = $_POST['ps3n'];
$gps4 = $_POST['ps4'];
$gps4n = $_POST['ps4n'];
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
   mysql_select_db("$db") or die(mysql_error());
   
if(isset($gps3)){mysql_query("UPDATE joy SET ps3 = '$gps3'");}
if(isset($gps3n)){mysql_query("UPDATE joy SET ps3n = '$gps3n'");}
if(isset($gps4)){mysql_query("UPDATE joy SET ps4 = '$gps4'");}
if(isset($gps4n)){mysql_query("UPDATE joy SET ps4n = '$gps4n'");}


   if(isset($delete))
   {
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
   mysql_select_db("$db") or die(mysql_error()); 
   mysql_query("DELETE FROM joy WHERE id = $delete"); 
   }
				mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
				mysql_select_db("$db") or die(mysql_error()); 

				$sql="SELECT * FROM joy";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
                $ps3 = $row['ps3'];
                $ps4 = $row['ps4'];
                $ps3n = $row['ps3n'];
                $ps4n = $row['ps4n'];
				}
				
				
				$sql="SELECT COUNT(*) FROM devices WHERE `Device Status` = 'On' AND `type` = 'single' AND `ps_version` = '3'";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
                $count_single_3 = $row['COUNT(*)'];
				}
	            $sql="SELECT COUNT(*) FROM devices WHERE `Device Status` = 'On' AND `type` = 'multi' AND `ps_version` = '3'";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
                $count_multi_3 = $row['COUNT(*)'];
				}	  
				$sql="SELECT COUNT(*) FROM devices WHERE `Device Status` = 'On' AND `type` = 'multi6' AND `ps_version` = '3'";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
                $count_multi6_3 = $row['COUNT(*)'];
				}				
				$sql="SELECT COUNT(*) FROM devices WHERE `Device Status` = 'On' AND `type` = 'multi7' AND `ps_version` = '3'";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
                $count_multi7_3 = $row['COUNT(*)'];
				}
				
				$c_s_3 = $count_single_3 * 2;
				$c_m_3 = $count_multi_3 * 4;
				$c_m6_3 = $count_multi6_3 * 6;
				$c_m7_3 = $count_multi7_3 * 7;
				$c_all_3 = $c_s_3 + $c_m_3 +$c_m6_3 +$c_m7_3;
				
				$sql="SELECT COUNT(*) FROM devices WHERE `Device Status` = 'On' AND `type` = 'single' AND `ps_version` = '4'";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
                $count_single_4 = $row['COUNT(*)'];
				}
	            $sql="SELECT COUNT(*) FROM devices WHERE `Device Status` = 'On' AND `type` = 'multi' AND `ps_version` = '4'";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
                $count_multi_4 = $row['COUNT(*)'];
				}	  
				$sql="SELECT COUNT(*) FROM devices WHERE `Device Status` = 'On' AND `type` = 'multi6' AND `ps_version` = '4'";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
                $count_multi6_4 = $row['COUNT(*)'];
				}				
				$sql="SELECT COUNT(*) FROM devices WHERE `Device Status` = 'On' AND `type` = 'multi7' AND `ps_version` = '4'";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
                $count_multi7_4 = $row['COUNT(*)'];
				}
				
				$c_s_4 = $count_single_4 * 2;
				$c_m_4 = $count_multi_4 * 4;
				$c_m6_4 = $count_multi6_4 * 6;
				$c_m7_4 = $count_multi7_4 * 7;
				$c_all_4 = $c_s_4 + $c_m_4 +$c_m6_4 +$c_m7_4;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
 
	<meta charset="utf-8">
	<title><?php echo $lang_29;?></title>
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
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>الدراعات</span>
			</div>
			<br/>
			<!-- content starts -->
						
						
					<div class="row-fluid sortable">		
				<div class="box span10">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $lang_29;?> </h2>
						
					</div>
 					<center> <h2><?php echo $lang_408;?>: <font color="orange"><?php echo $ps3+$ps4+$ps3n+$ps4n;?></font> <?php echo $lang_175;?></h2></center>
 					<center> <h2><?php echo $lang_30;?>: <font color="orange"><?php echo $ps3+$ps4;?></font> <?php echo $lang_175;?></h2></center>
 					<center> <h2><?php echo $lang_31;?>: <font color="orange"><?php echo $ps3n+$ps4n;?></font> <?php echo $lang_175;?></h2></center>
 					<center> <h2><?php echo $lang_174;?>: <font color="orange"><?php echo $c_all_3+$c_all_4;?></font> <?php echo $lang_175;?></h2></center>
					<br/>
					<br/>
					<h3>دراعات PS3 المستخدمة الان  ( <font color="orange"><?php echo $c_all_3?></font> دراع )</h3>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						 <thead>
<tr>
								  <th><font color="green"><?php echo $lang_3;?> </font></th>
								  <th><font color="green"><?php echo $lang_4;?> </font></th>
								  <th><font color="green"><?php echo $lang_6;?>  </font></th>
								  <th><font color="green"><?php echo $lang_7;?>  </font></th>
</tr>
</thead>	  
<tbody>
 <tr> 
                                  <td><?php echo $c_s_3;?> <font color="red"> <?php echo $lang_175;?></font></td>
                                  <td><?php echo $c_m_3;?> <font color="red"> <?php echo $lang_175;?></font></td>
                                  <td><?php echo $c_m6_3;?> <font color="red"> <?php echo $lang_175;?></font></td>
                                  <td><?php echo $c_m7_3;?> <font color="red"> <?php echo $lang_175;?></font></td>
 </tr> 
 <tr>
 <td colspan="3"><h3>اجمالي دراعات PS3 السليمة</h3></td>
 <td colspan="2"><h3>
<form action="control_joystick.php" method="POST">
 <input name="ps3" style="height: 36px;width: 60px;font-size: 40px;" type="number" value="<?php echo $ps3?>"/>  <button type="submit">تعديل</button></h3>
 </form>
 </td>
 <td></td>
 </tr>

  <tr>
 <td colspan="3"><h3>اجمالي دراعات PS3 الغير سليمة</h3></td>
 <td colspan="2"><h3> <form action="control_joystick.php" method="POST">
 <input name="ps3n" style="height: 36px;width: 60px;font-size: 40px;" type="number" value="<?php echo $ps3n?>"/>  <button type="submit">تعديل</button></h3>
 </form></td>
 <td></td>
 </tr>
						  </tbody>
					  </table>            
					</div>
										<h3>دراعات PS4 المستخدمة الان ( <font color="orange"><?php echo $c_all_4?> </font>دراع )</h3>

					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						 <thead>
<tr>
								  <th><font color="green"><?php echo $lang_3;?> </font></th>
								  <th><font color="green"><?php echo $lang_4;?> </font></th>
								  <th><font color="green"><?php echo $lang_6;?>  </font></th>
								  <th><font color="green"><?php echo $lang_7;?>  </font></th>
</tr>
</thead>	  
<tbody>
 <tr> 
                                  <td><?php echo $c_s_4;?> <font color="red"> <?php echo $lang_175;?></font></td>
                                  <td><?php echo $c_m_4;?> <font color="red"> <?php echo $lang_175;?></font></td>
                                  <td><?php echo $c_m6_4;?> <font color="red"> <?php echo $lang_175;?></font></td>
                                  <td><?php echo $c_m7_4;?> <font color="red"> <?php echo $lang_175;?></font></td>
 </tr>  <tr>
 <td colspan="3"><h3>اجمالي دراعات PS4 السليمة</h3></td>
 <td colspan="2"><h3> <form action="control_joystick.php" method="POST">
 <input name="ps4" style="height: 36px;width: 60px;font-size: 40px;" type="number" value="<?php echo $ps4?>"/>  <button type="submit">تعديل</button></h3>
 </form></td>
 <td></td>
 </tr>
  <tr>
 <td colspan="3"><h3>اجمالي دراعات PS4 الغير سليمة</h3></td>
 <td colspan="2"><h3><form action="control_joystick.php" method="POST">
 <input name="ps4n" style="height: 36px;width: 60px;font-size: 40px;" type="number" value="<?php echo $ps4n?>"/>  <button type="submit">تعديل</button></h3>
 </form></td>
 <td></td>
 </tr>

						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div>	
						
						
						
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
