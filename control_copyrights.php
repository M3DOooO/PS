<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
 
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}    $id=$_GET['id'];			
    $type=$_GET['type'];			
    $_SESSION['id']="$id";
    $cat = $_GET['cat']; 		
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gesture for Playstation</title>
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
			<?php 
			mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	$sql="SELECT * FROM version";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
		{
	     $name = $row['name'];
	     $phone = $row['phone'];
	     $buy_date = $row['buy_date'];
	     $renew = $row['renew'];
	     $client_id = $row['client_id'];
	     $version_num = $row['version_num'];
	     $version_last_update = $row['version_last_update'];
		}
			?>
			<div id="content" class="span10">
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>عن البرنامج</span>
			</div>
			<br/>
			<!-- content starts -->
<div class="row-fluid">
				<div class="span6">
				<hr/>
					<center> <h3>بيانات مالك هذه النسخة</h3></center>
					 <h4>الإسم: <?php echo $name;?></h4><br/>
					 <h4>التليفون: <?php echo $phone;?></h4><br/>
					 <h4>تاريخ الشراء: <?php echo $buy_date;?></h4><br/>
					 <h4>تاريخ التجديد: <?php echo $renew;?></h4><br/>
					 <h4 style="margin-bottom: 23px;">الرقم المرجعي: <?php echo $client_id;?></h4>
				<hr/>
				النسخة الحالية: v<?php echo $version_num;?><br/>
				تاريخ اخر تعديل: <?php echo $version_last_update;?>
				<hr/>
				</div><!--/span-->
				<div class="span6">
				<center>
				<hr/>
					<h2 class="login-introfont">
					<?php echo $lang_169;?><br/>
					<img src="img/app/defaults/logo20.png"/> 
					  <br/><?php echo $lang_168;?></h2>
					  <hr/>
				</center>
				<p>جميع الحقوق محفوظة لشركة Hype Solutions ولا يحق إعادة بيع أو نسخ البرنامج الا عن طريق الشركة نفسها, و من يخالف ذلك يعرض نفسه للمسائلة القانونية</p>
				<hr/>
 				</center>
 				</div><!--/span-->
				<div class="span12">
				<center>
				<h2>للإستفسارات أو الدعم الفني اتصل على</h2>
				<br/>
				
				<h3 style="direction:ltr;">010 2648 1000</h3>
				<h3 style="direction:ltr;">010 2648 2000</h3>
				<h3><a target="_blank" href="http://www.psxegy.com">www.psxegy.com</a></h3>
				</div>
			</div><!--/row-->					<!-- content ends -->
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
