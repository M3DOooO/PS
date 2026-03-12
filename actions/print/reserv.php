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
 

$id = $_GET['id']; // To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
 $sql="SELECT * FROM reservation ORDER BY id DESC LIMIT 1";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
  {
  $id = $row['id'];
   $odate = $row['date'];
 $otime = $row['time'];
 $name = $row['name'];
 $mobile = $row['mobile'];
 $type = $row['type'];
 $money = $row['money'];
  }
 // $name = $_GET['name'];
 // $mobile = $_GET['mobile'];
 // $type = $_GET['type'];
 // $money = $_GET['money'];

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
<td align = 'center'><?php  echo $id; ?></td>
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
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_79;?></b></td>
<td align = 'center'><?php  echo $mobile; ?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_80;?></b></td>
<td align = 'center'><?php  echo $type; ?></td>
</tr>
<tr>
<td align = 'center'><b><?php echo $lang_81;?></b></td>
<td align = 'center'><?php  echo $money; ?></td>
</tr>

</table>
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