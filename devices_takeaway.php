<?php
if (function_exists('session_status')) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
} elseif (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['ps_user'])) {
    include('login.php');
    die();
}

include('includes/config.php');
if ($lang == 'en') {
    include('languages/en.php');
} else if ($lang == 'ar') {
    include('languages/ar.php');
}

$id = isset($_GET['id']) ? $_GET['id'] : '';

function getSession($tadd_item)
{
    include('includes/config.php');

    mysql_connect("$host", "$user", "$pass") or die(mysql_error());
    mysql_select_db("$db") or die(mysql_error());

    $sql = "SELECT * FROM orders WHERE `ornum` = '$tadd_item'";
    $result = mysql_query($sql);

    $current_session = null;
    while ($row = mysql_fetch_array($result)) {
        $current_session = $row['session_id'];
    }

    if (isset($current_session) && $current_session !== '') {
        $session_id = $current_session;
    } else {
        mysql_connect("$host", "$user", "$pass") or die(mysql_error());
        mysql_select_db("$db") or die(mysql_error());

        mysql_query("SELECT GET_LOCK('reports2_session_id_lock', 5)");
        $sql = "SELECT MAX(session_id) AS max_session FROM reports2";
        $result = mysql_query($sql);

        $last_session = null;
        while ($row = mysql_fetch_array($result)) {
            $last_session = $row['max_session'];
        }

        if (!isset($last_session) || $last_session === '' || $last_session === null) {
            $session_id = 1;
        } else {
            $session_id = $last_session + 1;
        }
        mysql_query("SELECT RELEASE_LOCK('reports2_session_id_lock')");
    }

    return $session_id;
}

// Current Cashier
$casheer = $_SESSION['ps_user'];
$Hour = idate('H');

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

// Getting data to delete item from order
$delete_oid   = isset($_GET['oid']) ? $_GET['oid'] : null;
$delete_name  = isset($_GET['oname']) ? $_GET['oname'] : null;
$delete_num   = isset($_GET['onum']) ? $_GET['onum'] : 0;
$delete_sess  = isset($_GET['osess']) ? $_GET['osess'] : null;

// Deleting Item from order
if (isset($delete_oid))
{
    mysql_connect("$host", "$user", "$pass") or die(mysql_error());
    mysql_select_db("$db") or die(mysql_error());

    mysql_query("DELETE FROM orders WHERE session_id = '$delete_sess' AND name = '$delete_name'");
    mysql_query("DELETE FROM reports2 WHERE `session_id` = '$delete_sess' AND `name` = '$delete_name'");

    mysql_connect("$host", "$user", "$pass") or die("cannot connect");
    mysql_select_db("$db") or die("cannot select DB");
    $result = mysql_query("SELECT *, MIN(date) FROM `stock` WHERE name = '$delete_name' AND (stock > sold)");

    $md = null;
    while ($row = mysql_fetch_array($result)) {
        $md = $row['MIN(date)'];
    }

    mysql_connect("$host", "$user", "$pass") or die("cannot connect");
    mysql_select_db("$db") or die("cannot select DB");
    $result = mysql_query("SELECT * FROM `stock` WHERE `name` = '$delete_name' AND date = '$md'");

    $hhh = 0;
    while ($row = mysql_fetch_array($result)) {
        $hhh = $row['sold'];
    }

    $nono = $hhh - $delete_num;
    mysql_query("UPDATE `stock` SET `sold` = '$nono' WHERE `name` = '$delete_name' AND date = '$md'");

    mysql_connect("$host", "$user", "$pass") or die("cannot connect");
    mysql_select_db("$db") or die("cannot select DB");
    $result = mysql_query("SELECT * FROM `recipe` WHERE item = '$delete_name'");

    while ($row = mysql_fetch_array($result))
    {
        $s_ing = $row['ing_name'];

        $resultt = mysql_query("SELECT MIN(date) FROM `ingredients` WHERE name = '$s_ing' AND (stock > sold)");
        $mmd = null;
        while ($roww = mysql_fetch_array($resultt)) {
            $mmd = $roww['MIN(date)'];
        }

        $resultt = mysql_query("SELECT * FROM `ingredients` WHERE name = '$s_ing' AND date = '$mmd'");
        $o_out = 0;
        $o_in = 0;
        $o_total = 0;

        while ($roww = mysql_fetch_array($resultt)) {
            $o_out = $roww['sold'];
            $o_in = $roww['stock'];
            $o_total = $o_in - $o_out;
        }

        $s_qty = $o_out - ($row['ing_qty'] * $delete_num);
        mysql_query("UPDATE `ingredients` SET `sold` = '$s_qty' WHERE `name` = '$s_ing' AND `date` = '$mmd'");

        $s_avl = $row['ing_avl'];
        $s_last = $s_avl + ($row['ing_qty'] * $delete_num);
        mysql_query("UPDATE `recipe` SET `ing_avl` = '$s_last' WHERE `ing_name` = '$s_ing'");
    }
}

$notes = isset($_POST['notes']) ? $_POST['notes'] : null;
$notes_session = isset($_POST['notes_session']) ? $_POST['notes_session'] : null;

if ($notes == 'yes')
{
    $or1_note = isset($_POST['or1_note']) ? $_POST['or1_note'] : null;
    $or2_note = isset($_POST['or2_note']) ? $_POST['or2_note'] : null;
    $or3_note = isset($_POST['or3_note']) ? $_POST['or3_note'] : null;

    if (isset($or1_note))
    {
        mysql_connect("$host", "$user", "$pass") or die("cannot connect");
        mysql_select_db("$db") or die("cannot select DB");
        mysql_query("UPDATE `orders` SET `notes` = '$or1_note' WHERE `ornum` = 'or1'");
        mysql_query("UPDATE `reports2` SET `order_notes` = '$or1_note' WHERE `ornum` = 'or1' AND `session_id` = '$notes_session'");
    }

    if (isset($or2_note))
    {
        mysql_connect("$host", "$user", "$pass") or die("cannot connect");
        mysql_select_db("$db") or die("cannot select DB");
        mysql_query("UPDATE `orders` SET `notes` = '$or2_note' WHERE `ornum` = 'or2'");
        mysql_query("UPDATE `reports2` SET `order_notes` = '$or2_note' WHERE `ornum` = 'or2' AND `session_id` = '$notes_session'");
    }

    if (isset($or3_note))
    {
        mysql_connect("$host", "$user", "$pass") or die("cannot connect");
        mysql_select_db("$db") or die("cannot select DB");
        mysql_query("UPDATE `orders` SET `notes` = '$or3_note' WHERE `ornum` = 'or3'");
        mysql_query("UPDATE `reports2` SET `order_notes` = '$or3_note' WHERE `ornum` = 'or3' AND `session_id` = '$notes_session'");
    }
}

