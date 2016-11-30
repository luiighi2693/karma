<? include("connect.php");
include("checklogin.php");
$totallifes=stripslashes(GetName1("lifes","totallives","id",$_SESSION['LIVESID']));
$query_order = "INSERT INTO users_lifes set 
				userid = '".$_SESSION['UsErIdFrOnT']."',
				avatarid='".addslashes($CURRENTgetuserwryRow['avatarid'])."',
				lifeid='".addslashes($_SESSION['LIVESID'])."',
				totallifes='".addslashes($totallifes)."',
				addeddate=now(),
				ipaddress='".get_client_ip()."'";			
mysql_query($query_order) or die(mysql_error()); 

$SelCustomerQry=mysql_query("UPDATE users SET active='Y',online='Y' where id='".$_SESSION['UsErIdFrOnT']."'");

$_SESSION['LIVESID']='';
header("location:dashboard.php?first=yes");
exit;
?>