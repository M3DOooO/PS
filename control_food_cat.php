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

$del = $_GET['delete'];
$dsub = $_GET['sub'];
if(isset($del))
{
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
  mysql_query("DELETE FROM stock WHERE sub_cat = '$dsub' "); 
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title><?php echo $lang_224;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $lang_1;?>">
	<meta name="author" content="Mohamed Gad">

	<!-- The styles -->
	 <?php include('includes/css.php');?>

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
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>فئات المأكولات</span>
			</div>
			<br/>
			<?php 
			$success = $_GET['success'];
			if($success == 'deleted'){
			?>
			<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?>!</strong> حذف فئة بنجاح
						</div> 
			<?php }
			if($success == 'edited'){
			?>
			<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?>!</strong> تعديل اسم الفئة
						</div> 
			<?php }?>
			<!-- content starts -->
			<a href ="control_cat_add.php?type=food" class="btn btn-primary"><?php echo $lang_52;?></a>

			<center><h2><?php echo $lang_223;?></h2></center></br></br>
<div class="sortable row-fluid">
  <?php  mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
 
 $sql="SELECT  * FROM stock WHERE catagory = 'food' GROUP BY sub_cat";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
  { 
  $sc = $row['sub_cat'];
  $scimg = $row['img'];
  ?>
				<div data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="control_food.php?cat=<?php  echo $sc; ?>">
					<span><img src="img/<?php echo $scimg;?>" height="35" /></span>
					<div><a href="control_food.php?cat=<?php  echo $sc; ?>"><?php  echo $row['sub_cat'];?></a></div>
 					<span class="notification red"><a href='actions/products/delete_cat.php?type=food&&sub=<?php echo $sc;?>'  onclick="return confirm('<?php echo $lang_244;?>')"> <?php echo $lang_167;?> </a></span>
				</div>
				
			<?php  }	?>
				
	 

				</div>

		
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