$disdis = isset($_GET['dis']) ? $_GET['dis'] : null;
$dis_n = isset($_POST['discount_value']) ? $_POST['discount_value'] : 0;
$dis_n2 = isset($_POST['discount_value2']) ? $_POST['discount_value2'] : 0;
$dis_r = isset($_POST['discount_reason']) ? $_POST['discount_reason'] : '';
$dis_s = isset($_GET['dsess']) ? $_GET['dsess'] : null;

if (isset($disdis))
{
    if ($dis_n > 0) {
        $dis_x = $dis_n;
        mysql_connect("$host", "$user", "$pass") or die(mysql_error());
        mysql_select_db("$db") or die(mysql_error());
        mysql_query("UPDATE `orders` SET `discount` = '$dis_x' WHERE `session_id` = '$dis_s' LIMIT 1");
        mysql_query("UPDATE `reports2` SET `discount` = '$dis_x' WHERE `session_id` = '$dis_s' LIMIT 1");
        mysql_query("UPDATE `reports2` SET `dis_reason` = '$dis_r' WHERE `session_id` = '$dis_s'");
    }
    else if ($dis_n2 > 0) {
        $dis_x = $dis_n2;
        mysql_connect("$host", "$user", "$pass") or die(mysql_error());
        mysql_select_db("$db") or die(mysql_error());
        mysql_query("UPDATE `orders` SET `discount2` = '$dis_x' WHERE `session_id` = '$dis_s' LIMIT 1");
        mysql_query("UPDATE `reports2` SET `discount2` = '$dis_x' WHERE `session_id` = '$dis_s' LIMIT 1");
        mysql_query("UPDATE `reports2` SET `dis_reason` = '$dis_r' WHERE `session_id` = '$dis_s'");
    }
}

$del_dis = isset($_GET['del_dis']) ? $_GET['del_dis'] : null;
$del_dsess = isset($_GET['del_dsess']) ? $_GET['del_dsess'] : null;

if ($del_dis == 'yes')
{
    mysql_connect("$host", "$user", "$pass") or die(mysql_error());
    mysql_select_db("$db") or die(mysql_error());
    mysql_query("UPDATE `orders` SET `discount` = '0' WHERE `session_id` = '$del_dsess'");
    mysql_query("UPDATE `orders` SET `discount2` = '0' WHERE `session_id` = '$del_dsess'");
    mysql_query("UPDATE `reports2` SET `dis_reason` = '' WHERE `session_id` = '$del_dsess'");
    mysql_query("UPDATE `reports2` SET `discount` = '0' WHERE `session_id` = '$del_dsess'");
    mysql_query("UPDATE `reports2` SET `discount2` = '0' WHERE `session_id` = '$del_dsess'");
    mysql_query("UPDATE `reports2` SET `discount_amount` = '0' WHERE `session_id` = '$del_dsess'");
}

$page_font_family = "'DroidArabicKufiRegular','Droid Sans',Tahoma,sans-serif";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $lang_287;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $lang_1;?>">
	<meta name="author" content="Mohamed Gad">

	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
<style type="text/css">
body {
	padding-bottom: 40px;
	font-family: <?php echo $page_font_family; ?> !important;
}
.sidebar-nav {
padding: 9px 0;
}
input,
button,
select,
textarea,
label,
.btn,
.navbar,
.dropdown-menu {
    font-family: <?php echo $page_font_family; ?> !important;
}
body .modal {
    /* new custom width */
    width: 750px;
    /* must be half of the width, minus scrollbar on the left (30px) */
    margin-left: -390px;
}
</style>
	<style> 
input[type=number] {
    height: 30px;
    line-height: 30px;
    font-size: 16px;
    padding: 0 8px;
}
input[type=number]::-webkit-inner-spin-button { 
     cursor:pointer;
    display:block;
    width:8px;
    color: #333;
    text-align:center;
    position:relative;
	opacity: 1;
	
}

input[type=number]:hover::-webkit-inner-spin-button { 
    background: #eee url('img/arrows.png') no-repeat 50% 50%;  
    width: 14px;
    height: 14px;
    padding: 4px;
    position: relative;
    right: 4px;
    border-radius: 28px;
}
.stick{
	    position: -webkit-sticky; /* Safari */
    position: sticky;
    top: 0;
}
 
