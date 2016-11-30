<? include("connect.php");
include("checklogin.php");
$GetUsersQry="SELECT * FROM users WHERE active='Y' and id='".mysql_real_escape_string($_REQUEST['id'])."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);
if($GetUsersQryRow['username']!=''){$username=stripslashes($GetUsersQryRow['username']);}else{$username=stripslashes($GetUsersQryRow['couponcode']);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/style.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
<script language="javascript" src="popup_fun.js?rnd=<? echo rand();?>"></script>
<script language="javascript" src="ajax_validation.js?rnd=<? echo rand();?>"></script>
<script language="javascript">
function hide_pop()
{
	document.getElementById('rightsidePOPUP_MAIN').style.display='none';
}
</script>
</head>
<body style="text-align:center;">
<iframe src="evecal.php" width="100%" height="100%" id="IfrmaeCal" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
</body>
</html>