<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
<a  href="devices.php"> <img class="brand-logo" alt="PlayStation Logo" src="img/app/defaults/ps_logo.png" /></a>
				<!-- theme selector starts -->
				<!-- theme selector ends -->
				<!-- user dropdown starts -->
<div class="btn-group span6" >
	<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				<?php 		
					include('includes/config.php');
				mysql_connect("$host", "$user", "$pass")or die("cannot connect");
				mysql_select_db("$db")or die("cannot select DB");
				$now = $_SESSION['ps_user'];
				$sql="SELECT * FROM users WHERE Username = '$now'";
				$result=mysql_query($sql);
				while($row = mysql_fetch_array($result))
				  {
			?>				<span class="hidden-phone"> <?php  echo $row['Username']; ?></span>
			<?php 	}	?>
							<span class="caret"></span>
	</a>
	<ul class="dropdown-menu">
		<li><a href="#" data-toggle="modal" data-target="#loging_out"><img src="img/app/buttons/logout.png" /></a></li>
	</ul>
	
	


<div Style="float:left; margin: 0 5px 0 5px;">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			 			<span class="hidden-phone"><?php echo $lang_357;?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" style="min-width: 16px;">
<li><a href="actions/language/change.php?ch=ar" data-rel="tooltip" title="<?php echo $lang_358;?>"><?php echo $lang_358;?></a></li>
<li><a href="actions/language/change.php?ch=en" data-rel="tooltip" title="<?php echo $lang_359;?>"><?php echo $lang_359;?></a></li>
					</ul>
</div>	
 	
	
	
<div Style="float:left; margin: 0;" >
<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
<?php     include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
  $sql="SELECT *,SUM(stock),SUM(sold) FROM stock GROUP BY name HAVING `SUM(stock)`-`SUM(sold)` < 10 AND `ing`='no' AND `name` !=' ' ";
// $sql="SELECT *,SUM(stock),SUM(sold) FROM stock WHERE (`SUM(stock)`-`SUM(sold)` < 10) AND `ing`='no' AND `name` !=' ' GROUP BY name";
$result=mysql_query($sql);
$numnum = mysql_num_rows($result);
?>
<span class="hidden-phone"> <?php echo $lang_294;?><font color="red"><b> ( <?php echo $numnum;?> )</b></font></span>

<span class="caret"></span>
</a>
<ul style="  margin: 0 30% 0 0;  overflow-y:scroll;max-height:600px;"class="dropdown-menu pull-right">
<?php 
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$now = $_SESSION['ps_user'];
  $sql="SELECT *,SUM(stock),SUM(sold) FROM stock GROUP BY name HAVING `SUM(stock)`-`SUM(sold)` < 10 AND `ing`='no' AND `name` !=' ' ";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{?>
	<li><a href="control_product.php?id=<?php echo $row['id'];?>"><?php echo $row['name'];?></a></li>
	<?php }?>
</ul>
</div>
<?php 
$sql="SELECT * FROM notes WHERE `seen` ='no'";
$result=mysql_query($sql);
$numnum2 = mysql_num_rows($result);
 $now = $_SESSION['ps_user'];
$sql="SELECT * FROM users WHERE Username = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
}
if($usern != 1 ){}else{
?>

<a href="control_notes.php" class="btn btn-primary" style="float: left;margin: 0 5px 0 5px;">الملاحظات <font color="red"><b>(<?php echo $numnum2;?>)</b></font></a>
<?php }?>
	
	
	
	
	
</div>
<div class="modal hide fade" id="loging_out">
<div class="modal-header">
 <h3><?php echo $lang_290;?></h3>
</div>
<div class="modal-body">
<center>
<h2><?php echo $lang_291;?></h2>
<br/>
 <table border="1" width="95%">
 <tr>
 <td align='center'>
	<a href="actions/login/logout.php?u=<?php echo $now;?>"><img src="img/app/buttons/logout.png"></a>
	<h4><?php echo $lang_292;?></h4><br/>
	</td>
	</tr>
	<tr>
	<td align='center'>
	<?php 
