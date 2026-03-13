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

$delete = $_GET['rid'];

		  if(isset($delete))
   {
   
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
  mysql_query("DELETE FROM reservation_type WHERE id = $delete"); 
   }
   $x1 = $_POST['x1']; 
   $x2 = $_POST['x2']; 
		if(isset($x1))
		{
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error());			 	
				mysql_query("INSERT INTO `reservation_type` ( `type`,`money`) VALUES ('$x1','$x2');"); 
 		}
		 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_143;?></title>
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
				<div class="alert alert-block span9">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span9">
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>إعدادات البرنامج</span>
			</div>
			<br/>
			               <?php 
						   $done = $_GET['done'];
						   if($done == 'true'){ ?>
                            <div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong><?php echo $lang_25;?>!</strong> <?php echo $lang_202;?>
						</div>
						   <?php }?>						
			<!-- content starts -->
			<div class="pull-right" style="border-left:2px solid #808080;padding:0  0 0 20px;"> 
<center> 
<form action="actions/settings/update.php" method="POST" >
<label class="control-label" for="focusedInput"><?php echo $lang_202;?></label>
<div class="controls">
<?php 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$sql="SELECT * FROM config";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
	
  {
	  $logo = $row['logo'];
	  ?>
<div class="box-content">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>القيمة</th>
                            <th>يظهر في الفاتورة؟</th>
                         </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $lang_203;?></td>
                            <td class="center"><input type="text" name="store" value='<?php echo $row['store'];?>' required></td>
                            <td class="center"><input type="checkbox" name="store_ch" <?php echo $row['store_ch'];?> ></td>
                             
                        </tr>
                        <tr>
                            <td><?php echo $lang_37;?></td>
                            <td class="center"><input type="text" name="phone" value='<?php echo $row['phone'];?>' required></td>
                            <td class="center"><input type="checkbox" name="phone_ch" <?php echo $row['phone_ch'];?> ></td>
                             
                        </tr>
						 <tr>
                            <td><?php echo $lang_184;?></td>
                            <td class="center"><input type="text" name="facebook" value='<?php echo $row['facebook'];?>'></td>
                            <td class="center"><input type="checkbox" name="fb_ch" <?php echo $row['fb_ch'];?> ></td>
                             
                        </tr>
						 <tr>
                            <td>اللوجو</td>
                            <td class="center">-</td>
                            <td class="center"><input type="checkbox" name="logo_ch" <?php echo $row['logo_ch'];?> ></td>
                             
                        </tr>
                        <tr>
                            <td><?php echo $lang_189;?></td>
                            <td class="center"><input type="text" name="wifi" value='<?php echo $row['wireless'];?>'></td>
                            <td class="center">-</td>
                             
                        </tr>
                       
						<tr>
                            <td>حجم الخط في الفواتير</td>
                            <td class="center"><input type="number" min="10" max="19" name="font" value='<?php echo $row['font'];?>' style="width:50px"> بكسل</td>
                            <td class="center">-</td>
                             
                        </tr>
                        
                        </tbody>
                    </table>
                      <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الحالة</th>
                           </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $lang_412;?></td>
							<?php if($row['print'] == 'yes'){?>
                            <td class="center"><input type="checkbox" name="printing" checked></td>
							<?php }else{?>
							<td class="center"><input type="checkbox" name="printing"></td>	 
							<?php }?>
                        </tr>
                        
                        
                        </tbody>
                    </table>
					 
					 <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الحالة</th>
                             <th><?php echo $lang_208;?></th>
                         </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $lang_204;?></td>
                             
							<?php if($row['add_funds'] == 'True'){?>
                            <td class="center"><input type="checkbox" name="add_funds" checked></td>
							<?php }else{?>
							<td class="center"><input type="checkbox" name="add_funds"></td>	 
							<?php }?>
                         
								<td><div class="controls">
								    <input type="text" name="funds" value='<?php echo $row['funds'];?>' style="width:50px;"><br>
								</div></td>
                             
                        </tr>
                        
                        
                        </tbody>
                    </table>
					
					
<script type="text/javascript">
$(document).ready(function(){
document.getElementById('tax_ch').onchange = function() {
    document.getElementById('tax_txt').disabled = !this.checked;
};
document.getElementById('service_ch').onchange = function() {
    document.getElementById('service_txt').disabled = !this.checked;
};
});
</script>
					<table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الحالة</th>
                            <th>القيمة</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>الضريبة</td>
 							<?php if($row['tax_ch'] == 'True'){?>
                            <td class="center"><input type="checkbox" name="tax_ch" id="tax_ch" checked></td>
							<td class="center"><div class="controls"><input  type="text" name="tax" value="<?php echo $row['tax'];?>" style="width:50px;" id="tax_txt"> %</div></td>
							<?php }else{?>
							<td class="center"><input type="checkbox" name="tax_ch"  id="tax_ch" ></td>	
							<td class="center"><div class="controls"><input  type="text" name="tax" value="<?php echo $row['tax'];?>" style="width:50px;" id="tax_txt" disabled> %</div></td>							
							<?php }?>
                            
								 
                             
                        </tr>
						 <tr>
                            <td>الخدمة</td>
 						   <?php if($row['service_ch'] == 'True'){?>
                            <td class="center"><input type="checkbox" name="service_ch" id="service_ch" checked></td>
							<td class="center"><div class="controls"><input type="text" name="service" value="<?php echo $row['service'];?>" style="width:50px;"  id="service_txt"> %</div></td>
							<?php }else{?>
							<td class="center"><input type="checkbox" name="service_ch" id="service_ch" ></td>
							<td class="center"><div class="controls"><input type="text" name="service" value="<?php echo $row['service'];?>" style="width:50px;"  id="service_txt" disabled> %</div></td>							
							<?php }?>
                            
								 
                             
                        </tr>
                        
                        
                        </tbody>
                    </table>
						<table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>الاسم</th>
							<th>القيمة</th>
                            <th>الحالة</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>تفعيل أقل وقت للعب</td>
							<td class="center">15 دقيقة</td>
 							<?php if($row['min_time'] == 'True'){?>
                            <td class="center"><input type="checkbox" name="min_time" checked></td>
							<?php }else{?>
							<td class="center"><input type="checkbox" name="min_time"></td>	 
							<?php }?>	 
                             
                        </tr>
						  
                        
                        
                        </tbody>
                    </table>
                </div>
 
 </div>
 
								<?php  } ?>
