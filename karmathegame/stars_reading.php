<? include("connect.php");
include("checklogin.php");
$GetUsersQry="SELECT profile_dob FROM users WHERE active='Y' and id='".mysql_real_escape_string($_REQUEST['id'])."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/style.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
<style type="text/css">body{overflow:auto};</style>
</head>
<body style="text-align:center;background-color:#FFFFFF">
<div style="overflow:auto;min-height:200px;">
<?
$profile_dob1=$CURRENTgetuserwryRow['profile_dob'];
$profile_dob2=$GetUsersQryRow['profile_dob'];
if($profile_dob1!='' && $profile_dob1!='0000-00-00' && $profile_dob2!='' && $profile_dob2!='0000-00-00')
{
	$exp1=explode("/",$profile_dob1);
	$mm1=$exp1[0];
	$dd1=$exp1[1];
	$yy1=$exp1[2];
	
	$exp2=explode("/",$profile_dob2);
	$mm2=$exp2[0];
	$dd2=$exp2[1];
	$yy2=$exp2[2];
	
	$filecontent_1= file_get_contents("http://astro.cafeastrology.com/cgi-bin/astro/comp2f?d1day=".$dd1."&d1month=".$mm1."&d1year=".$yy1."&d2day=".$dd2."&d2month=".$mm2."&d2year=".$yy2."");
	$filecontent_2=explode("<h1>Compare to another person</h1>",$filecontent_1);
	$filecontent_3=explode('<p><a href="http://cafeastrology.com/astrologyarticles.html">',$filecontent_2[1]);
	?>
	<table width="100%" border="0" cellspacing="2" cellpadding="2">
		  <tr>
			<td  align="left"><? echo str_replace("/cgi-bin/graphic/two2?dformat","http://astro.cafeastrology.com/cgi-bin/graphic/two2?dformat",$filecontent_3[0]);?></td>
		  </tr>
		</table>
	<?
	
}
else
{
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td ><br /><? echo  "Sorry! Birthdate not provided by this soulmate.";?></td>
		  </tr>
		</table>

	<?
	
}
?>
</div>
</body>
</html>