</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		<script type="text/javascript">
// Popup window code
function newPopupx(url) {
	popupWindow = window.open(
	url,'popUpWindow','height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
			popupWindow.focus();

	// window.open('devices_takeaway.php');
	setTimeout(function() { your_func(); }, 3000);
	window.open("devices_takeaway.php","_self");

	// window.close();


}
</script>
<script type="text/javascript">
// Popup window code
function newPopup2(url) {
	popupWindow = window.open(
	url,'popUpWindow','height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
	popupWindow.focus();
}
</script>
</head>

<body>
<!-- topbar starts -->
<?php include('includes/navbar.php');?>
<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
<!-- left menu starts -->
<?php include('includes/menu.php');?>
<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			
                             <!--<form style="margin-right:60px;" method="POST" action="devices_takeaway.php?Search=true"> 
							 <img src="img/bar.png" height="39" width="70"><input type = "text" name="Search_bar" autofocus />
							<button class="btn btn-primary"><?php //echo $lang_345 ?></button>
							 </form>-->
			 
   
			</br>
<div class="box span10">
				 <div class=" row-fluid ">
				 <?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE ornum ='or1'", $link);
	$num_rows = mysql_num_rows($result);
	if ($num_rows <= 0){ ?>
			 	<a href="#"  style="width:32%;" data-rel="tooltip" title="<?php echo $lang_410;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or1_all">	<span><img src="img/app/control/gen.png" height="35" /></span>
	<div><?php echo $lang_409;?></div>
	
 	<span class="notification"><?php echo $lang_410;?></span></a>
	<?php }else {
		$resultx = mysql_query("SELECT * FROM `orders` WHERE ornum ='or1'");
			 while($rowx = mysql_fetch_array($resultx))
  {
	  $search_sess1 = $rowx['session_id'];
  }
		?>
 	 <div style="width:32%;" data-rel="tooltip"   class="well span3 top-blockk" >	<span><a href="#" data-toggle="modal" data-target="#or1_all"><img src="img/app/control/gen-add.png" height="35" /></a></span>
	<div><?php echo $lang_411;?></div>
	<form method="POST" action="actions/takeaway/add.php"> 
 <?php 
$result = mysql_query("SELECT * FROM `stock` WHERE name!='' GROUP BY name having SUM(stock)-SUM(sold) >0");
?>
<datalist id="ttt">
<?php while($row = mysql_fetch_array($result))
  {
	  $sitem_id = $row['id'];
	  $sitem_ing = $row['ing'];
	  ?>
<option value="<?php echo $row['name'];?>">
 <?php }?></datalist>
<input list="ttt" name="item[0][namee]"  placeholder = "<?php echo $lang_405;?>" required="" autocomplete="off" style="width:160px"/>
<input type="number" name="item[0][num]" min="0" style="width:40px" placeholder="البحث عن أصناف" value="1"/>
<input type="hidden" name="ps_id" value="<?php echo $sitem_id;?>">
<input type="hidden" name="s" value="<?php echo $search_sess1;?>">
<input type="hidden" name="add_item" value="or1">
<input type="hidden" name="item[0][has_ing]" value="<?php echo $sitem_ing;?>">
<input type="hidden" name="item[0][id]" value="<?php echo $sitem_id;?>">
 

<td><button class="btn btn-success">+</button></td>
  </form>
  <a href="#" id="ddd1">اضافة خصم</a>
  <br/><a href="#" id="nnn1">اضافة ملاحظات</a>

  
  
  
  
  
  
  
  <table style="width:100%;" border="1">
	<thead>
	<tr>
<th><?php echo $lang_179;?></th>
<th><?php echo $lang_51;?></th>
<th><?php echo $lang_180;?></th>
<th><?php echo $lang_106;?></th>                                        
<th><?php echo $lang_167;?></th>                                        
	</tr>
	</thead>
	<tbody>
	<?php // To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(price),SUM(num) FROM `orders`  WHERE ornum ='or1' GROUP BY name");
			 while($row = mysql_fetch_array($result))
  {
$order_id = $row['order_id']; 
$order_name = $row['name']; 
$order_num = $row['SUM(num)']; 
$tt = $row['SUM(price)'];
     ?>
	<?php $session_id = getSession('or1');?>
<tr><td align='center'><?php  echo $row['name']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']/$row['SUM(num)']; ?></td>
		<td align='center' align = 'left'><?php  echo $row['SUM(num)']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']; ?></td>
		<td align='center'><a  onclick="return confirm('<?php echo $lang_244;?>')" class="btn btn-danger" href="devices_takeaway.php?oid=<?php  echo $order_id;?>&&oname=<?php echo $order_name; ?>&&onum=<?php echo $order_num; ?>&&osess=<?php echo $session_id?>&&ornum=1" ><?php echo $lang_167;?></a></td>
  </tr>
  <?php 
}
$query = "SELECT  SUM(price),SUM(discount),SUM(discount2) FROM orders WHERE ornum ='or1'"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
	$dis=$row['SUM(discount)'];
$dis2=$row['SUM(discount2)'];
  $totalx = $row['SUM(price)'];

 if($usern   >=0 )
{
 if($dis ==0&&$dis2==0){

   ?>
		<tr  id="dis1" style="display:none;">
		<form method="POST" action="devices_takeaway.php?dsess=<?php echo $search_sess1;?>&dis=true"> 
		<td><?php echo $lang_182;?>: </td>
		<td colspan="4">
			<div class="controls">
				<div class="input-append">
				{
					<input id="appendedInput" size="12" type="number"  name="discount_value" max="100" min="1" placeholder="<?php echo $lang_364;?>"><span class="add-on">%</span><br/>
					<?php echo $lang_347;?><br/>
					<input id="appendedInput" size="12" type="number" placeholder="<?php echo $lang_23;?>" name="discount_value2" min="1" max="<?php echo $row['SUM(price)'];?>"><span class="add-on"><?php echo $lang_100;?></span>
				}	
					<input type="text" placeholder="<?php echo $lang_153;?>" name="discount_reason" required="" style="width:190px;"/>
					<br/>
					<button class="btn btn-success"><?php echo $lang_348;?></button>
				</div> 
			</div>
		<input name="diss_sess" value="<?php echo $search_sess1;?>" type="hidden"></form>
	
		</tr>
		<?php  }else{ ?>
<?php if($dis>0){
 
	?>
<tr>
<td colspan="1"> <?php echo $lang_182;?></td>
<td colspan="1"> <font color="red" ><?php  echo $dis;?></font> % </td>
<?php  $after_discount = $totalx - ($totalx * ($dis / 100)) ?>
   <td colspan="2">  (<font color="yellow" >
   <?php  $exact_discount = $totalx-$after_discount;
	echo $exact_discount;?> </font><?php echo $lang_100;?>)</td>
	<td><a href="devices_takeaway.php?del_dis=yes&del_dsess=<?php echo $search_sess1?>" onclick="return confirm('<?php echo $lang_244;?>')"><span class="btn-danger" style="font-size:12px;"><?php  echo $lang_167;?></span></a></td>
	 

</tr>
<?php 
$totalx = $totalx-$exact_discount;
}else if($dis2>0){
 	?>
<tr>
<td colspan="1"><?php echo $lang_182;?></td>
<td colspan="3"><font color="red" ><?php  echo $dis2;?></font> <?php echo $lang_100;?></td><td colspan=""> <?php  $after_discount = $tt - $dis2 ?><a href="devices_takeaway.php?del_dis=yes&del_dsess=<?php echo $search_sess1?>" onclick="return confirm('<?php echo $lang_244;?>')"><button class="btn btn-danger" style="margin:7px 0 0 0;padding:0px;"><?php  echo $lang_167;?></button></a></td>
</tr>
<?php 
$totalx = $row['SUM(price)']-$dis2;
}}}}
 unset($dis);unset($dis2);
 
  ?>
  <tr>
  <td colspan="1">الإجمالي</td>
  <td colspan="2"><?php echo $totalx;?> <?php echo $lang_100?></td>
    
  <td colspan="2"><a href="JavaScript:newPopupx('actions/print/takeaway.php?Receipt=<?php  echo $session_id;?>');"><img src="img/app/buttons/pay.png" width="150" height="50" /></a> </td>
  </tr>
<?php $query = "SELECT * FROM orders WHERE ornum ='or1' LIMIT 1"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
  ?>
  <form action="devices_takeaway.php" method="POST">
    <input type="hidden" name="notes" value="yes"/>
    <input type="hidden" name="notes_session" value="<?php echo $session_id?>"/>
<tr id="note1" style="display:none;"><td colspan="5"><textarea name="or1_note" placeholder="ملاحظات على الفاتورة"><?php echo $row['notes'];?></textarea><center><button class="input-group-addon btn btn-primary">حفظ الملاحظات</button></center></td></tr>
</form>
<?php }?>
	</tbody>
	</table>
  
   
 	<span class="notification"><?php echo $lang_410;?></span></div>
	<?php }?>
 			 
				 <?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE ornum ='or2'", $link);
	$num_rows = mysql_num_rows($result);
	if ($num_rows <= 0){ ?>
			 	<a href="#"  style="width:32%;" data-rel="tooltip" title="<?php echo $lang_410;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or2_all">	<span><img src="img/app/control/gen.png" height="35" /></span>
	<div><?php echo $lang_409;?></div>
	
 	<span class="notification"><?php echo $lang_410;?></span></a>
	<?php }else {
		$resultx = mysql_query("SELECT * FROM `orders` WHERE ornum ='or2'");
			 while($rowx = mysql_fetch_array($resultx))
  {
	  $search_sess2 = $rowx['session_id'];
  }
		?>
 	 <div style="width:32%;" data-rel="tooltip"   class="well span3 top-blockk" >	<span><a href="#" data-toggle="modal" data-target="#or2_all"><img src="img/app/control/gen-add.png" height="35" /></a></span>
	<div><?php echo $lang_411;?></div>
		<form method="POST" action="actions/takeaway/add.php"> 
 <?php 
$result = mysql_query("SELECT * FROM `stock` WHERE name!='' GROUP BY name having SUM(stock)-SUM(sold) >0");
?>
<datalist id="ttt">
<?php while($row = mysql_fetch_array($result))
  {
	  $sitem_id = $row['id'];
	  $sitem_ing = $row['ing'];
	  ?>
<option value="<?php echo $row['name'];?>">
 <?php }?></datalist>
<input list="ttt" name="item[0][namee]"  placeholder = "<?php echo $lang_405;?>" required="" autocomplete="off" style="width:160px"/>
<input type="number" name="item[0][num]" min="0" style="width:40px" placeholder="البحث عن أصناف" value="1"/>
<input type="hidden" name="ps_id" value="<?php echo $sitem_id;?>">
<input type="hidden" name="s" value="<?php echo $search_sess2;?>">
<input type="hidden" name="add_item" value="or2">
<input type="hidden" name="item[0][has_ing]" value="<?php echo $sitem_ing;?>">
<input type="hidden" name="item[0][id]" value="<?php echo $sitem_id;?>">
 

<td><button class="btn btn-success">+</button></td>
  <a href="#" id="ddd2">اضافة خصم</a>
    <br/><a href="#" id="nnn2">اضافة ملاحظات</a>


  </form>
<table style="width:100%;" border="1">
	<thead>
	<tr>
<th><?php echo $lang_179;?></th>
<th><?php echo $lang_51;?></th>
<th><?php echo $lang_180;?></th>
<th><?php echo $lang_106;?></th>                                        
<th><?php echo $lang_167;?></th>                                        
	</tr>
	</thead>
	<tbody>
	<?php // To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(price),SUM(num) FROM `orders`  WHERE ornum ='or2' GROUP BY name");
			 while($row = mysql_fetch_array($result))
  {
$order_id = $row['order_id']; 
$order_name = $row['name']; 
$order_num = $row['SUM(num)']; 
$tt2 = $row['SUM(price)'];
     ?>
	<?php $session_id = getSession('or2');?>
<tr><td align='center'><?php  echo $row['name']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']/$row['SUM(num)']; ?></td>
		<td align='center' align = 'left'><?php  echo $row['SUM(num)']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']; ?></td>
		<td align='center'><a  onclick="return confirm('<?php echo $lang_244;?>')" class="btn btn-danger" href="devices_takeaway.php?oid=<?php  echo $order_id;?>&&oname=<?php echo $order_name; ?>&&onum=<?php echo $order_num; ?>&&osess=<?php echo $session_id?>&&ornum=2" ><?php echo $lang_167;?></a></td>
  </tr>
  <?php 
}
$query = "SELECT  SUM(price),SUM(discount),SUM(discount2) FROM orders WHERE ornum ='or2'"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
	$dis=$row['SUM(discount)'];
$dis2=$row['SUM(discount2)'];
  $totalx2 = $row['SUM(price)'];

 if($usern   >=0 )
{
 if($dis ==0&&$dis2==0){

   ?>
		<tr  id="dis2" style="display:none;">
		<form method="POST" action="devices_takeaway.php?dsess=<?php echo $search_sess2;?>&dis=true"> 
		<td><?php echo $lang_182;?>: </td>
		<td colspan="4">
			<div class="controls">
				<div class="input-append">
				{
					<input id="appendedInput" size="12" type="number"  name="discount_value" max="100" min="1" placeholder="<?php echo $lang_364;?>"><span class="add-on">%</span><br/>
					<?php echo $lang_347;?><br/>
					<input id="appendedInput" size="12" type="number" placeholder="<?php echo $lang_23;?>" name="discount_value2" min="1" max="<?php echo $row['SUM(price)'];?>"><span class="add-on"><?php echo $lang_100;?></span>
				}	
					<input type="text" placeholder="<?php echo $lang_153;?>" name="discount_reason" required="" style="width:190px;"/>
					<br/>
					<button class="btn btn-success"><?php echo $lang_348;?></button>
				</div> 
			</div>
		<input name="diss_sess" value="<?php echo $search_sess2;?>" type="hidden"></form>
	
		</tr>
		<?php  }else{ ?>
<?php if($dis>0){
 
	?>
<tr>
<td colspan="1"> <?php echo $lang_182;?></td>
<td colspan="1"> <font color="red" ><?php  echo $dis;?></font> % </td>
<?php  $after_discount2 = $totalx2 - ($totalx2 * ($dis / 100)) ?>
   <td colspan="2">  (<font color="yellow" >
   <?php  $exact_discount2 = $totalx2-$after_discount2;
	echo $exact_discount2;?> </font><?php echo $lang_100;?>)</td>
	<td><a href="devices_takeaway.php?del_dis=yes&del_dsess=<?php echo $search_sess2?>" onclick="return confirm('<?php echo $lang_244;?>')"><span class="btn-danger" style="font-size:12px;"><?php  echo $lang_167;?></span></a></td>
	 

</tr>
<?php 
$totalx2 = $totalx2-$exact_discount2;
}else if($dis2>0){
 	?>
<tr>
<td colspan="1"><?php echo $lang_182;?></td>
<td colspan="3"><font color="red" ><?php  echo $dis2;?></font> <?php echo $lang_100;?></td><td colspan=""> <?php  $after_discount2 = $tt2 - $dis2 ?><a href="devices_takeaway.php?del_dis=yes&del_dsess=<?php echo $search_sess2?>" onclick="return confirm('<?php echo $lang_244;?>')"><button class="btn btn-danger" style="margin:7px 0 0 0;padding:0px;"><?php  echo $lang_167;?></button></a></td>
</tr>
<?php 
$totalx2 = $row['SUM(price)']-$dis2;
}}}}
 unset($dis);unset($dis2);
 
  ?>
  <tr>
  <td colspan="1">الإجمالي</td>
  <td colspan="2"><?php echo $totalx2;?> <?php echo $lang_100?></td>
    
  <td colspan="2"><a href="JavaScript:newPopupx('actions/print/takeaway.php?Receipt=<?php  echo $session_id;?>');"><img src="img/app/buttons/pay.png" width="150" height="50" /></a> </td>
  </tr>
