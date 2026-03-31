<?php session_start();
if( !isset($_SESSION['ps_user']) )
{
	include('login.php');
	die();
}
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}
$casheer = $_SESSION['ps_user'];
$close = $_GET['action']; 
$pause = $_GET['pause']; 
$reprep = $_GET['session']; 
$money = $_GET['wanted']; 
$old_id = $_POST['old_id'];
$new_id = $_POST['new_id'];
$old_time = $_POST['old_time'];
$barca = $_POST['barca'];
$dName = $_GET['name'];
$old_time = $_GET['seconds'];
$matloob = $_GET['seconds'];
$op = $_GET['oppa'];
$Receipt = $reprep;
$Month = idate('m');
$Day = idate('d');
$youm = $Day;
$Hour = idate('H');
$Minute = idate('i');
$Second = idate('s'); 
$Year = idate('Y');
$id = $_GET['id'];
$resume = $_GET['resume'];
$H = $Hour;
$tdis = $_GET['tdis']; 
$exact_discount = $_GET['exact_discount']; 

 	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	$sql="SELECT * FROM config";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
		{
	     $current_shift = $row['current_shift'];
	     $last_shift = $row['last_shift'];
	     $shift_day = $row['shift_day'];
	     $shift_month = $row['shift_month'];
		}
 if($current_shift == 'No')
 {
	 
	mysql_query("UPDATE `config` set `shift_day` = '$Day';"); 
	mysql_query("UPDATE `config` set `shift_month` = '$Month';"); 
 }
 
 
  
mysql_query("SELECT GET_LOCK('reports_session_id_lock', 5)");
$sql="SELECT MAX(session_id) AS max_session FROM reports";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{ 
  $last_session =  $row['max_session'];
}
if(!isset($last_session) || $last_session === '' || $last_session === null)
{
	$sess = 1;
 }
else{
  $sess = $last_session + 1;
 }
mysql_query("SELECT RELEASE_LOCK('reports_session_id_lock')");
 
     ob_start();  
	system('ipconfig /all');  
	$mycom=ob_get_contents(); 
	ob_clean();  
	$findme = "Physical";
	$pmac = strpos($mycom, $findme); 
	$mac=substr($mycom,($pmac+36),17);  
 
	$sql="SELECT * FROM config";
	$result=mysql_query($sql);
 	while($row = mysql_fetch_array($result))
	{
    $labx = $row['lic'];
	$mx = md5($mac);
 	}
     if($labx != $mx)
     {
	 header("location:control_copyrights_check.php");
	 die();
	 }
	
	// if($matloob < 900)
	// {
	// $matloob = 900;
	// if($close_p == 'single')
	// {$money = $singlea / 4;}
	// else if($close_p == 'multi')
	// {$money = $multia / 4;}
	// else if($close_p == 'multi6')
	// {$money = $multi6a / 4;}
	// else if($close_p == 'multi7')
	// {$money = $multi7a / 4;}
 

