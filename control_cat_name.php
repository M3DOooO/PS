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
              $id=$_GET['id'];			
               $_SESSION['id']="$id";
		$var1 = $_POST['quan'];
		$var2 = $_POST['new_name'];
		$var3 = $_POST['new_price'];
		$cat = $_GET['cat'];
		if(isset($var1)||isset($var2)||isset($var3))
		{
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
   mysql_select_db("$db") or die(mysql_error()); 

 mysql_query("UPDATE `stock` set `we_have` = '$var1'  WHERE `id` = '$id';");  
 mysql_query("UPDATE `stock` set `name` = '$var2'  WHERE `id` = '$id';");  
 mysql_query("UPDATE `stock` set `price` = '$var3'  WHERE `id` = '$id';");   

		}
		$type= $_GET['type'];
 
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_229;?></title>
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
			<?php if($type == 'drinks'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_drinks_cat.php"><span>فئات المشروبات</span></a> / <a href="control_drinks.php?cat=<?php echo $cat;?>"><span><?php echo $cat;?></span></a> / <span>تعديل اسم الفئة</span>
			</div>
			<?php }else if($type == 'food'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_food_cat.php"><span>فئات المأكولات</span></a> / <a href="control_food.php?cat=<?php echo $cat;?>"><span><?php echo $cat;?></span></a> / <span>تعديل اسم الفئة</span>
			</div>
			<?php }?>
			<br/>
			<?php 
			$success = $_GET['success'];
			if($success == 'added'){
			?>
			<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?>!</strong> إضافة فئة جديدة
						</div> 
			<?php }?>
			<!-- content starts -->
			 
			 
			 <?php 
								$id = $_GET['id'];
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `stock` Where sub_cat = '$cat' LIMIT 1");
			 while($row = mysql_fetch_array($result))
  {
 
 $old_cat = $_GET['old_cat'];
  ?>
  
  
			 
			 
			 
			 
 <center> 			 
<form action="actions/products/edit_cat_name.php" method="POST" >
<input type ="hidden" name = "change_sub" value="true" >
<input type ="hidden" name = "old_cat" value="<?php echo $row['sub_cat'];?>" >
<input type ="hidden" name = "type" value="<?php echo $type;?>" >
    <h2><font color="red" ><?php echo $lang_230;?>: </font><?php  echo $row['sub_cat'] ?></h2>

   </br>
  </br>
 <h3><?php echo $lang_194;?></h3>
  </br>
  <?php echo $lang_231;?>:<br><input type="text" name="sub_sub" value="<?php echo $row['sub_cat'];?>"><br>
 
 								  
 								<button type="submit" class="btn btn-primary"><?php echo $lang_232;?></button>
</center>
</form>     


			<?php  } ?>
  
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
