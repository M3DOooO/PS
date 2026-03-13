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
	
		$var1 = $_POST['quan'];
		$var2 = $_POST['new_name'];
		$var3 = $_POST['new_price'];
		$var4 = $_POST['iddd'];
		$var12 = $_POST['old'];
		$barcode = $_POST['barcode'];
		
				 
		
		
		if(isset($var1)||isset($var2)||isset($var3))
		{
		$var13 = $var1 + $var12;
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
   mysql_select_db("$db") or die(mysql_error()); 

 mysql_query("UPDATE `stock` set `we_have` = '$var13'  WHERE `id` = '$var4';");  
 mysql_query("UPDATE `stock` set `stock` = '$var13'  WHERE `id` = '$var4';");  
 mysql_query("UPDATE `stock` set `name` = '$var2'  WHERE `id` = '$var4';");  
 mysql_query("UPDATE `stock` set `price` = '$var3'  WHERE `id` = '$var4';");   
 mysql_query("UPDATE `stock` set `barcode` = '$barcode'  WHERE `id` = '$var4';");   

		}
		 
       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_118;?></title>
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
<?php include('includes/navbar.php');?>
		<div class="container-fluid">
		<div class="row-fluid">				
<!-- left menu starts -->
<?php include('includes/menu.php');?>
<!--/span-->
<!-- left menu ends -->
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<center><h2><?php echo $lang_118;?></h2></center></br></br>
<div class="row-fluid">
				<a data-rel="tooltip" title="<?php echo $lang_119;?>" class="well span3 top-blockk" href="control_ps.php">
					<span><img src="img/app/control/ps.png" height="50" /></span>
					<div><?php echo $lang_120;?></div>
 					<span class="notification"><?php echo $lang_121;?></span>
				</a>
				<a data-rel="tooltip" title="<?php echo $lang_122;?>" class="well span3 top-blockk" href="control_ps_add.php">
					<span><img src="img/app/control/add_ps.png" height="50" /></span>
					<div><?php echo $lang_122;?></div>
 					<span class="notification green"><?php echo $lang_123;?></span>
				</a>
				<a data-rel="tooltip" title="<?php echo $lang_124;?>" class="well span3 top-blockk" href="control_users.php">
					<span><img src="img/app/control/view.png" height="50" /></span>
					<div><?php echo $lang_125;?></div>
 					<span class="notification"><?php echo $lang_126;?></span>
				</a>
				<a data-rel="tooltip" title="<?php echo $lang_127;?>" class="well span3 top-blockk" href="control_users_add.php">
					<span><img src="img/app/control/add2.png" height="50" /></span>
					<div><?php echo $lang_128;?></div>
 					<span class="notification green"><?php echo $lang_123;?></span>
				</a>
				</div>
