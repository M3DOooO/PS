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
$id = $_GET['id'];  $id = $_GET['id']; 
 $sess = $_GET['session']; 

 $delete_user = $_GET['delete'];
 if(isset($delete_user))
 {
  include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
mysql_query("DELETE FROM users WHERE ID = $delete_user");  
 } 
  $edit_user = $_GET['edit'];
  $edit_user2 = $_POST['change_to'];
  $edit_user3 = $_POST['change_to_s'];

 if(isset($edit_user))
 {
  include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
mysql_query("UPDATE `users` set `type` = '$edit_user2' WHERE `ID` = '$edit_user';");  
mysql_query("UPDATE `users` set `shift` = '$edit_user3' WHERE `ID` = '$edit_user';");  
 }

 $change_pass = $_POST['change_pass'];
 if($change_pass == 'true')
 {
	 $old_pass = md5($_POST['old_pass']);
	 $new_pass = md5($_POST['new_pass']);
	 $change_p_id = $_POST['change_p_id'];
     mysql_connect("$host", "$user", "$pass")or die("cannot connect");
     mysql_select_db("$db")or die("cannot select DB");
     $result = mysql_query("SELECT * FROM `users` WHERE ID = '$change_p_id'");
     while($row = mysql_fetch_array($result))
     {
		$saved_pass = $row['Password'];
	 }
     
	 if($old_pass == $saved_pass)
	 {
         mysql_connect("$host", "$user", "$pass")or die("cannot connect");
         mysql_select_db("$db")or die("cannot select DB");
         mysql_query("UPDATE `users` set `Password` = '$new_pass' WHERE `ID` = '$change_p_id';");  
		  $error = 'pass_changed';
     }
     else
	 {
		 $error = 'true';
	 }		 
	 
 }
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title><?php echo $lang_190;?></title>
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
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>التحكم في المستخدمين</span>
			</div>
			 
			<br/>
			<!-- content starts -->
			<?php 
 			 if($error == 'true')
			 {
				 ?>
				 <div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_84;?></strong> <?php echo $lang_85;?>
						</div>  
			<?php  } 
				else if($error == 'pass_changed')
			 {
				 ?>
				 <div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong><?php echo $lang_191;?></strong> 
						</div>  
			<?php  }	 
			 
			 ?>
			
 <div class="row-fluid">		
				<div class="box span11">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i><?php echo $lang_190;?> </h2>
					 
					</div>
					<div class="box-content span12 ">
						<table  class="table table-striped table-bordered bootstrap-datatable datatable">
						  <?php 
								
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `users` WHERE `Email` != 'whhw47@hotmail.com'");
?><thead>
<tr>
								  <th><?php echo $lang_192;?></th>
                                  <th><?php echo $lang_188;?></th>
								  <th><?php echo $lang_91;?></th>
								  <th><?php echo $lang_89;?></th>
								  <th><?php echo $lang_193;?></th>
								  <th><?php echo $lang_150;?></th>
								  <th><?php echo $lang_194;?></th>
								  <th><?php echo $lang_167;?></th>
</tr>
</thead> 
  <tbody>
						  <?php 
								
								
while($row = mysql_fetch_array($result))
{
      
  echo "<tr>";
   echo "<td>" . $row['ID'] . "</td>";
   echo "<td><h2>" . $row['Username'] . "</h2></td>";
   echo "<td>" . $row['Email'] . "</td>";
  ?>
  <td><center><form action="control_users.php" method="POST">
  <input type="hidden" name="change_pass" value="true">
  <input type="hidden" name="change_p_id" value="<?php echo $row['ID'];?>">
  <input style="width:100%;" type="password" placeholder="<?php echo $lang_195;?>" name="old_pass"required/>
  <br/>
  <input style="width:100%; margin-left:7px;" type="password" placeholder="<?php echo $lang_196;?>" name="new_pass"required/><br/>
  <button class='btn btn-info'><?php echo $lang_197;?></button></center></form></td>
  <?php 
   $role = $row['type'];
   if($role == 1)
   {
   ?><td><span class='btn-success'><?php echo $lang_198;?></span></td><?php 
    }
	   if($role == 0)
   {
  ?><td><span class='btn-primary'><?php echo $lang_199;?></span></td>
   <?php }
   $shift = $row['shift'];
   if($shift == 1)
   {
   ?><td><span class='btn-success'><?php echo $lang_17;?></span></td><?php 
    }
	   else if($shift == 2)
   {
  ?><td><span class='btn-primary'><?php echo $lang_16;?></span></td>
  <?php 
    }	   else if($shift == 3)
   {
  ?><td><span class='btn-warning'><?php echo $lang_419;?></span></td>
  <?php 
    }
	$del = $row['ID'];?>
    <td>
	<form action="control_users.php?edit=<?php echo $del;?>" method="post">
    <center><select style="width:100%" name="change_to">
	<option value="<?php echo $role;?>"><?php echo $lang_200;?></option>
	<option value="1" ><?php echo $lang_93;?></option>
	<option value="0" ><?php echo $lang_94;?></option>
	</select>
	<select style="width:100%" name="change_to_s">
	<option value="<?php echo $shift;?>"><?php echo $lang_200;?></option>
	<option value="1" ><?php echo $lang_155;?></option>
	<option value="2" ><?php echo $lang_156;?></option>
	<option value="3" ><?php echo $lang_419;?></option>
	</select>
	<button class="btn btn-info"><?php echo $lang_201;?></button>
	</center>
	</form>
    </td> 
    <td><a  onclick="return confirm('<?php echo $lang_244;?>')"  class="btn btn-danger" href="control_users.php?delete=<?php  echo $del;?>"><?php echo $lang_167;?></a></td> 
  <?php   echo "</tr>";
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
