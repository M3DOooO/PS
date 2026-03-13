<?php session_start();
  	include('includes/config.php');
	if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}$id = $_GET['id']; 

	   	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	$sql="SELECT * FROM config";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
		{
			$logo = $row['logo'];
			$store = $row['store'];
			$phone = $row['phone'];
			$facebook = $row['facebook'];
		}
		
?>
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PlayStation</title>
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
				 
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2 class="login-introfont">
						<img src="img/app/defaults/ps_logo.png" alt="PlayStation Logo" style="max-width: 90px; margin-bottom: 8px;" />
						<br/>
						<font size="7" color="#33b5e5">PlayStation</font>
					</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
			<?php 	$error = $_GET['error'];
			if(isset($error))
			{
			?>
						<div class="alert alert-error">
						<?php echo $lang_170;?>
					</div>
				<?php }	else { ?>
				<div class="alert alert-info">
						<?php echo $lang_171;?>
					</div><?php  } ?>
					<form class="form-horizontal" action="actions/login/login_processs.php" method="post">
						<fieldset>
							<div class="input-prepend" title="<?php echo $lang_172;?>" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="p_spass" id="username" type="password" value="" />
							</div>
						       <div class="clearfix"></div>
							 
  
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary"><?php echo $lang_173;?></button>
							</p>
						</fieldset>
					</form>
					<center><img src = "img/app/defaults/ps_logo.png"  /></center>
				</div><!--/span-->
			</div><!--/row-->
				</div><!--/fluid-row-->
		<footer>
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">PlayStation</a> <?php $Year = idate('Y');   echo $Year;?></p>
 		</footer>
	</div><!--/.fluid-container-->
<?php  include 'includes/js.php';?>

		
</body>
</html>
