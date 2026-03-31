<?php session_start();
if( !isset($_SESSION['ps_user']) )
{
	include('../../login.php');
	die();
}
include('../../includes/config.php');
$casheer = $_SESSION['ps_user'];
$close = $_POST['action']; 
$reprep = $_POST['session']; 
$money = $_POST['wanted']; 
$dName = $_POST['name'];
$matloob = $_POST['seconds'];
$Receipt = $reprep;
$Minute = idate('i');
$Second = idate('s'); 
$Year = idate('Y');
$RealDay = idate('d');
$RealMonth = idate('m');
$id = $_POST['id'];
$H = idate('H');
$tdis = $_POST['tdis']; 
$exact_discount = $_POST['exact_discount']; 
$calc_serv = $_POST['calc_serv'];
$calc_tax = $_POST['calc_tax'];

function ceil_to_five($amount)
{
	if ($amount <= 0)
	{
		return 0;
	}
	return ceil($amount / 5) * 5;
}
?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php 


	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	
	 

if($close == 'close')
{
 
 	$sql="SELECT * FROM devices WHERE `ID` = '$id'";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
		{
	     $current_ip = $row['ip'];
	     $current_port = $row['port'];
	     $current_close = $row['closeword'];
 		}
  
  	    if($ta7akom == 'yes'){

  $socket = fsockopen($current_ip, $current_port); // creates connection it returns the file pointer
if($socket) {  // if it returns a file pointer
 fwrite($socket, $current_close);  //write the filename in the file pointer returned by socket and chagne line
}
		}
	
	
  	$result = mysql_query("SELECT * FROM `devices` WHERE `session_id` = '$reprep'");
	while($rowe = mysql_fetch_array($result))
	{
		$singlea = $rowe['single'];
		$multia = $rowe['multi'];
		$multi6a = $rowe['multi6'];
		$multi7a = $rowe['multi7'];
    }
 	$sql="SELECT * FROM reports WHERE `session_id` = '$reprep'";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$close_p = $row['type'];
		$dda = $row['discount2'];
	}
	$sql="SELECT * FROM config";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$min_time = $row['min_time'];
 	}
