<?php session_start();
if( !isset($_SESSION['ps_user']) )
{
	include('login.php');
	die();
}

include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}$id = $_GET['id']; $id = $_GET['id']; 
$date = $_GET['date']; 
$sess = $_GET['session']; 

$delete = $_GET['rid'];
$rmonth = $_GET['month'];
if(isset($delete))
{

	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("DELETE FROM members WHERE id = $delete"); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $lang_283;?></title>
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
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>بيانات العملاء</span>
			</div>
			<br/>
			<?php 
			$success = $_GET['success'];
			if($success == 'edited'){
			?>
			<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?>!</strong> تعديل بيانات العميل
						</div> 
			<?php }?>
<!-- content starts -->
<a href="control_members_add.php" class="btn btn-success"><?php echo $lang_35;?></a>
<div class="row-fluid">		
<div class="box span11">
<div class="box-header well" data-original-title>
<h2><i class="icon-user"></i> <?php echo $lang_283;?> </h2>

</div>

<div class="box-content">
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<?php 
// To connect to the database
$result = mysql_query("SELECT * FROM `members`");
?><thead>
<tr>
								<th><?php echo $lang_38;?></th>
								<th><?php echo $lang_21;?></th>
								<th><?php echo $lang_37;?></th>
								<th><?php echo $lang_39;?> - <?php echo $lang_194;?></th>
<?php 
$now = $_SESSION['ps_user'];
$sqlqq="SELECT * FROM users WHERE Username = '$now'";
$resultqq=mysql_query($sqlqq);
while($rowqq = mysql_fetch_array($resultqq))
{
	$usern = $rowqq['type'];
}
if($usern == 1 )
{
	?>
								<th><?php echo $lang_167;?></th>
<?php 
}
?>
</tr>
</thead> 
<tbody>
<?php 
while($row = mysql_fetch_array($result))
{
	$reid = $row['id'];
	echo "<tr>";
	echo "<td>" . $row['card'] . "</td>";
	echo "<td>" . $row['name'] . "</td>";
	echo "<td>" . $row['mobile'] . "</td>";
	echo "<td>" . $row['points'] . "</td>";
	 
$now = $_SESSION['ps_user'];
$sqlqq="SELECT * FROM users WHERE Username = '$now'";
$resultqq=mysql_query($sqlqq);
while($rowqq = mysql_fetch_array($resultqq))
{
	$usern = $rowqq['type'];
}
if($usern == 1 )
{
	?>      
	<td class="center">
	<span class="label label-important">
	<a href="control_members.php?rid=<?php  echo $reid;?>"  onclick="return confirm('<?php echo $lang_244;?>')" ><?php echo $lang_167;?></a>
	</span>
	<span class="label label-info">
	<a href="control_members_edit.php?id=<?php  echo $reid;?>"><?php echo $lang_194;?></a>
	</span>
    </td>   
	<?php }
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
