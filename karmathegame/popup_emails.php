<? include("connect.php");
include("checklogin.php");
$GetUsersQry="SELECT * FROM users WHERE active='Y' and id='".mysql_real_escape_string($_REQUEST['id'])."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);
if($GetUsersQryRow['username']!=''){$username=stripslashes($GetUsersQryRow['username']);}else{$username=stripslashes($GetUsersQryRow['couponcode']);}

$GetMessagesQryRow = null;

function runMyFunction() {
	echo 'console.log('.$_GET['mailid'].');';
}

if (isset($_GET['mailid'])) {
	runMyFunction();
}
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
				<table width="100%" border="0" cellspacing="3" cellpadding="3">
					<tr>
						<td class="bottmborder_white">
							<br />
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="8%" align="left"><img src="images/icon_email.png" border="0"/></td>
									<td width="80%"><h1 style="text-align:left;">EMAILS</h1></td>
									<td width="10%" align="right"><a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a></td>
								</tr>
							</table>
							<br />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<br />
	<br />
	<div class="dashboard_whitetext" width="100%">
		<div width="95%">

			<div class="dashboard_whitetext" style="display:inline-block;padding-left:5%; width:22%;" >Date</div>
			<div style="width:12%;display:inline-block;" valign="top" class="dashboard_whitetext">From</div>
			<div style="width:5%; display:inline-block" valign="top" class="dashboard_whitetext" >Type</div>
			<div style="width:20%; text-align:right; display:inline-block" valign="top" class="dashboard_whitetext" >MESSAGE</div>
		</div>
		<div style="padding-left:5%; padding-top:10px;">
			<div id="mailListmailList" style="width:40%;display:inline-block; height:300px; overflow:auto;background:white;box-shadow: 0px 0px 15px #000000;">
				<?
								  
				$getHidedusersQryRs=mysql_query("SELECT userid_to FROM users_hide WHERE userid_from='".$_SESSION['UsErIdFrOnT']."'");
				$TotgetHidedusersQryRs=mysql_affected_rows();
				if($TotgetHidedusersQryRs>0)
				{
					while($getHidedusersQryRow=mysql_fetch_array($getHidedusersQryRs))
					{
						$userid_to.=$getHidedusersQryRow['userid_to'].",";
					}
					$userid_to=substr($userid_to,0,-1);
					$andQryHide=" and userid_from not in ($userid_to)";
				}
				$getHidedusersQryRs=mysql_query("SELECT userid_to FROM users_zap WHERE userid_from='".$_SESSION['UsErIdFrOnT']."'");
				$TotgetHidedusersQryRs=mysql_affected_rows();
				if($TotgetHidedusersQryRs>0)
				{
					while($getHidedusersQryRow=mysql_fetch_array($getHidedusersQryRs))
					{
						$userid_to2.=$getHidedusersQryRow['userid_to'].",";
					}
					$userid_to2=substr($userid_to2,0,-1);
					$andQryHide.=" and userid_from not in ($userid_to2)";
				}
				$GetMessagesQryRs=mysql_query("SELECT * FROM users_emails WHERE userid_to='".$_SESSION['UsErIdFrOnT']."' $andQryHide order by id desc");
				$TotGetMessages=mysql_affected_rows();
				if($TotGetMessages>0)
				{
					while($GetMessagesQryRow=mysql_fetch_array($GetMessagesQryRs))
					{
						?>
						<div onclick="LoadEmail(<? echo $GetMessagesQryRow['id']?>); mailSelected=<?echo $GetMessagesQryRow['id']?>; typeMailSelected=<?echo "'".$GetMessagesQryRow['TYPE']."'"?>;verifyTypeMail();"  style="display:inline-block; cursor:pointer; background:#210C08; height:45px; width:100%;border-bottom: 1px solid white; padding-top:5px;">
							<div align="left" style="padding-left:6px; display:inline-block;"><? echo date("M d", strtotime($GetMessagesQryRow['createdate']));?></div>
							<div align="center" valign="center" style="padding-left:3px;width:58%;display:inline-block;"><? echo GetUserName($GetMessagesQryRow['userid_from']);?></div>
							<div align="left" valign="center" style="display:inline-block;  padding-right:10px;margin-top:3px;" ><? echo GetMessageTypeIcon($GetMessagesQryRow['TYPE']);?></div>
											
							<div style="align:right; display:inline-block;border: 1px solid white;align:center;">
								<input id="<?echo $GetMessagesQryRow['id'];?>" style="float:right;border: 1px solid white;" type="checkbox" name="checks[]" ></div>
						</div>

					<? }?>
				<? } else {?>
					<div>
						<div align="left" colspan="2" valign="top" height="35">No messages.</div>
					</div>
				<? }?>
			</div>
			<div style="display:inline-block;float:right;width:53%;padding-right:4% ;height:430px;">

				<div align="left" style="background-color:#FFFFFF;box-shadow: 0px 0px 15px #000000;">
					<div style="padding:3px; width:100%; height:100%;" id="EMailBody">
						<table width="100%" height="100%" border="0" cellspacing="2" cellpadding="2">
							<tr>
								<td>Please select message from left side.</td>
							</tr>
						</table>
					</div>
				</div>
				<div>
					<img id="haloIcon" onclick="promptChat()" style="    width: 18%;border: solid 3px;margin-top: 15px; float: right; display: none;" src="images/halo_glint_transp.png" alt=""/>
					<img id="bombIcon" onclick="hideUser()" style="    width: 18%;border: solid 3px;margin-top: 15px; float: right; display: none;" src="images/bomb_expl_transp.png" alt=""/>
				</div>
			</div>
			<br />
			<div style="width:40%; height:80px;  font-size:35; padding-top:50;">
				<div style="height:80px;width:49%;display:inline-block;">
					
					 <a href="#"  onclick="DeleteEmailList();">
                                    <img src="images/button_delete.png" border="0" style="width:100%;" >
                                    </a>
				</div>
				<div  style="height:80px;width:48.1%;display:inline-block;">
					 <a href="#"  onclick="reply(mailSelected);">
                                    <img src="images/button_reply.png" border="0" style="width:100%;" >
                                    </a>
				</div>
			</div>

</div>
	</div>

</form>	
</body>
</html>