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
$now = $_SESSION['ps_user'];
$sql="SELECT * FROM users WHERE Username = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
}
if($usern != 1 ){echo "<script>location='../../devices.php'</script>";}

 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
  
   $var14 = $_POST['change_sub'];
		$var15 = $_POST['sub_sub'];
		$var16 = $_POST['old_cat'];
		$type = $_POST['type'];
		if(isset($var14))
		{
                mysql_query("UPDATE `stock` set `sub_cat` = '$var15'  WHERE `sub_cat` = '$var16';");  

		}
  
  
  
 
  			  			if($type == 'drinks'){
						echo "<script>location='../../control_drinks_cat.php?success=edited'</script>";
						}else if($type=='food'){
						echo "<script>location='../../control_food_cat.php?success=edited'</script>";

						}
			  
			  ?>