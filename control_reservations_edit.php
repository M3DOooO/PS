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
	<title><?php echo $lang_76;?></title>
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
<!-- jQuery UI -->
<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
 
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
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
			<!-- content starts -->
			 
  			 <center>
<form action="actions/reservations/edit.php" method="POST" >
 		 <label class="control-label" for="focusedInput"><?php echo $lang_421;?></label>
								<div class="controls">
							
								 <?php 
$id = $_GET['id'];

$result = mysql_query("SELECT * FROM `reservation` WHERE `id` = '$id'");
while($row = mysql_fetch_array($result))
{
								?>	
<input type="hidden" name="id" value="<?php echo $id;?>"/>
  <?php echo $lang_21;?>:<br><input type="text" name="re_name" value="<?php echo $row['name'];?>" required><br>
  <?php echo $lang_77;?>:<br><input type="text" name="re_date" id="datepicker"  value="<?php echo $row['date'];?>"><br>
  <?php echo $lang_78;?><br><input type="text" name="re_time"  value="<?php echo $row['time'];?>" > </br>
    <?php echo $lang_79;?>:<br><input type="text" name="re_mobile"  value="<?php echo $row['mobile'];?>"><br>
  <?php echo $lang_80;?>:<br><input type="text" name="re_type"  value="<?php echo $row['type'];?>"><br>
  <?php echo $lang_81;?>:<br><input type="number"  step="0.1" min="0" name="re_money"  value="<?php echo $row['money'];?>"><br>
             
<?php }?>
  
								</div>
								
								<button type="submit" class="btn btn-primary"><?php echo $lang_232;?></button>
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
