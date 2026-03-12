<?php session_start();
 if( !isset($_SESSION['ps_user']) )
 {
	include('login.php');
	    die();
}
include('includes/config.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
$now = $_SESSION['ps_user'];
$sql="SELECT * FROM users WHERE Username = '$now'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$usern = $row['type'];
}
if($usern != 1 ){echo "<script>location='devices.php'</script>";}
 		
			  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="js/jquery-1.7.2.min.js"></script>
<script>
$(document).ready(function()
{
    function updatePrice()
    {
        var price = parseFloat($("#dare_price").val());
        var qty = parseFloat($("#qty").val());
        // var total = (price + 1) * 1.05;
         var total = price/qty;
        var total = total.toFixed(4);
        $("#total_price_amount").val(total);
    }
	    function updatePrice2()
    {
        var price = parseFloat($("#dare_price2").val());
        var qty = parseFloat($("#qty2").val());
        // var total = (price + 1) * 1.05;
         var total = price/qty;
        var total = total.toFixed(4);
        $("#total_price_amount2").val(total);
    }
	    function updatePrice3()
    {
        var price = parseFloat($("#dare_price3").val());
        var qty = parseFloat($("#qty3").val());
        // var total = (price + 1) * 1.05;
         var total = price/qty;
        var total = total.toFixed(4);
        $("#total_price_amount3").val(total);
    }
	    function updatePrice4()
    {
        var price = parseFloat($("#dare_price4").val());
        var qty = parseFloat($("#qty4").val());
        // var total = (price + 1) * 1.05;
         var total = price/qty;
        var total = total.toFixed(4);
        $("#total_price_amount4").val(total);
    }
	    function updatePrice5()
    {
        var price = parseFloat($("#dare_price5").val());
        var qty = parseFloat($("#qty5").val());
        // var total = (price + 1) * 1.05;
         var total = price/qty;
        var total = total.toFixed(4);
        $("#total_price_amount5").val(total);
    }
    $(document).on("change, keyup", "#dare_price", updatePrice);
    $(document).on("change, keyup", "#dare_price2", updatePrice2);
    $(document).on("change, keyup", "#dare_price3", updatePrice3);
    $(document).on("change, keyup", "#dare_price4", updatePrice4);
    $(document).on("change, keyup", "#dare_price5", updatePrice5);
});




