<? include("connect.php");
$SelCustomerQry=mysql_query("select id from users where couponcode='".addslashes($_REQUEST['couponcode'])."' and id='".addslashes($_REQUEST['id'])."'");
$TotUsername=mysql_affected_rows();
if($TotUsername>0)
{	
	$SelCustomerRow=mysql_fetch_array($SelCustomerQry);
	$_SESSION['UsErIdFrOnT']=$SelCustomerRow['id'];
	header("location:select-lives.php");
	exit;
}
else
{
	header("location:thank-you.php?msg=Something is wrong!!");
	exit;
}
?>