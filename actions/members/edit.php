<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	echo "<script>location='../../devices.php'</script>";
	    die();
}
 
include('../../includes/config.php');
if($lang == 'en'){include('../../languages/en.php');}else if($lang == 'ar'){include('../../languages/ar.php');}
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
  ?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php 
               
			   $id=$_POST['id']; 
			   $new_member_name=$_POST['new_member_name']; 
			   $new_member_mobile=$_POST['new_member_mobile']; 
			   $new_member_card=$_POST['new_member_card']; 
			   $new_member_points=$_POST['new_member_points'];
			   
			     mysql_query("UPDATE `members` set `name` = '$new_member_name' WHERE id = $id;");  
                 mysql_query("UPDATE `members` set `mobile` = '$new_member_mobile' WHERE id = $id;");  
                 mysql_query("UPDATE `members` set `card` = '$new_member_card' WHERE id = $id;");  
                 mysql_query("UPDATE `members` set `points` = '$new_member_points' WHERE id = $id;");  

				 
				 header('Location: ../../control_members.php?success=edited');
				 die();

			   
			   ?> 