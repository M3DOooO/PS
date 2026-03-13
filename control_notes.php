<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
 
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}$id = $_GET['id'];  $id = $_GET['id']; 
 $date = $_GET['date']; 
 $sess = $_GET['session']; 
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
$delete = $_GET['rid'];
$done = $_GET['done'];
$rmonth = $_GET['month'];
   if(isset($delete))
   {
   
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
  mysql_query("DELETE FROM notes WHERE id = $delete"); 
   } 
   if(isset($done))
   {
   
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
  mysql_query("Update notes SET seen = 'yes' WHERE id = $done"); 
   }
    
	
	
	$delete2 = $_GET['reset'];
	if(isset($delete2))
	{
		   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
  mysql_query("TRUNCATE notes"); 
	}
	
	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>الملاحظات</title>
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
				<div class="box span10"> <a href="control_notes.php?reset=true" class="btn btn-danger">تصفير الملاحظات</a>

					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> الملاحظات </h2>
						
					</div>
 					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
// To connect to the database
$result = mysql_query("SELECT * FROM `notes` ORDER BY seen DESC");
?><thead>
<tr>
								  <th>م</th>
								  <th>الملاحظة</th>
								  <th>اليوم</th>
								  <th>الشهر</th>
                                  <th>السنة</th>
								  <th>الساعة</th>
								  <th>الكاشير</th>
								  <th>الشفت</th>
								  <th>الحالة</th>
								  <th>التحكم</th>
								  
 </tr>
</thead> 	  						   
						  <tbody>
						  <?php 
while($row = mysql_fetch_array($result))
{
 $reid = $row['id'];
  $seen = $row['seen'];
 if($seen == 'no')
 {
  echo "<tr style='background-color:white;'>";
 }
 else{
	  echo "<tr>"; 
 }
   echo "<td>" . $row['id'] . "</td>";
   echo "<td>" . $row['note'] . "</td>";
   echo "<td>" . $row['day'] . "</td>";
   echo "<td>" . $row['month'] . "</td>";
   echo "<td>" . $row['year'] . "</td>";
   echo "<td>" . $row['hour'] . "</td>";
   echo "<td>" . $row['casheer']. "</td>";
   echo "<td>" . $row['shift']. "</td>";
 ?>
 <td><?php if($seen =='no'){echo '<font color="green">جديد</font>';}else{echo 'قديم';}?></td>
 <?php 
   
  ?>
 <td class="center" >
 <?php if($seen =='no'){?>
  <span class="label label-success"><a href="control_notes.php?done=<?php  echo $reid;?>" >تمت المشاهدة</a></span>
 <?php }?>
 <span class="label label-important"><a href="control_notes.php?rid=<?php  echo $reid;?>" ><?php echo $lang_167;?></a></span>
									</td>    <?php 
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
