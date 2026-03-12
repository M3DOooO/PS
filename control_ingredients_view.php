<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
 
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}    $id=$_GET['id'];			

             $id=$_GET['id'];			
			//  session_register("id");
              $_SESSION['id']="$id";
		$var1 = $_POST['quan'];
		$var2 = $_POST['new_name'];
		$var3 = $_POST['new_price'];
		if(isset($var1)||isset($var2)||isset($var3))
		{
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
   mysql_select_db("$db") or die(mysql_error()); 

 mysql_query("UPDATE `stock` set `we_have` = '$var1'  WHERE `id` = '$id';");  
 mysql_query("UPDATE `stock` set `name` = '$var2'  WHERE `id` = '$id';");  
 mysql_query("UPDATE `stock` set `price` = '$var3'  WHERE `id` = '$id';");   

		}
 

		
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_369;?></title>
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
								$id = $_GET['id'];
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `ingredients` Where id = '$id'");
			 while($row = mysql_fetch_array($result))
  {
  			$aaas =  $row['stock'] - $row['sold'];
$item_name = $row['name'];
  $resultx = mysql_query("SELECT *,SUM(stock) FROM `ingredients` Where name = '$item_name'");
			 while($rowx = mysql_fetch_array($resultx))
  {
	  $sss = $rowx['SUM(stock)'];
  }
  ?>
			<div id="content" class="span10">
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_ingredients.php"><span>المكونات</span></a> / <span><?php echo $item_name;?></span>
			</div>
			<br/>
			<!-- content starts -->
			 
			 

<center>
<form action="actions/ingredients/edit.php" method="POST">
<input type ="hidden" name = "iddd" value="<?php  echo $id;?>" >
<input type ="hidden" name = "old" value="<?php  echo $sss ?>" >
   <h2><font color="red" ><?php echo $lang_21;?> </font><?php  echo $row['name'] ?></h2>
  <h2><font color="blue" ><?php echo $lang_235;?> </font><?php  echo $row['price']?> <?php echo $lang_100;?></h2>
  <h2><font color="Green" ><?php echo $lang_236;?> </font><?php  echo $sss?> <?php  echo $row['unit']?></h2>
   </br>
   <button data-toggle="modal" data-target="#myModal"><?php echo $lang_238;?></button>
  </br>
 <h3><?php echo $lang_194;?></h3>
  </br>
 <!-- Add Items:<br><input type="text" name="quan" value="0"><br> -->


  <?php echo $lang_239;?></br><input type="text" name="new_name" value="<?php  echo $row['name'] ?>"></br>
  <?php echo $lang_240;?></br><input type="text" name="new_price" value="<?php  echo $row['price'] ?>"></br>
  <?php echo $lang_413;?></br><input type="text" name="new_unit" value="<?php  echo $row['unit'] ?>">
 								  
 								<br/><button type="submit" class="btn btn-primary"><?php echo $lang_232;?></button>
</center>
</form>     			<?php  } ?>

					<!-- content ends -->
			
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<h3>إضافة كمية جديدة</h3>
			</div>
			
			<div class="modal-body">
            <form action="actions/ingredients/add_qty.php?id=<?php echo $id;?>" method="POST">
			<input type="hidden" name="old_stock" value="<?php echo $sss;?>">
			<label>الكمية الجديدة</label><input type="number" name="add_new_quan"/>
			<label>تكلفة الكمية</label><input type="number" name="add_new_cost"/>
			
			</div>
			<div class="modal-footer">
							<button href="#" type="submit" class="btn btn-primary">حفظ</button>

				<a href="#" class="btn" data-dismiss="modal">إغلاق</a>
			</div>
			</form>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">Gesture For Playstation</a> <?php $Year = idate('Y');   echo $Year;?></p>
			
		</footer>
		
	</div><!--/.fluid-container-->

	<?php  include 'includes/js.php';?>
	
		
</body>
</html>
