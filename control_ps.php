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
$id = $_GET['id'];  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_119;?></title>
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
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>التحكم في الأجهزة</span>
			</div>
			<br/>
			
			<?php 
			$success = $_GET['success'];
			if($success == 'deleted')
			{
			?>
			<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?>!</strong> <?php echo $lang_280;?>
						</div>
			<?php }?>
			
			<!-- content starts -->
			<center><h2><?php echo $lang_119;?></h2></center></br></br>

			
						<?php 
			
    include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

$sql="SELECT * FROM devices ORDER BY orderby";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
  {
 			?>	
			<div class="row-fluid">
		<?php 
										?>
				<a data-rel="tooltip"   class="well span3 top-block" href="control_ps_edit.php?id=<?php echo $row['ID'];?>">
										<div><?php  echo $row['Device Name']; ?></div>
 
					<?php if($row['ps_version'] == '3') { ?>
			<span><img id="aa" src="img/app/devices/p3.png"    /></span>
			<?php }
		else if($row['ps_version'] == '4')
		{
			?>
			<span><img id="aa" src="img/app/devices/p4.png"    /></span>
			<?php }
		else if($row['ps_version'] == '2')
		{
			?>
			<span><img id="aa" src="img/app/devices/p2.png"     /></span>
			<?php } else if($row['ps_version'] == '5')
		{
			?>
			<span><img id="aa" src="img/app/devices/tenis.png"    /></span>
			<?php } else if($row['ps_version'] == '6')
		{
			?>
			<span><img id="aa" src="img/app/devices/billiard.png"    /></span>
			<?php }else if($row['ps_version'] == '7')
			{
				?>
				<span><img id="aa" src="img/app/devices/bein.png"   style="height: 50px;"  /></span>
			<?php }
			else if($row['ps_version'] == '8')
			{
				?>
				<span><img id="aa" src="img/app/devices/vr.png"     /></span>
			<?php }else if($row['ps_version'] == '9')
			{
				?>
				<span><img id="aa" src="img/app/devices/wii.png"  /></span>
			<?php }else if($row['ps_version'] == '10')
			{
				?>
				<span><img id="aa" src="img/app/devices/xbox.png"  /></span>
			<?php }
			else if($row['ps_version'] == '11')
			{
				?>
				<span><img id="aa" src="img/app/devices/cafe.png" style="height: 50px;" /></span>
			<?php }?>
	 
 					<span class="notification green"><?php echo $lang_331;?></span>
 				 <p><?php echo $lang_3;?>: <?php echo $row['single'];?> <?php echo $lang_100;?><br/>
				 <p><?php echo $lang_4;?>: <?php echo $row['multi'];?> <?php echo $lang_100;?><br/>
				 <p><?php echo $lang_6;?>: <?php echo $row['multi6'];?> <?php echo $lang_100;?><br/>
				 <p><?php echo $lang_7;?>: <?php echo $row['multi7'];?> <?php echo $lang_100;?></p>
				</a><?php }?>
  </div>
  
			
			</br>
			
			
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
