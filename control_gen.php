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
$id = $_GET['id'];  $delete = $_GET['deleteid'];
	 if(isset($delete))
	 {
	 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
     mysql_select_db("$db") or die(mysql_error()); 
     mysql_query("DELETE FROM stock WHERE id = $delete ");  
	 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title><?php echo $lang_228;?></title>
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
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>التحكم في الأصناف العامة</span>
			</div>
			<br/>
			<!-- content starts -->
			<a href ="control_product_add.php?type=general" class="btn btn-primary"><?php echo $lang_47;?></a>

 

<div class="row-fluid">		
				<div class="box span10">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $lang_135;?></h2>
						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
								
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE catagory = 'general' AND name !=' '  GROUP BY name ORDER BY name ASC");
?><thead>
<tr>
								  <th><?php echo $lang_49;?></th>
  								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_194;?></th>
								  <th><?php echo $lang_167;?></th>
</tr>
</thead>  
						  <tbody>
						  <?php 
								
								
																while($row = mysql_fetch_array($result))
  {
  			$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
    $idid = $row['id'];

  echo "<tr>";
  echo '<td><a class="btn btn-info" href="control_product.php?id='.$row['id'].'">'.'<i class="icon-edit icon-white"></i>'.' '.$row['name'].'</a></td>';
   echo "<td>" . $row['price'] ."</td>";
  if($row['ing'] == 'no' ){
  echo "<td>" ." ".$lang_114." ". $aaas . "</td>"; } else { echo "<td><b>".$lang_402."</b></td>"; }  echo '<td><a class="btn btn-success" href="control_product.php?id='.$row['id'].'">'.'<i class="icon-zoom-in icon-white"></i>'.$lang_194.'</a></td>';
  ?>    <td class="center">
																		  <span class="label label-important"><a href="control_gen.php?deleteid=<?php  echo $idid;?>"  onclick="return confirm('<?php echo $lang_244;?>')"><?php echo $lang_167;?></a></span>
									</td>      <?php 
  echo "</tr>";
  }?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

			
			
			 
			
			
			

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
