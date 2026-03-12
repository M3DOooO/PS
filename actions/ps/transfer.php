<?php session_start();
if( !isset($_SESSION['ps_user']) )
{
	include('../../login.php');
	die();
}
include('../../includes/config.php');
$casheer = $_SESSION['ps_user'];
$close = $_POST['action']; 
$pause = $_POST['pause']; 
$reprep = $_POST['session']; 
$money = $_POST['wanted']; 
$old_id = $_POST['old_id'];
$new_id = $_POST['new_id'];
$old_time = $_POST['old_time'];
$barca = $_POST['barca'];
$dName = $_POST['name'];
$old_time = $_POST['seconds'];
$matloob = $_POST['seconds'];
$op = $_POST['oppa'];
$Receipt = $reprep;
$Month = idate('m');
$Day = idate('d');
$youm = $Day;
$Hour = idate('H');
$Minute = idate('i');
$Second = idate('s'); 
$Year = idate('Y');
$id = $_POST['id'];
$resume = $_POST['resume'];
$H = $Hour;
$tdis = $_POST['tdis']; 
$exact_discount = $_POST['exact_discount']; 
$get_mon = $_POST['mon'];
$calc_serv = $_POST['calc_serv'];
$calc_tax = $_POST['calc_tax'];
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
	
if($old_id > 0)
{
	$sql="SELECT * FROM devices WHERE ID = '$old_id'";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$tran_t = $row['type'];
		$tran_na = $row['Device Name'];
		$tran_h = $row['hour'];
		$tran_m = $row['minute'];
		$tran_s = $row['second'];
		$oldm = $row['end_m'];
		$oldh = $row['end_h'];
		$tran_sess = $row['session_id'];
		$old_time_type = $row['timetype'];
		$dis_count = $row['discount'];
		$dis_count2 = $row['discount2'];
		$dis_count3 = $row['discount_admount'];
		$dis_count4 = $row['dis_reason'];
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
	$sql="SELECT * FROM devices WHERE ID = '$new_id'";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$new_name = $row['name'];
			     $current_ipx = $row['ip'];
	     $current_portx = $row['port'];
	     $current_open = $row['openword'];
	}
	    if($ta7akom == 'yes'){

  $socketx = fsockopen($current_ipx, $current_portx); // creates connection it returns the file pointer
if($socketx) {  // if it returns a file pointer
 fwrite($socketx, $current_open);  //write the filename in the file pointer returned by socket and chagne line
		}}
	mysql_query("UPDATE `reports` set `total` = '$barca'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id' AND End_hour = '-';"); 
	mysql_query("UPDATE `reports` set `End_minute` = '$Minute'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id' AND End_hour = '-';"); 
	mysql_query("UPDATE `reports` set `End_second` = '$Second'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id' AND End_hour = '-';"); 
	mysql_query("UPDATE `reports` set `money` = '$get_mon'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id' AND End_hour = '-';"); 
	mysql_query("UPDATE `reports` set `name` = '$tran_na'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id' AND End_hour = '-';"); 
	mysql_query("UPDATE `reports` set `shift` = '$current_shift'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id' AND End_hour = '-';"); 
	mysql_query("UPDATE `reports` set `End_hour` = '$H'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id';"); 
	 mysql_query("UPDATE `reports` set `discount` = '0'   WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id';"); 
	 mysql_query("UPDATE `reports` set `discount2` = '0'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id';"); 
	 mysql_query("UPDATE `reports` set `discount_amount` = '0'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id';"); 
	mysql_query("UPDATE `reports` set `End_hour` = '$H'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id';"); 
	mysql_query("UPDATE `reports` set `casheer` = '$casheer'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id';"); 
	// mysql_query("UPDATE `reports` set `status` = 'done'  WHERE `session_id` = '$tran_sess' AND pc_id ='$old_id';"); 
	mysql_query("INSERT INTO `reports`
	  (`name`,`type`, `pc_id`, `Start_hour` ,`Start_minute`,`session_id`,`day`,`day2`,`month`,`year`,`shift`,`Start_second`,`casheer`,`discount`,`discount2`,`dis_reason`,`discount_amount`) VALUES 
	  ('$new_name','$tran_t', '$new_id','$H','$Minute','$tran_sess','$shift_day','$Day2','$shift_month','$Year','$current_shift','$Second','$casheer','$dis_count','$dis_count2','$dis_count4','$dis_count3');");
	
	mysql_query("UPDATE `devices` set `Device Status` = 'Off'  WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `discount` = '0'  WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `discount2` = '0' WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `type` = ''       WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `session_id` = '' WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `day` = ''        WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `month` = ''      WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `year` = ''       WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `timetype` = ''   WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `end_h` = ''      WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `end_m` = ''      WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `hour` = ''       WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `minute` = ''     WHERE `id` = '$old_id';"); 
	mysql_query("UPDATE `devices` set `second` = ''     WHERE `id` = '$old_id';"); 
	
	mysql_query("UPDATE `devices` set `Device Status` = 'On'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `timetype` = '$old_time_type'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `end_h` = '$oldh'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `end_m` = '$oldm'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `type` = '$tran_t'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `hour` = '$Hour'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `minute` = '$Minute'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `second` = '$Second'     WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `day` = '$Day'        WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `month` = '$Month'      WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `year` = '$Year'       WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `discount2` = '$dis_count2'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `discount` = '$dis_count'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `second` = '$Second'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `devices` set `session_id` = '$tran_sess'  WHERE `id` = '$new_id';"); 
	mysql_query("UPDATE `ps_orders` set `ps_id` = '$new_id'  WHERE `ps_id` = '$old_id' AND `status` = 'no';"); 
}
 
	echo "<script>location='../../devices.php'</script>";

?>
