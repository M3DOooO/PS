<?php
require_once dirname(__DIR__, 2) . '/includes/mysql_compat.php';

$DBHOST = getenv('TOUR_DB_HOST') ?: getenv('DB_HOST') ?: 'localhost'; // mysql host name
$DBUSER = getenv('TOUR_DB_USER') ?: getenv('DB_USER') ?: 'psxeqwgl_toot'; // database username
$DBPASS = getenv('TOUR_DB_PASS') ?: getenv('DB_PASS') ?: 'Midos2010@'; // database password
$DBNAME = getenv('TOUR_DB_NAME') ?: 'brac'; // database name

//Connect to mysql
mysql_connect($DBHOST, $DBUSER, $DBPASS) or die(mysql_error());
//Connect to database
mysql_select_db($DBNAME) or die(mysql_error());
?>

<html>
<head>
<title>jQuery Tournament Brackets</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.bracket.js"></script>
<script type="text/javascript" src="js/jquery.json-2.3.min.js"></script>

<?php 
$tidParam = isset($_GET['tid']) ? (int) $_GET['tid'] : 0;
$isAdminMode = (isset($_GET['secretMode']) && $_GET['secretMode'] === 'inlanadminmode');

if($tidParam > 0)
{
  $q = "SELECT * FROM lan_brackets WHERE tid = " . $tidParam;
  $r = mysql_query($q) or die(mysql_error());
  $data = mysql_fetch_assoc($r);
  $json = $data['json'];
  if(!empty($json))
    echo '<script type="text/javascript">var autoCompleteData = '.$json.'</script>';
  else
    echo '<script type="text/javascript">var autoCompleteData = {
    teams : [["Devon", ""],["", ""]], results : []}</script>';
}
else
    echo '<script type="text/javascript">var autoCompleteData = {
    teams : [["Devon", ""],["", ""]], results : []}</script>';



if($isAdminMode)
{ ?>
<script type="text/javascript" src="js/brackets.js"></script>
<?php }
else
{ ?>
<script type="text/javascript" src="js/brackets-rd.js"></script>
<?php } ?>




<link rel="stylesheet" type="text/css" href="css/jquery.bracket.css" />
</head>
<body>

<?php
if($isAdminMode)
{
$q = "SELECT * FROM lan_tournaments";
$r = mysql_query($q) or die(mysql_error());
while($data = mysql_fetch_assoc($r))
{
  echo '<a href="brackets.php?secretMode=inlanadminmode&tid='.$data['id'].'">'.$data['name'].'</a><br />';
}
}
?>


<div id="autoComplete"></div>
<?php

if(isset($_POST['data']) && $tidParam !== 0 && $isAdminMode)
{
  $tid = $tidParam;
  $json = $_POST['data'];
  
  $q = "SELECT * FROM lan_brackets WHERE tid = " . $tid;
  $r = mysql_query($q) or die(mysql_error());
  
  if(mysql_num_rows($r) == 0)
    $q = "INSERT INTO lan_brackets (tid, json)
          VALUES ('".$tid."', '".$json."')";
  else
    $q = "UPDATE lan_brackets SET json = '".$json."' WHERE tid = " . $tid;
    
  $r = mysql_query($q) or die(mysql_error());
}

?>

</body>
</html>
