<?php session_start();
 
include('../../includes/config.php');
 
  ?>
<html>
<body style="background-color:#0c0c0c;">
<center>
<img style="width:100%;margin-top: -200px;" src="../../img/closing.gif">
</center>
</body>
</html>
<?php   
// To connect to the database
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

// To receive the variables sent from the login form
$username=$_POST['ps_user'];
$password=$_POST['ps_pass'];

// Table Name
$tbl_name="users";

$encrypted_password=md5($password);

// Mysql Query to match user name and password with the records in the database
$sql="SELECT * FROM $tbl_name WHERE Username='$username' and Password='$encrypted_password'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $username and $password, table row must be 1 row

if($count==1){
// Register $username, $password and redirect to file "after_login.php"
//session_register("ps_user");
//session_register("ps_pass");
//To put the user and password in the session
$_SESSION['ps_user']="$username";
$_SESSION['ps_pass']="$encrypted_password";
while($row = mysql_fetch_array($result))
  {
//$idd = $row['id'];
mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");
mysql_query("INSERT INTO `login` (`user`,`type`) VALUES ('$username','login');"); 

  				 echo "<script>location='../../devices.php'</script>";
}
}
else { 
  				 echo "<script>location='../../login.php?error=true'</script>";

  } ?>