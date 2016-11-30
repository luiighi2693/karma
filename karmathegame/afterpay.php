<? include("connect.php");
if($_GET['Paid']=="Y")
{
	$totallifes=stripslashes(GetName1("lifes","totallives","id",$_SESSION['LIVESID']));
	$query_order = "INSERT INTO users_lifes set 
					userid = '".$_SESSION['UsErIdFrOnT']."',
					avatarid='".addslashes($CURRENTgetuserwryRow['avatarid'])."',
					lifeid='".addslashes($_SESSION['LIVESID'])."',
					totallifes='".addslashes($totallifes)."',
					addeddate=now(),
					ipaddress='".get_client_ip()."'";			
	mysql_query($query_order) or die(mysql_error()); 
	
	$SelCustomerQry=mysql_query("UPDATE users SET active='Y' where id='".$_SESSION['UsErIdFrOnT']."'");
	
	$query_order = "update ordermaster set ispaid = 'paid' where id='".$_REQUEST['orid']."'";			
	mysql_query($query_order) or die(mysql_error()); 
}
$_SESSION['LIVESID']='';
$_SESSION['total']="";
$_SESSION['finaltotal']="";

$_SESSION['cctype'] = "";
$_SESSION['ccnumber'] = "";
$_SESSION['ccmonth'] = "";
$_SESSION['ccyear'] = "";
$_SESSION['cvv'] = "";	
$_SESSION['ship_fname'] = "";
$_SESSION['ship_lname'] = "";
$_SESSION['ship_address1'] = "";
$_SESSION['ship_address2'] = "";
$_SESSION['ship_city'] = "";
$_SESSION['ship_state'] = "";
$_SESSION['ship_country'] = "";
$_SESSION['ship_zipcode'] = "";
$_SESSION['ship_day_telephone'] = "";				
$_SESSION['fname'] = "";
$_SESSION['lname'] = "";
$_SESSION['address1'] = "";
$_SESSION['address2'] = "";
$_SESSION['city'] = "";
$_SESSION['state'] = "";
$_SESSION['country'] = "";
$_SESSION['zipcode'] = "";
$_SESSION['day_telephone'] = "";
header("location:dashboard.php?first=yes");
exit;
?>