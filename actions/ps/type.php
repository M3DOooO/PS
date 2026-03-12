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
  
$change=$_POST['change']; 
$change_n=$_POST['name_change']; 
$mon=$_POST['time_change']; 
$change_sess=$_POST['sess_change']; 
$change_ty=$_POST['type_change']; 
$change_id=$_POST['change_id']; 

//تحويل نوع اللعب سنجل أو ملطي
if(isset($change))
{
 
	$sql="SELECT * FROM reports WHERE session_id = '$change_sess' AND dis_reason !=''";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$oold_dis = $row['discount'];
		$oold_dis2 = $row['discount2'];
		$oold_dis3 = $row['dis_reason'];
		$oold_dis4 = $row['discount_amount'];
	}

 	mysql_query("UPDATE `reports` set `total` = '$matloob'  WHERE `session_id` = '$change_sess' AND pc_id = '$change_id' AND End_hour = '-';"); 
	mysql_query("UPDATE `reports` set `End_minute` = '$Minute'  WHERE `session_id` = '$change_sess' AND End_hour = '-' AND pc_id = '$change_id';"); 
	mysql_query("UPDATE `reports` set `End_second` = '$Second'  WHERE `session_id` = '$change_sess' AND End_hour = '-' AND pc_id = '$change_id';"); 
	mysql_query("UPDATE `reports` set `money` = '$mon'  WHERE `session_id` = '$change_sess' AND notes ='On' AND End_hour = '-' AND pc_id = '$change_id';"); 
	mysql_query("UPDATE `reports` set `name` = '$change_n'  WHERE `session_id` = '$change_sess' AND pc_id = '$change_id' AND End_hour = '-' AND pc_id = '$change_id';"); 
	mysql_query("UPDATE `reports` set `casheer` = '$casheer'  WHERE `session_id` = '$change_sess' AND pc_id = '$change_id' AND End_hour = '-' AND pc_id = '$change_id';"); 
	// mysql_query("UPDATE `reports` set `status` = 'done'  WHERE `session_id` = '$change_sess' AND pc_id = '$change_id' AND End_hour = '-' AND pc_id = '$change_id';"); 
	// mysql_query("UPDATE `reports` set `notes` = 'changed'  WHERE `session_id` = '$change_sess' AND pc_id = '$change_id';"); 
	mysql_query("UPDATE `reports` set `shift` = '$current_shift'  WHERE `session_id` = '$change_sess' AND pc_id = '$change_id' AND End_hour = '-';"); 
	mysql_query("UPDATE `reports` set `End_hour` = $H  WHERE `session_id` = '$change_sess';"); 
	mysql_query("UPDATE `devices` set `type` = '$change_ty'  WHERE `id` = '$change_id';");  
	mysql_query("UPDATE `devices` set `day` = '$shift_day'  WHERE `id` = '$change_id';");  
	mysql_query("UPDATE `devices` set `day2` = '$Day2'  WHERE `id` = '$change_id';");  
	mysql_query("UPDATE `devices` set `month` = '$shift_month'  WHERE `id` = '$change_id';");  
	mysql_query("UPDATE `devices` set `year` = '$Year'  WHERE `id` = '$change_id';");  
	mysql_query("UPDATE `devices` set `hour` = $H  WHERE `id` = '$change_id';");  
	mysql_query("UPDATE `devices` set `minute` = '$Minute'  WHERE `id` = '$change_id';");  
	mysql_query("UPDATE `devices` set `second` = '$Second'  WHERE `id` = '$change_id';");  
	mysql_query("INSERT INTO `reports` (`type`, `pc_id`, `Start_hour` ,`Start_minute`,`day`,`day2`,`month`,`year`,`Start_second`,`session_id`,`casheer`) VALUES ('$change_ty', '$change_id','$H','$Minute','$shift_day','$Day2','$shift_month','$Year','$Second','$change_sess','$casheer');"); 

}
 
	echo "<script>location='../../devices.php'</script>";

?>