<center><h2><?php echo $lang_129;?></h2></center></br></br>
<div class=" row-fluid">

				<a data-rel="tooltip" title="<?php echo $lang_130;?>" class="well span3 top-blockk" href="control_drinks_cat.php">
					<span><img src="img/app/control/drinks.png" height="50" /></span>
					<div><?php echo $lang_131;?></div>
 					<span class="notification"><?php echo $lang_121;?></span>
				</a>
      			<a data-rel="tooltip" title="<?php echo $lang_132;?>" class="well span3 top-blockk" href="control_food_cat.php">
					<span><img src="img/app/control/food.png" height="50" /></span>
					<div><?php echo $lang_133;?></div>
 					<span class="notification yellow"><?php echo $lang_121;?></span>
				</a> 
				<a data-rel="tooltip" title="<?php echo $lang_134;?>" class="well span3 top-blockk" href="control_gen.php" >
					<span><img src="img/app/control/gen.png" height="50" /></span>
					<div><?php echo $lang_135;?></div>
 					<span class="notification green"><?php echo $lang_121;?></span>
				</a>	
		 
				<a data-rel="tooltip" title="<?php echo $lang_136;?>" class="well span3 top-blockk" href="control_choc.php" >
					<span><img src="img/app/control/choc.png" height="50" /></span>
					<div><?php echo $lang_111;?></div>
 					<span class="notification red"><?php echo $lang_121;?></span>
				</a>
				<a data-rel="tooltip" title="<?php echo $lang_375;?>" class="well span10 top-blockk" href="control_ingredients.php">
					<span><img src="img/app/control/gread.png" height="50" /></span>
					
					
					<div><?php echo $lang_365;?></div>
 					<span class="notification red"><?php echo $lang_121;?></span>
				</a>
 <a data-rel="tooltip" title="<?php echo $lang_384;?>" class="well span3 top-blockk" href="control_product_update_bulk.php" >
					<span><img src="img/app/control/plus.png" height="50" /></span>
					<div><?php echo $lang_385;?></div>
 					<span class="notification green"><?php echo $lang_115;?></span>
				</a>
				<a data-rel="tooltip" title="<?php echo $lang_386;?>" class="well span3 top-blockk" href="control_product_add_bulk.php">
					<span><img src="img/app/control/plus.png" height="50" /></span>
					<div><?php echo $lang_386;?></div>
 					<span class="notification green"><?php echo $lang_115;?></span>
				</a>
				<a data-rel="tooltip" title="<?php echo $lang_387;?>" class="well span3 top-blockk" href="control_ingredients_update_bulk.php">
					<span><img src="img/app/control/plus.png" height="50" /></span>
					<div><?php echo $lang_388;?></div>
 					<span class="notification green"><?php echo $lang_115;?></span>
				</a>
				<a data-rel="tooltip" title="<?php echo $lang_389;?>" class="well span3 top-blockk" href="control_ingredients_add_bulk.php">
					<span><img src="img/app/control/plus.png" height="50" /></span>
					<div><?php echo $lang_389;?></div>
 					<span class="notification green"><?php echo $lang_115;?></span>
				</a>		
				</div>
				<center><h2><?php echo $lang_137;?></h2></center></br></br>
				<div class=" row-fluid">
				<!--<a data-rel="tooltip" title="<?php //echo $lang_138;?>" class="well span3 top-blockk" href="add_out.php">
					<span><img src="img/out.png" height="50" /></span>
					<div><?php //echo $lang_104;?></div>
 					<span class="notification red"><?php //echo $lang_123;?></span>
				</a>
				<a data-rel="tooltip" title="<?php //echo $lang_139;?>" class="well span3 top-blockk" href="add_in.php">
					<span><img src="img/add_money.png" height="50" /></span>
					<div><?php //echo $lang_140;?></div>
 					<span class="notification red"><?php //echo $lang_123;?></span>
				</a>-->
                <a data-rel="tooltip"  class="well span3 top-blockk" href="control_reset_reports.php">
					<span><img src="img/app/control/del-time.png" height="50" /></span>
					<div><?php echo $lang_145;?></div>
					<div><?php echo $lang_146;?></div>
					<span class="notification red">-</span>
				</a>

				<a data-rel="tooltip"  class="well span3 top-blockk" href="control_reset_products.php">
					<span><img src="img/app/control/del-orders.png" height="50" /></span>
					<div><?php echo $lang_145;?></div>
					<div><?php echo $lang_147;?></div>
					<span class="notification red">-</span>
				</a>
				<a data-rel="tooltip" title="<?php echo $lang_141;?>" class="well span3 top-blockk" href="control_joystick.php">
					<span><img src="img/app/control/joystick.png" height="50" /></span>
					<div></br><?php echo $lang_29;?></div>
 					<span class="notification green"><?php echo $lang_121;?></span>
				</a>
								<a data-rel="tooltip" title="<?php echo $lang_143;?>" class="well span3 top-blockk" href="control_settings.php">
					<span><img src="img/app/control/wireless.png" height="50" /></span>
					<div></br><?php echo $lang_143;?></div>
 					<span class="notification green"><?php echo $lang_121;?></span>
				</a>
				<a data-rel="tooltip" title="عن البرنامج" class="well span10 top-blockk" href="control_copyrights.php">
					<span><img src="img/app/defaults/logo20.png" height="100" /></span>
					<div></br>عن البرنامج و حقوق الملكية</div>
 					<span class="notification green"><?php echo $lang_121;?></span>
				</a>
				 
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
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">PlayStation</a> <?php $Year = idate('Y');   echo $Year;?></p>
			
		</footer>
		
	</div><!--/.fluid-container-->
<?php  include 'includes/js.php';?>

		
</body>
</html>
