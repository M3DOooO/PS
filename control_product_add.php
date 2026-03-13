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
	
$id=$_GET['id'];			
    $type=$_GET['type'];			
    $_SESSION['id']="$id";
    $cat = $_GET['cat']; 
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
 	<meta charset="utf-8">
	<title><?php echo $lang_47;?></title>
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
			<?php if($type == 'drinks'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_drinks_cat.php"><span>فئات المشروبات</span></a> / <a href="control_drinks.php?cat=<?php echo $cat;?>"><span><?php echo $cat;?></span></a> / <span>إضافة صنف جديد</span>
			</div>
			<?php }else if($type == 'food'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_food_cat.php"><span>فئات المأكولات</span></a> / <a href="control_food.php?cat=<?php echo $cat;?>"><span><?php echo $cat;?></span></a> / <span>إضافة صنف جديد</span>
			</div>
			<?php }else if($type == 'general'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_gen.php"><span>الأصناف العامة</span></a> / <span>إضافة صنف جديد</span>
			</div>
			<?php }else if($type == 'choc'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_choc.php"><span>الحلويات</span></a> / <span>إضافة صنف جديد</span>
			</div>
			<?php }?>
			<br/>
			<?php 
			$success = $_GET['success'];
			if($success == 'added'){
			?>
			<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?>!</strong> <?php echo $lang_47;?><br/> 
  
						</div> 
			<?php }?>
			<!-- content starts -->
		
		
 <center> 			 
 
<form action="actions/products/add_product.php" method="POST" class="span4 pull-left">
 		 <label class="control-label" for="focusedInput"><?php echo $lang_48;?></label>
								<div class="controls">
							
								 
						 <h3><?php echo $lang_402;?></h3>		
  <?php echo $lang_49;?>:<br><input type="text" name="sub_name" required><br>
  <?php echo $lang_51;?>:<br><input type="number"  step="0.1" min="0" name="sub_price" required><br>
  <input type="hidden" name ="sub_ing" value="yes" >

  
 
		   <input type="hidden" name ="thetype" value="<?php  echo $type; ?>" >
            <input type="hidden" name ="cat" value="<?php  echo $cat; ?>" >
  
								</div>
 								<button type="submit" class="btn btn-primary"><?php echo $lang_47;?></button>

</form>    
   

<form action="actions/products/add_product.php" method="POST" class="span4 pull-right">
 		 <label class="control-label" for="focusedInput"><?php echo $lang_48;?></label>
								<div class="controls">
							
								 
								<h3><?php echo $lang_403;?></h3>
  <?php echo $lang_49;?>:<br><input type="text" name="sub_name" required><br>
  <?php echo $lang_51;?>:<br><input type="number"  step="0.1" min="0" name="sub_price" required><br>
    <input type="hidden" name ="sub_ing" value="no" >

 
  <?php echo $lang_50;?>:<br><input type="text" id="qty" name="sub_num" required><br>
  <?php echo $lang_392;?>:<br><input id="dare_price" type="text" name="sub_cost" ><br>
  <?php echo $lang_393;?>:<br><input id="total_price_amount" type="text"  readonly="readonly" name="" >

		   <input type="hidden" name ="thetype" value="<?php  echo $type; ?>" >
            <input type="hidden" name ="cat" value="<?php  echo $cat; ?>" >
  
								</div>
 								<button type="submit" class="btn btn-primary"><?php echo $lang_47;?></button>
</center>
</form>    
</center>
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
