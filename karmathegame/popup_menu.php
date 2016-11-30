<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/opening_styles.css">
<title></title>
</script>
</head>
<body>
<div id="main_menu">
	<div style="width:30% text-align:center margin-bottom: 50px;" >
	
	<table style="text-align:center;margin-left:auto;margin-right:auto;" width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tr>
		<td class="bottmborder_white">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			<td width="8%" align="left">
			<img src="images/lock.png" border="0">
			</td>
			<td width="52%">
				<h1 style="text-align:left;">Menu</h1>
			</td>
			<td width="10%" align="right">
				<a href="#" onclick="hide_pop();return false;">
				<img src="images/popup_close.png" border="0">
			</td>
			</tr>
		</table>
		</td>
		<br />
	</tr>
	</tbody>
	</table>	 
	</div>
	<? ini_set( "display_errors", 0); 
	   include("connect.php"); 
	   include("checklogin.php");
	   $avatarlogo=stripslashes(GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']));?> 
	  
	   
  <ul style="padding-left: 100px; padding-top: 40px;">
	<li style="background:#5D4C46;"><a href="#"><img src="images/icon_journeybook.png" style="height:56px; width:56px;" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a></li>
	<li style="background:#5D4C46;"><a href="#"><img src="images/icon_calendar.png" style="height:56px; width:56px;" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a></li>
	<li style="background:#5D4C46;"><a href="#"><img src="images/icon_email.png" style="height:56px; width:56px;" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a></li>
	<li style="background:#5D4C46;"><a href="#"><img src="images/icon_bucketlist.png" style="height:56px; width:56px;" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a></li>
	<li style="background:#5D4C46;"><a href="#"><img src="images/icon_bail.png" style="height:56px; width:56px;" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a></li>
	<li style="background:#5D4C46;"><a href="#"><img src="images/icon_gears.png" style="height:56px; width:56px;" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a></li>
	<li style="background:#5D4C46;"><a href="#"><img src="images/icon_tokens_white.png" style="height:56px; width:56px;" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a></li>


  </ul>
</div>
</body>
</html>