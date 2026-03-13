<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
    die();
} 
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_35;?></title>
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
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_members.php"><span>بيانات العملاء</span></a> / <span>إضافة عميل جديد</span>
			</div>
			<br/>
			<?php 
			$success = $_GET['success'];
			if($success == 'added'){
			?>
			<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?>!</strong> إضافة عضو جديد
						</div> 
			<?php }?>
			<!-- content starts -->
  			 		<center>
<form action="actions/members/add.php" method="POST" >
 		 <label class="control-label" for="focusedInput"><?php echo $lang_35;?></label>
								<div class="controls">
  <?php echo $lang_21;?>:<br/><input  type="text" name="new_member_name"   required><br/>
  <?php echo $lang_37;?>:<br/><input  type="text" name="new_member_mobile" required><br/>
  <?php echo $lang_38;?>:<br/><input  type="text" name="new_member_card"   ><br/>
  <?php echo $lang_39;?>:<br/><input  type="text" name="new_member_points" value="0" ><br/>
								</div>
  <button type="submit" class="btn btn-primary"><?php echo $lang_35;?></button>
  </center>
  </form>       
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