<?php $query = "SELECT * FROM orders WHERE ornum ='or2' LIMIT 1"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
  ?>
  <form action="devices_takeaway.php" method="POST">
    <input type="hidden" name="notes" value="yes"/>
    <input type="hidden" name="notes_session" value="<?php echo $session_id?>"/>
<tr id="note2" style="display:none;"><td colspan="5"><textarea name="or2_note" placeholder="ملاحظات على الفاتورة"><?php echo $row['notes'];?></textarea><center><button class="input-group-addon btn btn-primary">حفظ الملاحظات</button></center></td></tr>
</form>
<?php }?>
	</tbody>
	</table>
 	<span class="notification"><?php echo $lang_410;?></span></div>
	<?php }?>
 
				 <?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE ornum ='or3'", $link);
	$num_rows = mysql_num_rows($result);
	if ($num_rows <= 0){ ?>
			 	<a href="#"  style="width:32%;" data-rel="tooltip" title="<?php echo $lang_410;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or3_all">	<span><img src="img/app/control/gen.png" height="35" /></span>
	<div><?php echo $lang_409;?></div>
	
 	<span class="notification"><?php echo $lang_410;?></span></a>
	<?php }else {
		$resultx = mysql_query("SELECT * FROM `orders` WHERE ornum ='or3'");
			 while($rowx = mysql_fetch_array($resultx))
  {
	  $search_sess3 = $rowx['session_id'];
  }
		?>
 	 <div style="width:32%;" data-rel="tooltip"  class="well span3 top-blockk" >	<span><a href="#" data-toggle="modal" data-target="#or3_all"><img src="img/app/control/gen-add.png" height="35" /></a></span>
	<div><?php echo $lang_411;?></div>
		<form method="POST" action="actions/takeaway/add.php"> 
 <?php 
$result = mysql_query("SELECT * FROM `stock` WHERE name!='' GROUP BY name having SUM(stock)-SUM(sold) >0");
?>
<datalist id="ttt">
<?php while($row = mysql_fetch_array($result))
  {
	  $sitem_id = $row['id'];
	  $sitem_ing = $row['ing'];
	  ?>
<option value="<?php echo $row['name'];?>">
 <?php }?></datalist>
<input list="ttt" name="item[0][namee]"  placeholder = "<?php echo $lang_405;?>" required="" autocomplete="off" style="width:160px"/>
<input type="number" name="item[0][num]" min="0" style="width:40px" placeholder="البحث عن أصناف" value="1"/>
<input type="hidden" name="ps_id" value="<?php echo $sitem_id;?>">
<input type="hidden" name="s" value="<?php echo $search_sess3;?>">
<input type="hidden" name="add_item" value="or3">
<input type="hidden" name="item[0][has_ing]" value="<?php echo $sitem_ing;?>">
<input type="hidden" name="item[0][id]" value="<?php echo $sitem_id;?>">
 

<td><button class="btn btn-success">+</button></td>
  <a href="#" id="ddd3">اضافة خصم</a>
  <br/><a href="#" id="nnn3">اضافة ملاحظات</a>

  </form>
  
  
  
  
  
  <table style="width:100%;" border="1">
	<thead>
	<tr>
<th><?php echo $lang_179;?></th>
<th><?php echo $lang_51;?></th>
<th><?php echo $lang_180;?></th>
<th><?php echo $lang_106;?></th>                                        
<th><?php echo $lang_167;?></th>                                        
	</tr>
	</thead>
	<tbody>
	<?php // To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(price),SUM(num) FROM `orders`  WHERE ornum ='or3' GROUP BY name");
			 while($row = mysql_fetch_array($result))
  {
$order_id = $row['order_id']; 
$order_name = $row['name']; 
$order_num = $row['SUM(num)']; 
$tt3 = $row['SUM(price)'];
     ?>
	<?php $session_id = getSession('or3');?>
<tr><td align='center'><?php  echo $row['name']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']/$row['SUM(num)']; ?></td>
		<td align='center' align = 'left'><?php  echo $row['SUM(num)']; ?></td>
		<td align='center'><?php  echo $row['SUM(price)']; ?></td>
		<td align='center'><a  onclick="return confirm('<?php echo $lang_244;?>')" class="btn btn-danger" href="devices_takeaway.php?oid=<?php  echo $order_id;?>&&oname=<?php echo $order_name; ?>&&onum=<?php echo $order_num; ?>&&osess=<?php echo $session_id?>&&ornum=3" ><?php echo $lang_167;?></a></td>
  </tr>
  <?php 
}
$query = "SELECT  SUM(price),SUM(discount),SUM(discount2) FROM orders WHERE ornum ='or3'"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
	$dis=$row['SUM(discount)'];
$dis2=$row['SUM(discount2)'];
  $totalx3 = $row['SUM(price)'];

 if($usern   >=0 )
{
 if($dis ==0&&$dis2==0){

   ?>
		<tr  id="dis3" style="display:none;">
		<form method="POST" action="devices_takeaway.php?dsess=<?php echo $search_sess3;?>&dis=true"> 
		<td><?php echo $lang_182;?>: </td>
		<td colspan="4">
			<div class="controls">
				<div class="input-append">
				{
					<input id="appendedInput" size="12" type="number"  name="discount_value" max="100" min="1" placeholder="<?php echo $lang_364;?>"><span class="add-on">%</span><br/>
					<?php echo $lang_347;?><br/>
					<input id="appendedInput" size="12" type="number" placeholder="<?php echo $lang_23;?>" name="discount_value2" min="1" max="<?php echo $row['SUM(price)'];?>"><span class="add-on"><?php echo $lang_100;?></span>
				}	
					<input type="text" placeholder="<?php echo $lang_153;?>" name="discount_reason" required="" style="width:190px;"/>
					<br/>
					<button class="btn btn-success"><?php echo $lang_348;?></button>
				</div> 
			</div>
		<input name="diss_sess" value="<?php echo $search_sess3;?>" type="hidden"></form>
	
		</tr>
		<?php  }else{ ?>
<?php if($dis>0){
 
	?>
<tr>
<td colspan="1"> <?php echo $lang_182;?></td>
<td colspan="1"> <font color="red" ><?php  echo $dis;?></font> % </td>
<?php  $after_discount3 = $totalx3 - ($totalx3 * ($dis / 100)) ?>
   <td colspan="2">  (<font color="yellow" >
   <?php  $exact_discount3 = $totalx3-$after_discount3;
	echo $exact_discount3;?> </font><?php echo $lang_100;?>)</td>
	<td><a href="devices_takeaway.php?del_dis=yes&del_dsess=<?php echo $search_sess3?>" onclick="return confirm('<?php echo $lang_244;?>')"><span class="btn-danger" style="font-size:12px;"><?php  echo $lang_167;?></span></a></td>
	 

</tr>
<?php 
$totalx3 = $totalx3-$exact_discount3;
}else if($dis2>0){
 	?>
<tr>
<td colspan="1"><?php echo $lang_182;?></td>
<td colspan="3"><font color="red" ><?php  echo $dis2;?></font> <?php echo $lang_100;?></td><td colspan=""> <?php  $after_discount3 = $tt3 - $dis2 ?><a href="devices_takeaway.php?del_dis=yes&del_dsess=<?php echo $search_sess3?>" onclick="return confirm('<?php echo $lang_244;?>')"><button class="btn btn-danger" style="margin:7px 0 0 0;padding:0px;"><?php  echo $lang_167;?></button></a></td>
</tr>
<?php 
$totalx3 = $row['SUM(price)']-$dis2;
}}}}
 unset($dis);unset($dis2);
 
  ?>
  <tr>
  <td colspan="1">الإجمالي</td>
  <td colspan="2"><?php echo $totalx3;?> <?php echo $lang_100?></td>
    
  <td colspan="2"><a href="JavaScript:newPopupx('actions/print/takeaway.php?Receipt=<?php  echo $session_id;?>');"><img src="img/app/buttons/pay.png" width="150" height="50" /></a> </td>
  </tr>