if($min_time == 'True'){
	if($matloob < 60)
	{
	$matloob = 60;
	if($close_p == 'single')
	{$money = $singlea / 60;}
	else if($close_p == 'multi')
	{$money = $multia / 60;}
	else if($close_p == 'multi6')
	{$money = $multi6a / 60;}
	else if($close_p == 'multi7')
	{$money = $multi7a / 60;}
	
	}
}
	$money = ceil_to_five($money);
	$now = $_SESSION['ps_user'];
	mysql_query("UPDATE `reports` set `total` = '$matloob'  WHERE  pc_id = '$id' AND `session_id` = '$reprep' AND `End_hour` ='-';"); 
	mysql_query("UPDATE `reports` set `End_minute` = '$Minute'  WHERE `session_id` = '$reprep' AND `End_hour` = '-';"); 
	mysql_query("UPDATE `reports` set `End_second` = '$Second'  WHERE `session_id` = '$reprep' AND `End_hour` = '-';"); 
	mysql_query("UPDATE `reports` set `money` = '$money'  WHERE `session_id` = '$reprep' AND notes ='On' AND `End_hour` = '-';"); 
	mysql_query("UPDATE `reports` set `name` = '$dName'  WHERE `session_id` = '$reprep' AND pc_id = '$id' AND `End_hour` = '-';"); 
	mysql_query("UPDATE `reports` set `notes` = 'Off'        WHERE  pc_id = '$id' AND End_hour ='-';"); 
	mysql_query("UPDATE `reports` set `status` = 'done'  WHERE `session_id` = '$reprep' ;"); 
	mysql_query("UPDATE `reports` set `game` = '$now'       WHERE  pc_id = '$id' AND End_hour ='-';"); 
	mysql_query("UPDATE `reports` set `shift` = '$current_shift'  WHERE  pc_id = '$id' AND `session_id` = '$reprep';"); 
	mysql_query("UPDATE `reports` set `casheer` = '$casheer'  WHERE  pc_id = '$id' AND `session_id` = '$reprep';"); 
	mysql_query("UPDATE `reports` set `discount2` = '$dda'  WHERE `session_id` = '$reprep' AND End_hour = '-'");  
    mysql_query("UPDATE `reports` set `discount` = '$tdis'  WHERE `session_id` = '$reprep' AND End_hour = '-'"); 	
	mysql_query("UPDATE `reports` set `discount_amount` = '$exact_discount'  WHERE `session_id` = '$reprep' AND End_hour = '-'");
	mysql_query("UPDATE `reports` set `service` = '$calc_serv'  WHERE `session_id` = '$reprep' AND End_hour = '-'");
	mysql_query("UPDATE `reports` set `tax` = '$calc_tax'  WHERE `session_id` = '$reprep' AND End_hour = '-'");
	mysql_query("UPDATE `reports` set `discount2` = '0'  WHERE `session_id` = '$reprep' AND End_hour != '-'");  
    mysql_query("UPDATE `reports` set `discount` = '0'  WHERE `session_id` = '$reprep' AND End_hour != '-'"); 	
	mysql_query("UPDATE `reports` set `discount_amount` = '0'  WHERE `session_id` = '$reprep' AND End_hour != '-'");
	mysql_query("UPDATE `reports` set `service` = '0'  WHERE `session_id` = '$reprep' AND End_hour != '-'");
	mysql_query("UPDATE `reports` set `tax` = '0'  WHERE `session_id` = '$reprep' AND End_hour != '-'");
 	mysql_query("UPDATE `reports` set `End_hour` = '$H'     WHERE `session_id` = '$reprep' AND End_hour = '-';"); 
	// mysql_query("UPDATE `reports` set `discount` = '$tdis'  WHERE `session_id` = '$reprep'");               
	mysql_query("UPDATE `reports` set `last` = 'last'  WHERE `session_id` = '$reprep'");               
	mysql_query("UPDATE `reports` set `last` = ''  WHERE `session_id` != '$reprep'");        

	///
	mysql_query("UPDATE `reports` set `day` = '$RealDay'  WHERE `session_id` = '$reprep'");               
	mysql_query("UPDATE `reports` set `month` = '$RealMonth'  WHERE `session_id` = '$reprep'"); 
	mysql_query("UPDATE `reports` set `year` = '$Year'  WHERE `session_id` = '$reprep'"); 
    mysql_query("UPDATE `ps_orders` set `day` = '$RealDay'  WHERE `session_id` ='$reprep';"); 
    mysql_query("UPDATE `ps_orders` set `month` = '$RealMonth'  WHERE `session_id` ='$reprep';"); 
    mysql_query("UPDATE `ps_orders` set `year` = '$Year'  WHERE `session_id` ='$reprep';"); 
    ///
	
	//mysql_query("UPDATE `reports` set `discount2` = '$dda'  WHERE `session_id` = '$reprep'");               
	//mysql_query("UPDATE `reports` set `discount_amount` = '$exact_discount'  WHERE `session_id` = '$reprep'");
    mysql_query("UPDATE `ps_orders` set `status` = 'yes'    WHERE `ps_id` = '$id'  AND `session_id` ='$reprep';"); 
    mysql_query("UPDATE `ps_orders` set `shift` = '$current_shift'    WHERE   `session_id` ='$reprep';"); 
    mysql_query("UPDATE `ps_orders` set `casheer` = '$casheer'    WHERE `ps_id` = '$id' AND `session_id` ='$reprep';"); 
	mysql_query("UPDATE `devices` set `Device Status` = 'Off' WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `discount` = '0'  WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `discount2` = '0' WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `type` = ''       WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `session_id` = '' WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `day` = ''        WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `month` = ''      WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `year` = ''       WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `timetype` = ''   WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `end_h` = ''      WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `end_m` = ''      WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `hour` = ''       WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `minute` = ''     WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `second` = ''     WHERE `id` = '$id';"); 
	mysql_query("UPDATE `devices` set `notes` = ''     WHERE `id` = '$id';"); 	
}
echo "<script>location='../../devices.php?action=close&&session=$Receipt&&id=$id'</script>";
?>
