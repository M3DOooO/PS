<?php session_start();
 
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
$id = $_GET['id']; $shift_option = $_POST['shift_option'];
$last_shift   = $_POST['last_shift'];
$shift_day    = $_POST['shift_day'];
$shift_month  = $_POST['shift_month'];

    
if($shift_option == 'start')
      {
		  if($last_shift == 'One')
		  {
			  $new_shift = 'Two';
		  }
	 else if($last_shift == 'Two')
     	 {
			  $new_shift = 'One';
	     }
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("UPDATE `config` set `current_shift` = '$new_shift'"); 
	mysql_query("UPDATE `config` set `shift_day` = '$shift_day'"); 
	mysql_query("UPDATE `config` set `shift_month` = '$shift_month'"); 
      }
	  else if($shift_option == 'End_One')
	  {
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("UPDATE `config` set `last_shift` = 'One'"); 
	mysql_query("UPDATE `config` set `current_shift` = 'No'"); 
	  }	
      else if($shift_option == 'End_Two')
	  {
	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	mysql_query("UPDATE `config` set `last_shift` = 'Two'"); 
	mysql_query("UPDATE `config` set `current_shift` = 'No'"); 

	  }
	
	
session_unset(); 
  				 echo "<script>location='../../login.php'</script>";

			  ?> 