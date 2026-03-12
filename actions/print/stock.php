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

$id = $_GET['id']; $order_id=$_GET['Receipt'];		
$Month = idate('m');
$Year = idate('Y');
$Day = idate('d'); 
$Hour = idate('H'); 
$Minute = idate('i'); 
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
 تقرير بكميات الأصناف
 </center>
 <?php }?>
  

 <table border="1" width="95%">
<tr>
<th>الصنف</th>
<th>الكمية</th>
  </tr>
<?php 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE name!='' GROUP BY name");
while($row = mysql_fetch_array($result))
{

	?>  <tr><td align='center'><?php  echo $row['name']; ?></td>
		<td align='center'><?php  echo $row['SUM(stock)']-$row['SUM(sold)']; ?></td>
 
		</tr>
	<?php 
}
 ?> 
	</table>   
  	 
<br/>
 
<p style="font-size: 10px;">تاريخ الطباعة: <?php echo date("d-m-Y h:i:s A");?></p>

 
</body>
</html>