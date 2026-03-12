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

$id = $_GET['id']; $Sess=$_GET['Session'];		
$id=$_GET['id'];		
$Month = idate('m');
$Year = idate('Y');
$Day = idate('d'); 
$Hour = idate('H'); 
$Minute = idate('i'); 

mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `devices` WHERE ID = '$id'");
while($rowe = mysql_fetch_array($result))
{
	$single = $rowe['single'];
	$multi = $rowe['multi'];
	$multi6 = $rowe['multi6'];
	$multi7 = $rowe['multi7'];
	$notes = $rowe['notes'];
	$cafe = $rowe['ps_version'];
}

mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `reports` WHERE session_id = '$Sess'");
while($rowe = mysql_fetch_array($result))
{
	$s_h = $rowe['Start_hour'];
	$s_m = $rowe['Start_minute'];
	$e_h = $rowe['End_hour'];
	$e_m = $rowe['End_minute'];
	$s_s = $rowe['Start_second'];
	$e_s = $rowe['End_second'];
	$casheer = $rowe['casheer'];
    $notes = $rowe['cnote'];
    $namex = $rowe['name'];

	$t_h = $s_h - $e_h;
	if($t_h < 0)
	{
		$t_h = $t_h + 24;
	}
	$t_m = $s_m - $e_m;
	if($t_m < 0)
	{
		$t_m = $t_m + 60;
	}
}
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `ps_orders` WHERE session_id = '$Sess'");
while($rowe = mysql_fetch_array($result))
{
	$sub_cat = $rowe['sub_cat'];
	$o_name = $rowe['name'];
	$o_num = $rowe['num'];
	$o_price = $rowe['price'];
} 
   	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	$sql="SELECT * FROM config";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
		{
			$logo = $row['logo'];
			$logo_ch = $row['logo_ch'];
			$store = $row['store'];
			$store_ch = $row['store_ch'];
			$phone = $row['phone'];
			$phone_ch = $row['phone_ch'];
			$fb_ch = $row['fb_ch'];
			$font = $row['font'];
						$facebook = $row['facebook'];

		} 