</script>
	<meta charset="utf-8">
	<title><?php echo $lang_389;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $lang_1;?>">
	<meta name="author" content="Mohamed Gad">

	<!-- The styles -->
			<?php  include 'includes/css.php';?>

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
			<div style="border-style:solid;border-width:1px;padding:15px;margin-right: 50px;">
			<a href="control.php"><span>لوحة التحكم</span></a> / <span>إضافة أكثر من مكون جديد</span>
			</div>
			<br/>
			 <!-- content starts
			<a href ="add_product.php?type=general" ><img src="img/add.png" width = "100" height="60"/></a>
  -->

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $lang_389;?></h2>
						 
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th><?php echo $lang_399;?></th>
								  <th><?php echo $lang_398;?></th>
								  <th><?php echo $lang_370;?></th>
 								  <th><?php echo $lang_180;?></th>
								  <th><?php echo $lang_392;?></th>
								  <th><?php echo $lang_393;?></th>
  							  </tr>
						  </thead>   
						  <tbody>	
						  <form action="actions/ingredients/add_bulk.php" method="POST">
							<tr>
								<td>  
								<div class="controls">
 <select name="choose_cat"   style="width:100px;">
   <option value="drinks"><?php echo $lang_316;?></option>
   <option value="food"><?php echo $lang_320;?></option>
   <option value="choc"><?php echo $lang_322;?></option>
   <option value="gen"><?php echo $lang_324;?></option>
  </select> </div>
  </td>	
        <td> 
	            <input name="choose_unit" size="10" type="text" />
	    </td>  
        <td> 
	            <input name="choose_name" size="20" type="text" />
	    </td>    
 		 
		 
	    <td>
	            <input id="qty" type="number" style="width:50px;" name="choose_qty" value="0">
	    </td>
        <td> 
	            <input id="dare_price" name="choose_cost"  style="width:50px;" type="number" />
	    </td>
        <td>
		        <input name = "total_cost" id="total_price_amount" readonly="readonly" size="10" value=""/>
		</td>
    
  </tr>			
  <tr>
																<td>  
								<div class="controls">
 <select name="choose_cat2"   style="width:100px;">
   <option value="drinks"><?php echo $lang_316;?></option>
   <option value="food"><?php echo $lang_320;?></option>
   <option value="choc"><?php echo $lang_322;?></option>
   <option value="gen"><?php echo $lang_324;?></option>
  </select> </div>
  </td>	
        <td> 
	            <input name="choose_unit2" size="10" type="text" />
	    </td>
        <td> 
	            <input name="choose_name2" size="20" type="text" />
	    </td>
					 
		 
	    <td>
	            <input id="qty2" type="number" style="width:50px;" name="choose_qty2" value="0">
	    </td>
        <td> 
	            <input id="dare_price2" name="choose_cost2" size="10" type="number"  style="width:50px;" />
	    </td>
        <td>
		        <input name = "total_cost2" id="total_price_amount2" readonly="readonly" size="10" value=""/>
		</td>
         
  </tr>
  							<tr>
																<td>  
								<div class="controls">
 <select name="choose_cat3"  style="width:100px;">
    <option value="drinks"><?php echo $lang_316;?></option>
   <option value="food"><?php echo $lang_320;?></option>
   <option value="choc"><?php echo $lang_322;?></option>
   <option value="gen"><?php echo $lang_324;?></option>
  </select> </div>
  </td>	
        <td> 
	            <input name="choose_unit3" size="10" type="text" />
	    </td>
        <td> 
	            <input name="choose_name3" size="20" type="text" />
	    </td>	 
		 
	    <td>
	            <input id="qty3" type="number" name="choose_qty3" value="0" style="width:50px;" >
	    </td>
        <td> 
	            <input id="dare_price3" name="choose_cost3" size="10" type="number"  style="width:50px;" />
	    </td>
        <td>
		        <input name = "total_cost3" id="total_price_amount3" readonly="readonly" size="10" value=""/>
		</td>
       
  </tr>
							 
			 								<tr>
																<td>  
								<div class="controls">
 <select name="choose_cat4"  style="width:100px;">
   <option value="drinks"><?php echo $lang_316;?></option>
   <option value="food"><?php echo $lang_320;?></option>
   <option value="choc"><?php echo $lang_322;?></option>
   <option value="gen"><?php echo $lang_324;?></option>
  </select> </div>
  </td>	
          <td> 
	            <input name="choose_unit4" size="10" type="text" />
	    </td>
        <td> 
	            <input name="choose_name4" size="20" type="text" />
	    </td>	 	
		 
	    <td>
	            <input id="qty4" type="number" name="choose_qty4" value="0" style="width:50px;" >
	    </td>
        <td> 
	            <input id="dare_price4" name="choose_cost4" size="10" type="number"  style="width:50px;" />
	    </td>
        <td>
		        <input name = "total_cost4" id="total_price_amount4" readonly="readonly" size="10" value=""/>
		</td>
    
  </tr>	 
  
  							<tr>
																<td>  
								<div class="controls">
 <select name="choose_cat5"   style="width:100px;">
   <option value="drinks"><?php echo $lang_316;?></option>
   <option value="food"><?php echo $lang_320;?></option>
   <option value="choc"><?php echo $lang_322;?></option>
   <option value="gen"><?php echo $lang_324;?></option>
  </select> </div>
  </td>	
        <td> 
	            <input name="choose_unit5" size="10" type="text" />
	    </td>
        <td> 
	            <input name="choose_name5" size="20" type="text" />
    </td>	 
		 
	    <td>
	            <input id="qty5" type="number" name="choose_qty5" value="0" style="width:50px;">
	    </td>
        <td> 
	            <input id="dare_price5" name="choose_cost5" size="10" type="number" style="width:50px;" />
	    </td>
        <td>
		        <input name = "total_cost5" id="total_price_amount5" readonly="readonly" size="10" value=""/>
		</td>
        
  </tr>
						  </tbody>
					  </table>            
					</div>
				<br/>
				<center>
				<button class="btn btn-success"><?php echo $lang_389;?></button>
				</center>
				</form>
				</div>

				
				<!--/span-->
			
			</div><!--/row-->

			
			
			 
			
			
			

					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

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

		<footer>
			<p class="pull-left">&copy; <a href="http://www.psxegy.com" target="_blank">Gesture For Playstation</a> <?php $Year = idate('Y');   echo $Year;?></p>
			
		</footer>
		
	</div><!--/.fluid-container-->
<?php  include 'includes/js.php';?>

	
		
</body>
</html>
