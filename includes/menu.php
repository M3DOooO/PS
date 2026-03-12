<div class="span2 main-menu-span ">		
<style>
		.blink_meee2 {
animation: blinker 1s linear infinite;
		}

		@keyframes blinker {  
			50% { opacity: 0.0; }
		}
</style>
<?php 
$Year = idate('Y');

if($Day != $shift_day)
{
?>

<div class="shift  sidebar-nav ">
	<span class="shift blink_meee2" style="color:red; margin-bottom:10px;">♠ <?php echo $lang_284;?> ♠</span>
</div>
	<?php 
}

?>

<?php 
include('includes/config.php');
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$now = $_SESSION['ps_user'];
$sql="SELECT * FROM users WHERE Username = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
	$user_shift = $row['shift'];
}
if($usern == 1 )
{
	?>
	<br />
	<div class="well nav-collapse sidebar-nav">
	<ul class="nav nav-tabs nav-stacked main-menu">
	<li class="nav-header hidden-tablet"><?php echo $lang_285;?></li>
	
	<li><a class="ajax-link" href="control.php"><i class="icon-align-justify"></i><span class=""> <?php echo $lang_118;?></span></a></li>
	<li><a class="ajax-link" href="reports.php"><i class="icon-align-justify"></i><span class=""> <?php echo $lang_251;?></span></a></li>
	<li class="nav-header "><?php echo $lang_286;?></li>
	<li><a class="ajax-link" href="devices.php"><i class="icon-picture"></i><span class=""> <?php echo $lang_120;?></span></a></li>
	<!--	<li 
	-->						<li class="nav-header "><?php echo $lang_151;?></li>
	<li><a class="ajax-link" href="devices_takeaway.php"><i class="icon-align-justify"></i><span class="">  <?php echo $lang_287;?></span></a></li>
	<li class="nav-header ">الإضافات</li>
 	<li><a class="ajax-link" href="devices_halls.php"><i class="icon-align-justify"></i><span class="">  القاعات</span></a></li>
	</ul>
	</div><!--/.well --><?php  } 
else 
{
	?>
	<div class="well nav-collapse sidebar-nav">
	<ul class="nav nav-tabs nav-stacked main-menu">
	<li class="nav-header "><?php echo $lang_286;?></li>
	<li><a class="ajax-link" href="devices.php"><i class="icon-picture"></i><span class=""> <?php echo $lang_120;?></span></a></li>
	<li class="nav-header "><?php echo $lang_151;?></li>
	<li><a class="ajax-link" href="devices_takeaway.php"><i class="icon-align-justify"></i><span class="">  <?php echo $lang_287;?></span></a></li>
	<li class="nav-header ">الإضافات</li>
 	<li><a class="ajax-link" href="devices_halls.php"><i class="icon-align-justify"></i><span class="">  القاعات</span></a></li>
	
	</ul>
	</div><!--/.well -->
	<?php }
?> 
<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
	url,'popUpWindow','height=300,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
	popupWindow.focus();

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
	<script src="js/jquery-1.7.2.min.js"></script> 

<?php 

