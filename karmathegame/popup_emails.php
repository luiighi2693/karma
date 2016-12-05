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
	<link href="css/style_popups.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
</head>
<body style="text-align:center;">
<form name="frmpopup" id="frmpopup" enctype="multipart/form-data" method="post" style="font-size: 2vh;">
	<div class="header">
		<div class="top_info">
			<div class="icon_holder">
				<img src="images/icon_email.png" border="0" alt="">
			</div>
			<div class="text_holder">
				EMAIL
			</div>
			<div class="icon_holder"style="float:right;">
				<a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a>
			</div>
		</div>
	</div>

	<div class="middlesection">
		<div class="centered_info" style="color: white; display: flex;">
			<div style="width: 40%; margin-right: 5%;">
				<div style="width: 100%;     display: flex;margin: 1%;">
					<div style="width:33%; text-align: center" >Date</div>
					<div style="width:33%; text-align: center">From</div>
					<div style="width:33%; text-align: center">Type</div>
				</div>
				<div id="mailList" style="width:100%;height: 70%; overflow:auto;background:white;box-shadow: 0px 0px 15px #000000;">
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
							<div onclick="LoadEmail(<? echo $GetMessagesQryRow['id']?>); mailSelected=<?echo $GetMessagesQryRow['id']?>; typeMailSelected=<?echo "'".$GetMessagesQryRow['TYPE']."'"?>;verifyTypeMail();"  style="cursor:pointer; background:#210C08; height:45px; width:100%;border-bottom: 1px solid white;padding-top: 1%; display: flex;">
								<div style="text-align: center;width: 33%;"><? echo date("M d", strtotime($GetMessagesQryRow['createdate']));?></div>
								<div style="text-align: center;width: 33%;"><? echo GetUserName($GetMessagesQryRow['userid_from']);?></div>
								<div style="text-align: center;width: 33%;">
									<? echo GetMessageTypeIcon($GetMessagesQryRow['TYPE']);?>
									<input id="<?echo $GetMessagesQryRow['id'];?>" type="checkbox" name="checks[]" >
								</div>
							</div>

						<? }?>
					<? } else {?>
						<div>
							No messages.
						</div>
					<? }?>
				</div>
				<div style="width:100%; height:30%;  font-size:3vh;display: inline-block;margin-top: 3%;">
					<a href="#"  onclick="DeleteEmailList();">
						<img src="images/button_delete.png" border="0" style="width:30%;" >
					</a>
					<a href="#"  onclick="reply(mailSelected);">
						<img src="images/button_reply.png" border="0" style="width:30%;" >
					</a>
				</div>
			</div>
			<div style="width: 55%; display: block;">
				<div style="width:100%; text-align: center" >MESSAGE</div>
				<div align="left" style="background-color:#FFFFFF;box-shadow: 0px 0px 15px #000000;">
					<div style="padding:1%; width:100%; height:100%; color: #000;" id="EMailBody">
						Please select message from left side.
					</div>
				</div>
				<div>
					<img id="haloIcon" onclick="promptChat()" style="width: 10%;border: solid 1px;margin-top: 1%;float: right;display: none;" src="images/halo_glint_transp.png" alt=""/>
					<img id="bombIcon" onclick="hideUser()" style="width: 10%;border: solid 1px;margin-top: 1%;float: right;display: none;" src="images/bomb_expl_transp.png" alt=""/>
				</div>
			</div>
		</div>
	</div>

	<div class="footer"></div>
</form>	
</body>
</html>