<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
include('includes/config.php');
   $casheer = $_SESSION['ps_user'];

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

		$rtype = $_POST['rtype'];
		$rname = $_POST['rname'];
		$rdate = $_POST['rdate'];
		$seth = $_POST['seth'];
		$setm = $_POST['setm'];
		$rnum = $_POST['rnum'];
		$rmobile = $_POST['rmobile'];
		$hallid = $_POST['hallid'];
		$rmoney = $_POST['rmoney'];
		$delete = $_GET['rid'];

		 $var8= $seth . ":" .$setm;  
		if($rname != '')
		{
			 $sess = "x".rand();
			$notes = 'Hall Reservation';
		  			   $out = 'in';
 			   $Year = idate('Y');
$Hour = idate('H');
			mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
			mysql_query("INSERT INTO `reservation` 
			       ( `name`,`mobile`,`type`,`money`,`date`,`time`,`ka3a`,`num`,`session`,`status`)
			VALUES ('$rname','$rmobile','$rtype','$rmoney','$rdate','$var8','$hallid','$rnum','$sess','new');"); 
			$x= '1';
 		 mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`session_id`,`hour`) VALUES ('$rname','$out','$notes','$rmoney','$shift_day','$shift_month','$Year','$current_shift','$casheer','0','$Hour');"); 
		}
   if(isset($delete))
   {
   
   mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
  mysql_query("DELETE FROM reservation WHERE id = $delete"); 
   }

   
   $activate =$_GET['activate'];
   $hall =$_GET['hall'];
   $hsess =$_GET['hsess'];
   if($activate > 0)
   {
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
 mysql_query("UPDATE `reservation` set `status` = 'old' WHERE id = '$activate';");  
 mysql_query("UPDATE `halls` set `status` = 'On' WHERE hallname = '$hall';");  
 mysql_query("UPDATE `halls` set `session` = '$hsess' WHERE hallname = '$hall';");  

   }
      $action =$_GET['action'];
      $endid =$_GET['endid'];
      $endsess =$_GET['endsess'];
      $endmon =$_GET['endmon'];
      $endn =$_GET['endn'];
      $serv =$_GET['serv'];
      $tax =$_GET['tax'];
      $endn =$_GET['endn'];
	  if($action == 'close')
	  {
		  	$notes = 'Hall Reservation';
		  			   $out = 'in';
					   $Hour = idate('H');
 			   $Year = idate('Y');
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
  mysql_query("UPDATE `halls` set `status` = 'Off' WHERE id = '$endid';");  
   mysql_query("UPDATE `halls` set `session` = '' WHERE id = '$endid';");  
 		 mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`,`shift`,`casheer`,`session_id`,`service`,`tax`,`hour`) VALUES ('$endn','$out','$notes','$endmon','$shift_day','$shift_month','$Year','$current_shift','$casheer','0','$serv','$tax','$Hour');"); 
          $x=2;
		      mysql_query("UPDATE `ps_orders` set `status` = 'yes'    WHERE `ps_id` = '$endid'  AND `session_id` ='$endsess';"); 
    mysql_query("UPDATE `ps_orders` set `shift` = '$current_shift'    WHERE   `session_id` ='$endsess';"); 
    mysql_query("UPDATE `ps_orders` set `casheer` = '$casheer'    WHERE `ps_id` = '$endid' AND `session_id` ='$endsess';");
	  }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_426;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $lang_1;?>">
	<meta name="author" content="Mohamed Gad">

	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
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
<script type="text/javascript">
 // Popup window code
// var url = document.getElementById("www.google.com");
   //url = document.getelementbyid('http://www.google.com');
function pay(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
}
</script>
 <script src="js/jquery-1.7.2.min.js"></script> 
<!-- jQuery UI -->
<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
 
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',minDate: 'dateToda' });
  } );
  </script>	
</head>

<?php 
		if($x == '1')
{
?><body onload="pay('actions/print/reserv2.php?name=<?php  echo $rname; ?>&&mobile=<?php  echo $rmobile; ?>&&type=<?php  echo $rtype; ?>&&money=<?php  echo $rmoney; ?>&&sess=<?php  echo $sess; ?>')">
<?php }
else if($x == '2')
{
?><body onload="pay('actions/print/reserv3.php?name=<?php  echo $endn; ?>&&mobile=<?php  echo $rmobile; ?>&&type=<?php  echo $rtype; ?>&&money=<?php  echo $endmon; ?>&&sess=<?php  echo $endsess; ?>&&serv=<?php echo $serv;?>&&tax=<?php echo $tax;?>')">
<?php }else{
?><body><?php }?>
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
			<center><h2><?php echo $lang_426;?></h2></center></br></br>
  <div class="">

 						<?php 
			
    include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

$sql="SELECT * FROM halls ORDER BY id";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
  {
	  $status = $row['status'];
	  $id = $row['id'];
	  $gsess = $row['session'];
	  if($status == 'On')
	  { 
$sqlc="SELECT * FROM `reservation` WHERE `session` = '$gsess'";
$resultc=mysql_query($sqlc);
while($rowc = mysql_fetch_array($resultc))
{
	$gtype = $rowc['type'];
	$gnum = $rowc['num'];
}
		
			?>
			<a data-rel="tooltip"   class="well span3 top-block" href="devices_hall.php?id=<?php echo $id;?>">
			<div><?php  echo $row['hallname']; ?></div>
            <span><img id="aa" src="img/app/halls/halls.png"   width="120" height="100" /></span>
			<div><?php  echo $gtype; ?></div>
			<font color="red" size="5"><?php echo $gnum;?> فرد</font></br>
			<p id="done_<?php  echo $id;?>"></p>
 
			<img src="img/app/buttons/info.png" /> 
			<span class="notification red"><?php echo $lang_2;?></span>
			</a>
 
		 <?php 
	} 
	else if ($status == 'Off')
	{		
		?>
		 
		<div data-rel="tooltip"  class="well span3 top-block" >
		<div><?php  echo $row['hallname']; ?></div>
            <span><img id="aa" src="img/app/halls/halls.png"   width="120" height="100" /></span>
						<br/>	<br/><font color="green" size="6">القاعة متاحة الان</font></br>

		
		 
		<span class="notification green"><?php echo $lang_12;?></span>
		</div>
		<?php  }

		} ?>

   <div data-rel="tooltip"  class="well span3 top-block" >
		<div>حجز جديد</div>
			<!--<span><img id="aa" src="img/p3.png"     /></span>-->
			
		
		<span>
		<form   action="devices_halls.php" method="POST"> 
  		<select name="rtype" style="width: 94%;">
	<?php 	$sql="SELECT * FROM reservation_type ORDER BY id";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
  {?>
		<option value="<?php echo $row['type'];?>"><?php echo $row['type'];?></option>
  <?php }?>
		</select>
		
		<br/>
		<input   name="rname" type="text"  style="width: 80%;"  placeholder="اسم الشخص">
		<input  style="width:30%;" name="rdate" type="text"  id="datepicker" value="<?php echo date('Y-m-d');?>">
		<input  type= "number" name="seth" placeholder="<?php echo $lang_10;?>" size = "7"  min = "0" max="24" style="width:70px;"/>
		<input  type= "number" name="setm" placeholder="<?php echo $lang_11;?>" size = "7" min="0" max="59" style="width:70px;" />
		<input  style="width:40%;" name="rnum" id="un_id_<?php echo $id;?>" type="text" placeholder="عدد الحضور">
		<input  style="width:40%;" name="rmobile" id="un_id_<?php echo $id;?>" type="text" placeholder="الموبايل">
		<input  style="width:40%;" name="rmoney" id="un_id_<?php echo $id;?>" type="text" placeholder="مبلغ الحجز"><select name="hallid" style="width: 40%;">
	<?php 	$sql="SELECT * FROM halls ORDER BY id";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
  {?>
		<option value="<?php echo $row['hallname'];?>"><?php echo $row['hallname'];?></option>
  <?php }?>
		</select>
  		<button  type="submit" class="btn btn-warning">الحجز</button>
		
		</form>
		</span>
		<span class="notification warning"><?php echo $lang_12;?></span>
		</div>
	
	 
	
	
  <div class="box span10">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> الحجوزات القادمة </h2>
						
					</div>
 					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
						  $today = date('Y-m-d');
// To connect to the database
$result = mysql_query("SELECT * FROM `reservation` WHERE ka3a != '' AND date >= '$today' AND status ='new'");
?><thead>
<tr>
								  <th><?php echo $lang_250;?></th>
								  <th>القاعة</th>
								  <th><?php echo $lang_77;?></th>
								  <th><?php echo $lang_78;?></th>
								  <th><?php echo $lang_21;?></th>
                                  <th><?php echo $lang_79;?></th>
								  <th>المناسبة</th>
								  <th>عدد الحضور</th>
								  <th><?php echo $lang_81;?></th>
								  <th>التحكم</th>
 </tr>
</thead> 	  						   
						  <tbody>
						  <?php 
while($row = mysql_fetch_array($result))
{
 $reid = $row['id'];
 $chka3a = $row['ka3a'];
 
 $resultx = mysql_query("SELECT * FROM `halls` WHERE hallname = '$chka3a'");
while($rowx = mysql_fetch_array($resultx))
{
	$chka3astatus = $rowx['status'];
}
 
  echo "<tr>";
   echo "<td>" . $row['id'] . "</td>";
   echo "<td>" . $row['ka3a'] . "</td>";
   echo "<td>" . $row['date'] . "</td>";
   echo "<td>" . $row['time'] . "</td>";
   echo "<td>" . $row['name'] . "</td>";
   echo "<td>" . $row['mobile'] . "</td>";
   echo "<td>" . $row['type'] . "</td>";
   echo "<td>" . $row['num'] . "</td>";
   echo "<td>" . $row['money'] ." ".$lang_100. "</td>";
 
 ?>
 <td class="center">
 <?php if($chka3astatus == 'Off'){?>
<span class="label label-success"><a href="devices_halls.php?activate=<?php  echo $reid;?>&&hall=<?php echo $row['ka3a'];?>&&hsess=<?php echo $row['session'];?>" ><font color="white">تشغيل القاعة</font></a></span>
<?php }else{?>
<span class="label label-warning"><a href="#" ><font color="white">القاعة مشغولة</font></a></span>

<?php }?>
<span class="label label-important"><a href="devices_halls.php?rid=<?php  echo $reid;?>" ><font color="white">حذف الحجز</font></a></span>
									</td>    <?php 
 echo "</tr>";
  }?>
						  </tbody>
					  </table>
		 </div>
				</div>
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

<!-- external javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<!-- jQuery -->
<script src="js/jquery-1.7.2.min.js"></script> 
<!-- jQuery UI -->
<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
<!-- transition / effect library -->
<script src="js/bootstrap-transition.js"></script>
<!-- alert enhancer library -->
<script src="js/bootstrap-alert.js"></script>
<!-- modal / dialog library -->
<script src="js/bootstrap-modal.js"></script>
<!-- custom dropdown library -->
<script src="js/bootstrap-dropdown.js"></script>
<!-- scrolspy library -->
<script src="js/bootstrap-scrollspy.js"></script>
<!-- library for creating tabs -->
<script src="js/bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="js/bootstrap-tooltip.js"></script>
<!-- popover effect library -->
<script src="js/bootstrap-popover.js"></script>
<!-- button enhancer library -->
<script src="js/bootstrap-button.js"></script>
<!-- accordion library (optional, not used in demo) -->
<!-- accordion library (optional, not used in demo) -->
<!-- accordion library (optional, not used in demo) -->
<!-- accordion library (optional, not used in demo) -->


	
	<script src="js/bootstrap-carousel.js"></script>
   <script src="js/bootstrap-tour.js"></script>
	 <script src='js/fullcalendar.min.js'></script>
	<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.min.js"></script>
	<script src="js/jquery.flot.pie.min.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
    <script src="js/jquery.colorbox.min.js"></script>
	
	<script src="js/jquery.cleditor.min.js"></script>
 	<script src="js/jquery.noty.js"></script>
 	<script src="js/jquery.elfinder.min.js"></script>
 	<script src="js/jquery.raty.min.js"></script>
    <script src="js/jquery.autogrow-textarea.js"></script>
 	<script src="js/jquery.uploadify-3.1.min.js"></script>
	<script src='js/jquery.dataTables.min.js'></script>
 



</body>



<!-- carousel slideshow library (optional, not used in demo) -->
<!-- autocomplete library -->
<script src="js/bootstrap-typeahead.js"></script>
<!-- tour library -->
<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calander plugin -->
<!-- data table plugin -->

<!-- chart libraries start -->

<!-- chart libraries end -->

<!-- select or dropdown enhancer -->
<script src="js/jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<!-- plugin for gallery image view -->
<!-- rich text editor library -->
<!-- notification plugin -->
	<script src="js/jquery.uniform.min.js"></script>

<!-- file manager library -->
<!-- star rating plugin -->
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- accordion library (optional, not used in demo) -->
<script src="js/bootstrap-collapse.js"></script>

 
<!-- autogrowing textarea plugin -->
<!-- multiple file upload plugin -->
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>

</html>
