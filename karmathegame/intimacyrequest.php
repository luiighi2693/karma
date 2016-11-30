<? include("connect.php");
if($_GET['randm']!="" && $_GET['id']!="")
{
	if($_GET['accepted']=='Y')
	{
		$del=mysql_query("UPDATE users_intimicy_lock_request SET accepted='Y' WHERE id='".mysql_real_escape_string($_GET['id'])."' and randm='".mysql_real_escape_string($_GET['randm'])."'");
	}
	if($_GET['rejected']=='Y')
	{
		$del=mysql_query("UPDATE users_intimicy_lock_request SET rejected='Y' WHERE id='".mysql_real_escape_string($_GET['id'])."' and randm='".mysql_real_escape_string($_GET['randm'])."'");
	}	
}
header("location:$SITE_URL");
exit;
?>