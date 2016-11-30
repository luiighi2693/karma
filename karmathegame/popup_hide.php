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
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="8%" align="left"><img src="images/icon_hide.png" border="0"/></td>
					<td width="82%"><h1 style="text-align:left;">HIDE</h1></td>
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
					<td width="170" align="left" valign="top" style="background-color:#FFFFFF;" >
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="center" height="190" valign="middle"><img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" width="150"  height="180"  /></td>
						  </tr>
						</table>
					</td>
					<td   align="left" valign="top" style="padding-left:60px;padding-top:30px;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
								<td><h1 style="text-align:left;"><input type="radio" name="neverwann" id="neverwann"  value="Y"/> <label for="neverwann">Click here if you never want to see this Player again</label></h1></td>
						  </tr>
						  <tr>
								<td align="left" class="dashboard_whitetext" style="padding-top:10PX;">DOING THIS DOES NOT HARM THE OTHER PLAYER OR YOURSELF. IT HELPS YOU TO LOWER YOUR NUMBER AND GET CLOSER TO YOUR SOULMATES.</td>
						  </tr>
						</table>
					</td>
				  </tr>
				  <tr>
				  	<td colspan="2" class="bottmborder_white">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="2"   align="left" valign="top" style="padding-left:60px;" class="dashboard_whitetext">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
								<td colspan="2" align="left" class="dashboard_whitetext" style="padding-top:10PX;">TO TEMPORARILY HIDE YOURSELF FROM THE ENTIRE GAME CLICK THE BUTTONS BELOW. THIS DOES NOT PAUSE THE GAME.</td>
						  </tr>
						  <tr>
								<td><h1 style="text-align:left;"><input type="radio" name="hideme" id="hideme1"  <? if(GetName1("users","hideme","id",$_SESSION['UsErIdFrOnT'])=='Y'){?>checked<? } ?>  value="Y"/> <label for="hideme1">HIDE ME</label></h1></td>
								<td><h1 style="text-align:left;"><input type="radio" name="hideme" id="hideme2"  <? if(GetName1("users","hideme","id",$_SESSION['UsErIdFrOnT'])=='N'){?>checked<? } ?>  value="N"/> <label for="hideme2">REVEAL ME</label></h1></td>
						  </tr>
						 <tr>
							<td align="right" style="padding-top:10px;" colspan="2">
							<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
							<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
							<input type="image" name="sendbutton" id="sendbutton" src="images/send-button-green.png" onclick="return POPUPfrmcheck('hidepop');" /> <a href="#" onclick="hide_pop();return false;"><img src="images/close-button-green.png" border="0" /></a>
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