<?php $query = "SELECT * FROM orders WHERE ornum ='or3' LIMIT 1"; 
$resulty = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($resulty)){
  ?>
  <form action="devices_takeaway.php" method="POST">
    <input type="hidden" name="notes" value="yes"/>
    <input type="hidden" name="notes_session" value="<?php echo $session_id?>"/>
<tr id="note3" style="display:none;"><td colspan="5"><textarea name="or3_note" placeholder="ملاحظات على الفاتورة"><?php echo $row['notes'];?></textarea><center><button class="input-group-addon btn btn-primary">حفظ الملاحظات</button></center></td></tr>
</form>
<?php }?>
	</tbody>
	</table>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

 	<span class="notification"><?php echo $lang_410;?></span></div>
	<?php }?>	
</div>
</div>
 
			
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="or1_all">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_325;?></h3>
</div>
<div class="modal-body">
 <center>
<h3><?php //echo $lang_133;?></h3>
<br/>
<div class="sortable row-fluid ">
			 	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_317;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or1_drinks">	<span><img src="img/app/control/drinks.png" height="35" /></span>
	<div><?php echo $lang_316;?></div>
	<span class="notification"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'drinks' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span></a>

	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_319;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or1_food">
	<span><img src="img/app/control/food.png" height="35" /></span>
	<div><?php echo $lang_320;?></div>
	<span class="notification yellow"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'food' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span>
	</a>
	
	
	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_321;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or1_choc">
	<span><img src="img/app/control/choc.png" height="35" /></span>
	<div><?php echo $lang_322;?></div>
	<span class="notification red"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'choc' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span>
	</a>
	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_323;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or1_gen">
	<span><img src="img/app/control/gen.png" height="35" /></span>
	<div><?php echo $lang_324;?></div>
	<span class="notification red"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'general' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span>
	</a> 
			</div>
