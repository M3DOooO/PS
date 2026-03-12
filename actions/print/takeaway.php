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
$order_id=$_GET['Receipt'];		
$Month = idate('m');
$Year = idate('Y');
$Day = idate('d'); 
$Hour = idate('H'); 
$Minute = idate('i'); 
   	 
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
			
		} 
		mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

$result = mysql_query("SELECT *,SUM(discount),SUM(discount2),SUM(price) FROM `reports2` WHERE `session_id` = '$order_id'");
while($row = mysql_fetch_array($result))
{
    $dddsum = $row['SUM(discount)'];
	$pricesum = $row['SUM(price)'];
}
	  if($dddsum>0){
	  // $new_dis = $pricesum - ($pricesum * ($dddsum / 100));
	  $new_dis = ($pricesum * ($dddsum / 100));
 
 	  mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
      mysql_select_db("$db") or die(mysql_error()); 
	  mysql_query("UPDATE `reports2` set `discount2` = '$new_dis'  WHERE `session_id` = '$order_id' LIMIT 1;"); 
	  mysql_query("UPDATE `reports2` set `discount` = ''  WHERE `session_id` = '$order_id';"); 
 }
$result = mysql_query("SELECT *,SUM(discount2) FROM `reports2` WHERE `session_id` = '$order_id'");
while($row = mysql_fetch_array($result))
{
	$order_notes = $row['order_notes'];
	$ddd = $row['discount'];
	$ddd2 = $row['SUM(discount2)'];
	$disrs = $row['dis_reason'];
}



$casheer = $_SESSION['ps_user'];

mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error()); 
mysql_query("UPDATE `reports2` set `casheer` = '$casheer'  WHERE `session_id` = '$order_id';");   
mysql_query("UPDATE `reports2` set `shift` = '$current_shift'  WHERE `session_id` = '$order_id';"); 
mysql_query("UPDATE `reports2` set `status` = 'done'  WHERE `session_id` = '$order_id';"); 

		
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
<td align = 'center'><?php  echo $order_id; ?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_78;?></b></td>
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
$result = mysql_query("SELECT *,SUM(price),SUM(num) FROM `reports2` WHERE `session_id` = '$order_id' GROUP BY name");
while($row = mysql_fetch_array($result))
{

	?>  <tr><td align='center'><?php  echo $row['name']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']/$row['SUM(num)']; ?></td>
		<td align='center' align = 'left'><?php  echo $row['SUM(num)']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']; ?></td>

		</tr>
	<?php 
}
$query = "SELECT  SUM(price) FROM reports2 WHERE session_id = $order_id"; 

$resulty = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($resulty)){


	$tot = $row['SUM(price)'];
	$last = $tot;

	?>
	</table>   
  	<table border="1" width="95%">
  
 

<?php if($ddd > 0 ){?>  
<tr>
<td align = 'center'><h3><?php echo $lang_106;?></h3></td>
<td align = 'center'><h3><font color='red'><?php echo $tot;?></font></h3></td>
<td align = 'center'><h3><?php echo $lang_100;?></h3></td>
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
<td align = 'center'><h3><?php echo $lang_106;?></h3></td>
<td align = 'center'><h3><font color='red'><?php echo $tot;?></font></h3></td>
<td align = 'center'><h3><?php echo $lang_100;?></h3></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_182;?></b></td>
<td align = 'center'><b><font color='black'><?php echo $ddd2;?></font></td>
<td align = 'center'><b><?php echo $lang_100;?></b></td>
</tr>
<?php 
$last = $tot - $ddd2;
}
?>
<tr>
<td align = 'center'><h3><?php echo $lang_106;?></h3></td>
<td align = 'center'><h3><font color='black'><?php echo $last;?></font></h3></td>
<td align = 'center'><h3><?php echo $lang_100;?></h3></td>
</tr>
</table>
<br/>
 <table border="1" width="95%">
 <tr>
 	<td><b>الملاحظات</b></td>
    <td><?php echo $order_notes; ?></td>
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
 

mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error()); 
  

mysql_query("DELETE FROM orders WHERE `session_id` = '$order_id'");  
?>
</body>
</html>