//$id=$_GET['id'];	
$sethour = isset($_POST['seth']) ? (int) $_POST['seth'] : 0;
$setminute = isset($_POST['setm']) ? (int) $_POST['setm'] : 0;
$sethour = isset($_POST['seth']) ? max(0, (int) $_POST['seth']) : 0;
$setminute = isset($_POST['setm']) ? max(0, (int) $_POST['setm']) : 0;
$setminute = min(59, $setminute);
$value1 = $_POST['selector']; 
$newt = isset($_POST['selector2']) ? $_POST['selector2'] : '';
if(isset($value1))
{
			$id=$_POST['idd'];

	    include('includes/config.php');

 	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	$sql="SELECT * FROM devices WHERE `ID` = '$id'";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
		{
	     $current_ip = $row['ip'];
	     $current_port = $row['port'];
	     $current_open = $row['openword'];
 		}
 
    if($ta7akom == 'yes'){
  $socket = fsockopen($current_ip, $current_port); // creates connection it returns the file pointer
if($socket) {  // if it returns a file pointer
 fwrite($socket, $current_open);  //write the filename in the file pointer returned by socket and chagne line
}
	}
	
	
	
	
	$run_unlimited = (($sethour + $setminute) <= 0);
	if($run_unlimited)
	{


		//$value3=$_POST['Game'];

		$Month = idate('m');
		$Year = idate('Y');
		$Hour = idate('H');
		$Minute = idate('i');
		$Second = idate('s'); 

		$H = $Hour;

		//$sess = rand();

		
	 
		mysql_query("UPDATE `devices` set `type` = '$value1'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `day` = '$shift_day'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `day2` = '$Day2'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `month` = '$shift_month'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `year` = '$Year'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `hour` = '$H'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `minute` = '$Minute'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `second` = '$Second'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `Device Status` = 'On'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `session_id` = '$sess'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `timetype` = 'unlimited'  WHERE `id` = '$id';");  

		mysql_query("INSERT INTO `reports` (`type`, `pc_id`, `Start_hour` ,`Start_minute`,`session_id`,`day`,`day2`,`month`,`year`,`Start_second`,`shift`) VALUES ('$value1', '$id','$H','$Minute','$sess','$shift_day','$Day2','$shift_month','$Year','$Second','$current_shift');"); 

	}
	else
	{
		$id=$_POST['idd']; 
		$Month = idate('m');
		$Year = idate('Y');
		$Hour = idate('H');
		$Minute = idate('i');
		$Second = idate('s'); 
		$H = $Hour;
		$new_h = $Hour + $sethour;
		$new_m = $Minute + $setminute-1;
		$end_day = $shift_day;

		if($new_m > 60)
		{
			$new_m = $new_m -60;
			$new_h = $new_h + 1;
		}
		if($new_h == '24'){$new_h = 0;$end_day = $shift_day+1; }
		if($new_h == '26'){$new_h = 1;$end_day = $shift_day+1;}
		if($new_h == '27'){$new_h = 2;$end_day = $shift_day+1;}
		if($new_h == '28'){$new_h = 3;$end_day = $shift_day+1;}
		if($new_h == '29'){$new_h = 4;$end_day = $shift_day+1;}
		if($new_h == '30'){$new_h = 5;$end_day = $shift_day+1;}
		if($new_h == '31'){$new_h = 6;$end_day = $shift_day+1;}

		mysql_query("UPDATE `devices` set `type` = '$value1'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `day` = '$shift_day'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `end_day` = '$end_day'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `month` = '$shift_month'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `year` = '$Year'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `hour` = '$H'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `minute` = '$Minute'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `second` = '$Second'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `Device Status` = 'On'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `session_id` = '$sess'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `timetype` = 'time'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `end_m` = '$new_m'  WHERE `id` = '$id';");  
		mysql_query("UPDATE `devices` set `end_h` = '$new_h'  WHERE `id` = '$id';");  

		mysql_query("INSERT INTO `reports` (`type`, `pc_id`, `Start_hour` ,`Start_minute`,`session_id`,`day`,`day2`,`month`,`year`,`Start_second`,`shift`) VALUES ('$value1', '$id','$H','$Minute','$sess','$shift_day','$Day2','$shift_month','$Year','$Second','$current_shift');"); 
	}}
$finishedid = $_GET['finishedid'];
if(isset($finishedid))
{
 
	mysql_query("UPDATE `devices` set `Device Status` = 'finished'  WHERE `id` = '$finishedid';"); 
}
 
