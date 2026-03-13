<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
 
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}
    $id=$_GET['id'];			
    $type=$_GET['type'];			
    $_SESSION['id']="$id";
	$cat = $_GET['cat']; 
	
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>تعديل الأيقونة</title>
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
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_drinks_cat.php"><span>فئات المشروبات</span></a> / <a href="control_drinks.php?cat=<?php echo $cat;?>"><span><?php echo $cat;?></span></a> / <span>تغيير الأيقونة</span>
			</div>
			<?php }else if($type == 'food'){?>
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <a href="control_food_cat.php"><span>فئات المأكولات</span></a> / <a href="control_food.php?cat=<?php echo $cat;?>"><span><?php echo $cat;?></span></a> / <span>تغيير الأيقونة</span>
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
			 
			 ?>
  			 
                    <center><form enctype="multipart/form-data" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset class="habl" dir="rtl">
<legend><?php echo $lang_54.' '.$cat;?> </legend>
 <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
 <input name="userfile" type="file" /></br></br>                     
			  
<?php
	// echo $value1;		    

// check if a file was submitted
if(!isset($_FILES['userfile'])) {
echo $lang_55;
}
else
{
try {
upload(); //this will upload your image
echo $lang_56; //Message after uploading

}
catch(Exception $e) {
echo $e->getMessage();
 echo $lang_57;
}
}
// the upload function
function upload(){
include "includes/config.php";
$maxsize = $_POST['MAX_FILE_SIZE'];
if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {
// check the file is less than the maximum file size
if( $_FILES['userfile']['size'] < $maxsize)
{
// prepare the image for insertion
$imgData =addslashes
(file_get_contents($_FILES['userfile']['tmp_name']));
// put the image in the db...
// database connection
mysql_connect($host, $user, $pass) OR DIE (mysql_error());
// select the db
mysql_select_db ($db) OR DIE ("Unable to select db".mysql_error());
// our sql query
//to assign the image to the registered person
		
$sql ="UPDATE `stock` SET `img` = '{$_FILES['userfile']['name']}'  WHERE `new` = 'new'";
 
// insert the image
mysql_query($sql) or die("Error in Query: " . mysql_error());


    if (file_exists("img/" . $_FILES["userfile"]["name"]))
      {
      echo $_FILES["userfile"]["name"] . "";
      }
    else
      {
      move_uploaded_file($_FILES["userfile"]["tmp_name"],
      "img/" . $_FILES["userfile"]["name"]);
      }

	  	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("UPDATE `stock` set `new` = '-'  ;"); 
	  
	  
}
}
 
}
?>
		
<input type="submit" value="<?php echo $lang_58;?>" />
   </fieldset>
</form> 
                
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">׼/button>
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
