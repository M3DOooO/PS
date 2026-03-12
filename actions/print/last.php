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

$id = $_GET['id'];   	              
 
$result = mysql_query("SELECT MAX(id) FROM reports WHERE `status` = 'done'");
while($rowe = mysql_fetch_array($result))
{
	$id_is = $rowe['MAX(id)']; 
 } 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `reports` WHERE last = 'last'");
while($rowe = mysql_fetch_array($result))
{
	$Sess = $rowe['session_id'];
	$id = $rowe['pc_id'];
	$casheer = $rowe['casheer'];
	$Hour = $rowe['End_hour'];
	$Minute = $rowe['End_minute'];
	$Year = $rowe['year'];
}  
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `devices` WHERE ID = '$id'");
while($rowe = mysql_fetch_array($result))
{
	$single = $rowe['single'];
	$multi = $rowe['multi'];
	$multi6 = $rowe['multi6'];
	$multi7 = $rowe['multi7'];
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
 <body <?php if($printornot == 'yes'){?>onload="window.print()"<?php }?>>
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
<body>
  <?php if($logo_ch == 'checked'){?>
  <center>
<img src="../../img/<?php echo $logo;?>" style="width:150px" height="150px"/></br>
</center>
  <?php }?>
<table border="1" width="95%">
<tr>
<td align = 'center'><b><?php echo $lang_149;?></b></td>
<td align = 'center'><?php  echo $Sess; ?> /<?php echo $Year;?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_178;?></b></td>
<td align = 'center'><?php  echo $shift_day; ?>-<?php  echo $shift_month; ?>-<?php  echo $Year; ?> </td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_161;?></b></td>
<td align = 'center'><?php  echo $Hour; ?>:<?php  echo $Minute; ?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_166;?></b></td>
<td align = 'center'><?php  echo $casheer;?></td>
</tr>
</table>
 <br/>
 <table border="1" width="95%">
<tr>
<th><?php echo $lang_179;?></th>
<th><?php echo $lang_51;?></th>
<th><?php echo $lang_180;?></th>
<th><?php echo $lang_106;?></th>
</tr>
<?php 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `reports` WHERE `session_id` = '$Sess'");
while($row = mysql_fetch_array($result))
{
	$tom = $row['total'];
	$ddd = $row['discount'];
	$ddd2 = $row['discount2'];
	$hr = floor($tom / 3600)%24;
	$mr = floor($tom / 60)%60;
	$sr = ($tom % 60);
	$thetype = $row['type'];

 
	?>  <tr>
	<!-- <td align = 'center'><?php  //echo  $row['name'] ." - ".$row['type']; ?></b> - From <?php  echo $row['Start_hour']; ?>:<?php // echo $row['Start_minute'];?>:<?php  //echo $row['Start_second'];?> To <?php  //echo $row['End_hour'];?>:<?php // echo $row['End_minute'];?>:<?php  echo $row['End_second'];?></td>-->
<td align='center'><?php echo $row['name'];?> - <?php   switch($thetype)
		{
		CASE 'single':   echo $lang_3;	BREAK;		
		CASE 'multi':   echo $lang_4;	BREAK;		
		CASE 'multi6':   echo $lang_6;	BREAK;		
		CASE 'multi7':   echo $lang_7;	BREAK;		
		} ?></b></td>	<td align = 'center'><?php  if($row['type'] == 'single' ) { echo $single;} else if($row['type'] == 'multi' ) { echo $multi;}else if($row['type'] == 'multi6' ) { echo $multi6;}else if($row['type'] == 'multi7' ) { echo $multi7;} ?></td>
	<td align = 'center'><?php  echo $hr; ?>:<?php  echo $mr; ?>:<?php  echo $sr; ?></td>
	<td align = 'center'><?php  echo $row['money'];?></td>
	<?php  } ?>
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
		<?php  } $query = "SELECT SUM(price) FROM ps_orders WHERE session_id = '$Sess'"; 
	
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
<td align = 'center'><b><?php echo $tot;?></b></td>
<td align = 'center'><b><?php echo $lang_100;?></b></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_182;?></b></td>
<td align = 'center'><b><?php echo $ddd;?></b></td>
<td align = 'center'><b>%</b></td>
</tr>
<?php 
$last = $tot - ($tot * ($ddd / 100));
}
else if($ddd2 > 0){
?>
<tr>
<td align = 'center'><b><?php echo $lang_181;?></b></td>
<td align = 'center'><b><?php echo $tot;?></b></td>
<td align = 'center'><b><?php echo $lang_100;?></b></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_182;?></b></td>
<td align = 'center'><b><?php echo $ddd2;?></td>
<td align = 'center'><b><?php echo $lang_100;?></b></td>
</tr>
<?php 
$last = $tot - $ddd2;
	}?>
<tr>
<td align = 'center'><h3><?php echo $lang_106;?></h3></td>
<td align = 'center'><h3><?php echo $last;?></h3></td>
<td align = 'center'><h3><?php echo $lang_100;?></h3></td>
</tr>

</table>
<br/>
 <table border="1" width="95%">
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
// mysql_query("DELETE FROM orders");  
mysql_query("UPDATE `reports` set `status` = 'done'  WHERE `session_id` = '$Sess';"); 
?>

</body>
</html>