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
$_SESSION['id']="$id";		
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_83;?></title>
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
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>إضافة مستخدم جديد</span>
			</div>
			
			<!-- content starts -->
			 <br/>
  			 <center>
			 <?php 
			 $error = $_GET['error'];
			 $success = $_GET['success'];
			 if($error == 'password')
			 {
				 ?>
				 <div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_84;?></strong> <?php echo $lang_85;?>
						</div>  
			<?php  }	 
			 
			 		else if($error == 'already')
			 {
				 ?>
				 <div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_86;?></strong> 
						</div>  
			<?php  }	 
			 			 if($success == 'added'){
						 ?>
						 <div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?></strong> <?php echo $lang_96;?>
						</div>    
						 <?php 
						 }
			 ?>
<form action="actions/users/add.php" method="POST" >
 		 <label class="control-label" for="focusedInput"><?php echo $lang_87;?></label>
								<div class="controls">
   <?php echo $lang_88;?>:<br><input type="text" name="ps_reg_user" required><br>
  <?php echo $lang_89;?>:</br><input type="password" name="ps_reg_pass"  required></br>
  <?php echo $lang_90;?>:</br><input type="password" name="ps_reg_repass"  required></br>
  <?php echo $lang_91;?>:</br><input type="text" name="ps_reg_mail"  ></br>
  <?php echo $lang_92;?>:</br><select name = "ps_reg_type">
  <option value = "1"><?php echo $lang_93;?></option>
  <option value = "0"><?php echo $lang_94;?></option>
  </select> </br> <?php echo $lang_418;?>:</br><select name = "ps_reg_shift">
	<option value="1" ><?php echo $lang_155;?></option>
	<option value="2" ><?php echo $lang_156;?></option>
	<option value="3" ><?php echo $lang_419;?></option>
  </select>
								</div>
								
								<button type="submit" class="btn btn-primary"><?php echo $lang_95;?></button>
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