</center>
</div>
</div>
<div class="modal hide fade" id="or2_all">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_325;?></h3>
</div>
<div class="modal-body">
 <center>
<h3><?php //echo $lang_133;?></h3>
<br/>
<div class="sortable row-fluid ">
			 	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_317;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or2_drinks">	<span><img src="img/app/control/drinks.png" height="35" /></span>
	<div><?php echo $lang_316;?></div>
	<span class="notification"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'drinks' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span></a>

	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_319;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or2_food">
	<span><img src="img/app/control/food.png" height="35" /></span>
	<div><?php echo $lang_320;?></div>
	<span class="notification yellow"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'food' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span>
	</a>
	
	
	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_321;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or2_choc">
	<span><img src="img/app/control/choc.png" height="35" /></span>
	<div><?php echo $lang_322;?></div>
	<span class="notification red"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'choc' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span>
	</a>
	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_323;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or2_gen">
	<span><img src="img/app/control/gen.png" height="35" /></span>
	<div><?php echo $lang_324;?></div>
	<span class="notification red"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'general' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span>
	</a> 
			</div>
</center>
</div>
</div>
<div class="modal hide fade" id="or3_all">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_325;?></h3>
</div>
<div class="modal-body">
 <center>
<h3><?php //echo $lang_133;?></h3>
<br/>
<div class="sortable row-fluid ">
			 	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_317;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or3_drinks">	<span><img src="img/app/control/drinks.png" height="35" /></span>
	<div><?php echo $lang_316;?></div>
	<span class="notification"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'drinks' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span></a>

	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_319;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or3_food">
	<span><img src="img/app/control/food.png" height="35" /></span>
	<div><?php echo $lang_320;?></div>
	<span class="notification yellow"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'food' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span>
	</a>
	
	
	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_321;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or3_choc">
	<span><img src="img/app/control/choc.png" height="35" /></span>
	<div><?php echo $lang_322;?></div>
	<span class="notification red"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'choc' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span>
	</a>
	<a href="#"  style="width:45%;" data-rel="tooltip" title="<?php echo $lang_323;?>" class="well span3 top-blockk" data-toggle="modal" data-target="#or3_gen">
	<span><img src="img/app/control/gen.png" height="35" /></span>
	<div><?php echo $lang_324;?></div>
	<span class="notification red"><?php
	$link = mysql_connect("$host", "$user", "$pass");
	mysql_select_db("$db", $link);
    $result = mysql_query("SELECT * FROM orders WHERE catagory = 'general' ", $link);
	$num_rows = mysql_num_rows($result);
	echo $num_rows;?> <?php echo $lang_318;?><?php 
	?></span>
	</a> 
			</div>
</center>
</div>
</div>
		
		
		
		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

<div class="modal hide fade" id="or1_drinks">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3>اختر الفئة الفرعية</h3>
</div>
<div class="modal-body">
 <center>
<h3><?php echo $lang_131;?></h3>
<br/>
 <div class="sortable row-fluid">
<?php 
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error());  
$sql="SELECT  * FROM stock WHERE catagory = 'drinks' GROUP BY sub_cat";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{ 
$sc = $row['sub_cat'];
$scimg = $row['img'];
?>  
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_takeaway.php?id=<?php echo $id;?>&&add_item=or1&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
<span><img src="img/<?php echo $scimg;?>" height="35" /></span>
<div><?php  echo $row['sub_cat'];?></div>
<span class="notification"><?php echo $lang_32;?></span>
</a>				
<?php }?>
</div>
</center>
</div>
</div>
<div class="modal hide fade" id="or2_drinks">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3>اختر الفئة الفرعية</h3>
</div>
<div class="modal-body">
 <center>
