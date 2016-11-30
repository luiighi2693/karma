<?
include("connect.php");
if($_REQUEST['id']>0)
{
	$update=mysql_query("UPDATE	coupons SET used='Y' WHERE id='".$_REQUEST['id']."'");
}
?>