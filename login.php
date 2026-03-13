<?php
if (function_exists('session_status')) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
} elseif (!isset($_SESSION)) {
    session_start();
}

include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}$id = $_GET['id'];     ob_start();  
	system('ipconfig /all');  
	$mycom=ob_get_contents(); 
	ob_clean();  
	$findme = "Physical";
	$pmac = strpos($mycom, $findme); 
	$mac=substr($mycom,($pmac+36),17);  
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
	$lab = $row['lic'];
	$m = md5($mac);
 	}
    // if($lab != $m)
    // {
	// header("location:install.php");
	// die();
	// }
	$lang_lo = $_GET['lo'];
if(isset($lang_lo))
{
	if($lang_lo == 'ar')
	{
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("UPDATE `config` set `lang` = 'ar';"); 
	echo "<script>location='login.php'</script>";
	}
	else if($lang_lo == 'en')
	{
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("UPDATE `config` set `lang` = 'en';"); 		
	echo "<script>location='login.php'</script>";
	}
}
?>
<!DOCTYPE html>
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
						<font size="6" face="Arial Unicode MS" color="#33b5e5">PlayStation</font>
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
						<?php echo $lang_185;?>
					</div>
				<?php }	else { ?>
					
				<div class="alert alert-info">
						<?php echo $lang_186;?>
					</div><?php  } ?>
					<form class="form-horizontal" action="actions/login/login_process.php" method="post">
						<fieldset>
							<div class="input-prepend" title="<?php echo $lang_88;?>" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="ps_user" id="username" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="<?php echo $lang_89;?>" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="ps_pass" id="password" type="password" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" /><?php echo $lang_188;?></label>
							</div>
							<div class="clearfix"></div>
        <a href="login.php?lo=ar" data-rel="tooltip" title="<?php echo $lang_358;?>"><img src="img/app/login/eg.ico" width="25" height="25" /></a>
		<a href="login.php?lo=en" data-rel="tooltip" title="<?php echo $lang_359;?>"><img src="img/app/login/us.ico" width="25" height="25" /></a>					  
 							<p class="center span5">
							<button type="submit" class="btn btn-primary"><?php echo $lang_187;?></button>
							</p>
						</fieldset>
					</form>
					<center><img src = "img/app/defaults/logo20.png"  /></center>
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