$sql="SELECT * FROM config";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$add_funds = $row['add_funds'];
	$funds = $row['funds'];
}
if($add_funds == 'True')
{

	$sql="SELECT * FROM reports2 WHERE day = '$shift_day' AND month = '$shift_month' AND year = '$Year'";
	$result=mysql_query($sql);
	$funds_done = mysql_num_rows($result);
	if($funds_done > 0)
	{

	}
	else{
		$out = 'in';
		$notes = 'Daily Funds';
		mysql_query("INSERT INTO `reports2` ( `name`,`catagory`,`notes`,`price`,`day`,`month`,`year`) VALUES
('Admin','$out','$notes','$funds','$shift_day','$shift_month','$Year');"); 
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript">
// Popup window code
// var url = document.getElementById("www.google.com");
//url = document.getelementbyid('http://www.google.com');
function pay(url) {
	popupWindow = window.open(
	url,'popUpWindow','height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
}

</script>


<title><?php echo $lang_1;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $lang_1;?>">
<meta name="author" content="Mohamed Gad">
		<style>
		a.tip {
    border-bottom: 1px dashed;
    text-decoration: none
}
a.tip:hover {
    cursor: help;
    position: relative
	
}
a.tip span {
    display: none
}
a.tip:hover span {
    border: #c0c0c0 1px dotted;
    padding: 5px 20px 5px 5px;
    display: block;
    z-index: 100;
    background: url(../images/status-info.png) #f0f0f0 no-repeat 100% 5%;
    left: 0px;
    margin: 10px;
    width: 250px;
    position: absolute;
	color: #ff0505;
    top: 10px;
    text-decoration: none
 }
		</style>
<!-- The styles -->
		<?php  include 'includes/css.php';?>
</head>
<?php 
if(isset($close))
{
	?><body onload="pay('actions/print/ps.php?Session=<?php  echo $Receipt; ?>&&id=<?php  echo $id; ?>')">
	<?php }
else
{
	?><body><?php 
}
?>
<!-- topbar starts -->
<?php include('includes/navbar.php');?>
<!-- topbar ends -->
<div class="container-fluid">
<div class="row-fluid">
<!-- left menu starts -->
<?php include('includes/menu.php');?>
<!--/span-->
<!-- left menu ends -->
<noscript>
<div class="alert alert-block span10">
<h4 class="alert-heading">Warning!</h4>
<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
</div>
</noscript>

<div id="content" class="span10">
<!-- content starts -->

<?php 

// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

$sql="SELECT * FROM devices ORDER BY orderby";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$uni = uniqid(); 
	$a = uniqid();
	$id = $row['ID'];
	$thetype = $row['type'];
	?>
	<div class="sortable row-fluid">
	<?php  
	$status = $row['Device Status'];
	$timetype = $row['timetype'];
	if ( $status == 'On')
	{
		if($timetype == 'unlimited')
		{
		 if($row['ps_version'] == '11'){ $the_url = 'devices_cafe.php?id=';}else{$the_url = 'devices_ps.php?id=';}
			 
			
			?>
			<a data-rel="tooltip"   class="well span3 top-block" href="<?php echo $the_url.$id;?>">
			<div><?php  echo $row['Device Name']; ?></div>

			<span><?php if($row['ps_version'] == '3') { ?>
				<span><img id="aa" src="img/app/devices/pss3.png"    /></span>
				<?php }
			else if($row['ps_version'] == '4')
			{
				?>
				<span><img id="aa" src="img/app/devices/pss4.png" /></span>
				<?php }
			else if($row['ps_version'] == '2')
			{
				?>
				<span><img id="aa" src="img/app/devices/pss2.png"   /></span>
				<?php } else if($row['ps_version'] == '5')
			{
				?>
				<span><img id="aa" src="img/app/devices/tenis2.png"    /></span>
				<?php } else if($row['ps_version'] == '6')
			{
				?>
				<span><img id="aa" src="img/app/devices/billiard2.png"    /></span>
				<?php }else if($row['ps_version'] == '7')
			{
				?>
				<span><img id="aa" src="img/app/devices/bein.png"  style="height: 50px;"  /></span>
			<?php }else if($row['ps_version'] == '8')
			{
				?>
				<span><img id="aa" src="img/app/devices/vr2.png"     /></span>
			<?php }else if($row['ps_version'] == '9')
			{
				?>
				<span><img id="aa" src="img/app/devices/wii2.png"  /></span>
			<?php }
			else if($row['ps_version'] == '10')
			{
				?>
				<span><img id="aa" src="img/app/devices/xbox2.png"  /></span>
			<?php }
			else if($row['ps_version'] == '11')
			{
				?>
				<span><img id="aa" src="img/app/devices/cafe.png" style="height: 100px;" /></span>
			<?php }?></span>
		
<?php 
if($row['ps_version'] == '11'){
	
	?>
	<br/>
	<br/>
	<?php 
}else{
?>
		<div>
			<?php  

			switch($thetype)
		{
		CASE 'single':   echo $lang_3;	BREAK;		
		CASE 'multi':   echo $lang_4;	BREAK;		
		CASE 'multi6':   echo $lang_6;	BREAK;		
		CASE 'multi7':   echo $lang_7;	BREAK;		
		} ?></div>
			<?php 
			//$Remain = $row['Remaining Time']; 
			$Hour = idate('H');
			$Minute = idate('i');
			$Second = idate('s');
			$gethour = $row['hour'];
			$getminute = $row['minute'];
			$getsecond = $row['second'];
			$start_day = $row['day'];
			$tod_date = idate('d');

			if($Hour == '0'){$Hour = 24;} if($gethour == '0'){$gethour = 24;}
	        $hdiff = $Hour - $gethour;
		    
			 
			if(($hdiff < 0)  && ($start_day !=$tod_date) || ($hdiff < 0) && ($start_day !=$end_dayy))
			{
				$hdiff = $hdiff + 24;
			}
			// elseif($hdiff = 0)
			//{
			// $hdiff = 0;
			// }
			$mdiff = $Minute - $getminute;

			$sdiff = $Second - $getsecond;

			// if($mdiff < 0)
			// {
			// $mdiff = $mdiff + 60;

			// }
			// elseif($mdiff = 0)
			// {
			// $mdiff = 0;
			// }
			// if($sdiff < 0)
			// {
			// $sdiff = $sdiff + 60;

			// }
			// elseif($sdiff = 0)
			// {
			// $sdiff = 0;
			// }
			$all = (($hdiff * 60*60)+($mdiff*60)+$sdiff);

			?><p></p>
			<font color="red" size="5">			<span id='countdownn_<?php  echo $id; ?>'><?php  echo $all;?></span></font></br>
			<p id="done_<?php  echo $id;?>"></p>

			<script type="text/javascript">   
			secs       =  parseInt(document.getElementById('countdownn_<?php  echo $id; ?>').innerHTML,10);
			setTimeout("countdown('countdownn_<?php  echo $id; ?>',"+secs+")", 1000);
			test       =  parseInt(document.getElementById('<?php  echo $id; ?>').innerHTML,10);

			// Initialize clock countdowns by using the total seconds in the elements tag
			
			// x = document.getElementById(<?php  echo $id;?>);

			/**
	* Countdown function
	* Clock count downs to 0:00 then hides the element holding the clock
	* @param id Element ID of clock placeholder
	* @param timer Total seconds to display clock
	*/
			function countdown(id, timer){
				timer++;
				hourRemain = Math.floor(timer / 3600)%24;
				minRemain  = Math.floor(timer / 60 )%60;
				secsRemain = new String(timer %60);
				// Pad the string with leading 0 if less than 2 chars long
				if (secsRemain.length < 2) {
					secsRemain = '0' + secsRemain;
				}

				// String format the remaining time
				clock      = hourRemain + ":" + minRemain + ":" + secsRemain;
				document.getElementById(id).innerHTML = clock;
				if ( timer > 0 ) {
					// Time still remains, call this function again in 1 sec
					setTimeout("countdown('" + id + "'," + timer + ")", 1000);
				} else {
					document.getElementById(id).style.display = 'none';

					//	  alert("One Playstation Time Has ended Please Bill the Customers");
					//	  window.location = "devices_ps.php?id=<?php  echo $id;?>"
					//	document.write("<p>The text from the intro paragraph: " + x.innerHTML + "</p>");
					//document.getElementById("done_<?php  echo $id;?>").innerHTML="Bill";
					// Time is out! Hide the countdown
				}
				
			}
</script><?php }?>
			<img src="img/app/buttons/info.png" /> 
			<span class="notification red"><?php echo $lang_2;?></span>
			<p></p>	</a>

			<?php 
		}
		else if($timetype == 'time')
		{
			?>
			<a data-rel="tooltip"   class="well span3 top-block" href="devices_ps.php?id=<?php echo $id;?>">
			<div><?php  echo $row['Device Name']; ?></div>

			<span><?php if($row['ps_version'] == '3') { ?>
				<span><img id="aa" src="img/app/devices/pss3.png"    /></span>
				<?php }
			else if($row['ps_version'] == '4')
			{
				?>
				<span><img id="aa" src="img/app/devices/pss4.png"    /></span>
				<?php }
			else if($row['ps_version'] == '2')
			{
				?>
				<span><img id="aa" src="img/app/devices/pss2.png"     /></span>
				<?php } else if($row['ps_version'] == '5')
			{
				?>
				<span><img id="aa" src="img/app/devices/tenis2.png"    /></span>
				<?php } else if($row['ps_version'] == '6')
			{
				?>
				<span><img id="aa" src="img/app/devices/billiard2.png"    /></span>
				<?php }else if($row['ps_version'] == '7')
			{
				?>
				<span><img id="aa" src="img/app/devices/bein.png"   style="height: 50px;"  /></span>
			<?php }else if($row['ps_version'] == '8')
			{
				?>
				<span><img id="aa" src="img/app/devices/vr2.png"     /></span>
			<?php }else if($row['ps_version'] == '9')
			{
				?>
				<span><img id="aa" src="img/app/devices/wii2.png"  /></span>
			<?php }
			else if($row['ps_version'] == '10')
			{
				?>
				<span><img id="aa" src="img/app/devices/xbox2.png"  /></span>
			<?php }
			else if($row['ps_version'] == '11')
			{
				?>
				<span><img id="aa" src="img/app/devices/cafe.png" style="height: 50px;" /></span>
			<?php }?>
			</span>
			 <div><?php  switch($thetype)
		{
		CASE 'single':   echo $lang_3;	BREAK;		
		CASE 'multi':   echo $lang_4;	BREAK;		
		CASE 'multi6':   echo $lang_6;	BREAK;		
		CASE 'multi7':   echo $lang_7;	BREAK;		
		}  ?></div>

			<?php 
			$Hour = idate('H');
			$Minute = idate('i');
			$Second = idate('s');
			$esth = $row['end_h'];
			$estm = $row['end_m'];
			$ests = $row['second'];
			$start_day = $row['day'];
			$elid = $row['ID'];
			$end_dayy = $row['end_day'];
			if($Hour == '0'){$Hour = 24;} if($gethour == '0'){$gethour = 24;}

			$hdiff = $esth - $Hour;
			$tod_date = idate('d');
			if(($hdiff < 0)  && ($start_day !=$tod_date) || ($hdiff < 0) && ($start_day !=$end_dayy))
			{
   		    $hdiff = $hdiff + 24;
			}
			else if($hdiff < 0)
			{
  
          mysql_query("UPDATE `devices` set `Device Status` = 'finished'  WHERE `ID` = '$elid';");
			}
			$mdiff = $estm - $Minute;
			$sdiff = $ests - $Second;
			$alll = (($hdiff * 60*60)+($mdiff*60)+$sdiff);
			
			?>
			<p></p>
			<font color="green" size="5">			<span id='countdownn__<?php  echo $id; ?>'><?php  echo $alll;?></span></font></br>
			<p id="done_<?php  echo $id;?>"></p>
			<script type="text/javascript">   
			secs       =  parseInt(document.getElementById('countdownn__<?php  echo $id; ?>').innerHTML,10);
			setTimeout("countdown2('countdownn__<?php  echo $id; ?>',"+secs+")", 1000);
			test       =  parseInt(document.getElementById('<?php  echo $id; ?>').innerHTML,10);

			// Initialize clock countdowns by using the total seconds in the elements tag
			
			// x = document.getElementById(<?php  echo $id;?>);

			/**
	* Countdown function
	* Clock count downs to 0:00 then hides the element holding the clock
	* @param id Element ID of clock placeholder
	* @param timer Total seconds to display clock
	*/
			function countdown2(id, timer){
				timer--;
				hourRemain = Math.floor(timer / 3600)%24;
				minRemain  = Math.floor(timer / 60 )%60;
				secsRemain = new String(timer %60);
				// Pad the string with leading 0 if less than 2 chars long
				if (secsRemain.length < 2) {
					secsRemain = '0' + secsRemain;
				}
				if (minRemain.length < 2) {
					minRemain = '0' + minRemain;
				}
				if (hourRemain.length < 2) {
					hourRemain = '0' + hourRemain;
				}

				// String format the remaining time
				clock      = hourRemain + ":" + minRemain + ":" + secsRemain;
				document.getElementById(id).innerHTML = clock;
				if ( timer > 0 ) {
					// Time still remains, call this function again in 1 sec
					setTimeout("countdown2('" + id + "'," + timer + ")", 1000);
				} else {
					document.getElementById(id).innerHTML = '00:00:00';

					//alert("One Playstation Time Has ended Please Bill the Customers");
					window.location.href = "actions/ps/timerstop.php?id=" + id;
				}

			}
			</script>
			<img src="img/app/buttons/info.png" /> 
			<span class="notification red"><?php echo $lang_2;?></span>
			<p></p>	</a>

			<?php 
		}
	} 
	else if ($status == 'Off')
	{		
		?>
		<script>
		$(document).ready(function()
		{
			$("#hide_b<?php echo $id;?>").hide();
			$("#start_op_<?php echo $id;?>").hide();
			$("#start_opp_<?php echo $id;?>").hide();
			$("#un_id_<?php echo $id;?>").hide();
			//on click on the unlimited hide time input and show unlimited
			$("#start_<?php echo $id;?>").click(function(){
			$("#start_op_<?php echo $id;?>").hide(0);
			$("#start_opp_<?php echo $id;?>").hide(0);
			$("#un_id_<?php echo $id;?>").show(0);
			$("#time_mode_<?php echo $id;?>").val('unlimited');
			$("#hide_b<?php echo $id;?>").show(0);
			});
			//on click on the time hide unlimited and show time
			$("#start2_<?php echo $id;?>").click(function(){
			$("#start_op_<?php echo $id;?>").show(0);
			$("#start_opp_<?php echo $id;?>").show(0);
			$("#hide_b<?php echo $id;?>").show(0);
			$("#un_id_<?php echo $id;?>").hide(0);
			$("#time_mode_<?php echo $id;?>").val('time');
			});
		});
		</script>

		<div data-rel="tooltip"  class="well span3 top-block" >
		<div><?php  echo $row['Device Name']; ?></div>
		<?php if($row['ps_version'] == '3') { ?>
			<span><a href="#" class="tip"><span> الألعاب المتاحة:<br/>
			<?php  echo $row['Paused']; ?>
			</span><img id="aa" src="img/app/devices/p3.png"   /></a></span>
			<?php }
		else if($row['ps_version'] == '4')
		{
			?>
			<span><a href="#" class="tip"><span> الألعاب المتاحة:<br/>
			<?php  echo $row['Paused']; ?>
			</span><img id="aa" src="img/app/devices/p4.png"   /></a></span>
			<?php }
		else if($row['ps_version'] == '2')
		{
			?>
			<span><a href="#" class="tip"><span> الألعاب المتاحة:<br/>
			<?php  echo $row['Paused']; ?>
			</span><img id="aa" src="img/app/devices/p2.png"   /></a></span>
			<?php } else if($row['ps_version'] == '5')
		{
			?>
			<span><img id="aa" src="img/app/devices/tenis.png"     /></span>
			<?php } else if($row['ps_version'] == '6')
		{
			?>
			<span><img id="aa" src="img/app/devices/billiard.png"     /></span>
			<?php }else if($row['ps_version'] == '7')
			{
				?>
				<span><img id="aa" src="img/app/devices/bein.png"   style="height: 50px;"  /></span>
			<?php }else if($row['ps_version'] == '8')
			{
				?>
				<span><img id="aa" src="img/app/devices/vr.png"     /></span>
			<?php }else if($row['ps_version'] == '9')
			{
				?>
				<span><img id="aa" src="img/app/devices/wii.png"  /></span>
			<?php }
			else if($row['ps_version'] == '10')
			{
				?>
				<span><img id="aa" src="img/app/devices/xbox.png"  /></span>
			<?php }
			else if($row['ps_version'] == '11')
			{
				?>
				<span><img id="aa" src="img/app/devices/cafe.png" style="height: 100px;" /></span>
			<?php }?>
		<span>
		<form   action="devices.php" method="post"> 
		<input type="hidden" name="idd" value="<?php echo $id;?>" />
		<?php if($row['ps_version'] == '11'){
			?>
		<input   name="selector2" id="un_id_<?php echo $id;?>" type="hidden" value="unlimited">

		<input type="hidden" name="selector" value="single"/>
		<input type="hidden" name="time_mode" value="unlimited"/>
		<br/>
		<br/>
		<button id="" type="submit" class="submit-button"><span class="hide-text">Submit the form</span></button>
		<?php }else{?>
		<input type="hidden" name="time_mode" id="time_mode_<?php echo $id;?>" value="unlimited"/>
		<select name="selector" style="width: 94%;">
		<option value="single"><?php echo $lang_3;?></option>
		<option value="multi"><?php echo $lang_4;?></option>
		<option value="multi6"><?php echo $lang_6;?></option>
		<option value="multi7"><?php echo $lang_7;?></option> 
 
		</select>
		<br/>
		<img id = "start_<?php echo $id;?>" src="img/app/devices/un.png" width="30" title="<?php echo $lang_8;?>" data-rel="tooltip"/>
		<img id = "start2_<?php echo $id;?>"  src="img/app/devices/ti.png" width="30" title="<?php echo $lang_9;?>" data-rel="tooltip"/><br/>
		<input  id="start_op_<?php echo $id;?>" type= "number" name="seth" placeholder="<?php echo $lang_10;?>" size = "7"  min = "0" max="24" style="width:70px;"/>
		<input  id="start_opp_<?php echo $id;?>" type= "number" name="setm" placeholder="<?php echo $lang_11;?>" size = "7" min="0" max="59" step="1" style="width:70px;" />
		<input  style="width:80%;" name="selector2" id="un_id_<?php echo $id;?>" type="text" value="unlimited" readonly>
		<br/>
		<button id="hide_b<?php echo $id;?>" type="submit" class="submit-button"><span class="hide-text">Submit the form</span></button>
		<?php }?>
		</form>
		</span>
		<span class="notification green"><?php echo $lang_12;?></span>
		</div>
		<?php  }
	else if ($status == 'finished')
	{
		?>
		<script>
		var snd = new Audio("sounds/aa.mp3"); // buffers automatically when created
		snd.play();
		</script>
		
		<a data-rel="tooltip"  class="well span3 top-block" href="devices_ps.php?id=<?php echo $id;?>">
		<div><?php  echo $row['Device Name']; ?></div>
		<div><?php  echo $row['type']; ?></div>
		<span><?php if($row['ps_version'] == '3') { ?>
			<span><img id="aa" src="img/app/devices/p3.png"    /></span>
			<?php }
		else if($row['ps_version'] == '4')
		{
			?>
			<span><img id="aa" src="img/app/devices/p4.png"    /></span>
			<?php }
		else if($row['ps_version'] == '2')
		{
			?>
			<span><img id="aa" src="img/app/devices/p2.png"     /></span>
			<?php } else if($row['ps_version'] == '5')
		{
			?>
			<span><img id="aa" src="img/app/devices/tenis.png"    /></span>
			<?php } else if($row['ps_version'] == '6')
		{
			?>
			<span><img id="aa" src="img/app/devices/billiard.png"    /></span>
			<?php }else if($row['ps_version'] == '7')
			{
				?>
				<span><img id="aa" src="img/app/devices/bein.png"   style="height: 50px;"  /></span>
			<?php }
			else if($row['ps_version'] == '8')
			{
				?>
				<span><img id="aa" src="img/app/devices/vr.png"     /></span>
			<?php }else if($row['ps_version'] == '9')
			{
				?>
				<span><img id="aa" src="img/app/devices/wii.png"  /></span>
			<?php }else if($row['ps_version'] == '10')
			{
				?>
				<span><img id="aa" src="img/app/devices/xbox.png"  /></span>
			<?php }
			else if($row['ps_version'] == '11')
			{
				?>
				<span><img id="aa" src="img/app/devices/cafe.png" style="height: 50px;" /></span>
			<?php }?>
			</span>
		<p></p> 
		<style>
		.blink_meee {
animation: blinker 1s linear infinite;
		}

		@keyframes blinker {  
			50% { opacity: 0.0; }
		}
		</style>
		<span><font color="#33b5e5" size="5">			<span class="blink_meee">00:00:00</span></font></br></span><p></p>
		<img src="img/app/buttons/pay.png" /> 

		<span class="notification orange"><?php echo $lang_13;?></span>
		</a>				<?php  }} ?>
</div>
<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->

<hr>

<div class="modal hide fade" id="shift">
<div class="modal-header">
 <h3><?php echo $lang_14;?></h3>
</div>
<div class="modal-body">
<center>
<h2><?php echo $lang_15;?></h2>
<br/>
<?php 
if($last_shift == 'One')
{
	$view_shift = $lang_16;
}
else if($last_shift == 'Two')
{
	$view_shift = $lang_17;
}
?>
<h3><?php echo $lang_18;?>: <?php echo $view_shift;?></h3>
<form action="actions/login/shifting.php" method="POST">
	<input type="hidden" name="shift_option" value="start"/>
	<input type="hidden" name="last_shift" value="<?php echo $last_shift?>"/>
	<input type="hidden" name="shift_day" value="<?php echo $Day?>"/>
	<input type="hidden" name="shift_month" value="<?php echo $Month?>"/>
	<input type="image" src="img/app/buttons/shift-start.png"/>
	</form>
	<a href="actions/login/logout.php"><img src="img/app/buttons/logout.png"></a><br/><br/>
	<a href="shift_report_day.php?day=<?php echo $Day?>&&month=<?php echo $Month?>&&year=<?php echo $Year?>"><img src="img/app/buttons/last-shift.png"/></a>
	
	 
	</center>
	</div>
<div class="modal-footer">
</div>
</div>
<div class="modal hide fade" id="shiftauth">
<div class="modal-header">
 <h3><?php echo $lang_170;?></h3>
</div>
<div class="modal-body">
<center>
<h2><?php echo $lang_416;?></h2>
<br/>
<?php 
if($user_shift == '2')
{
	$view_shift = $lang_16;
	$auth_shift = 'One'; 
}
else if($user_shift == '1')
{
	$view_shift = $lang_17;
	$auth_shift = 'Two';
}
?>
<h3><?php echo $lang_418;?>: <?php echo $view_shift;?></h3>
<form action="actions/login/shifting.php" method="POST">
	<input type="hidden" name="shift_option" value="start"/>
	<input type="hidden" name="last_shift" value="<?php echo $auth_shift?>"/>
	<input type="hidden" name="shift_day" value="<?php echo $Day?>"/>
	<input type="hidden" name="shift_month" value="<?php echo $Month?>"/>
	<input type="image" src="img/app/buttons/shift-start.png"/>
	</form>
	<a href="actions/login/logout.php"><img src="img/app/buttons/logout.png"></a><br/><br/>
 	
	 
	</center>
	</div>
<div class="modal-footer">
</div>
</div>
<footer>
<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">Gesture For Playstation</a> <?php $Year = idate('Y');   echo $Year;?></p>

</footer>

</div><!--/.fluid-container-->

<!-- external javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<!-- jQuery -->
<script src="js/jquery-1.7.2.min.js"></script> 
<!-- jQuery UI -->
<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
<!-- transition / effect library -->
<script src="js/bootstrap-transition.js"></script>
<!-- alert enhancer library -->
<script src="js/bootstrap-alert.js"></script>
<!-- modal / dialog library -->
<script src="js/bootstrap-modal.js"></script>
<!-- custom dropdown library -->
<script src="js/bootstrap-dropdown.js"></script>
<!-- scrolspy library -->
<script src="js/bootstrap-scrollspy.js"></script>
<!-- library for creating tabs -->
<script src="js/bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="js/bootstrap-tooltip.js"></script>
<!-- popover effect library -->
<script src="js/bootstrap-popover.js"></script>
<!-- button enhancer library -->
<script src="js/bootstrap-button.js"></script>
<!-- accordion library (optional, not used in demo) -->

<!-- carousel slideshow library (optional, not used in demo) -->
<!-- autocomplete library -->
<script src="js/bootstrap-typeahead.js"></script>
<!-- tour library -->
<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calander plugin -->
<!-- data table plugin -->

<!-- chart libraries start -->

<!-- chart libraries end -->

<!-- select or dropdown enhancer -->
<script src="js/jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<!-- plugin for gallery image view -->
<!-- rich text editor library -->
<!-- notification plugin -->
	<script src="js/jquery.uniform.min.js"></script>

<!-- file manager library -->
<!-- star rating plugin -->
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- accordion library (optional, not used in demo) -->
<script src="js/bootstrap-collapse.js"></script>

 
<!-- autogrowing textarea plugin -->
<!-- multiple file upload plugin -->
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>
<script>
(function() {
    function ensureOrderToast() {
        var box = document.getElementById('room-order-toast');
        if (box) return box;

        box = document.createElement('div');
        box.id = 'room-order-toast';
        box.style.cssText = 'display:none;position:fixed;top:20px;right:20px;width:280px;min-height:120px;background:#1f2937;color:#fff;border:2px solid #33b5e5;border-radius:10px;padding:12px;z-index:99999;box-shadow:0 6px 20px rgba(0,0,0,.35);font-family:Tahoma;';
        box.innerHTML = '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">' +
                        '<div style="font-weight:bold;font-size:16px;">طلب جديد</div>' +
                        '<button id="room-order-toast-close" type="button" style="background:transparent;border:1px solid #fff;color:#fff;border-radius:4px;width:24px;height:24px;line-height:20px;cursor:pointer;">×</button>' +
                        '</div>' +
                        '<div id="room-order-toast-room" style="margin-bottom:6px;"></div>' +
                        '<div id="room-order-toast-order" style="line-height:1.5;"></div>';
        setTimeout(function(){
            var closeBtn = document.getElementById('room-order-toast-close');
            if (closeBtn) {
                closeBtn.onclick = function() {
                    box.style.display = 'none';
                };
            }
        }, 0);
        document.body.appendChild(box);
        return box;
    }

    function showRoomOrderToast(message) {
        var box = ensureOrderToast();
        var roomEl = document.getElementById('room-order-toast-room');
        var orderEl = document.getElementById('room-order-toast-order');

        var msg = message || '';
        var roomPart = msg;
        var orderPart = '';
        if (msg.indexOf('طلب:') !== -1) {
            var parts = msg.split('طلب:');
            roomPart = parts[0];
            orderPart = 'الطلب: ' + parts.slice(1).join('طلب:');
        }

        roomEl.textContent = roomPart.trim();
        orderEl.textContent = orderPart.trim();

        box.style.display = 'block';
    }

    function checkRoomOrderAlerts() {
        $.ajax({
            url: 'actions/ps/order_alert_poll.php',
            dataType: 'json',
            cache: false,
            success: function(resp) {
                if (!resp || !resp.ok || !resp.has_alert) {
                    return;
                }
                var msg = resp.message || 'Room order';
                if (resp.room || resp.order) {
                    msg = 'Room ' + (resp.room || '') + ': ' + (resp.order || '');
                }
                showRoomOrderToast(msg);
            }
        });
    }

    setInterval(checkRoomOrderAlerts, 5000);
})();
</script>

</body>
</html>