<h3><?php echo $lang_131;?></h3>
<br/>
 <div class="sortable row-fluid">
<?php 
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error());  
$sql="SELECT  * FROM stock WHERE catagory = 'drinks' GROUP BY sub_cat";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{ 
$sc = $row['sub_cat'];
$scimg = $row['img'];
?>  
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_takeaway.php?id=<?php echo $id;?>&&add_item=or2&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
<span><img src="img/<?php echo $scimg;?>" height="35" /></span>
<div><?php  echo $row['sub_cat'];?></div>
<span class="notification"><?php echo $lang_32;?></span>
</a>				
<?php }?>
</div>
</center>
</div>
</div>
<div class="modal hide fade" id="or3_drinks">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3>اختر الفئة الفرعية</h3>
</div>
<div class="modal-body">
 <center>
<h3><?php echo $lang_131;?></h3>
<br/>
 <div class="sortable row-fluid">
<?php 
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error());  
$sql="SELECT  * FROM stock WHERE catagory = 'drinks' GROUP BY sub_cat";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{ 
$sc = $row['sub_cat'];
$scimg = $row['img'];
?>  
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_takeaway.php?id=<?php echo $id;?>&&add_item=or3&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
<span><img src="img/<?php echo $scimg;?>" height="35" /></span>
<div><?php  echo $row['sub_cat'];?></div>
<span class="notification"><?php echo $lang_32;?></span>
</a>				
<?php }?>
</div>
</center>
</div>
</div>
<?php 
$add_item = $_GET['add_item'];
$acat = $_GET['acat'];
$asub_cat = $_GET['asub_cat'];
 if($add_item =='or1'){?><script type="text/javascript">$(window).load(function(){$('#or1_item').modal('show');});</script><?php } 
if($add_item =='or2'){?><script type="text/javascript">$(window).load(function(){$('#or2_item').modal('show');});</script><?php } 
if($add_item =='or3'){?><script type="text/javascript">$(window).load(function(){$('#or3_item').modal('show');});</script><?php }?>

<div class="modal hide fade" id="or1_item">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $asub_cat;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE catagory = '$acat' AND sub_cat = '$asub_cat' AND name !=' ' GROUP BY name ORDER BY name ASC");
?><thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
 </tr></thead><tbody>
<form action="actions/takeaway/add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<?php $session_id = getSession($add_item);?>
<input type="hidden" name="s" value="<?php echo $session_id;?>">
<input type="hidden" name="add_item" value="<?php echo $add_item;?>">

<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];

?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 

 if($row['ing'] == 'no')
  {
	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}

else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">

<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">

<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  

 $cc++;
}?>
<tr>
<td><button class="btn btn-success stick"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>
<div class="modal hide fade" id="or2_item">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $asub_cat;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE catagory = '$acat' AND sub_cat = '$asub_cat' AND name !=' ' GROUP BY name ORDER BY name ASC");
?><thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
 </tr></thead><tbody>
<form action="actions/takeaway/add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<?php $session_id = getSession($add_item);?>
<input type="hidden" name="s" value="<?php echo $session_id;?>">
<input type="hidden" name="add_item" value="<?php echo $add_item;?>">

<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];

?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 

 if($row['ing'] == 'no')
  {
	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}

else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">

<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">

<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  

 $cc++;
}?>
<tr>
<td><button class="btn btn-success stick"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>
<div class="modal hide fade" id="or3_item">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $asub_cat;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE catagory = '$acat' AND sub_cat = '$asub_cat' AND name !=' ' GROUP BY name ORDER BY name ASC");
?><thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
 </tr></thead><tbody>
<form action="actions/takeaway/add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<?php $session_id = getSession($add_item);?>
<input type="hidden" name="s" value="<?php echo $session_id;?>">
<input type="hidden" name="add_item" value="<?php echo $add_item;?>">

<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];

?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 

 if($row['ing'] == 'no')
  {
	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}

else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">

<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">

<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  

 $cc++;
}?>
<tr>
<td><button class="btn btn-success stick"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>

<div class="modal hide fade" id="or1_food">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_325;?></h3>
</div>
<div class="modal-body">
 <center>
<h3><?php echo $lang_133;?></h3>
<br/>
 <div class="sortable row-fluid">
<?php 
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error());  
$sql="SELECT  * FROM stock WHERE catagory = 'food' GROUP BY sub_cat";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{ 
$sc = $row['sub_cat'];
$scimg = $row['img'];
?>  
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_takeaway.php?id=<?php echo $id;?>&&add_item=or1&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
<span><img src="img/<?php echo $scimg;?>" height="35" /></span>
<div><?php  echo $row['sub_cat'];?></div>
<span class="notification"><?php echo $lang_32;?></span>
</a>				
<?php }?>
</div>
</center>
</div>
</div>
<div class="modal hide fade" id="or2_food">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_325;?></h3>
</div>
<div class="modal-body">
 <center>
<h3><?php echo $lang_133;?></h3>
<br/>
 <div class="sortable row-fluid">
<?php 
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error());  
$sql="SELECT  * FROM stock WHERE catagory = 'food' GROUP BY sub_cat";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{ 
$sc = $row['sub_cat'];
$scimg = $row['img'];
?>  
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_takeaway.php?id=<?php echo $id;?>&&add_item=or2&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
<span><img src="img/<?php echo $scimg;?>" height="35" /></span>
<div><?php  echo $row['sub_cat'];?></div>
<span class="notification"><?php echo $lang_32;?></span>
</a>				
<?php }?>
</div>
</center>
</div>
</div>
<div class="modal hide fade" id="or3_food">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_325;?></h3>
</div>
<div class="modal-body">
 <center>
<h3><?php echo $lang_133;?></h3>
<br/>
 <div class="sortable row-fluid">
<?php 
mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
mysql_select_db("$db") or die(mysql_error());  
$sql="SELECT  * FROM stock WHERE catagory = 'food' GROUP BY sub_cat";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{ 
$sc = $row['sub_cat'];
$scimg = $row['img'];
?>  
<a data-rel="tooltip" title="<?php echo $lang_205;?>" class="well span3 top-blockk" href="devices_takeaway.php?id=<?php echo $id;?>&&add_item=or3&&acat=<?php echo $row['catagory'];?>&&asub_cat=<?php echo $sc;?>">
<span><img src="img/<?php echo $scimg;?>" height="35" /></span>
<div><?php  echo $row['sub_cat'];?></div>
<span class="notification"><?php echo $lang_32;?></span>
</a>				
<?php }?>
</div>
</center>
</div>
</div>
 
 
<div class="modal hide fade" id="or1_gen">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $lang_111;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE `catagory` = 'general' AND `name` !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								   
</tr></thead><tbody>
<form action="actions/takeaway/add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<?php $session_id = getSession('or1');?>
<input type="hidden" name="s" value="<?php echo $session_id;?>">
<input type="hidden" name="add_item" value="or1">


