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
 $sess = $_GET['sess'];

 
 $sql="SELECT * FROM `reservation` WHERE `session` = '$sess'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
  {
  $id = $row['id'];
   $odate = $row['date'];
 $otime = $row['time'];
 $mobile = $row['mobile'];
 $type = $row['num'];
 $hagz = $row['money'];
 $type2 = $row['type'];
  }
  $name = $_GET['name'];
  $money = $_GET['money'];
  $calc_serv = $_GET['serv'];
  $calc_tax = $_GET['tax'];

  mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
 $sql="SELECT * FROM `reservation_type` WHERE `type` = '$type2'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
  {
	 $monasba = $row['money']; 
  }
  
  
  
    	mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
	mysql_select_db("$db") or die(mysql_error()); 
	$sql="SELECT * FROM config";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
		{
			$logo = $row['logo'];
			$store = $row['store'];
			$phone = $row['phone'];
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
	  font-size: 13px;
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
<center>
<img src="../../img/<?php echo $logo;?>" style="width:150px" height="150px"/>
<h3><?php echo $store;?></h3>
</center>
<table border="1" width="95%">
<tr>
<td align = 'center'><b><?php echo $lang_250;?></b></td>
<td align = 'center'><?php  echo $sess; ?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_77;?></b></td>
<td align = 'center'><?php  echo $odate; ?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_78;?></b></td>
<td align = 'center'><?php  echo $otime; ?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_21;?></b></td>
<td align = 'center'><?php  echo $name; ?></td>
</tr><tr>
<td align = 'center'><b>المناسبة</b></td>
<td align = 'center'><?php  echo $type2; ?></td>
</tr>

<tr>
<td align = 'center'><b>عدد الحضور</b></td>
<td align = 'center'><?php  echo $type; ?></td>
</tr>
 <tr>
<td align = 'center'><b>تكلفة المناسبة</b></td>
<td align = 'center'><?php  echo $monasba; ?></td>
</tr>
<tr>
<td align = 'center'><b>مبلغ الحجز</b></td>
<td align = 'center'><?php  echo $hagz; ?></td>
</tr>
<?php 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `ps_orders` WHERE session_id = '$sess'");
while($rowe = mysql_fetch_array($result))
{
	$sub_cat = $rowe['sub_cat'];
	$o_name = $rowe['name'];
	$o_num = $rowe['num'];
	$o_price = $rowe['price'];
	$o_id = $rowe['order_id'];
} 

?>

</table>
 <?php  if(isset($sub_cat))
{
	?>
 <table border="1" width="95%">

	<tr><td align='center'>الصنف</td>
		<td align='center'>سعر الصنف</td>
		<td align='center' align = 'left'>الكمية</td>
		<td align='center'>الإجمالي</td>

		</tr>
	<?php 
	mysql_connect("$host", "$user", "$pass")or die("cannot connect");
	mysql_select_db("$db")or die("cannot select DB");
	$result = mysql_query("SELECT *,SUM(num),SUM(price) FROM `ps_orders` WHERE session_id = '$sess' GROUP BY name");
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
	}?>
 </table>
<?php 
}else{$Orders_total = 0;}

 ?>
 <table border="1" width="95%">

 <?php if($calc_serv > 0){
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
 <tr>
<td align = 'center'><b>المتبقي</b></td>
<td align = 'center'><?php  echo $money+$calc_serv+$calc_tax; ?></td>
    <td>جنية</td>
</tr>
 <tr>
 	<td><b>الإجمالي</b></td>
    <td><?php echo $Orders_total +$hagz + $money+$calc_serv+$calc_tax; ?></td>
    <td>جنية</td>
 </tr>
 
 
 
 </table>
 <br/>
 <table border="1" width="95%">

 <tr>
 	<td><b><?php echo $lang_183;?></b></td>
    <td><?php echo $phone; ?></td>
 </tr>
 <tr>
	<td><b><font size="3"> <?php echo $lang_184;?> </b></td>
	<td><font size="4"><?php echo $facebook;?> </font>  / <img src="../../img/app/social/facebook.png" width= "20" height="20"/></font></td>
</tr>	
</table>


 </body>
 </html>