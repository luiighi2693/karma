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
</head>
<body style="text-align:center;">
<form name="frmpopup" id="frmpopup" enctype="multipart/form-data" method="post">
<table width="95%" style="text-align:center;margin-left:auto;margin-right:auto;" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table width="100%" align="center" border="0" cellspacing="3" cellpadding="3">
		  <tr>
			<td class="bottmborder_white">
			<br />
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="8%" align="left"><img src="images/icon_star.png" border="0"/></td>
					<td width="82%"><h1 style="text-align:left;">PLAY THE STARS</h1></td>
					<td width="10%" align="right"><a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a></td>
				  </tr>
				</table>
				<br />
			</td>
		  </tr>
		  <tr>
			<td style="padding-top:20px;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr >
					<td width="180" align="left" valign="top"  >
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="center" height="190" valign="middle">
							<? if($CURRENTgetuserwryRow['avatarid']!='') { $avatarlogo=stripslashes(GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']));?>
								<img src="Avatars/<? echo $avatarlogo;?>" width="180" height="250" />
							<? }?>
							</td>
						  </tr>
						</table>
					</td>
					<td   align="left" valign="top" style="padding-left:10px;padding-right:10px;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
								<td align="left"><h1>HERE IS YOUR COMPATIBILITY READING</h1></td>
						  </tr>
						  <tr>
								<td align="center"><iframe src="stars_reading.php?id=<? echo $_REQUEST['id'];?>&from=<? echo $_SESSION['UsErIdFrOnT'];?>&to=<? echo mysql_real_escape_string($_REQUEST['id']);?>" width="100%" height="250"  scrolling="yes"  frameborder="0"></iframe></td>
						  </tr>
						  <tr>
								<td align="right" valign="top"><a href="http://cafeastrology.com/" target="_blank"><img src="images/cafe-astrology.png"  border="0" style="max-width:340px;"/></a></td>
						  </tr>
						</table>
					</td>
					<td width="180" align="left" valign="top"  >
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="center" height="190" valign="middle">
							<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" width="180"  height="250"  />
							</td>
						  </tr>
						</table>
					</td>
				  </tr>
				  
				  <tr>
					<td colspan="3"   align="left" valign="bottom" style="padding-left:60px;" class="dashboard_whitetext">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						 
						 <tr>
							<td align="right" style="padding-top:20px;" colspan="2">
							<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
							<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
							<?php /*?><input type="image" name="sendbutton" id="sendbutton" src="images/send-button-green.png" onclick="return POPUPfrmcheck('hidepop');" /><?php */?> <a href="#" onclick="hide_pop();return false;"><img src="images/close-button-green.png" border="0" /></a>
							<span id="MessageId" style="color:#FF0000;"></span>
							</td>
						 </tr>
						</table>
					</td>
				  </tr>
				</table>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
</table>
</form>
</body>
</html>