<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];

?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 

 if($row['ing'] == 'no')
  {
	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}

else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">

<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">

<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  

 $cc++;
}?>
<tr>
<td><button class="btn btn-success stick"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>
<div class="modal hide fade" id="or2_gen">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $lang_111;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE `catagory` = 'general' AND `name` !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								   
</tr></thead><tbody>
<form action="actions/takeaway/add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<?php $session_id = getSession('or2');?>
<input type="hidden" name="s" value="<?php echo $session_id;?>">
<input type="hidden" name="add_item" value="or2">


<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];

?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 

 if($row['ing'] == 'no')
  {
	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}

else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">

<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">

<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  

 $cc++;
}?>
<tr>
<td><button class="btn btn-success stick"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>
<div class="modal hide fade" id="or3_gen">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $lang_111;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE `catagory` = 'general' AND `name` !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								   
</tr></thead><tbody>
<form action="actions/takeaway/add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<?php $session_id = getSession('or3');?>
<input type="hidden" name="s" value="<?php echo $session_id;?>">
<input type="hidden" name="add_item" value="or3">


<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];

?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 

 if($row['ing'] == 'no')
  {
	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}

else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">

<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">

<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  

 $cc++;
}?>
<tr>
<td><button class="btn btn-success stick"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>

<div class="modal hide fade" id="or1_choc">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $lang_328;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE catagory = 'choc' AND name !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								  
</tr></thead><tbody>
<form action="actions/takeaway/add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<?php $session_id = getSession('or1');?>
<input type="hidden" name="s" value="<?php echo $session_id;?>">
<input type="hidden" name="add_item" value="or1">


<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];

?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 

 if($row['ing'] == 'no')
  {
	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}

else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">

<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">

<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  

 $cc++;
}?>
<tr>
<td><button class="btn btn-success stick"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>
<div class="modal hide fade" id="or2_choc">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $lang_328;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE catagory = 'choc' AND name !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								  
</tr></thead><tbody>
<form action="actions/takeaway/add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<?php $session_id = getSession('or2');?>
<input type="hidden" name="s" value="<?php echo $session_id;?>">
<input type="hidden" name="add_item" value="or2">


<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];

?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 

 if($row['ing'] == 'no')
  {
	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}

else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">

<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">

<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  

 $cc++;
}?>
<tr>
<td><button class="btn btn-success stick"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>
<div class="modal hide fade" id="or3_choc">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"></button>
<h3><?php echo $lang_326;?></h3>
</div>
<div class="modal-body">
 <center>
 <h3><?php echo $lang_328;?></h3>
 <br/>
    <table class="table table-striped table-bordered">
<?php 								
include('includes/config.php');
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT *,SUM(stock),SUM(sold) FROM `stock` WHERE catagory = 'choc' AND name !=' ' GROUP BY name");?>
<thead><tr>
								  <th><?php echo $lang_21;?></th>
 								  <th><?php echo $lang_51;?></th>
								  <th><?php echo $lang_117;?></th>
								  <th><?php echo $lang_327;?></th>
								  
</tr></thead><tbody>
<form action="actions/takeaway/add.php" method="POST">
<input type="hidden" name="ps_id" value="<?php echo $id;?>">
<?php $session_id = getSession('or3');?>
<input type="hidden" name="s" value="<?php echo $session_id;?>">

<input type="hidden" name="add_item" value="or3">


<?php 
$cc = 0;
while($row = mysql_fetch_array($result))
{
$aaas =  $row['SUM(stock)'] - $row['SUM(sold)'];
$itna =  $row['name'];

?>
<input type="hidden" name="item[<?php echo $cc;?>][namee]" value="<?php echo $itna;?>">
<tr>
<td><a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i><?php  echo $row['name'];?></a></td>
<td><?php  echo $row['price'];?></td>
 <?php 

 if($row['ing'] == 'no')
  {
	  
	  ?>
	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="no">
  <td> <?php echo $lang_114;?> <?php echo $aaas;?></td>
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">
<?php if($aaas >0){?>
<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $aaas;?>" style="width:50px;height:30px;font-weight:bold;" /></td>  
<?php }else{?>
<td><input type="text" name="item[<?php echo $cc;?>][num]" value="0" min="0" style="width:50px;height:30px;font-weight:bold;" readonly="readonly" /></td>
<?php }

}

else{
	  $resultr = mysql_query("SELECT MIN(ing_avl / ing_qty) FROM `recipe` Where item = '$itna'");
			 while($rowr = mysql_fetch_array($resultr))
  {
       $ingtotal = $rowr['MIN(ing_avl / ing_qty)'];
  }?>
  	  <input type="hidden" name="item[<?php echo $cc;?>][has_ing]" value="yes">

<td> <?php echo $lang_404;?> <?php echo floor($ingtotal);?></td> 
<input type="hidden" name="item[<?php echo $cc;?>][id]" value="<?php echo $row['id'];?>">

<td><input type="number" name="item[<?php echo $cc;?>][num]" value="0" min="0" max="<?php echo $ingtotal;?>" style="width:50px;height:30px;font-weight:bold;" <?php if ($ingtotal <= 0) echo "readonly='readonly'"; ?>/></td>       
<?php }?>
</tr> 
<?php  

 $cc++;
}?>
<tr>
<td><button class="btn btn-success stick"><i class="icon-zoom-in icon-white"></i><?php echo $lang_115;?></button></td>
</tr>
</form>	
</tbody>
</table>
</center>
</div>
</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">Gesture For Playstation</a> <?php $Year = idate('Y');   echo $Year;?></p>
			
		</footer>
		
	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	  <script>
      jQuery( function ( ) {
         jQuery('#ddd1').click(function () {
					event.preventDefault();
            jQuery('#dis1').slideToggle();
    	});     
		jQuery('#ddd2').click(function () {
					event.preventDefault();
            jQuery('#dis2').slideToggle();
    	}); 	
		jQuery('#ddd3').click(function () {
					event.preventDefault();
            jQuery('#dis3').slideToggle();
    	}); 		
		jQuery('#nnn1').click(function () {
					event.preventDefault();
            jQuery('#note1').slideToggle();
    	}); 		
		jQuery('#nnn2').click(function () {
					event.preventDefault();
            jQuery('#note2').slideToggle();
    	}); 		
		jQuery('#nnn3').click(function () {
					event.preventDefault();
            jQuery('#note3').slideToggle();
    	}); 
		
    	});  
  </script>
	<script src="js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.min.js"></script>
	<script src="js/jquery.flot.pie.min.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
		<script src="js/jquery.uniform.min.js"></script>

	<!-- plugin for gallery image view -->
	<script src="js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="js/charisma.js"></script>
</body>
</html>