$shift_total = 0;
if($current_shift =='One' || $current_shift =='Two')
{
	$shift_money_1 = 0;
	$shift_money_2 = 0;
	$shift_money_3 = 0;
	$shift_money_4 = 0;
	$shift_money_5 = 0;
	$shift_money_6 = 0;
	$shift_disdiscount = 0;

	$result_shift = mysql_query("SELECT SUM(money) AS total_money FROM reports WHERE day = '$shift_day' AND month = '$shift_month' AND year = '$Year' AND status = 'done' AND shift = '$current_shift'");
	while($row_shift = mysql_fetch_array($result_shift))
	{
		$shift_money_1 = $row_shift['total_money'];
	}

	$result_shift = mysql_query("SELECT SUM(price) AS total_price FROM reports2 WHERE day = '$shift_day' AND month = '$shift_month' AND year = '$Year' AND catagory != 'exp' AND status = 'done' AND shift = '$current_shift'");
	while($row_shift = mysql_fetch_array($result_shift))
	{
		$shift_money_2 = $row_shift['total_price'];
	}

	$result_shift = mysql_query("SELECT SUM(price) AS total_orders FROM ps_orders WHERE day = '$shift_day' AND month = '$shift_month' AND year = '$Year' AND shift != '' AND shift = '$current_shift'");
	while($row_shift = mysql_fetch_array($result_shift))
	{
		$shift_money_3 = $row_shift['total_orders'];
	}

	$result_shift = mysql_query("SELECT SUM(price) AS total_expenses FROM reports2 WHERE day = '$shift_day' AND month = '$shift_month' AND year = '$Year' AND catagory = 'exp' AND shift = '$current_shift'");
	while($row_shift = mysql_fetch_array($result_shift))
	{
		$shift_money_4 = $row_shift['total_expenses'];
	}

	$result_shift = mysql_query("SELECT SUM(discount2) AS total_discount FROM reports WHERE day = '$shift_day' AND month = '$shift_month' AND year = '$Year' AND status = 'done' AND shift = '$current_shift'");
	while($row_shift = mysql_fetch_array($result_shift))
	{
		$shift_money_5 = $row_shift['total_discount'];
	}

	$result_shift = mysql_query("SELECT SUM(discount_amount) AS total_discount_amount FROM reports WHERE day = '$shift_day' AND month = '$shift_month' AND year = '$Year' AND status = 'done' AND shift = '$current_shift'");
	while($row_shift = mysql_fetch_array($result_shift))
	{
		$shift_money_6 = $row_shift['total_discount_amount'];
	}

	$result_shift = mysql_query("SELECT SUM(discount2) AS total_reports2_discount FROM reports2 WHERE day = '$shift_day' AND month = '$shift_month' AND year = '$Year' AND shift = '$current_shift' AND status = 'done'");
	while($row_shift = mysql_fetch_array($result_shift))
	{
		$shift_disdiscount = $row_shift['total_reports2_discount'];
	}

	$shift_total = (float)$shift_money_1 + (float)$shift_money_2 + (float)$shift_money_3 - (float)$shift_money_4 - (float)$shift_money_5 - (float)$shift_money_6 - (float)$shift_disdiscount;
}

 
		  
if($current_shift =='No')
{
	?>
<script type="text/javascript">
    $(window).load(function(){
$('#shift').modal({backdrop: 'static', keyboard: false})  
    });
</script>
	
	

	<?php 
}
else if($current_shift =='One')
{
	
	if($user_shift == '2' )
	{
		?>
		<script type="text/javascript">
    $(window).load(function(){
$('#shiftauth').modal({backdrop: 'static', keyboard: false})  
    });
</script>
		<?php 	
		}else{
	?>
	
	<br /> 
	<div class="shift well nav-collapse sidebar-nav">
<br />
	<span class="shift"> ♠ <?php echo $lang_155;?> ♠ <br/> <?php echo $lang_288;?> <?php echo $shift_month;?>/<?php echo $shift_day;?></span>
	<form action="actions/login/shifting.php" method="POST">
	<input type="hidden" name="shift_option" value="End_One"/>
	<input type="hidden" name="last_shift" value="<?php echo $last_shift?>"/>
	<input type="hidden" name="shift_day" value="<?php echo $Day?>"/>
	<input type="hidden" name="shift_month" value="<?php echo $Month?>"/>
	<br />
		<input type="image" src="img/app/buttons/shift-end.png" onclick="return confirm('<?php echo $lang_244;?>')" />
		</form>
			 <br/>
			 <span class="shift" style="font-weight:bold;"><?php echo 'حساب الشيفت';?>:</span><br/>
			 <span class="shift" style="color:green;"><?php echo number_format($shift_total, 2);?> <?php echo $lang_100;?></span>
			 <br/><br/>

	<?php echo $lang_289;?>:  
 

<script type="text/javascript">

/***********************************************

* JavaScript Alarm Clock- by JavaScript Kit (www.javascriptkit.com)
* This notice must stay intact for usage
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and 100s more

***********************************************/

var jsalarm={
	padfield:function(f){
		return (f<10)? "0"+f : f
	},
	showcurrenttime:function(){
		var dateobj=new Date()
		var ct=this.padfield(dateobj.getHours())+":"+this.padfield(dateobj.getMinutes())+":"+this.padfield(dateobj.getSeconds())
		this.ctref.innerHTML=ct
		this.ctref.setAttribute("title", ct)
		 
	},
	init:function(){
		var dateobj=new Date()
		this.ctref=document.getElementById("jsalarm_ct")
 
		 
		var selections=document.getElementsByTagName("select")
		this.hourselect=selections[0]
		this.minuteselect=selections[1]
		this.secondselect=selections[2]
		 
		jsalarm.showcurrenttime()
		jsalarm.timer=setInterval(function(){jsalarm.showcurrenttime()}, 1000)
	} 
}

</script>
	<form action="" method="">
<div id="jsalarmclock">
<div>  <span id="jsalarm_ct" style="letter-spacing: 2px"></span></div>
  </div>
</form>


<script type="text/javascript">

jsalarm.init()

</script>
</div>
	<?php 
		}}
