<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	echo "<script>location='../../devices.php'</script>";
	    die();
}
 
include('../../includes/config.php');
if($lang == 'en'){include('../../languages/en.php');}else if($lang == 'ar'){include('../../languages/ar.php');}
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
 $ps = $_POST['ps'];
 if(isset($ps))
{
 
$sql="SELECT * FROM devices where ID = $ps";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
  {
	     $single = $row['single'];
		 $multi = $row['multi'];
		 $multi6 = $row['multi6'];
		 $multi7 = $row['multi7']; 
  }
    $money = $_POST['money'];
   	$x = (($money / $single)*60*60);
   	$x1 = (($money / $multi)*60*60);
   	$x3 = (($money / $multi6)*60*60);
   	$x4 = (($money / $multi7)*60*60);
    
	$time = gmdate("H:i:s", $x);
	$time1 = gmdate("H:i:s", $x1);
	$time3 = gmdate("H:i:s", $x3);
	$time4 = gmdate("H:i:s", $x4);
}
?>
  <html>
  <head>
  <link href="../../css/bootstrap-responsive.css" rel="stylesheet">
  <link id="bs-css" href="../../css/bootstrap-cerulean.css" rel="stylesheet">

  </head>
 <body bgcolor="#5C7AD2">
 <form action = "calc.php" method="post">
 <center>
 <br/>
<?php echo $lang_23;?>:&nbsp;<input type="number" step="0.1" min="0" name="money" autofocus /> 
<select name="ps">
 <?php // To connect to the database

$sql="SELECT * FROM devices";
$resulty=mysql_query($sql);
while($row = mysql_fetch_array($resulty))
  {
	  ?>
<option value='<?php echo $row['ID'];?>'><?php  echo $row['Device Name']; ?></option>
  <?php  }?>
</select>

<button class="btn btn-success"><?php echo $lang_45;?></button><br/></center>
</form>
<table border="1" width="95%">
<tr><td align="center"><?php echo $lang_3;?> </td><td><?php echo $time;?></td></tr>
<tr><td align="center"><?php echo $lang_4;?> </td><td><?php echo $time1;?></td></tr>
<tr><td align="center"><?php echo $lang_6;?> </td><td><?php echo $time3;?></td></tr>
<tr><td align="center"><?php echo $lang_7;?> </td><td><?php echo $time4;?></td></tr>
 
</table>
 </body>
 </html>