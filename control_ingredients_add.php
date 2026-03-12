<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
 
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}    $id=$_GET['id'];			

            

		
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_366;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $lang_1;?>">
	<meta name="author" content="Mohamed Gad">
	<!-- The styles -->
	<script src="js/jquery-1.7.2.min.js"></script>
<script>
$(document).ready(function()
{
    function updatePrice()
    {
        var price = parseFloat($("#dare_price").val());
        var qty = parseFloat($("#qty").val());
        // var total = (price + 1) * 1.05;
         var total = price/qty;
        var total = total.toFixed(4);
        $("#total_price_amount").val(total);
    }
	    $(document).on("change, keyup", "#dare_price", updatePrice);
});
 		 
</script>
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
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_ingredients.php"><span>المكونات</span></a> / <span>إضافة مكون جديد</span>
			</div>
			<br/>
			<?php 
			$success = $_GET['success'];
			if($success == 'added'){
			?>
			<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?>!</strong> إضافة مكون جديد
						</div> 
			<?php }?>
			<!-- content starts -->
			 
  			 <center>
<form action="actions/ingredients/add.php" method="POST" >
 		 <label class="control-label" for="focusedInput"><?php echo $lang_374;?></label>
								<div class="controls">
							
								 
								
  <?php echo $lang_370;?><br><input type="text" name="ing_name" ><br>
  <?php echo $lang_180;?><br><input type="text" id="qty" name="ing_qty" ><br>
  <?php echo $lang_372;?><br><input  id="dare_price" type="text" name="total_paid" ><br>
  <?php echo $lang_373;?><br><input type="text" name="ing_price" id="total_price_amount" readonly="readonly" size="10" value=""><br>
  <?php echo $lang_367;?><br><input type="text" name="ing_unit" ><br>
          
 
  
								</div>
 								<button type="submit" class="btn btn-primary"><?php echo $lang_366;?></button>
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
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">Gesture For Playstation</a> <?php $Year = idate('Y');   echo $Year;?></p>
			
		</footer>
		
	</div><!--/.fluid-container-->
<?php  include 'includes/js.php';?>

		
</body>
</html>
