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
$id = $_GET['id']; 			   $var1=$_POST['wifi']; 
			   $var2=$_POST['add_funds']; 
			   $var3=$_POST['funds']; 
			   $var4=$_POST['store']; 
			   $facebook=$_POST['facebook']; 
			   $phone=$_POST['phone']; 
			   $printing=$_POST['printing']; 
			   $store_ch=$_POST['store_ch']; 
			   $phone_ch=$_POST['phone_ch']; 
			   $fb_ch=$_POST['fb_ch']; 
			   $logo_ch=$_POST['logo_ch']; 
			   $font=$_POST['font']; 
			   $min_time=$_POST['min_time']; 
			   
			   $tax=$_POST['tax']; 
			   $tax_ch=$_POST['tax_ch']; 
			   $service=$_POST['service']; 
			   $service_ch=$_POST['service_ch']; 
               
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
               
                 mysql_query("UPDATE `config` set `wireless` = '$var1';");  
                 mysql_query("UPDATE `config` set `funds` = '$var3';");  
                 mysql_query("UPDATE `config` set `store` = '$var4';");  
                 mysql_query("UPDATE `config` set `phone` = '$var5';");  
                 mysql_query("UPDATE `config` set `facebook` = '$facebook';");  
                 mysql_query("UPDATE `config` set `phone` = '$phone';");  
                 mysql_query("UPDATE `config` set `font` = '$font';");  
				 
if($store_ch == 'on'){mysql_query("UPDATE `config` set `store_ch` = 'checked';");}
else{mysql_query("UPDATE `config` set `store_ch` = '';");}
if($phone_ch == 'on'){mysql_query("UPDATE `config` set `phone_ch` = 'checked';");}
else{mysql_query("UPDATE `config` set `phone_ch` = '';");}
if($fb_ch == 'on'){mysql_query("UPDATE `config` set `fb_ch` = 'checked';");}
else{mysql_query("UPDATE `config` set `fb_ch` = '';");}
if($logo_ch == 'on'){mysql_query("UPDATE `config` set `logo_ch` = 'checked';");}
else{mysql_query("UPDATE `config` set `logo_ch` = '';");}	

if($printing == 'on'){mysql_query("UPDATE `config` set `print` = 'yes';");}
else{mysql_query("UPDATE `config` set `print` = 'no';");}	

if($var2 == 'on'){mysql_query("UPDATE `config` set `add_funds` = 'True';");}
else{mysql_query("UPDATE `config` set `add_funds` = 'False';");}		 
				 
if($min_time == 'on'){mysql_query("UPDATE `config` set `min_time` = 'True';");}
else{mysql_query("UPDATE `config` set `min_time` = 'False';");}		
		
if($tax_ch == 'on'){mysql_query("UPDATE `config` set `tax_ch` = 'True';");}
else{mysql_query("UPDATE `config` set `tax_ch` = 'False';");}
mysql_query("UPDATE `config` set `tax` = '$tax';");  
if($service_ch == 'on'){mysql_query("UPDATE `config` set `service_ch` = 'True';");}
else{mysql_query("UPDATE `config` set `service_ch` = 'False';");}
mysql_query("UPDATE `config` set `service` = '$service';");  
		
						 echo "<script>location='../../control_settings.php?done=true'</script>";

 				 die();

 			  ?>
 