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
					<td width="8%" align="left"><img src="images/icon_zap.png" border="0"/></td>
					<td width="82%"><h1 style="text-align:left;">ZAP</h1></td>
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
					<td width="150" align="left" valign="top" style="background-color:#FFFFFF;" >
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="center" height="150" valign="middle"><img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" width="150"  height="150"  /></td>
						  </tr>
						</table>
					</td>
					<td   align="left" valign="top" style="padding-left:60px;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
								<td><h1 style="text-align:left;"><input type="radio" name="neverwann" id="neverwann"  value="Y"/> <label for="neverwann">Click here if wann to ZAP this player off your list and the game.</label></h1></td>
						  </tr>
						  <tr>
								<td align="left" class="dashboard_whitetext" style="padding-top:10PX;">DOING THIS WILL TERMINATE THE PLAYER IF THEY ONLY HAVE ONE LIFE. IF THEY HAVE MORE LIVES THEY WILL BE TAGGED AS HAVING BEEN ZAPPED AS A WARNING TO OTHER PLAYERS. YOU CAN ZAP FOR ANY PERSON BUT YOU WILL ALSO BE TAGGED AS SOMEONE WHO ZAPS.</td>
						  </tr>
						</table>
					</td>
				  </tr>
				  <tr>
				  	<td colspan="2" class="bottmborder_white">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="2"   align="left" valign="top"  class="dashboard_whitetext">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
								<td  align="left" valign="top" class="dashboard_whitetext" style="padding-top:10PX;" width="25%">CHECK ABOVE AND<br>CONFIRM BY REASON<br />HERE</td>
								<td  align="left" valign="top" class="dashboard_whitetext" style="padding-top:10PX;">
									<?
									$getZapOptionsQryRs=mysql_query("SELECT * FROM  zap_options ORDER BY id ASC");
									while($getZapOptionsQryRow=mysql_fetch_array($getZapOptionsQryRs))
									{
									?>
										<h3 style="text-align:left;"><input type="radio" name="hideme" id="hideme<? echo $getZapOptionsQryRow['id'];?>"     value="<? echo $getZapOptionsQryRow['id'];?>"/> <label for="hideme<? echo $getZapOptionsQryRow['id'];?>"><? echo $getZapOptionsQryRow['name'];?></label></h3>
									<? }?>
								</td>
						  </tr>
						  
						 <tr>
							<td align="right" colspan="2">
							<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
							<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
							<input type="image" name="sendbutton" id="sendbutton" src="images/send-button-green.png" onclick="return POPUPfrmcheck('zap');" /> <a href="#" onclick="hide_pop();return false;"><img src="images/close-button-green.png" border="0" /></a>
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