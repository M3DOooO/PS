<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	echo "<script>location='../../devices.php'</script>";
	    die();
}
 
include('../../includes/config.php');
if($lang == 'en'){include('../../languages/en.php');}else if($lang == 'ar'){include('../../languages/ar.php');}
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
               ?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php  
			   $new_member_name=$_POST['new_member_name']; 
			   $new_member_mobile=$_POST['new_member_mobile']; 
			   $new_member_card=$_POST['new_member_card']; 
			   $new_member_points=$_POST['new_member_points']; 
			   mysql_query("INSERT INTO `members` (`name`,`mobile`,`card`,`points`) 
			   VALUES
			   ('$new_member_name','$new_member_mobile','$new_member_card','$new_member_points');"); 
			   
			 	  echo "<script>location='../../control_members_add.php?success=added'</script>";

			 ?> 