if($current_shift =='One')
{
	?>
 	<form action="actions/login/logout2.php" method="POST">
	<input type="hidden" name="shift_option" value="End_One"/>
	<input type="hidden" name="last_shift" value="<?php echo $last_shift?>"/>
	<input type="hidden" name="shift_day" value="<?php echo $Day?>"/>
	<input type="hidden" name="shift_month" value="<?php echo $Month?>"/>
	<input type="image" src="img/app/buttons/shift-end.png"/>
	</form>
 	<?php 
}
else if($current_shift =='Two')
{
		?>
  	<form action="actions/login/logout2.php" method="POST">
	<input type="hidden" name="shift_option" value="End_Two"/>
	<input type="hidden" name="last_shift" value="<?php echo $last_shift?>"/>
	<input type="hidden" name="shift_day" value="<?php echo $Day?>"/>
	<input type="hidden" name="shift_month" value="<?php echo $Month?>"/>
 	<input type="image" src="img/app/buttons/shift-end.png"/>
	</form>
	<?php 
}
?>
 <h4><?php echo $lang_293;?></h4><br/>
	</td>
	</tr>
	</table>
	</center>
	</div>
<div class="modal-footer">
</div>
</div>
<?php 
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$result = mysql_query("SELECT * FROM `reports`");
while($row = mysql_fetch_array($result))
{
	$check_last = $row['session_id'];
}
if(!isset($check_last))
{
	$last_fat = 'class="not-active';
}
	?>
	<style>
.not-active {
   pointer-events: none;
   cursor: default;

}
	</style>

				<!-- user dropdown ends -->
<div class="circles" >
<a data-rel="tooltip" href = "control_add_out.php" title="<?php echo $lang_138;?>"><img class="c-inner " src="img/app/nav/out.png"  /></a>
<a data-rel="tooltip" href = "control_add_in.php" title="<?php echo $lang_139;?>"><img class="c-inner" src="img/app/nav/add_money.png" /></a>
 <a data-rel="tooltip" href = "control_reservations_add.php" title="<?php echo $lang_76;?>"><img class="c-inner" src="img/app/nav/addre.png"  /></a>
<style>
		.blink_meee2 {
animation: blinker 1s linear infinite;
		}

		@keyframes blinker {  
			50% { opacity: 0.0; }
		}
</style>
<?php 
 $RDay = date('d');
 $RMonth = date('m');
 $RYear = date('Y');
 
 mysql_connect("$host", "$user", "$pass") or die(mysql_error()); 
 mysql_select_db("$db") or die(mysql_error()); 
$reserv_date = $RDay."/".$RMonth."/".$RYear;
$result = mysql_query("SELECT * FROM `reservation` WHERE `date` = '$reserv_date'");
 while($row = mysql_fetch_array($result))
{
	$chk_rsv = $row['id'];
}
if(isset($chk_rsv))
{
	$Rflash = 'blink_meee2';
}
?>
<a data-rel="tooltip" href = "control_reservations.php" title="<?php echo $lang_296;?>"><img class="c-inner <?php echo $Rflash;?>" src="img/app/nav/res.png"  /></a>

<a data-rel="tooltip" href = "JavaScript:newPopup('actions/print/wireless.php')" title="<?php echo $lang_297;?>"><img class="c-inner" src="img/app/nav/wireless.png"  /></a>
<a data-rel="tooltip" href = "JavaScript:newPopup('actions/print/card.php')" title="<?php echo $lang_298;?>"><img class="c-inner" src="img/app/nav/card.png"/></a>
<a data-rel="tooltip" href = "control_members.php" title="<?php echo $lang_299;?>"><img class="c-inner" src="img/app/nav/members.png" /></a>
<a data-rel="tooltip" href = "JavaScript:newPopup('actions/calculator/calc.php')" title="<?php echo $lang_300;?>"><img class="c-inner" src="img/app/nav/cc.png"  /></a>
<a data-rel="tooltip"  href = "JavaScript:newPopup2('actions/print/last.php')" title="<?php echo $lang_301;?>" <?php echo $last_fat?>><img class="c-inner" src="img/app/nav/rec.png"  /></a>
<a data-rel="tooltip"  href = "JavaScript:newPopup2('actions/print/stock.php')" title="المخزن"><img class="c-inner" src="img/app/nav/storage.png"  /></a>
</div>


			</div>
		</div>
	</div>

	

	