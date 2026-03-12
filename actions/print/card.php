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
<img src="../../img/<?php echo $logo;?>" style="width:150px" height="150px"/></br>
<h2><?php echo $store;?> </h2>
</center>
<table border="0" width="95%">
<tr>
 <td align = 'center'><?php echo $lang_36;?>
 </td>
</tr><tr>
 <td align = 'center'> <p> <?php echo $phone;?>   </p>

 </td>
</tr><tr>
 <td align = 'center'> <p> <?php echo $facebook;?> / <img src="../../img/app/social/facebook.png" width= "20" height="20"/>  </p>

 </td>
</tr>
</table>

 </body>
 </html>