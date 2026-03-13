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
			
		 
 
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_279;?></title>
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
$result = mysql_query("SELECT * FROM `devices` Where ID = '$id'");
			 while($row = mysql_fetch_array($result))
  {
	  $thename = $row['Device Name'];
  ?>
 			<div id="content" class="span10">
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <span><a href="control_ps.php">التحكم في الأجهزة</span></a> / <?php echo $thename;?><span></span>
			</div>
			<br/>
			<!-- content starts -->
			 
			 <?php 
			  $success = $_GET['success'];
			 			 if($success == 'edited'){

 ?>
 <div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_25;?>!</strong> تعديل بيانات الجهاز
						</div> 
						 <?php }?>
		
  
  
			 
			 
			 
			 
			 
 <center> 			 
<form action="actions/ps/edit.php" method="POST" >
<input type ="hidden" name = "idddd" value="<?php  echo $id;?>" >
   <h2><font color="red" ><?php echo $lang_62;?>: </font><?php  echo $row['Device Name'] ?></h2>
  
   </br>
  </br>
 <h3><?php echo $lang_194;?></h3>
  </br>
  <?php echo $lang_21;?>:<br><input type="text" name="new_ps_name" value="<?php  echo $row['Device Name'] ?>"required><br>
  <?php echo $lang_63;?>:<br>
   <select name="new_ps_type">
   <option value="<?php  echo $row['ps_version'] ?>"><?php echo $lang_200;?></option>
   <option value="2"><?php echo $lang_64;?></option>
   <option value="3"><?php echo $lang_65;?></option>
   <option value="4"><?php echo $lang_66;?></option>
   <option value="5"><?php echo $lang_67;?></option>
   <option value="6"><?php echo $lang_68;?></option>
   <option value="7">Bein Sports</option>
   <option value="8">VR</option>
   <option value="9">Wii</option>
   <option value="10">xbox</option>
   <option value="11">Cafe</option>
   </select> 
 <br>
  <?php echo $lang_69;?>:</br><input type="number" min="0" step="0.1" name="new_single_price" value="<?php  echo $row['single'] ?>"required></br>
  <?php echo $lang_70;?>:</br><input type="number" min="0" step="0.1" name="new_multi_price" value="<?php  echo $row['multi'] ?>"required></br>
  <?php echo $lang_72;?> :</br><input type="number" min="0" step="0.1" name="new_multi6_price" value="<?php  echo $row['multi6'] ?>"required></br>
  <?php echo $lang_73;?> :</br><input type="number" min="0" step="0.1" name="new_multi7_price" value="<?php  echo $row['multi7'] ?>"required></br> 
  <?php echo $lang_360;?> :</br><input type="number" min="0" step="0.1" name="ps_order" value="<?php  echo $row['orderby'] ?>"></br>
  <?php echo $lang_415;?> :</br><textarea name="al3ab"><?php  echo $row['Paused'] ?></textarea></br>
 	 ip :</br><input type="text"  name="ip" value="<?php  echo $row['ip'] ?>"></br>
 Port :</br><input type="text"  name="port" value="<?php  echo $row['port'] ?>"></br>
 Open :</br><input type="text"  name="open" value="<?php  echo $row['openword'] ?>"></br>
 Close :</br><input type="text"  name="close" value="<?php  echo $row['closeword'] ?>"></br>
 										  
 								<button type="submit" class="btn btn-primary"><?php echo $lang_232;?></button>
								</form> 
								<a href="control_ps_delete.php?id=<?php  echo $row['ID'];?>" ><button class="btn btn-danger"><?php echo $lang_280;?></button></a>
</center>
    			




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