else if($current_shift =='Two')
{
		if($user_shift == '1' )
	{
		?>
		<script type="text/javascript">
    $(window).load(function(){
$('#shiftauth').modal({backdrop: 'static', keyboard: false})  
    });
</script>
		<?php 	
		}else{
	
		?>
		
		
<br />
	<div class="shift well nav-collapse sidebar-nav">
<br />
<span class="shift"> ♠ <?php echo $lang_156;?> ♠ <br/> <?php echo $lang_288;?> <?php echo $shift_month;?>/<?php echo $shift_day;?></span>

	<form action="actions/login/shifting.php" method="POST">
	<input type="hidden" name="shift_option" value="End_Two"/>
	<input type="hidden" name="last_shift" value="<?php echo $last_shift?>"/>
	<input type="hidden" name="shift_day" value="<?php echo $Day?>"/>
	<input type="hidden" name="shift_month" value="<?php echo $Month?>"/>
	<br/>
		<input type="image" src="img/app/buttons/shift-end.png" onclick="return confirm('<?php echo $lang_244;?>')" />
		</form>
		 <br/>
		 <span class="shift" style="font-weight:bold;"><?php echo 'حساب الشيفت';?>:</span><br/>
		 <span class="shift" style="color:green;"><?php echo number_format($shift_total, 2);?> <?php echo $lang_100;?></span>
		 <br/><br/>
		<?php echo $lang_289;?>:  
 
 
<script type="text/javascript">

/***********************************************

* JavaScript Alarm Clock- by JavaScript Kit (www.javascriptkit.com)
* This notice must stay intact for usage
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and 100s more

***********************************************/

var jsalarm={
	padfield:function(f){
		return (f<10)? "0"+f : f
	},
	showcurrenttime:function(){
		var dateobj=new Date()
		var ct=this.padfield(dateobj.getHours())+":"+this.padfield(dateobj.getMinutes())+":"+this.padfield(dateobj.getSeconds())
		this.ctref.innerHTML=ct
		this.ctref.setAttribute("title", ct)
		 
	},
	init:function(){
		var dateobj=new Date()
		this.ctref=document.getElementById("jsalarm_ct")
 
		 
		var selections=document.getElementsByTagName("select")
		this.hourselect=selections[0]
		this.minuteselect=selections[1]
		this.secondselect=selections[2]
		 
		jsalarm.showcurrenttime()
		jsalarm.timer=setInterval(function(){jsalarm.showcurrenttime()}, 1000)
	} 
}

</script>
	<form action="" method="">
<div id="jsalarmclock">
<div>  <span id="jsalarm_ct" style="letter-spacing: 2px"></span></div>
  </div>
</form>


<script type="text/javascript">

jsalarm.init()

</script>
	
</div>	

	<?php 
}}
?>
<br/>
	<div class="shift well nav-collapse sidebar-nav">
<form action="actions/notes/add.php" method="POST">
<textarea name="x_note" style="width: 82%;height: 82px;" placeholder="الملاحظات">
</textarea>
<button type="submit" class="btn btn-primary">إضافة ملاحظات جديدة</button>
</form>
</div>

</div>
