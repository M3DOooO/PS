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
  $wireless = $row['wireless'];
  $store = $row['store'];
  $logo = $row['logo'];
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
  </style>
  </head>
 <body <?php if($printornot == 'yes'){?>onload="window.print()"<?php }?>>
 <center>
<img src="../../img/<?php echo $logo;?>" style="width:150px" height="150px"/></br>
<center><?php  echo $store;?></center> 
</center>
<table border="0" width="95%">
 
<tr>
 <td align = 'center'><?php echo $lang_189;?></td>
</tr>
<tr>
 <td align = 'center'><h2><?php  echo $wireless;?></h2></td>
</tr>
</table>
  
  
 </body>
 </html>