?>
<html>
<head>
<style>
 @font-face {
    font-family: "DroidArabicKufiRegular";
    src: url(../../fonts/DroidKufi/DroidKufi-Bold.ttf) format("truetype");
}
body {
    font-family: 'DroidArabicKufiRegular'; 
    font-style: normal; 
  
  }
  *{
	  direction:rtl;
	  font-size: <?php echo $font;?>px;
	  font-weight: bold;

  }
    @page 
        {
            size: auto;   /* auto is the current printer page size */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
		table {
    border-collapse: collapse;
}

.t1 table, th, td {
    border: 1px dashed black;
}

th {
    height: 50px;
}
  </style>

</head>
 <body <?php if($printornot == 'yes'){?>onload="window.print()"<?php }?>>
   <?php if($logo_ch == 'checked'){?>
  <center>
<img src="../../img/<?php echo $logo;?>" style="width:150px" height="150px"/></br>
</center>
 <?php }?>
<table border="1" width="95%">
<tr>
<td align = 'center'><b><?php echo $lang_149;?></b></td>
<td align = 'center'><?php  echo $Sess;?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_178;?></b></td>
<td align = 'center'><?php  echo $Year; ?>-<?php  echo $shift_month; ?>-<?php  echo $shift_day; ?> </td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_160;?></b></td>
<td align = 'center'><?php  echo $s_h; ?>:<?php  echo $s_m; ?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_161;?></b></td>
<td align = 'center'><?php  echo $e_h; ?>:<?php  echo $e_m; ?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_166;?></b></td>
<td align = 'center'><?php  echo $casheer;?></td>
</tr>
</table>
 <br/>
 <table border="1" width="95%">
<?php if($cafe == '11'){?><tr>
<td colspan="2" align='center'><?php echo $namex;?></td>
<td colspan="2" align='center'>كافيه</td>
<?php 
$dont = 1;
}?></tr>
<tr>
<th><?php if($cafe == '11'){echo 'الصنف';}else{echo $lang_179;}?></th>
<th><?php echo $lang_51;?></th>
<th><?php echo $lang_180;?></th>
<th><?php echo $lang_106;?></th>
</tr>
<?php 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT SUM(discount),SUM(discount2) FROM `reports` WHERE session_id = '$Sess'");
while($row = mysql_fetch_array($result))
{
		$ddd = $row['SUM(discount)'];
	$ddd2 = $row['SUM(discount2)'];
}
$result = mysql_query("SELECT * FROM `reports` WHERE session_id = '$Sess'");
while($row = mysql_fetch_array($result))
{
	$tom = $row['total'];
	$thetype = $row['type'];
	$calc_serv = $row['service'];
	$calc_tax = $row['tax'];

	$hr = floor($tom / 3600)%24;
	$mr = floor($tom / 60)%60;
	$sr = ($tom % 60);
	?> 
	<tr>
<?php if($dont !=1){?>	
<td align='center'><?php echo $row['name'];?> - <?php   switch($thetype)
		{
		CASE 'single':   echo $lang_3;	BREAK;		
		CASE 'multi':   echo $lang_4;	BREAK;		
		CASE 'multi6':   echo $lang_6;	BREAK;		
		CASE 'multi7':   echo $lang_7;	BREAK;		
		} ?></b></td>	
		<td align='center'><?php  if($row['type'] == 'single' ) { echo $single;} else if($row['type'] == 'multi' ) { echo $multi;}else if($row['type'] == 'multi6' ) { echo $multi6;}else if($row['type'] == 'multi7' ) { echo $multi7;} ?></td>
	<td align='center'><?php  echo $hr; ?>:<?php  echo $mr; ?>:<?php  echo $sr; ?></td>
	<td align='center'><?php  echo $row['money'];?></td>
	
<?php } } ?>
</tr>
<?php  if(isset($sub_cat))
{
	mysql_connect("$host", "$user", "$pass")or die("cannot connect");
	mysql_select_db("$db")or die("cannot select DB");
	$result = mysql_query("SELECT *,SUM(num),SUM(price) FROM `ps_orders` WHERE session_id = '$Sess' GROUP BY name");
	while($row = mysql_fetch_array($result))
	{
		?>
	<tr><td align='center'><?php  echo $row['name']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']/$row['SUM(num)']; ?></td>
		<td align='center' align = 'left'><?php  echo $row['SUM(num)']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']; ?></td>

		</tr>
		<?php  } $query = "SELECT  SUM(price) FROM ps_orders WHERE session_id = '$Sess'"; 
	
	$resulty = mysql_query($query) or die(mysql_error());

	// Print out result
	while($row = mysql_fetch_array($resulty)){
		$Orders_total = $row['SUM(price)'];
	}
} 
$query = "SELECT  SUM(money) FROM reports WHERE session_id = '$Sess'"; 
$resulty = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($resulty)){

	$tot = $row['SUM(money)']+ $Orders_total;
	?>
	</table>   
 	<?php 
	$last = $tot;
?>
<table border="1" width="95%">
<?php if($ddd > 0 ){?>  
<tr>
<td align = 'center'><b><?php echo $lang_181;?></b></td>
<td align = 'center'><b><font color='red'><?php echo $tot;?></font></b></td>
<td align = 'center'><b><?php echo $lang_100;?></b></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_182;?></b></td>
<td align = 'center'><b><font color='red'><?php echo $ddd;?></font></b></td>
<td align = 'center'><b>%</b></td>
</tr>
<?php 
$last = $tot - ($tot * ($ddd / 100));
}
else if($ddd2 > 0){
?>
<tr>
<td align = 'center'><b><?php echo $lang_181;?></b></td>
<td align = 'center'><b><font color='black'><?php echo $tot;?></font></b></td>
<td align = 'center'><b><?php echo $lang_100;?></b></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_182;?></b></td>
<td align = 'center'><b><font color='black'><?php echo $ddd2;?></font></td>
<td align = 'center'><b><?php echo $lang_100;?></b></td>
</tr>
<?php 
$last = $tot - $ddd2;
	} 
 if($calc_serv > 0){
 	?>
<tr>
<td align = 'center'><b>الخدمة (<?php echo $service;?>)%</b></td>
<td align = 'center'><b><font color='black'><?php echo $calc_serv;?></font></b></td>
<td align = 'center'><b><?php echo $lang_100;?></b></td>
</tr>
<?php }else{$calc_serv = 0;}

 if($calc_tax > 0)
{
	?>
<tr>
<td align = 'center'><b>الضريبة (<?php echo $tax;?>)%</b></td>
<td align = 'center'><b><font color='black'><?php echo $calc_tax;?></font></b></td>
<td align = 'center'><b><?php echo $lang_100;?></b></td>
</tr>
<?php }else{$calc_tax = 0;}?>
<?php 
	$last = $last+$calc_serv+$calc_tax;

?>

<tr>
<td align = 'center'><h3><?php echo $lang_106;?></h3></td>
<td align = 'center'><h3><font color='black'><?php echo ceil($last);?></font></h3></td>
<td align = 'center'><h3><?php echo $lang_100;?></h3></td>
</tr>

</table>
<br/>
 <table border="1" width="95%">
 
 <tr>
 	<td><b> <?php echo $lang_406;?></b></td>
    <td><?php echo $notes; ?></td>
</tr> 
  <?php if($phone_ch == 'checked'){?>
 <tr>
 	<td><b> <?php echo $lang_183;?></b></td>
    <td><?php echo $phone; ?></td>
 </tr>
  <?php }?>
  <?php if($fb_ch == 'checked'){?>
 <tr>
	<td><b><font size="3"> <?php echo $lang_184;?> </b></td>
	<td><font size="4"><?php echo $facebook;?> </font>  / <img src="../../img/app/social/facebook.png" width= "20" height="20"/></font></td>
</tr>
  <?php }?>	
</table>
<p style="font-size: 10px;">تاريخ الطباعة: <?php echo date("d-m-Y h:i:s A");?></p>
	<?php 
}
?></font><?php 
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error()); 
mysql_query("UPDATE `reports` set `status` = 'done'  WHERE `session_id` = '$Sess';"); 
?>

</body>
</html>