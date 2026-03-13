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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_251;?></title>
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
			
			<?php 
			$back = $_GET['backup'];
			if($back =='true'){?>
			<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?></strong> أخذ نسخة إحتياطية
						</div>
			<?php }?>
			
			<!-- content starts -->
			<?php 
  include('includes/config.php');
 
$Month = idate('m');
$Year = idate('Y');
$Day = idate('d');
			// if($current_shif == 'One')
			// {
				// $echo_current_shift = 'الأولى';
			// }
			// else
			// {
				// $echo_current_shift = 'الثانية';
			// }
 
 			?>
			<div class="sortable row-fluid">
				 				
				<!-- <a data-rel="tooltip"   class="well span3 top-blockk" href="reports_shift.php"> -->
					<!-- <span class="icon32 icon-color icon-copy"></span> -->
					<!-- <div>تقارير بالشفت</div> -->
					<!-- <div>الشفت الحالية <?php echo $echo_current_shift; ?></div> -->
					<!-- <span class="notification green">اليوم</span> -->
				<!-- </a> -->

				<a data-rel="tooltip"   class="well span3 top-blockk" href="reports_day.php">
					<span><img src="img/app/reports/day-rec.png" height="50" /></span>
					<div><?php echo $lang_252;?></div>
					<div><?php echo $lang_253;?> <?php echo $Day; ?></div>
					<span class="notification green"><?php echo $lang_177;?></span>
				</a>

				<a data-rel="tooltip"   class="well span3 top-blockk" href="reports_month.php">
					<span><img src="img/app/reports/month-rec.png" height="50" /></span>
					<div><?php echo $lang_254;?></div>
					<div><?php echo $lang_255;?> <?php echo $Month; ?></div>
					<span class="notification green"><?php echo $lang_176;?></span>
				</a>

				<a data-rel="tooltip"  class="well span3 top-blockk" href="reports_year.php">
					<span><img src="img/app/reports/year-rec.png" height="50" /></span>
					<div><?php echo $lang_256;?></div>
					<div><?php echo $lang_260;?> <?php echo $Year; ?></div>
					<span class="notification red"><?php echo $lang_257;?></span>
				</a>
				<a data-rel="tooltip"  class="well span3 top-blockk" href="reports_search.php">
					<span><img src="img/app/reports/search-rec.png" height="50" /></span>
					<div><?php echo $lang_258;?></div>
					<div><?php echo $lang_259;?></div>
					<span class="notification red"><?php echo $lang_258;?></span>
				</a>	
				<a data-rel="tooltip"  class="well span3 top-blockk" href="reports_login.php">
					<span><img src="img/app/reports/log-view.png" height="50" /></span>
					<div><?php echo $lang_401;?></div>
					<div></div>
					<span class="notification red"><?php echo $lang_126;?></span>
				</a>
				<a data-rel="tooltip"  class="well span3 top-blockk" href="actions/backup/backup.php">
					<span><img src="img/app/reports/backup.png" height="50" /></span>
					<div><?php echo $lang_407;?></div>
					<div></div>
					<span class="notification red"><?php echo $lang_395;?></span>
				</a>
				
				
								 
			</div>

					<!-- content ends -->
			</div><!--/#content.span10-->
	
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
