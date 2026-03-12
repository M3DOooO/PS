<?php session_start();
if( !isset($_SESSION['ps_user']) )
{
	include('login.php');
	die();
}

include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}$id = $_GET['id']; $order_id=$_GET['Receipt'];		
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
			$store = $row['store'];
			$phone = $row['phone'];
			$facebook = $row['facebook'];
		} 
		mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `reports2` WHERE `session_id` = '$order_id'");
while($row = mysql_fetch_array($result))
{
	$casheer = $row['casheer'];
}
		
 ?>
<html>
<head>
<style>
 @font-face {
    font-family: "DroidArabicKufiRegular";
    src: url(fonts/DroidKufi/DroidKufi-Bold.ttf) format("truetype");
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
 </center>
 <?php 
 //$id = $_GET['Receipt'];
 mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$sql="SELECT * FROM `devices` where `id` = $id";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
{
	$xname= $row['Device Name'];
	$xID= $row['ID'];
}
 ?>
<table border="1" width="95%">
<tr>
<td align = 'center'><b><?php echo $lang_62;?></b></td>
<td align = 'center'><?php  echo $xname; ?></td>
</tr>
 
</table>
 <table border="1" width="95%">
<tr>
<th><?php echo $lang_179;?></th>
 <th><?php echo $lang_180;?></th>
 </tr>
<?php 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(num),SUM(price) FROM `ps_orders` where `session_id` = '$order_id' AND `status` = 'no' GROUP BY name");
while($row = mysql_fetch_array($result))
{

	?>  <tr><td align='center'><?php  echo $row['name']; ?></td>
 		<td align='center' align = 'left'><?php  echo $row['SUM(num)']; ?></td>
 
		</tr>
	<?php 
} ?>
	</table>    
<p style="font-size: 10px;">تاريخ الطباعة: <?php echo date("d-m-Y h:i:s A");?></p>
</body>
</html>