<button type="submit" class="btn btn-primary"><?php echo $lang_209;?></button>
</center></form> 
</div>
<center>
<div class="pull-right" style="margin: 0 20px 0 0;" >

<label class="control-label" for="focusedInput"><?php echo $lang_210;?></label>
<img src="img/<?php echo $logo;?>" width="150" height="150"/>
<br/>
<br/>
<center><form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset class="habl" dir="rtl">
<legend><?php echo $lang_211;?></legend>
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<input name="userfile" type="file" /></br></br>                     		  
<?php
// check if a file was submitted
if(!isset($_FILES['userfile'])) {
?><p><?php echo $lang_212;?></p><?php 
}
else
{
try {
upload(); //this will upload your image
?><p><?php echo $lang_213;?></p><?php  //Message after uploading
 
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
		
$sql ="UPDATE `config` SET `logo` = '{$_FILES['userfile']['name']}'";
 
// insert the image
mysql_query($sql) or die("Error in Query: " . mysql_error());


    if (file_exists("img/" . $_FILES["userfile"]["name"]))
      {
      echo $_FILES["userfile"]["name"] . " ". $lang_214." ";
      }
    else
      {
      move_uploaded_file($_FILES["userfile"]["tmp_name"],
      "img/" . $_FILES["userfile"]["name"]);
      }	   
}
}
}
?>
		
<input class="btn btn-primary" type="submit" value="<?php echo $lang_215;?>" />
   </fieldset>
</form> 
<hr/>
 <h2>التحكم في القاعات</h2>
 <div class="box span10">
				 
 					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <?php 
	 					  $today = date('Y-m-d');
  $result = mysql_query("SELECT * FROM `reservation_type`");
?><thead>
<tr>
								  <th>النوع</th>
								  <th>السعر</th> 
								  <th>التحكم</th> 
 </tr>
</thead> 	  						   
						  <tbody>
						  <?php 
while($row = mysql_fetch_array($result))
{
	$reid = $row['id'];
 echo "<tr>";
  echo "<td>" . $row['type'] . "</td>";?>
   <td><?php echo $row['money']?></td> 
 
 
 <td class="center">
   
 
 
<span class="label label-important"><a href="control_settings.php?rid=<?php echo $reid;?>" ><font color="white">حذف النوع</font></a></span>
									</td>    <?php 
 echo "</tr>";
  }?>
  <tr>
  <form action="control_settings.php" method="POST">
  <td><input type="text" name="x1" style="width:60px" placeholder="اسم النوع"></td>
  <td><input type="text" name="x2" style="width:50px" placeholder="السعر"></td>
  <td><input type="submit" Value="إضافة نوع جديد"/></td>
  </tr>
						  </tbody>
					  </table>
		 </div>
				</div>
</div>


</center>
 
<div class="span2"></div>
      
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
